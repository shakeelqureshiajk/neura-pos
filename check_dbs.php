<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '');
    $databases = ['neurapos1', 'newposdb'];
    
    foreach ($databases as $db) {
        $result = $pdo->query("SHOW DATABASES LIKE '$db'");
        if ($result->rowCount() > 0) {
            $pdo2 = new PDO("mysql:host=127.0.0.1;dbname=$db", 'root', '');
            $tables = $pdo2->query('SHOW TABLES');
            echo "$db: " . $tables->rowCount() . " tables\n";
        } else {
            echo "$db: does not exist\n";
        }
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
