<?php

$errors = [];
$inputs = [];

if (is_post_request()) {
    $fields = [
        'username' => 'string | required | alphanumeric | between: 3, 15 | unique: users, username',
        'email' => 'email | required | email | unique: users, email',
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password',
        //'agree' => 'string | required'
    ];
    // custom messages
    $messages = [
        'password2' => [
            'required' => 'Please enter the password again',
            'same' => 'The password does not match'
        ],
        'agree' => [
            'required' => 'You need to agree to the term of services to register'
        ]
    ];
    // var_dump($_POST);
    // die();
    [$inputs, $errors] = filter($_POST, $fields, $messages);
    //STOPPED HERE!!!!!
    if ($errors) {
        // echo "HERE";
        // var_dump($inputs);
        // die();
        redirect_with('register.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    // echo "HERE";
    // var_dump($inputs);
    // die();
    if (register_user($inputs['email'], $inputs['username'], $inputs['password'])) {
        redirect_with_message(
            'login.php',
            'Your account has been created successfully. Please login here.'
        );
    }
    // echo "HERE";
    // var_dump($inputs);
    // die();
} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}
