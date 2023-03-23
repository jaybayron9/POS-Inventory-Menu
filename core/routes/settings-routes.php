<?php 

$set = new Settings();
$set_action = !isset($_GET['t']) ? '' : strtolower($_GET['t']);

$setFunc = [
    'update_settings' => ['obj' => $set, 'method' => 'update_settings'],
];

method($set_action, $setFunc);