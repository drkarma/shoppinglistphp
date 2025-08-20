<?php
spl_autoload_register(function ($class) {
    $prefix = 'Controller\\';
    $base_dir = __DIR__ . '/Controller/';
    if (strncmp($prefix, $class, strlen($prefix)) === 0) {
        $relative_class = substr($class, strlen($prefix));
        $file = $base_dir . $relative_class . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});