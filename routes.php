<?php

$reqpass_id = isset($_SESSION['reqpass_id']) ? $_SESSION['reqpass_id'] : '!@#$%^&*)(I*&^%$#$%^&*&^%$%^&*';

return [
    '' => view('dashboard'),
    'menu' => view('menu'),
    'order' => view('order'),
    'product' => view('product'),
    'history' => view('history'),
    'meals' => view('product'),
    'drinks' => view('product'),
    'inventory' => view('inventory'),

    // Authentication routes
    'login' => view('auth/login'),
    'users' => view('auth/users'),
    'profile' => view('auth/profile'),
    $reqpass_id => view('auth/pass-reset'),
    'settings' => view('settings/settings'),

    '404' => view('auth/404'),
];