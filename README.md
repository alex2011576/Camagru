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

## SCREENSHOTS

### Desktop

![Screen Shot 2022-10-18 at 18 24 26](https://user-images.githubusercontent.com/84226106/196474068-f6b72817-fdc0-44dc-a09c-e050a48bfcc0.png)
![Screen Shot 2022-10-18 at 18 24 18](https://user-images.githubusercontent.com/84226106/196474069-69c3a598-db4b-44dc-bb02-775f10778771.png)
![Screen Shot 2022-10-18 at 18 24 10](https://user-images.githubusercontent.com/84226106/196474084-0b60be8e-7931-4e15-b52f-e9ce2a2b6c1f.png)
![Screen Shot 2022-10-18 at 18 17 03](https://user-images.githubusercontent.com/84226106/196477428-cbeba8b9-d1dd-49f6-b09d-f5dc3c04ca99.png)
![Screen Shot 2022-10-18 at 18 14 15](https://user-images.githubusercontent.com/84226106/196474151-47eae18a-f3f0-46d5-b4a8-99cd5e9cdc4c.png)
![Screen Shot 2022-10-18 at 18 08 47](https://user-images.githubusercontent.com/84226106/196474186-b3a69929-5e80-41c9-9e24-303455246299.png)
![Screen Shot 2022-10-18 at 18 10 52](https://user-images.githubusercontent.com/84226106/196474207-fd6af580-7e94-4d6a-a8dc-fb3472c534e5.png)
![Screen Shot 2022-10-18 at 18 08 12](https://user-images.githubusercontent.com/84226106/196474124-49dd4e34-5d28-457e-9b7f-5418f8840718.png)

### Mobile
![Screen Shot 2022-10-18 at 18 19 38](https://user-images.githubusercontent.com/84226106/196476130-ae697b87-a682-4f70-b9bc-b3f8f2dc9d68.png)
  
![Screen Shot 2022-10-18 at 18 20 19](https://user-images.githubusercontent.com/84226106/196476795-a036cbfe-4409-4703-914e-fb72cd546953.png)
  
![Screen Shot 2022-10-18 at 18 18 17](https://user-images.githubusercontent.com/84226106/196474612-0fb7038e-ada3-460b-8f2e-c99b1db1285c.png)
  
![Screen Shot 2022-10-18 at 18 17 45](https://user-images.githubusercontent.com/84226106/196474690-7665a2cf-6998-462b-9c9a-889f9e3a7394.png)
  
![Screen Shot 2022-10-18 at 18 23 20](https://user-images.githubusercontent.com/84226106/196474380-ff64fc7d-9247-4aef-b087-ee4731ea1f3f.png)
  
![Screen Shot 2022-10-18 at 18 23 41](https://user-images.githubusercontent.com/84226106/196474440-f751879c-1337-49b5-9f3d-a123cf6f001f.png)
  
![Screen Shot 2022-10-18 at 18 23 53](https://user-images.githubusercontent.com/84226106/196474461-eb877bbb-0d71-4eb7-8d8c-569717db05b2.png)
  
![Screen Shot 2022-10-18 at 18 21 06](https://user-images.githubusercontent.com/84226106/196474498-83cbeefd-beda-4c84-9657-1e40a25e6547.png)
