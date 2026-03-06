<?php
try {
    echo "Step 1: Connecting to MySQL server...\n";
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '');
    echo "✓ MySQL connection successful\n\n";
    
    echo "Step 2: Checking for neurapos1 database...\n";
    $result = $pdo->query('SHOW DATABASES LIKE "neurapos1"');
    
    if ($result->rowCount() > 0) {
        echo "✓ Database 'neurapos1' EXISTS\n\n";
    } else {
        echo "Database 'neurapos1' DOES NOT EXIST\n";
        echo "Creating database...\n";
        $pdo->exec('CREATE DATABASE neurapos1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        echo "✓ Database created successfully!\n\n";
    }
    
    echo "Step 3: Testing connection to neurapos1 database...\n";
    $pdo2 = new PDO('mysql:host=127.0.0.1;dbname=neurapos1', 'root', '');
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Connection to neurapos1 successful!\n\n";
    
    echo "Step 4: Checking tables...\n";
    $tables = $pdo2->query('SHOW TABLES');
    $count = $tables->rowCount();
    echo "✓ Database has $count tables\n";
    
    echo "\n=== ALL CHECKS PASSED ===\n";
    
} catch (Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
