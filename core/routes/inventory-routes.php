<?php 

$inv = new Inventory();
$inv_action = !isset($_GET['i']) ? '' : strtolower($_GET['i']);

$invFunc = [
    'add_item' => ['obj' => $inv, 'method' => 'add_item'],
    'get_item' => ['obj' => $inv, 'method' => 'get_item'],
    'update_item' => ['obj' => $inv, 'method' => 'update_item'],
    'delete_rows' => ['obj' => $inv, 'method' => 'delete_rows'],
    'export_csv' => ['obj' => $inv, 'method' => 'export_csv'],
];

method($inv_action, $invFunc);