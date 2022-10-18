# Camagru
This project is about building a photo-gallery web application that allows users to _make_, _share_ and _react to_ basic photo and video edits with a webcam and some predefined images (stickers).
  In my implementation editing is displayed in a live preview.
  
  As with any other 42 project, there were some constraints:
* It had to be written in PHP.
* Every framework, micro-framework or library that you don’t create are totally forbidden (except for CSS frameworks that don’t need JavaScript).
* Final superposing of stickers had to happen on the server-side.


## Technologies used:

1. Client-side: CSS, HTML, BootStrap, JavaScript Vanilla (Fetch API, FileReader API, FormData API, Media Capture and Streams API and Canvas API),
2. Server-side: PHP (Standard Library), MariaDB
3. Deployment: MAMP local Apache server

## Functionality:

1. **new_post.php**
- users are able to take pictures with a webcamera and upload images,
- apply (also move/remove) stickers to to the pictures (taken/uploaded) in a live preview,
- see all previous posts of the logged-in user
2. **feed.php**
- see all posts (uploaded pictures with descriptions, likes and comments),
- possibility to like, comment posts,
- delete own: posts, likes and comments,
3. **other pages**
- subsribe/unsubscribe to notifications about new comments on own posts,
- register, login, logout, recover/change password, change email, username, delete account etc. (with activation links and tokens for password reset being sent to email).
  
## Security measures and other features:

- abstracted module for sanitization and validation of inputs (**XSS attacks**)
- PDO MySQL bindings (**SQL injections**)
- session regeneration (**Session Fixation**)
- **hashing and 1-way encryption** of passwords and tokens
- get->post->get system (to avoid accidental double post request)
- flushing of messages, inputs and errors,
- ajaxified posting, liking, commenting and pagination

## Design:

**MVC (model - view - controller) approach was attempted.**
- root directory containes the VIEW part (witch some additional VIEW components in src/inc/ directory).
- server-side CONTROLLER and MODEL are located in SRC and CONFIG folders. 
- most controller files are coupled to their VIEW counterparts.
- additionaly, there are separate blocks dedicated for general usage by multiple pages. 
- all of the general blocks are connected in bootstrap.php.
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
