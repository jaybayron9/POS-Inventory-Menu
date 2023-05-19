<?php 

$conn = new mysqli('localhost', 'root', '', 'hotplatepos');

$order = $conn->query("SELECT * FROM orders where order_id = 42");
$products = $conn->query("SELECT * FROM products");

foreach ($order as $orderName) {
    if (strpos($orderName['name'], '+') !== false) {
        $arrProduct = explode(", ", $orderName['name']);
        $filteredNames = array_filter($arrProduct, function($item) {
            return strpos($item, '+') === 0;
        });
        $strNames = implode(", ", $filteredNames);

        $arrProduct = explode(", ", $strNames);
        $filteredNames = array_map(function($item) {
            return ltrim($item, '+');
        }, $arrProduct);
        // $result = implode(", ", $filteredNames);
        
        // echo $result . '<br />';

        // echo $productName['name'];
        print_r($filteredNames);
    }
}




// if (strpos($order['name'], '+') !== false) { 
//     $arrName = explode(', ', $order['name']);
//     $filteredNames = array_filter($arrName, function($item) {
//         return strpos($item, '+') === 0;
//     });
//     $strNames = implode(", ", $filteredNames);

//     $arrProduct = explode(", ", $strNames);
//     $filteredNames = array_map(function($item) {
//         return ltrim($item, '+');
//     }, $arrProduct);
//     $addOns = implode(", ", $filteredNames);
// } 




if (strpos($order['name'], '+') !== false) { 
    $orderNameArray = explode(", ", $order['name']);
    $orderQuantityArray = explode(", ", $order['quantity']);
    $orderPriceArray = explode(", ", $order['price']);

    // Step 2: Filter the arrays based on $orderNameArray
    $filteredOrderNameArray = [];
    $filteredOrderQuantityArray = [];
    $filteredOrderPriceArray = [];

    foreach ($orderNameArray as $index => $name) {
        if (strpos($name, '+') === 0) {
            $filteredOrderNameArray[] = $name;
            $filteredOrderQuantityArray[] = $orderQuantityArray[$index];
            $filteredOrderPriceArray[] = $orderPriceArray[$index];
        }
    }

    // Step 3: Convert filtered arrays back to strings
    $filteredOrderName = implode(", ", $filteredOrderNameArray);

    // Step 4: Explode the filtered names and remove the "+"
    $filteredOrderNameArray = explode(", ", $filteredOrderName);
    $filteredOrderNameArray = array_map(function($item) {
        return ltrim($item, '+');
    }, $filteredOrderNameArray);
    
    $filteredOrderNameArray;
    $filteredOrderQuantityArray;
    $filteredOrderPriceArray;

    for ($i = 0; $i < count($filteredOrderNameArray); $i++) {
        if ($filteredOrderNameArray[$i] == $product['name']) {
            $newSale = (int)$product['sale'] + ((int)$product['price'] * (int)$filteredOrderQuantityArray[$i]);
            $newQuantity = (int)$product['quantity'] - (int)$filteredOrderQuantityArray[$i];
            $newTotal = $product['price'] * $newQuantity;

            $qry = parent::$conn->query("
                update products 
                set 
                    sale = '{$newSale}',
                    quantity = '{$newQuantity}',
                    total = '{$newTotal}'
                where 
                    name = '{$data[$i]}'
            ");

            if ($qry) {
                return parent::alert('success', 'Order served');
            } else {
                return parent::alert('failed', 'There\'s a problem.');
            }
        }
    }
}