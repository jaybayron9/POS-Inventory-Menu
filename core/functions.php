<?php

function dd($value) {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

function urlIs($value) {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) === $value;
}

function checkUrl($get) {
    $r = require('routes.php');

    if (array_key_exists($get, $r)) {
        return $r[$get];
    } else {
        return $r['404'];
    }
}
$get = isset($_GET['p']) ? $_GET['p'] : '';

function view($dir) {
    return 'views/'.$dir.'.php';
}

function core($dir) {
    return 'core/'.$dir.'.php';
}

function method($action, $exfunc) {
    if (array_key_exists($action, $exfunc)) {
        echo call_user_func_array([
                $exfunc[$action]['obj'], 
                $exfunc[$action]['method']
            ], 
                isset($exfunc[$action]['args']) ? $exfunc[$action]['args'] : []
            );
        die();
    }
}