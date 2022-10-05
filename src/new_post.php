<?php

if (!is_user_logged_in()) {
    redirect_to('login.php');
}
const sticker_dir = __DIR__ . '/../static/stickers/';
if (is_post_request()) {
}
