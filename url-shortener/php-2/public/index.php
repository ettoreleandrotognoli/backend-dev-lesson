<?php

    include_once '../connection.php';

    $routes = array(
        '@^/$@' => '../index.php',
        '@^/(?P<code>[^/]+)$@' => '../redirect.php',
        '@^/preview/(?P<code>[^/]+)$@' => '../preview.php',
    );

    $path = $_SERVER['REQUEST_URI'];
    foreach ($routes as $rule => $action) {
        $matches = array();
        $match = preg_match($rule,$path,$matches);
        if(!$match){
            continue;
        }
        extract($matches);
        require $action;
    }
    