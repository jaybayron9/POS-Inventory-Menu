<?php

class Inventory extends Connection {
    public static function inventorytbl() {
        $product = parent::$conn->query("SELECT * FROM products");
        $inventory = parent::$conn->query("SELECT * FROM inventory");
        
        foreach ($product as $proItem) {
            $desc = explode(", ", $proItem['description']);
            for ($i = 0; $i < count($desc); $i++) {
                $inv = parent::$conn->query("SELECT * FROM inventory WHERE ItemName = '$desc[$i]'");
                foreach ($inv as $invItem) {
                    parent::$conn->query("UPDATE inventory SET ReorderPoints = ReorderPoints - 1 WHERE ItemName = '$desc[$i]'");
                }
            }
        }
        return $inventory;
    }

    public function add_item() {
        extract($_POST);

        $result = parent::$conn->query("
            insert into inventory (
                ItemName, Description, Quantity, Unit, UnitPrice, TotalValue, Supplier, Location
            ) values (
                '$itemName', '$description', '$quantity', '$unit', '$unitPrice', '$totalPrice', '$supplier', '$location'
            )
        ");

        if($result) {
            return parent::alert('success', 'Item added successfully.');
        } else {
            return parent::alert('error', 'Item could not be added.');
        }
    }

    public function get_item() {

        $inv = parent::$conn->query("select * from inventory where ItemID = '{$_POST['itemId']}'");

        foreach($inv as $item) {
            return json_encode($item);
        }
    }

    public function update_item() {
        $inv = parent::$conn->query("
            UPDATE inventory
            SET
                ItemName = '{$_POST['itemName']}',
                Description = '{$_POST['description']}',
                Quantity = '{$_POST['quantity']}',
                Unit = '{$_POST['unit']}',
                UnitPrice = '{$_POST['unitPrice']}',
                TotalValue = '{$_POST['totalPrice']}',
                Supplier = '{$_POST['supplier']}',
                Location = '{$_POST['location']}'
            WHERE
                ItemID = '{$_POST['id']}'
        ");

        if ($inv) {
            return parent::alert('success', 'Item updated successfully.');
        }

        return parent::alert('error', 'Item could not be updated.');
    }

    public function delete_rows() {
        foreach($_POST['ids'] as $id) {
            $del = parent::$conn->query("
                DELETE FROM inventory WHERE ItemID = '{$id}'
            ");
        }

        if($del) {
            return parent::alert('success', 'Item\'s deleted successfully.');
        }

        return parent::alert('error', 'Item\'s could not be deleted.');
    }

    public function export_csv() {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=posinventory.csv');
        $output = fopen("php://output", "w");
        fputcsv($output, array('ItemID', 'ItemName', 'Description', 'Quantity', 'Unit', 'UnitPrice', 'TotalValue', 'Supplier', 'Location', 'Updated_at'));

        $result = parent::$conn->query("select * from inventory");

        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, $row);
        }
        fclose($output);
    }
}

require_once('core/routes/inventory-routes.php');