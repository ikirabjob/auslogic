<?php
/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 06.11.16
 * Time: 9:53
 */

require 'config.php';
require 'class/db.php';
require 'class/Crypt.php';
$result = false;
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Incorrect e-mail';
    }

    if(empty($errors)){
        // Кодируем e-mail
        $encodedEmail = Crypt::getInstance()->encodeEmail($email);

        $db = new db();

        $user = $db->get_('SELECT * FROM `users` WHERE `email`=:email',0, [':email'=>$encodedEmail]);

        $key = Crypt::getInstance()->getKey($email);

        $decodePhone = Crypt::getInstance()->decodePhone($user['phone']);

        if($decodePhone){
            $to  = $email;

            $subject = "Your phone";

            $message = "<p>Your phone:</p> </br> <b>{$decodePhone}</b>";

            $headers  = "Content-type: text/html; charset=utf-8 \r\n";
            $headers .= 'From: test@example.com' . "\r\n";
            $headers .= "Reply-To: test@example.com\r\n";
            $headers .= 'X-Mailer: task4';

            mail($to, $subject, $message, $headers);

            $result = true;
        }
    }
}

include 'views/restore.php';