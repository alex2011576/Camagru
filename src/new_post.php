<?php

if (!is_user_logged_in()) {
    redirect_to('login.php');
}
