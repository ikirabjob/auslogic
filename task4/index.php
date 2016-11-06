<?php
/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 06.11.16
 * Time: 9:04
 */
ini_set('display_errors', '1');
require 'config.php';
require 'class/db.php';
require 'class/Crypt.php';
$result = false;
if (isset($_POST['email']) && isset($_POST['phone'])){
    $email = $_POST['email'];
    $phone = htmlspecialchars($_POST['phone']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Incorrect e-mail';
    }

    if (empty($phone)){
        $errors[] = 'Enter phone';
    }

    if (empty($errors))
    {
        // Кодируем e-mail
        $encodedEmail = Crypt::getInstance()->encodeEmail($email);
        // Получаем ключ для кодировки телефона
        $key = Crypt::getInstance()->getKey($email);
        // Кодируем телефон
        $encodedPhone = Crypt::getInstance()->encodePhone($phone);

        $db = new db();

        $data = $db->insert_("INSERT INTO `users` SET `email`=:email, `phone`=:phone", [':email'=>$encodedEmail, ':phone' => $encodedPhone]);

        if(!$data){
            $errors[] = 'Error! Try again!';
        } else {
            $result = true;
        }
    }
}

include 'views/index.php';