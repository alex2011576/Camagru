<?php

/**
 * Connect to the database and returns an instance of PDO class
 * or false if the connection fails
 *
 * @return PDO
 */
function db(): PDO
{
    static $pdo;
    global $DB_DSN;
    global $DB_USER;
    global $DB_PASSWORD;

    if (!$pdo) {
        // return new PDO(
        //     $DB_DSN,
        //     $DB_USER,
        //     $DB_PASSWORD,
        //     [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        // );
        try {
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            return new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
