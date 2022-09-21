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
function register_user(string $email, string $username, string $password, bool $is_admin = false): bool
{
    $activation_code = md5($email . time());
    $sql = 'INSERT INTO users(username, email, password, is_admin, activation_code)
            VALUES(:username, :email, :password, :is_admin, :activation_code)';

    $statement = db()->prepare($sql);
    // var_dump($statement);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);
    $statement->bindValue(':activation_code', $activation_code, PDO::PARAM_STR);

    try {
        return $statement->execute();
    } catch (PDOException $e) {
        echo "registration failed";
        die($e->getMessage());
    }
}
