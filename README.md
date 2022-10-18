# Camagru
Full-stack photo-gallery web application allowing users to make basic photo and video editing using a webcam and some predefined images (stickers). 

## Technologies used:

1. Client-side: CSS, HTML, BootStrap, JavaScript Vanilla (Fetch API, FileReader API, FormData API, Media Capture and Streams API and Canvas API),
2. Server-side: PHP (Standard Library), MariaDB
3. Deployment: MAMP local Apache server

## Functionality:

- users are able to take pictures with a webcamera and upload images,
- apply stickers to to the pictures (taken/uploaded) in a live preview,
- see all uploaded pictures with description (posts) in a feed,
- possibility to like, comment posts,
- delete own posts, likes and comments,
- subsribe/unsubscribe to notifications about new comments on own posts,
- register, login, logout, recover/change password, change email, username, delete account etc. (with activation links and tokens for password reset being sent to email).

## Security measures taken:

- module for scalable and abstracted sanitization and validation of inputs to prevent **XSS attacks **
- PDO SQL bindings against **SQL injections**
- session regeneration to prevent **Session Fixation**
- hashing + 1-way encryption of passwords and tokens
- access limitations

## Design:

**MVC (model - view - controller) approach was attempted.**
- root directory containes the VIEW part (witch some additional VIEW components in src/inc/ directory),
- server-side CONTROLLER and MODEL are located in SRC and CONFIG foldrs. 
- most controller files are coupled to their VIEW counterparts.
- additionaly, there are separate blocks dedicated for general usage by multiple pages. All of the general blocks are connected in bootstrap.php.
- attempted to add scalability and abstraction by creation of a universal system for filtering, santitzation, validation and flushing of inputs and errors. 

## Installation guide

1. install [Bitnami MAMP](https://bitnami.com/stack/mamp)
2. clone this repository to the '.../apache2/htdocs/' derictory in your MAMP install path:
```
git clone https://github.com/alex2011576/Camagru.git Camagru
```
APP_URL is defaulted to 'http://localhost:8080/Camagru/' in 'config/app.php'

3. modify the **$DB_USER** and **$DB_PASSWORD** variables in the file 'config/database.php', with the username and password you provided when installing MAMP
4. start the MariaDB and Apache Web servers using 'manager-osx.app' in the MAMP root folder (Manage Servers -> Start All)
5. configure mail sender for the PHP `mail()` function to work
6. app is ready to use in your browser, using address http://localhost:8080/Camagru
