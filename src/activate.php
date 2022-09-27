<?php

if (is_get_request()) {

    // sanitize the email & activation code
    [$inputs, $errors] = filter($_GET, [
        'email' => 'string | required | email',
        'activation_code' => 'string | required'
    ]);

    if (!$errors) {
        $user = find_unverified_user($inputs['activation_code'], $inputs['email']);
        // var_dump($user);
        // die();
        // if user exists and activate the user successfully
        if ($user && activate_user($user['user_id'])) {
            redirect_with_message(
                'login.php',
                'You account has been activated successfully. Please login here.'
            );
        }
    }
}

// redirect to the register page in other cases
redirect_with_message(
    'register.php',
    'The activation link is not valid anymore. Please, register again.',
    FLASH_ERROR
);
