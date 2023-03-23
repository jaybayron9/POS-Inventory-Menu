<?php

class Connection 
{
    private static $instance = null;
    public static $conn;
    var $message = 'There\'s a problem connecting to the database.';

    public function __construct()
    {
        $config = require('config.php');

        extract($config['database']);

        try {
            self::$conn = new mysqli($host, $user, $pass, $name);
        } catch(Exception $e) {
            echo "There's a problem connecting to database: " . $e->$this->message;
        }
    }

    public static function closeConnection()
    {
        mysqli_close(self::$conn);
        self::$instance = null;
    }

    public function alert($status, $message)
    {
        return json_encode(
                array(
                    'status' => $status, 
                    'msg' => $message
                )
            );
    }

    public function photo() {
        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                echo "Error: The file has an invalid extension.";
                return;
            }

            $newFileName = uniqid() . '.' . $fileExtension;

            $filePath = "public/storage/uploads/$newFileName";
            move_uploaded_file($fileTmpName, $filePath);

            return  $newFileName;
        } 

        return false;
    }

    public function del_photo($table, $column, $id, $picture = 'picture') {
        $query_img = self::$conn->query("select $picture from $table where $column = '{$id}'"); 
            foreach ($query_img as $row) {
                unlink("public/storage/uploads/". $row[$picture]. "");
            }
    }
}