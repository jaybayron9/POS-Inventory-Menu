<!-- History -->
$data = [];
for ($i = 0; $i < count($name); $i++) {
    $data[$i] = array(
        'order_id' => $row['order_id'],
        'Invoice_no' => $row['invoice_no'],
        'purchase' => $name[$i] . ', ' . $quantity[$i] . ', ' . $price[$i],
        'total' => $row['total'],
        'New total' => $row['total_discount'],
        'service' => $row['service']
    );
}

for ($i = 0; $i < count($name); $i++) {
    fputcsv($output, $data[$i]);
}
fputcsv($output, array(''));