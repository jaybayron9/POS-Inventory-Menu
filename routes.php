<?php

return [
    '404' => view('auth/404'),
    '' => view('dashboard'),
    'menu' => view('menu'),
    'order' => view('order'),
    'product' => view('product'),
    'history' => view('history'),
    'meals' => view('product'),
    'drinks' => view('product'),
    'add-ons' => view('product'),
    'other' => view('product'),
    'product-history' => view('product-history'),
    'receipts' => view('receipts'),
    'docs' => view('docs/documentation'),

    // Authentication routes
    'login' => view('auth/login'),
    'users' => view('auth/users'),
    'profile' => view('auth/profile'),
    'settings' => view('settings/settings'),
];