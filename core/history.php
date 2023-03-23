<?php

class History extends Connection {
    public static function getHistory() {
        return parent::$conn->query("SELECT * FROM orders order by status");
    }

    public function clear_history() {
        parent::$conn->query("DELETE FROM orders");
        return parent::alert('success', '');
    }
}

require_once('core/routes/history-routes.php');