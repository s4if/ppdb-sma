<?php

/**
 * Database Connection Diagnostic Script
 * 
 * This script helps diagnose SQLite connection issues in CodeIgniter 4
 */

echo "=== CodeIgniter 4 Database Diagnostic ===\n\n";

// Check PHP version
echo "PHP Version: " . PHP_VERSION . "\n";

// Check if running from CLI
if (PHP_SAPI === 'cli') {
    echo "Running from: CLI\n";
} else {
    echo "Running from: Web Server\n";
}

// Check SQLite3 extension
echo "\n1. Checking SQLite3 Extension:\n";
if (extension_loaded('sqlite3')) {
    echo "   ✓ SQLite3 extension is loaded\n";
    $sqliteVersion = SQLite3::version();
    echo "   SQLite3 Version: " . $sqliteVersion['versionString'] . "\n";
} else {
    echo "   ✗ SQLite3 extension is NOT loaded\n";
    echo "   Install with: apt-get install php-sqlite3 (Ubuntu/Debian)\n";
}

// Check if we're in a CI4 environment
echo "\n2. Checking CodeIgniter Environment:\n";
if (defined('FCPATH')) {
    echo "   ✓ FCPATH defined: " . FCPATH . "\n";
} else {
    echo "   ✗ FCPATH not defined\n";
    // Try to define it for testing
    define('FCPATH', __DIR__ . '/public/');
}

// Load CI4 paths if available
$pathsFile = __DIR__ . '/app/Config/Paths.php';
if (file_exists($pathsFile)) {
    echo "   ✓ Paths config file exists\n";
    require_once $pathsFile;
    if (class_exists('Config\Paths')) {
        $paths = new \Config\Paths();
        echo "   ✓ Paths class loaded\n";
        
        // Check writable path
        $writablePath = $paths->writableDirectory;
        echo "   Writable directory: " . $writablePath . "\n";
        
        if (is_dir($writablePath)) {
            echo "   ✓ Writable directory exists\n";
            if (is_writable($writablePath)) {
                echo "   ✓ Writable directory is writable\n";
            } else {
                echo "   ✗ Writable directory is NOT writable\n";
                echo "   Fix with: chmod -R 755 " . $writablePath . "\n";
            }
        } else {
            echo "   ✗ Writable directory does NOT exist\n";
            echo "   Fix with: mkdir -p " . $writablePath . "\n";
        }
        
        // Check db directory
        $dbPath = $writablePath . 'db';
        echo "\n3. Checking Database Directory:\n";
        echo "   Database directory: " . $dbPath . "\n";
        
        if (is_dir($dbPath)) {
            echo "   ✓ Database directory exists\n";
            if (is_writable($dbPath)) {
                echo "   ✓ Database directory is writable\n";
            } else {
                echo "   ✗ Database directory is NOT writable\n";
                echo "   Fix with: chmod 755 " . $dbPath . "\n";
            }
        } else {
            echo "   ✗ Database directory does NOT exist\n";
            echo "   Fix with: mkdir " . $dbPath . "\n";
            
            // Try to create it
            if (mkdir($dbPath, 0755, true)) {
                echo "   ✓ Created database directory successfully\n";
            } else {
                echo "   ✗ Failed to create database directory\n";
            }
        }
        
        // Check database file
        $dbFile = $dbPath . '/ppdb.sqlite';
        echo "\n4. Checking Database File:\n";
        echo "   Database file: " . $dbFile . "\n";
        
        if (file_exists($dbFile)) {
            echo "   ✓ Database file exists\n";
            if (is_writable($dbFile)) {
                echo "   ✓ Database file is writable\n";
            } else {
                echo "   ✗ Database file is NOT writable\n";
                echo "   Fix with: chmod 664 " . $dbFile . "\n";
            }
        } else {
            echo "   - Database file does not exist (this is OK for first run)\n";
            
            // Test if we can create it
            try {
                $testDb = new SQLite3($dbFile);
                echo "   ✓ Can create database file\n";
                $testDb->close();
                // Remove the test file
                unlink($dbFile);
            } catch (Exception $e) {
                echo "   ✗ Cannot create database file: " . $e->getMessage() . "\n";
            }
        }
        
    } else {
        echo "   ✗ Paths class not found\n";
    }
} else {
    echo "   ✗ Paths config file not found\n";
}

// Check .env file
echo "\n5. Checking Environment Configuration:\n";
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    echo "   ✓ .env file exists\n";
    
    // Load and parse .env
    $envContent = file_get_contents($envFile);
    $lines = explode("\n", $envContent);
    
    $dbConfig = [];
    foreach ($lines as $line) {
        if (strpos($line, 'database.') === 0 && strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $dbConfig[trim($key)] = trim($value, " '\t\n\r\0\x0B\"");
        }
    }
    
    if (!empty($dbConfig)) {
        echo "   Database configuration found:\n";
        foreach ($dbConfig as $key => $value) {
            echo "     $key = $value\n";
        }
        
        // Check DSN
        if (isset($dbConfig['database.default.DSN'])) {
            $dsn = $dbConfig['database.default.DSN'];
            echo "   ✓ DSN found: $dsn\n";
            
            // Check if WRITEPATH is in DSN
            if (strpos($dsn, 'WRITEPATH') !== false) {
                echo "   ✓ DSN uses WRITEPATH constant\n";
            } else {
                echo "   ⚠ DSN does not use WRITEPATH constant\n";
            }
        }
    } else {
        echo "   ✗ No database configuration found in .env\n";
    }
} else {
    echo "   ✗ .env file does not exist\n";
    echo "   Copy env to .env and configure it\n";
}

// Test actual database connection if we can
echo "\n6. Testing Database Connection:\n";
try {
    // Try to load CI4 if available
    if (file_exists($pathsFile)) {
        require_once $pathsFile;
        $paths = new \Config\Paths();
        
        // Define WRITEPATH for testing
        if (!defined('WRITEPATH')) {
            define('WRITEPATH', $paths->writableDirectory);
        }
        
        // Load database config
        $dbConfigFile = $paths->appDirectory . '/Config/Database.php';
        if (file_exists($dbConfigFile)) {
            require_once $dbConfigFile;
            
            if (class_exists('Config\Database')) {
                $db = new \Config\Database();
                echo "   ✓ Database config loaded\n";
                
                // Try to connect
                $defaultGroup = $db->default;
                echo "   Default group: " . print_r($defaultGroup, true) . "\n";
                
                if ($defaultGroup['DBDriver'] === 'SQLite3') {
                    $dbPath = WRITEPATH . 'db/ppdb.sqlite';
                    echo "   Attempting to connect to: $dbPath\n";
                    
                    $connection = new SQLite3($dbPath);
                    echo "   ✓ Database connection successful!\n";
                    $connection->close();
                } else {
                    echo "   ⚠ Not using SQLite3 driver\n";
                }
            } else {
                echo "   ✗ Database config class not found\n";
            }
        } else {
            echo "   ✗ Database config file not found\n";
        }
    }
} catch (Exception $e) {
    echo "   ✗ Database connection failed: " . $e->getMessage() . "\n";
}

echo "\n=== Diagnostic Complete ===\n";