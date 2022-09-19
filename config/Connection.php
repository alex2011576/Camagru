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

	if (!$pdo) {
		return new PDO(
			sprintf("mysql:host=%s;dbname=%s;charset=UTF8", DB_HOST, DB_NAME),
			DB_USER,
			DB_PASSWORD,
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);
	}

	return $pdo;
}






// class Connection
// {
// 	public static function make($DB_DSN, $DB_USER, $DB_PASSWORD)
// 	{
// 		//$DB_DSN = "mysql:host=$host;dbname=$db;charset=UTF8";

// 		try {
// 			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// 			return new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
// 		} catch (PDOException $e) {
// 			die($e->getMessage());
// 		}
// 	}
// }

// return Connection::make($DB_DSN, $DB_USER, $DB_PASSWORD);