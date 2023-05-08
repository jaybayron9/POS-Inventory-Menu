<?php 

class Dashboard extends Connection {
    public function sale() {
        extract($_POST);

        switch ($totalSale) {
            case 'today':
                $sql = parent::$conn->query("SELECT SUM(total_discount) AS total FROM orders WHERE DATE(create_at) = CURDATE() AND payment_status = 'Paid'");
                $row = mysqli_fetch_assoc($sql);
                echo '<span class="text-green-600">₱ </span>' . number_format($row['total'], 2);
                break;
            case 'last-7-days':
                $sql = parent::$conn->query("SELECT SUM(total_discount) AS total FROM orders WHERE DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND payment_status = 'Paid'");
                $row = mysqli_fetch_assoc($sql);
                echo '<span class="text-green-600">₱ </span>' . number_format($row['total'], 2);
                break;
            case 'last-30-days':
                $sql = parent::$conn->query("SELECT SUM(total_discount) AS total FROM orders WHERE DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND payment_status = 'Paid'");
                $row = mysqli_fetch_assoc($sql);
                echo '<span class="text-green-600">₱ </span>' . number_format($row['total'], 2);
                break;
            default:
                $sql = parent::$conn->query("SELECT SUM(total_discount) AS total FROM orders WHERE DATE(create_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND payment_status = 'Paid'");
                $row = mysqli_fetch_assoc($sql);
                echo '<span class="text-green-600">₱ </span>' . number_format($row['total'], 2);
                break;
        }
    }

    public function customer() {
        extract($_POST);

        switch ($totalCustomer) {
            case 'today':
                $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM orders WHERE DATE(create_at) = CURDATE()");
                $row = mysqli_fetch_assoc($sql);
                echo $row['total'];
                break;
            case 'last-7-days':
                $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM orders WHERE DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
                $row = mysqli_fetch_assoc($sql);
                echo $row['total'];
                break;
            case 'last-30-days':
                $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM orders WHERE DATE(create_at) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
                $row = mysqli_fetch_assoc($sql);
                echo $row['total'];
                break;
            default:
                $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM orders WHERE DATE(create_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)");
                $row = mysqli_fetch_assoc($sql);
                echo $row['total'];
                break;
        }
    }

    public function pending() {
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = ''");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function unpaid() {
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM orders WHERE payment_status = 'Unpaid'");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function totalProduct() {
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM products WHERE category = 'meals' or category = 'drinks' or category = 'add-ons'");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function reorder() {
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM products WHERE quantity <= reorder_level");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function low() {
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM products WHERE quantity > reorder_level AND quantity < reorder_level + 10");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function outStock() {
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM products WHERE quantity = 0");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function totalStaffs() {
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'staff'");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function productSale() {
        $sql = parent::$conn->query("SELECT SUM(sale) AS total FROM products");
        $row = mysqli_fetch_assoc($sql);
        echo '<span class="text-green-600">₱ </span>' . number_format($row['total'], 2);
    }

    public function thebest() {
        $sql = parent::$conn->query("SELECT name, SUM(sale) AS total FROM products GROUP BY name ORDER BY total DESC LIMIT 1");
        $row = mysqli_fetch_assoc($sql);
        echo $row['name'];
    }

    public function aov() {
        $sql = parent::$conn->query("SELECT AVG(total_discount) as average_order_value FROM orders WHERE status = 'served' AND payment_status = 'Paid' AND DATE(create_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)");
        $row = mysqli_fetch_assoc($sql);
        echo '<span class="text-green-600">₱ </span>' . number_format($row['average_order_value'], 2);
    }

    public function unvailable(){
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM products WHERE status = 'unavailable'");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }

    public function available(){
        $sql = parent::$conn->query("SELECT COUNT(*) AS total FROM products WHERE status = 'available' and category = 'meals' or category = 'drinks' or category = 'add-ons'");
        $row = mysqli_fetch_assoc($sql);
        echo $row['total'];
    }
}

require(core('routes/dashboard-routes'));