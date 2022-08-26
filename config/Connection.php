<?php

require_once 'database.php';

class Connection
{
	public static function make($DB_DSN, $DB_USER, $DB_PASSWORD)
	{
		//$DB_DSN = "mysql:host=$host;dbname=$db;charset=UTF8";

		try {
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

			return new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}

return Connection::make($DB_DSN, $DB_USER, $DB_PASSWORD);