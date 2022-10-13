<?php

/**
 * Register a user
 *
 * @param string $email
 * @param string $username
 * @param string $password
 * @param bool $is_admin
 * @return bool
 */
function register_user(string $email, string $username, string $password, string $activation_code, int $expiry = 1 * 24  * 60 * 60, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin, activation_code, activation_expiry)
            VALUES(:username, :email, :password, :is_admin, :activation_code,:activation_expiry)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);
    $statement->bindValue(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
    $statement->bindValue(':activation_expiry', date('Y-m-d H:i:s',  time() + $expiry));

    try {
        return $statement->execute();
    } catch (PDOException $e) {
        echo "registration failed";
        die($e->getMessage());
    }
}

/**
 * Find a user by username,
 * return asocciative array[username, password] or false.
 * 
 * @param string $username
 * @return mixed
 */
function find_user_by_username(string $username): mixed
{
    $sql = 'SELECT user_id, username, password, active, email
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Find a user by username or email,
 * return asocciative array[username, password] or false.
 * 
 * @param string $username
 * @return mixed
 */
function find_user_by_identifier(string $identifier): mixed
{
    $sql = 'SELECT user_id, username, password, active, email
            FROM users
            WHERE email=:email OR username =:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $identifier, PDO::PARAM_STR);
    $statement->bindValue(':email', $identifier, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Return true if the user is logged in
 *
 * @return boolean
 */
function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}

/**
 * Redirect to login.php if user is not logged in
 *
 * @return void
 */
function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_to('login.php');
    }
}

/**
 * Log out and redirect to login.php
 *
 * @return void
 */
function logout(): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
        redirect_to('login.php');
    }
}

/**
 * Log in a user
 *
 * @param string $username
 * @param string $password
 * @return boolean
 */
function login(string $username, string $password): bool
{
    $user = find_user_by_username($username);

    // if user found, check the password
    if ($user && is_user_active($user) && password_verify($password, $user['password'])) {

        // prevent session fixation attack
        session_regenerate_id();

        // set username in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id']  = $user['user_id'];


        return true;
    }

    return false;
}

/**
 * Check if the user is activated
 *
 * @return boolean
 */
function is_user_active($user): bool
{
    return (int)$user['active'] === 1;
}

function generate_activation_code(): string
{
    return bin2hex(random_bytes(16));
}


function send_activation_email(string $email, string $activation_code): void
{
    // create the activation link
    $activation_link = APP_URL . "/activate.php?email=$email&activation_code=$activation_code";

    // set email subject & body
    $subject = 'Please activate your account';
    $message = <<<MESSAGE
            Hi,
            Please click the following link to activate your account:
            $activation_link
            MESSAGE;
    // email header
    $header = "From:" . SENDER_EMAIL_ADDRESS;

    // send the email
    // var_dump($email);
    // var_dump($message);
    // var_dump($activation_link);
    // var_dump($header);
    // die();
    mail($email, $subject, nl2br($message), $header);
}

function send_pass_reset_email(string $email, string $activation_code): void
{
    // create the activation link
    $activation_link = APP_URL . "/reset_pass.php?email=$email&reset_code=$activation_code";

    // set email subject & body
    $subject = 'Please, reset password for your account';
    $message = <<<MESSAGE
            Hi,
            Please click the following link to reset password for your account:
            $activation_link
            MESSAGE;
    // email header
    $header = "From:" . SENDER_EMAIL_ADDRESS;

    // send the email
    // var_dump($email);
    // var_dump($message);
    // var_dump($activation_link);
    // var_dump($header);
    // die();
    mail($email, $subject, nl2br($message), $header);
}

function delete_user_by_id(int $id, int $active = 0)
{
    $sql = 'DELETE FROM users
            WHERE user_id=:user_id and active=:active';

    $statement = db()->prepare($sql);
    $statement->bindValue(':user_id', $id, PDO::PARAM_INT);
    $statement->bindValue(':active', $active, PDO::PARAM_INT);

    return $statement->execute();
}

function find_unverified_user(string $activation_code, string $email)
{

    $sql = 'SELECT user_id, activation_code, activation_expiry < now() as expired
            FROM users
            WHERE active = 0 AND email=:email';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    // var_dump($activation_code);
    // var_dump($user['activation_code']);
    // var_dump($email);
    // var_dump($user);
    // die();
    if ($user) {
        // already expired, delete the in active user with expired activation code
        if ((int)$user['expired'] === 1) {
            delete_user_by_id($user['user_id']);
            return null;
        }
        // verify the password
        if (password_verify($activation_code, $user['activation_code'])) {
            return $user;
        }
    }
    // var_dump($user);
    // die();
    return null;
}

function activate_user(int $user_id): bool
{
    $sql = 'UPDATE users
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE user_id=:user_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    return $statement->execute();
}

/**
 * Check if user exists and create a request to reset user password
 *
 * @param string $identifier
 * @return boolean
 */
function recover_user(string $identifier): bool
{
    $user = find_user_by_identifier($identifier);

    if ($user && is_user_active($user)) {

        $reset_code = generate_activation_code();

        if (request_reset_password($user['user_id'], $user['email'], $reset_code)) {
            send_pass_reset_email($user['email'], $reset_code);
        } else {
            return false;
        }

        // echo $reset_code;
        // die();

        return true;
    }

    return false;
}


/**
 * Request_reset_password
 *
 * @param int $user_id
 * @param string $email
 * @param string $reset_code
 * @param int $expiry
 * @return bool
 */
function request_reset_password(int $user_id, string $email, string $reset_code, int $expiry = 30 * 60): bool
{
    $sql = 'INSERT INTO password_reset(user_id, email, reset_code, reset_expiry)
            VALUES(:user_id, :email, :reset_code, :reset_expiry)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':reset_code', password_hash($reset_code, PASSWORD_DEFAULT));
    //$statement->bindValue(':reset_code', $reset_code);
    $statement->bindValue(':reset_expiry', date('Y-m-d H:i:s',  time() + $expiry));

    try {
        return $statement->execute();
    } catch (PDOException $e) {
        echo "registration failed";
        die($e->getMessage());
    }
}

/**
 * Reset password
 *
 * @param int $user_id
 * @param string $password
 * @return bool
 */
function reset_password(int $user_id, string $new_password): bool
{
    $sql = 'UPDATE  users
            SET password = :new_password
            WHERE user_id = :user_id';

    $statement = db()->prepare($sql);

    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':new_password', password_hash($new_password, PASSWORD_BCRYPT));

    return $statement->execute();
}

function find_unrecovered_user(string $reset_code, string $email)
{

    $sql = 'SELECT id, user_id, email, reset_code, reset_expiry < now() as expired
            FROM password_reset
            WHERE email=:email
            ORDER BY id DESC LIMIT 1';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    // var_dump($activation_code);
    // var_dump($user['activation_code']);
    // var_dump($email);
    // var_dump($user);
    // die();
    if ($user) {
        // already expired, delete the inactive request with expired reset code
        if ((int)$user['expired'] === 1) {
            dlt_reset_rqst_by_email($user['email']);
            return null;
        }
        // verify the token 
        // var_dump($reset_code);
        // var_dump($user['reset_code']);
        // var_dump(password_verify($reset_code, $user['reset_code']));
        // die();
        if (password_verify($reset_code, $user['reset_code'])) {
            dlt_reset_rqst_by_email($user['email']);
            return $user;
        }
        // echo "Here";
        // die();
    }
    // var_dump($user);
    // die();
    return null;
}


function dlt_reset_rqst_by_email(string $email): bool
{
    $sql = 'DELETE FROM password_reset
            WHERE email=:email';

    $statement = db()->prepare($sql);
    $statement->bindValue(':email', $email);

    return $statement->execute();
}

function change_email(string $email, int $user_id): bool
{
    $sql = 'UPDATE  users
    SET email = :email
    WHERE user_id = :user_id';

    $statement = db()->prepare($sql);

    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':email', $email);

    return $statement->execute();
}

function change_username(string $username, int $user_id): bool
{
    $sql = 'UPDATE  users
    SET username = :username
    WHERE user_id = :user_id';

    $statement = db()->prepare($sql);

    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':username', $username);

    return $statement->execute();
}

function delete_account(string $user_id): bool
{
    $sql = 'DELETE FROM users
            WHERE user_id = :user_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':user_id', $user_id);

    return $statement->execute();
}

function notifications_status($post_id)
{
    $sql = 'SELECT  users.notifications, users.email
        FROM users
        JOIN posts ON posts.owner_id = users.user_id
        WHERE posts.post_id = :post_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':post_id', $post_id);
    try {
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die();
        // echo json_encode(['error' => $e->getMessage()]);
        //  die($e->getMessage());
    }
}
