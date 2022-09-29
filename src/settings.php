<?php

if (!is_user_logged_in()) {
    redirect_to('login.php');
}

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'new_username' => 'string | required | alphanumeric | between: 3, 15 | unique: users, username',
        'password' => 'string | required',
        'new_email' => 'email | required | email | unique: users, email',
        'new_password' => 'string | required | secure',
        'new_password2' => 'string | required | same: new_password',
        //'agree' => 'string | required'
    ];
    // custom messages
    $messages = [
        'new_password2' => [
            'required' => 'Please enter the password again',
            'same' => 'The password does not match'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    if ($errors) {

        redirect_with('register.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    $activation_code = generate_activation_code();

    if (register_user($inputs['email'], $inputs['username'], $inputs['password'], $activation_code)) {

        // send the activation email
        send_activation_email($inputs['email'], $activation_code);
        // echo $activation_code;
        // die;
        redirect_with_message(
            'login.php',
            'Please check your email to activate your account before signing in'
        );
    }
    //maybe some error handling
} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}
