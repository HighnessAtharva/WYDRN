**Support me here if you liked this!**
[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://www.buymeacoffee.com/AtharvaShah)

# Overview

WYDRN is a Social Networking website where you can track your movies, tv, games, books and music. Match your interests with your friends and export your media items. I aim to develop it to provide a centralized platform to track all your favorite media instead of using multiple platforms like IMDB, Goodreads, Steam, RateYourMusic and TVTime. One platform to rule them all.

# Usage

The site is not deployed currently so you can't get a live preview but you can try it out on `localhost`.

## Installing on Local Machine

- Clone this repository/download the ZIP file in `C:/xampp/htdocs`
- Launch Xampp. Start Apache and MySQL services.

- Fire up your browser and navigate to -> [PHPMyAdmin](localhost/phpmyadmin)
![1](https://user-images.githubusercontent.com/68660002/180612573-c1856eff-3217-45cb-adf9-69ed1034ab0c.JPG)

- Create New Database and call it `wydrn`
![2](https://user-images.githubusercontent.com/68660002/180612577-f9cb6a98-6a1e-4ed2-9088-3a5913b8aefd.JPG)

- Click the created database in the left panel and then head to the `Import` tab. The SQL file is `SQL/wydrn.sql` in the repository itself. Import it.
![3](https://user-images.githubusercontent.com/68660002/180612580-d657f747-3708-4bb9-9582-6d4d48427efd.JPG)

- Verify that the database tables and their content have been imported successfully. Now you can explore the web application.
![4](https://user-images.githubusercontent.com/68660002/180612581-0bcc3930-d4da-41a9-8407-f96ce678efde.JPG)

- Fire up your browser and navigate to -> [WYDRN](http://localhost/WYDRN/login.php)
![5](https://user-images.githubusercontent.com/68660002/180612842-7a10aeb5-d734-4d85-a2da-2b5a3ece72b9.JPG)

- A guest account with `username` : `dev` and `password` : `deadlines` is already made avaiable for your usage. Login with it.
- For Load Testing use username `spammer` with password `hellohi123`.
- Admin Account: `username`:`admin` & `pass`:`godmodeon`
- You can now add media, export your media, search for other users and see your mutual medias.

## [Documentation](https://github.com/HighnessAtharva/WYDRN/wiki/Documentation)

## [Project Plan Board](https://github.com/users/HighnessAtharva/projects/1)

## Known Issues

- During CSV imports-> inserts the '?' character in the database when UTF-8 characters are present (Roman, Japanese, Latin, Greek)
- On Welcome.php Movies Section will not populate the input field while selecting when dropdown options are <2
- Diary and Export CSV pages will show a blank row when the last modified change done by the user is a clear profile page.
- On Browse Movies and TV pages sometimes the movie details will not load after making a selection from the dropdown.
- PDF exports are not UTF-8 safe.

## ToDo Checks

- All images must have alternate text
- Add Meta Description, Meta Keyword to all files. (<https://www.webfx.com/blog/web-design/20-html-best-practices-you-should-follow>)
- All image tags must be self-closed
- Minify CSS files using <https://www.cssportal.com/css-optimize/>
- add mysqli_real_escape_string() at all the places where data is being stored from forms or from GET/POST request methods.
