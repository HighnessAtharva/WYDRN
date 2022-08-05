import lodashThrottle from "https://cdn.skypack.dev/lodash.throttle@4.1.1";

const scrollContainer = document.querySelector('[data-scroller]')
const sections = gsap.utils.toArray('section')
const track = document.querySelector('[data-draggable]')
const navLinks = gsap.utils.toArray('[data-link]')
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)')

const lastItemWidth = () => navLinks[navLinks.length - 1].offsetWidth

const getUseableHeight = () => document.documentElement.offsetHeight - window.innerHeight

const getDraggableWidth = () => {
	return ((track.offsetWidth * 0.5) - lastItemWidth())
}

const updatePosition = () => {
	const left = track.getBoundingClientRect().left * -1
	const width = getDraggableWidth()
	const useableHeight = getUseableHeight()
	const y = gsap.utils.mapRange(0, width, 0, useableHeight, left)

	st.scroll(y)
}

const tl = gsap.timeline()
	.to(track, {
		x: () => getDraggableWidth() * -1,
		ease: 'none'
	})

const st = ScrollTrigger.create({
	animation: tl,
	scrub: 0,
})

const draggableInstance = Draggable.create(track, {
	type: 'x',
	inertia: true,
	bounds: {
		minX: 0,
		maxX: getDraggableWidth() * -1
	},
	edgeResistance: 1,
	onDragStart: () => st.disable(),
	onDragEnd: () => st.enable(),
	onDrag: updatePosition,
	onThrowUpdate: updatePosition
})

const initSectionAnimation = () => {
	/* Do nothing if user prefers reduced motion */
	if (prefersReducedMotion.matches) return
	
	sections.forEach((section, index) => {
		const heading = section.querySelector('h2')
		const image = section.querySelector('.section__image')
		
		/* Set animation start state */
		gsap.set(heading, {
			opacity: 0,
			y: 50
		})
		gsap.set(image, {
			opacity: 0,
			rotateY: 15
		})

		/* Create the timeline */
		const sectionTl = gsap.timeline({
			scrollTrigger: {
				trigger: section,
				start: () => 'top center',
				end: () => `+=${window.innerHeight}`,
				toggleActions: 'play reverse play reverse',
				// toggleClass: 'is-active',
				// markers: true,
			}
		})
		
		/* Add tweens to the timeline */
		sectionTl.to(image, {
			opacity: 1,
			rotateY: -5,
			duration: 6,
			ease: 'elastic'
		})
		.to(heading, {
			opacity: 1,
			y: 0,
			duration: 2
		}, 0.5)
		
		/* Create a new timeline to add an active class to the nav link for the current section */
		const sectionTl2 = gsap.timeline({
			scrollTrigger: {
				trigger: section,
				start: 'top 20px',
				end: () => `bottom top`,
				toggleActions: 'play none play reverse',
				onToggle: ({ isActive }) => {
					const sectionLink = navLinks[index]
					
					if (isActive) {
						sectionLink.classList.add('is-active')
					} else {
						sectionLink.classList.remove('is-active')
					}
				}
			}
		})
	})
}

initSectionAnimation()

/* Allow navigation via keyboard */
track.addEventListener('keyup', (e) => {
	const id = e.target.getAttribute('href')
	if (!id || e.key !== 'Tab') return
	
	const section = document.querySelector(id)
	const y = section.getBoundingClientRect().top + window.scrollY
	
	st.scroll(y)
})