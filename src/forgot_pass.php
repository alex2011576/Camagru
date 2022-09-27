<?php

if (is_user_logged_in()) {
    redirect_to('feed.php');
}

$inputs = [];
$errors = [];

if (is_post_request()) {

    [$inputs, $errors] = filter($_POST, [
        'identifier' => 'string | required'
    ]);

    if ($errors) {
        redirect_with('forgot_pass.php', ['errors' => $errors, 'inputs' => $inputs]);
    }

    // if no user like that
    if (!recover_user($inputs['identifier'])) {

        $errors['identifier'] = 'No user with such username or email';

        redirect_with('forgot_pass.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }

    // activation code sent 
    redirect_with_message(
        'login.php',
        'Please check your email to reset your password'
    );
} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
