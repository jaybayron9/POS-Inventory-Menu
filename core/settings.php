<?php

class Settings extends Connection {
    public function __construct() {
        $this->create_POS_records_folder('HOTPLATE Reports');
        $this->daily_report();
    }

    public function update_settings() {
        $newImage = parent::photo();
        if ($newImage) {
            parent::del_photo('settings', 'logo', $_POST['id'], 'logo');
            $query = parent::$conn->query("update settings set
                bussiness_name = '{$_POST['business_name']}',
                bussiness_tin = '{$_POST['business_tin']}',
                address = '{$_POST['business_address']}',
                contact_no = '{$_POST['business_phone']}',
                email = '{$_POST['business_email']}',
                URL = '{$_POST['business_fb']}',
                daily_report_hr = '{$_POST['end_date']}',
                logo = '{$newImage}'
            ") ;

            if ($query) {
                echo 'Success updating!';
            } else {
                echo 'Error updating!';
            }
        } else {
            $query = parent::$conn->query("update settings set
                bussiness_name = '{$_POST['business_name']}',
                bussiness_tin = '{$_POST['business_tin']}',
                address = '{$_POST['business_address']}',
                contact_no = '{$_POST['business_phone']}',
                email = '{$_POST['business_email']}',
                daily_report_hr = '{$_POST['end_date']}',
                URL = '{$_POST['business_fb']}'
            ") ;

            if ($query) {
                echo 'Success updating!';
            } else {
                echo 'Error updating!';
            }
        }
    }

    public function settings() {
        return parent::$conn->query("
            select * from settings
        ");
    }

    public function create_POS_records_folder($folderName) {
        if (getenv('USERPROFILE')) {
            // Windows
            $desktopPath = getenv('USERPROFILE') . DIRECTORY_SEPARATOR . 'Desktop'; // Get the path to the desktop directory
            $folderPath = $desktopPath . DIRECTORY_SEPARATOR . $folderName;
        
            if (!file_exists($folderPath)) {
                // Create 2 additional folders
                $subFolderPath1 = $folderPath . DIRECTORY_SEPARATOR . 'TRANSACTION HISTORY';
                $subFolderPath2 = $folderPath . DIRECTORY_SEPARATOR . 'SALES AND INVENTORY';
                
                mkdir($folderPath, 0777, true);
                mkdir($subFolderPath1, 0777, true);
                mkdir($subFolderPath2, 0777, true);
            }
        }
    }

    public function expireOrdersCookie() {
        foreach ($_COOKIE as $cookieName => $cookieValue) {
            if ($cookieValue === "true" || $cookieValue === "false") {
                setcookie($cookieName, '', time() - 3600, '/');
                unset($_COOKIE[$cookieName]);
            }
        }
    }

    public function daily_report() {
        $time = parent::$conn->query("SELECT daily_report_hr AS timer FROM settings")->fetch_assoc()['timer'];

        $currentDateTime = date('Y-m-d H:i:s');
        $endOfDay = date("Y-m-d {$time}");

        if ($currentDateTime >= $endOfDay) {
            require('pdf-daily-report.php');
            parent::$conn->query("update products set orig_quantity = quantity");
            self::expireOrdersCookie();
        }
    }
}

require_once(core('routes/settings-routes'));