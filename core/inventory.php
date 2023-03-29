<?php

class Inventory extends Connection {
    public static function inventorytbl() {
        return parent::$conn->query("SELECT * FROM inventory");
    }

    public function add_item() {
        extract($_POST);

        $result = parent::$conn->query("
            insert into inventory (
                item_name, description, quantity, unit_cost, total_value, reorder_level, supplier, location
            ) values (
                '$itemName', '$description', '$quantity', '$UnitCost', '$totalValue', '$reorderLevel', '$supplier', '$location'
            )
        ");

        if($result) {
            return parent::alert('success', 'Item added successfully.');
        } else {
            return parent::alert('error', 'Item could not be added.');
        }
    }

    public function get_item() {

        $inv = parent::$conn->query("select * from inventory where id = '{$_POST['itemId']}'");

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
                DELETE FROM inventory WHERE id = '{$id}'
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
        fputcsv($output, array('id', 'item_name', 'description', 'quantity', 'unit_cost', 'total_value', 'reorder_level', 'supplier', 'location', 'updated_at'));

        $result = parent::$conn->query("select id, item_name, description, quantity, unit_cost, total_value, reorder_level, supplier, location, updated_at from inventory");

        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, $row);
        }
        fclose($output);
    }
}

require_once('core/routes/inventory-routes.php');