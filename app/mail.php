<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 10.05.2019
 * Time: 11:41
 */
require_once('include/Repository.php');

if(isset($_POST["subject"]) && isset($_POST["text"]) && isset($_POST["Id"])){
    $rep = new Repository();

    $message = $_POST["text"];
    $to = $rep->GetUserById($_POST["Id"])["Email"];
    $subject = $_POST["subject"];
    $subject = "=?utf-8?B?".base64_encode($subject)."?=";

    mail($to, $subject, $message);
    header('Location: ../clients.php');
}
else{
    echo "Ошибка отправки сообщения!";
    exit();
}