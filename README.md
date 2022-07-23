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
- Verify that the database tables and their content have been imported successfully. Now you can explore the web applicatio
![4](https://user-images.githubusercontent.com/68660002/180612581-0bcc3930-d4da-41a9-8407-f96ce678efde.JPG)

## Usage
- Fire up your browser and navigate to -> [WYDRN](http://localhost/WYDRN/login.php)
![5](https://user-images.githubusercontent.com/68660002/180612842-7a10aeb5-d734-4d85-a2da-2b5a3ece72b9.JPG)

- A guest account with `username` : `dev` and `password` : `deadlines` is already made avaiable for your usage. Login with it.
- You can now add media, export your media, search for other users and see your mutual medias. 

Please star this repository if you found this project helpful.
