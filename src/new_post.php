<?php

if (!is_user_logged_in()) {
    redirect_to('login.php');
}

// if (is_post_request()) {
//     var_dump($_FILES);
//     var_dump($_POST);
//     die();
// }
