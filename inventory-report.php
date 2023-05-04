<?php
session_start();

setcookie('unset_session', 'true', time() + 5);

if (isset($_COOKIE['unset_session'])) {
    unset($_SESSION['product_id']);
    setcookie('unset_session', '', time() - 3600);
}

require('core/functions.php');
require(core('connection'));
require(core('menu'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= 'inv_report_' . date('m-d-Y') ?></title>

    <style>
        table {
            border-collapse: collapse;
        }
        th {
            padding: 0px 20px 0px;
        }
        td {
            padding: 8px;
        }
    </style>
</head>
<body>
    <table border="2">
        <thead>
            <tr>
                <th>PID.</th>
                <th>NAME</th>
                <th>ON HAND</th>
                <th>REORDER</th>
                <th>TOTAL</th>
                <th>SALE</th>
                <th>DATE MODIFIED</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $conn = new Connection(); 
            if (isset($_SESSION['product_id'])) {
                foreach ($_SESSION['product_id'] as $id) {
                    $query = Connection::$conn->query("select * from products where product_id = '{$id}'");
                    foreach ($query as $row) {
                        ?>
                        <tr>
                            <td><?= $row['product_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['quantity'] ?></td>
                            <td><?= $row['reorder_level'] ?></td>
                            <td><?= $row['total'] ?></td>
                            <td><?= $row['sale'] ?></td>
                            <td><?= $row['update_at'] ?></td>
                        </tr>
                        <?php
                    }
                }
            } else {
                echo 'Please select product first.';
            }
                ?>
        </tbody>
    </table>
</body>
</html>

<?php
require(view('partial/foot'));
?>