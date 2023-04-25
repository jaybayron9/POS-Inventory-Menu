<?php 

$auth = new Auth();
$sec = !isset($_GET['s']) ? '' : strtolower($_GET['s']);

$authFunc = [
    'login' => ['obj' => $auth, 'method' => 'login'],
    'logout' => ['obj' => $auth, 'method' => 'logout'],
    'pass_req' => ['obj' => $auth, 'method' => 'pass_req'],
    'change_pass' => ['obj' => $auth, 'method' => 'change_pass'],
    'update_profile' => ['obj' => $auth, 'method' => 'update_profile'],
    'change_user_password' => ['obj' => $auth, 'method' => 'change_user_password'],
    'add_user' => ['obj' => $auth, 'method' => 'add_user'],
    'delete_users' => ['obj' => $auth, 'method' => 'delete_users'],
    'recovery_account' => ['obj' => $auth, 'method' => 'recovery_account'],
    'confirm_answer' => ['obj' => $auth, 'method' => 'confirm_answer'],
];

method($sec, $authFunc);