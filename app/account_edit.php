<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 08.05.2019
 * Time: 11:23
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
    $user = $_SESSION["User"];
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
    $image = $_FILES['Image']['tmp_name'] != "" ? addslashes(file_get_contents($_FILES['Image']['tmp_name'])) : $user["Image"];


    if ($password == "")
        $password = $user["Password"];

    //Validation
    if ($login != $user["Login"]) {
        if ($login == "" || $login == " "
            || $password == "" || $password == " ") {
            $_SESSION["UpdateError"] = 3;
            header('Location: ../account.php');
            exit();
        }

        if ($rep->CheckLoginExists($login)) {
            $_SESSION["UpdateError"] = 1;
            header('Location: ../account.php');
            exit();
        }
    }
    if ($password == "" || $password == $user["Password"])
        $password = $user["Password"];
    else {
        if ($password != $p2) {
            $_SESSION["UpdateError"] = 2;
            header('Location: ../account.php');
            exit();
        }
    }


    if ($rep->UpdateUser(
        $user["Id"],
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
    )) {
        $_SESSION["User"] = $rep->GetUser($login, $password);
        $_SESSION["UpdateError"] = 0;
        header('Location: ../index.php');
    } else {
        $_SESSION["UpdateError"] = 5;
        header('Location: ../account.php');
    }


} else {
    $_SESSION["UpdateError"] = 4;
    header('Location: ../account.php');
}