<?php

if (is_get_request()) {

    // sanitize the email & activation code
    [$inputs, $errors] = filter($_GET, [
        'email' => 'string | required | email',
        'reset_code' => 'string | required'
    ]);

    if (!$errors) {
        $user = find_unrecovered_user($inputs['reset_code'], $inputs['email']);
        // var_dump($user);
        // die();
        // if user exists and activate the user successfully
        if ($user) {
            redirect_with_message(
                'passReset_form.php',
                'Your password has been successfully changed. Please login here.'
            );
        }
    }
}

// redirect to the register page in other cases
redirect_with_message(
    'forgot_pass.php',
    'The password_reset link is not valid anymore. Please, request password reset again.',
    FLASH_ERROR
);
