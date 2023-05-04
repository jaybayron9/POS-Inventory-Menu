<?php 

$dash = new Dashboard();
$board = !isset($_GET['d']) ? '' : strtolower($_GET['d']);

$dashboardr = [
    'sale' => ['obj' => $dash, 'method' => 'sale'],
    'customer' => ['obj' => $dash, 'method' => 'customer'],
    'pending' => ['obj' => $dash, 'method' => 'pending'],
    'unpaid' => ['obj' => $dash, 'method' => 'unpaid'],
    'total-product' => ['obj' => $dash, 'method' => 'totalProduct'],
    'reorder' => ['obj' => $dash, 'method' => 'reorder'],
    'low' => ['obj' => $dash, 'method' => 'low'],
    'out-stock' => ['obj' => $dash, 'method' => 'outStock'],
    'total-staffs' => ['obj' => $dash, 'method' => 'totalStaffs'],
    'product-sale' => ['obj' => $dash, 'method' => 'productSale'],
    'thebest' => ['obj' => $dash, 'method' => 'thebest'],
    'aov' => ['obj' => $dash, 'method' => 'aov'],
    'unvailable' => ['obj' => $dash, 'method' => 'unvailable'],
    'available' => ['obj' => $dash, 'method' => 'available'],
];

method($board, $dashboardr);