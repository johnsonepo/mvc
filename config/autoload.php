<?php

namespace App\Config;

// Define paths to core directories
define('ROOT_DIR', __DIR__ . '/../..');

// Autoloader
spl_autoload_register(function ($class) {
    // Define your base namespace
    $baseNamespace = 'App\\';

    // Map the namespace to the corresponding directory
    $namespaceMap = [
        'App' => 'app',
        'App\\Core' => 'app/core',
        'App\\Controllers' => 'app/controllers',
        'App\\Models' => 'app/models',
        'App\\Views' => 'app/views',
        'App\\Config' => 'app/config',
    ];

    // Iterate through the namespace map to find a match
    foreach ($namespaceMap as $namespace => $directory) {
        if (strpos($class, $namespace) === 0) {
            // Construct the file path
            $filePath = ROOT_DIR . '/' . $directory . strtolower(str_replace('\\', '/', substr($class, strlen($namespace)))) . '.php';

            // Include the file if it exists
            if (file_exists($filePath)) {
                require_once $filePath;
            }
            break;
        }
    }
});
