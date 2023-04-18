<?php 

$history = new History();
$his = !isset($_GET['h']) ? '' : strtolower($_GET['h']);

$historyfunc = [
    'clear_history' => ['obj' => $history, 'method' => 'clear_history'],
    'toexportcsv' => ['obj' => $history, 'method' => 'toexportcsv'],
    'export_csv' => ['obj' => $history, 'method' => 'export_csv'],
    'toexportpdf' => ['obj' => $history, 'method' => 'toexportpdf'],
    'getsale' => ['obj' => $history, 'method' => 'getsale'],
    'delete_row' => ['obj' => $history, 'method' => 'delete_row'],
    'receipt' => ['obj' => $history, 'method' => 'receipt'],
    'reissue_receipt' => ['obj' => $history, 'method' => 'reissue_receipt'],
    'unset_receipt' => ['obj' => $history, 'method' => 'unset_receipt'],
];

method($his, $historyfunc);