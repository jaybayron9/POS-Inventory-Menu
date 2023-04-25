<?php

class Settings extends Connection {
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
}

require_once(core('routes/settings-routes'));