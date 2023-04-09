<?php 
require('core/mailer.php');

class Auth extends Connection {

    public function __destruct() {
        $this->closeConnection();
    }

    public static function isAuth() {
        if (isset($_SESSION['log_id']) || isset($_COOKIE['log_id'])) {
            return true;
        }
        return false;
    }

    public static function isAdmin() {
        if (isset($_SESSION['log_id']) || isset($_COOKIE['log_id'])) {
            $_SESSION['log_id'] = $_COOKIE['log_id'];
            $query = parent::$conn->query("select * from users where `user_id` = '{$_COOKIE['log_id']}' and role = 'Admin'");
            if ($query->num_rows > 0) {
                return true;
            }
            return false;
        }
    }

    public static function isSetPassReq() {
        $reqpass_id = isset($_SESSION['reqpass_id']) ? $_SESSION['reqpass_id'] : '!@#$%^&*)(I*&^%$#*';
        if (isset($_GET['p']) == $reqpass_id && checkUrl($reqpass_id) == 'views/auth/pass-reset.php') {
            $query = parent::$conn->query("
                select * from users 
                where 
                    token = '{$_GET['p']}'
            ");

            if($query->num_rows == 1){
                return true;
            }
            return false;
        }
        return false;
    }

    public function login() {
        $stmt = parent::$conn->prepare("
            select * from users 
            where
                username = ?
            and 
                password = ?
        ");

        $stmt->bind_param("ss", $_POST['email'], $_POST['password']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            foreach ($result as $row) {
                $_SESSION['log_id'] = $row['user_id'];
                setcookie('log_id', $row['user_id'], time() + (86400 * 30), '/');
            }
            return parent::alert('success', 'Login successful.');
        } 
        return parent::alert('error', 'Invalid username or password.');
    }

    public function logout() {
        unset($_SESSION['log_id']);
        setcookie('log_id', '', time() - 3600, '/');
    }

    public function pass_req() {
        $email = $_POST['email'];
        $stmt = parent::$conn->prepare("
            SELECT * FROM users 
            WHERE email = ? 
            LIMIT 1
        ");
    
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            $id = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 50)), 0, 50);

            parent::$conn->query("
                update users set token = '{$id}' where email = '{$email}' limit 1
            ");
            $_SESSION['reqpass_id'] = $id;
            $email = new Emailer();

            $url = '<a href="http://localhost/HotPlatePOS/?p='. $id .'">Click Here!</a>';

            $from = 'dclinic139@gmail.com';
            $send_to = $_POST['email'];
            $subject = 'Password reset request';
            $body = "You have requested to reset your password. <br><br>
                Please $url to reset your password:<br><br>
                If you did not make this request, please ignore this email.<br><br>
                PS: This password request only works on the computer where the application is installed";
            
            if ($email->send_email($from, $send_to, $subject, $body)) {
                return parent::alert('success', 'Password request has been sent successfully.');
            } else {
                return parent::alert('error', 'There\'s a problem sending your password request.');
            }
        } 
        return parent::alert('error', 'Email not found.');
    }    

    public function change_pass() {
        if ($_POST['newpass'] ==  $_POST['conpass']) {
            $query = parent::$conn->query("
                update users 
                set 
                    password = '{$_POST['newpass']}'
                where
                    token = '{$_SESSION['reqpass_id']}'
            ");

            if ($query) {
                unset($_SESSION['reqpass_id']);
                echo 'Your password has been changed.';
            } else {
                echo 'Your password has not been changed.';
            }
        } else {
            echo 'Passwords do not match.';
        }
    }

    public static function users() {
        return parent::$conn->query("
            select * from users where role = 'Cashier' or role = 'Chef'
        ");
    }

    public static function user($id) {
        if (isset($_SESSION['log_id']) || isset($_COOKIE['log_id'])) {
            $_SESSION['log_id'] = $_COOKIE['log_id'];
            return parent::$conn->query("
                select * from users where user_id = {$id}
            ");
        }
    }

    public function update_profile() {
        extract($_POST);
        $query = parent::$conn->query("
            UPDATE users SET 
                username = '{$username}',
                email = '{$email}'
            WHERE user_id = {$_SESSION['log_id']}
        ");
        if($query){
            return parent::alert('success', 'Your profile has been updated.');
        }else {
            return parent::alert('error', 'There\'s a problem updating your profile.');
        }
    }

    public function change_user_password() {
        extract($_POST);

        $cur_pass = parent::$conn->query("
            select password from users 
            where 
                password = '{$currentPassword}' and 
                user_id = '{$_SESSION['log_id']}'
        ");

        if ($cur_pass->num_rows !== 0){
            if ($newPassword === $retypePassword) {
                $query = parent::$conn->query("
                    UPDATE users SET 
                        password = '{$newPassword}'
                    WHERE 
                        user_id = '{$_SESSION['log_id']}' and 
                        password = '{$currentPassword}'
                ");
                if($query){
                    return parent::alert('success', 'Your password has been changed.');
                }else {
                    return parent::alert('error', 'There\'s a problem changing your password.');
                }
            } else {
                return parent::alert('error', 'Passwords do not match.');
            }
        }else {
            return parent::alert('error', 'Your current password is incorrect.');
        }
    }

    public function add_user() {
        extract($_POST);
        $query = parent::$conn->query("
            INSERT INTO users (name, username, email, password, role) 
            VALUES ('{$name}', '{$username}', '{$email}', '{$password}', '{$role}')
        ");
        if($query){
            return parent::alert('success', 'User Added Successfully.');
        }else {
            return parent::alert('error', 'There\'s a problem adding user.');
        }
    }

    public function delete_users() {
        foreach($_POST['ids'] as $id) {
            $del = parent::$conn->query("
                DELETE FROM users WHERE user_id = '{$id}'
            ");
        }
        if($del){
            echo 'User has been deleted.';
        }else {
            echo 'User has not been deleted.';
        }
    }
}

require('core/routes/auth-routes.php');