<?php 

$history = new History();
$his = !isset($_GET['h']) ? '' : strtolower($_GET['h']);

$historyfunc = [
    'clear_history' => ['obj' => $history, 'method' => 'clear_history'],
    'toexportcsv' => ['obj' => $history, 'method' => 'toexportcsv'],
    'export_csv' => ['obj' => $history, 'method' => 'export_csv'],
    'getsale' => ['obj' => $history, 'method' => 'getsale'],
];

method($his, $historyfunc);