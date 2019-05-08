<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 07.05.2019
 * Time: 16:36
 */

require_once('include/Repository.php');
session_start();

if (
    isset($_POST["Login"])
    && isset($_POST["Password"])
    && isset($_POST["p2"])
    && isset($_POST["FirstName"])
    && isset($_POST["LastName"])
    && isset($_POST["Email"])
    && isset($_POST["Phone"])
    && isset($_POST["Gender"])
    && isset($_POST["City"])
) {
    $rep = new Repository();

    $login = $_POST["Login"];
    $password = $_POST["Password"];
    $p2 = $_POST["p2"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $email = $_POST["Email"];
    $phone = $_POST["Phone"];
    $gender = $_POST["Gender"];
    $city = $_POST["City"];
    $about = $_POST["About"] ? $_POST["About"] : null;
    $image = $_POST["Image"] ? addslashes(file_get_contents($_FILES['Image']['tmp_name'])) : null;

    //Validation
    if ($login == "" || $login == " "
        || $password == "" || $password == " ") {
        $_SESSION["RegisterError"] = 3;
        header('Location: ../register.php');
        exit();
    }

    if ($rep->CheckLoginExists($login)) {
        $_SESSION["RegisterError"] = 1;
        header('Location: ../register.php');
        exit();
    }

    if ($password != $p2) {
        $_SESSION["RegisterError"] = 2;
        header('Location: ../register.php');
        exit();
    }

    if($rep->RegisterUser(
        $login,
        $password,
        $firstName,
        $lastName,
        $email,
        $phone,
        $gender,
        $city,
        $about,
        $image
    )){
        $_SESSION["User"] = $rep->GetUser($login, $password);
        $_SESSION["RegisterError"] = 0;
        header('Location: ../index.php');
    }
    else{
        $_SESSION["RegisterError"] = 5;
        header('Location: ../register.php');
    }


} else {
    $_SESSION["RegisterError"] = 4;
    header('Location: ../register.php');
}