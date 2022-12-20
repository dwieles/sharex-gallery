<?php
    spl_autoload_register(function($className) {
		$path = dirname(__DIR__) . '\\classes\\' .  $className . '.php';
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

        if(file_exists($path)) {
            require $path;
        }
    });