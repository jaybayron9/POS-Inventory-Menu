<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'core/ThirdParty/PHPMailer/src/PHPMailer.php';
require 'core/ThirdParty/PHPMailer/src/Exception.php';
require 'core/ThirdParty/PHPMailer/src/SMTP.php';

class Emailer {
    function send_email($from, $send_to, $subject, $body) {
        $config = require('config.php');
        extract($config['mailer']);

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $user;
        $mail->Password = $pass;
        $mail->SMTPSecure = $enc;
        $mail->Port = $port;

        $mail->setFrom($from);

        $mail->addAddress($send_to);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $body;

        $result = $mail->send();
        if ($result) {
            return true;
        }
        return false;
    }
}