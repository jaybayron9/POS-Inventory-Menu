<?php

$menu = new Menu();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$actions = !isset($_GET['a']) ? '' : strtolower($_GET['a']);

$menuFunc = [
    'orders' => ['obj' => $menu, 'method' => 'save'],
    'print' => ['obj' => $menu, 'method' => 'print_receipt'],
    'refresh_table' => ['obj' => $menu, 'method' => 'unset_orders'],
    'cancel_orders' => ['obj' => $menu, 'method' => 'cancel_orders'],
    'endsess' => ['obj' => $menu, 'method' => 'endsess'],
    'up_order' => ['obj' => $menu, 'method' => 'up_order'],
    'unset' => ['obj' => $menu, 'method' => 'unset_session'],
    // Product CRUD
    'add_product' => ['obj' => $menu, 'method' => 'add_product'],
    'data_product' => ['obj' => $menu, 'method' => 'data_product'],
    'update_product' => ['obj' => $menu, 'method' => 'update_product'],
    'delete_product' => ['obj' => $menu, 'method' => 'delete', 'args' => [
            'products', 'product_id', $id 
        ]
    ],
    'status_product' => ['obj' => $menu, 'method' => 'up_status_meal'],
    'notif_orders' => ['obj' => $menu, 'method' => 'notif_orders'],
    'reset_sale' => ['obj' => $menu, 'method' => 'reset_sale'],
    'ring_notif' => ['obj' => $menu, 'method' => 'ring_notif'],
    'pause_bell' => ['obj' => $menu, 'method' => 'pause_bell'],
    'today_report' => ['obj' => $menu, 'method' => 'today_report'],
    'find_order' => ['obj' => $menu, 'method' => 'find_order'],
    'addons' => ['obj' => $menu, 'method' => 'addons'],
];

method($actions, $menuFunc);