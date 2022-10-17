<?php

if (!is_user_logged_in()) {
    redirect_to('login.php');
}

$errors = [];
$inputs = [];

if (is_post_request()) {

    $pre_fields = [
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
    //might be better perfomance wise to hardcode fileds for ech form to avoid repetetive filter
    $fields = array_filter(
        $pre_fields,
        fn ($key) => isset($_POST[$key]),
        ARRAY_FILTER_USE_KEY
    );

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    if ($errors) {

        redirect_with('settings.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    // var_dump($_POST);
    // die();
    if (isset($_POST['change_email'])) {
        // var_dump($_SESSION['user_id']);
        // die();
        $user = find_user_by_username($_SESSION['username']);
        if ($user && is_user_active($user) && password_verify($inputs['password'], $user['password'])) {
            // var_dump($_SESSION['user_id']);
            // die();
            if (!change_email($inputs['new_email'], $_SESSION['user_id'])) {
                redirect_to('error.php');
            }
            redirect_with_message(
                'settings.php',
                'Email was changed successfully'
            );
        } else {
            redirect_with_message(
                'settings.php',
                'Wrong Password!',
                FLASH_ERROR
            );
        }
    }
    if (isset($_POST['change_username'])) {
        // var_dump($_SESSION['user_id']);
        // die();
        $user = find_user_by_username($_SESSION['username']);
        // var_dump($user);
        // var_dump($inputs);
        // die();
        if ($user && is_user_active($user) && password_verify($inputs['password'], $user['password'])) {
            // var_dump($_SESSION['user_id']);
            // die();
            if (!change_username($inputs['new_username'], $_SESSION['user_id'])) {
                redirect_to('error.php');
            }
            $_SESSION['username'] = $inputs['new_username'];
            redirect_with_message(
                'settings.php',
                'Username was changed successfully'
            );
        } else {
            redirect_with_message(
                'settings.php',
                'Wrong Password!',
                FLASH_ERROR
            );
        }
    }
    if (isset($_POST['change_password'])) {
        // var_dump($_SESSION['user_id']);
        // die();
        $user = find_user_by_username($_SESSION['username']);
        // var_dump($user);
        // var_dump($inputs);
        // die();
        if ($user && is_user_active($user) && password_verify($inputs['password'], $user['password'])) {
            // var_dump($_SESSION['user_id']);
            // die();
            if (!reset_password($_SESSION['user_id'], $inputs['new_password'])) {
                redirect_to('error.php');
            }
            redirect_with_message(
                'settings.php',
                'Password was changed successfully'
            );
        } else {
            redirect_with_message(
                'settings.php',
                'Wrong Password!',
                FLASH_ERROR
            );
        }
    }
    if (isset($_POST['delete_account'])) {
        // var_dump($_SESSION['user_id']);
        // die();
        $user = find_user_by_username($_SESSION['username']);
        // var_dump($user);
        // var_dump($inputs);
        // die();
        if ($user && is_user_active($user) && password_verify($inputs['password'], $user['password'])) {
            // var_dump($_SESSION['user_id']);
            // die();
            if (!delete_account($_SESSION['user_id'])) {
                redirect_to('error.php');
            }
            session_unset();
            session_destroy();
            //session_write_close();
            //setcookie(session_name(), '', 0, '/');
            session_start();
            session_regenerate_id();

            redirect_with_message(
                'register.php',
                'You account has been successfully deleted! We are sorry to lose you :(',
                FLASH_WARNING
            );
        } else {
            redirect_with_message(
                'settings.php',
                'Wrong Password!',
                FLASH_ERROR
            );
        }
    }

    if (isset($_POST['sub'])) {
        $sub_v = filter_var($_POST["sub"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        if (!is_numeric($sub_v)) {
            die(json_encode(["error" => "BAD BAD BOY!"]));
        }
        if (!change_subscription($sub_v, $_SESSION['user_id'])) {
            die(json_encode(["error" => ":("]));
        }
        die(json_encode(["success" => ":)"]));
    }

    //maybe some error handling
} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
    if (check_notifications_status($_SESSION['user_id']) == 1) {
        $inputs['sub'] = 1;
    } else {
        $inputs['sub'] = 2;
    }
}
