<?php
// Path to wp-config.php - adjust the path as necessary
include('path/to/wp-config.php');

// Use the WordPress database constants
$host = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$database_name = DB_NAME;

// Connect to MySQL using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the table prefix from wp-config.php
    $table_prefix = $table_prefix;

    // Define SQL queries with dynamic table names
    $table_name = $table_prefix . 'actionscheduler_actions';
    $logs_table_name = $table_prefix . 'actionscheduler_logs';

    $queries = [
        "DELETE FROM `$table_name` WHERE `status` = 'canceled'",
        "DELETE FROM `$table_name` WHERE `status` = 'failed'",
        "DELETE FROM `$table_name` WHERE `status` = 'complete'",
        // Optionally, clean ActionScheduler logs
        "TRUNCATE TABLE `$logs_table_name`", // This will remove all entries from the logs table
    ];

    foreach ($queries as $query) {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    echo "Database cleanup completed successfully.";
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
