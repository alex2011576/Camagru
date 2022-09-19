<?php

try {
    $conn = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $db_check = $conn->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'mycamagru_db'");
        if ((bool) $db_check->fetchColumn()) {
            return;
        } else {
            try {
                $sql = file_get_contents(__DIR__ . "/init_db.sql");
                $conn->exec($sql);
                // echo "Migrated successfully.";
            } catch (PDOException $e) {
                echo "Migration failed: " . $e->getMessage();
                die();
            }
        }
    } catch (PDOException $e) {
        echo "DB setup failed: " . $e->getMessage();
        die();
    }
} catch (PDOException $e) {
    echo "DB connection failed: " . $e->getMessage();
    die();
}
$db_check = null;
$conn = null;

// $dbc = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
// $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
