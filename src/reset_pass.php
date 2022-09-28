<?php
if (is_post_request()) {
    $fields = [
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password'
    ];
    // custom messages
    $messages = [
        'password2' => [
            'required' => 'Please enter the password again',
            'same' => 'The password does not match'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    if ($errors) {

        redirect_with('reset_pass.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    if (reset_password($_SESSION['user_id'], $inputs['password'])) {

        unset($_SESSION['username'], $_SESSION['user_id'], $_SESSION['password_reset']);
        //maybe not to not break flash
        //session_destroy();
        redirect_with_message(
            'login.php',
            'Your password has been successfully updated!'
        );
    }
    //maybe some error handling
}
if (is_get_request()) {
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && $_SESSION['password_reset'] === 1) {
        [$inputs, $errors] = session_flash('inputs', 'errors');
    } else {

        [$inputs, $errors] = filter($_GET, [
            'email' => 'string | required | email',
            'reset_code' => 'string | required'
        ]);

        if (!$errors) {
            // var_dump($inputs);
            // die();
            $user = find_unrecovered_user($inputs['reset_code'], $inputs['email']);
            // var_dump($user);
            // die();
            // if user exists and reset_code is correct
            if ($user) {
                //INSTEAD SHOULD SEND TO FORM FOR CHANGING PASSWORD
                redirect_with('reset_pass.php', [
                    'user_id' => $user['user_id'],
                    'password_reset' => 1,
                    'inputs' => $inputs,
                    'errors' => $errors
                ]);
            }
        }
        redirect_with_message(
            'forgot_pass.php',
            'The password_reset link is not valid anymore. Please, request password reset again.',
            FLASH_ERROR
        );
    }
    // sanitize the email & activation code
}

// redirect to the register page in other cases
// redirect_with_message(
//     'forgot_pass.php',
//     'The password_reset link is not valid anymore. Please, request password reset again.',
//     FLASH_ERROR
// );
