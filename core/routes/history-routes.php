<?php 

$history = new History();
$his = !isset($_GET['h']) ? '' : strtolower($_GET['h']);

$historyfunc = [
    'clear_history' => ['obj' => $history, 'method' => 'clear_history'],
];

method($his, $historyfunc);