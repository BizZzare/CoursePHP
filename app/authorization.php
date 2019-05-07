<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 05.05.2019
 * Time: 15:38
 */

require_once('include/Repository.php');

if(isset($_POST["Login"]) && isset($_POST["Password"]) && $_POST["Login"] != "" && $_POST["Password"] != "" ){

    $login = $_POST["Login"];
    $password = $_POST["Password"];

    $rep = new Repository();
    $result = $rep->CheckCredentials($login, $password);

    session_start();
    if($result) {
        $_SESSION["User"] = $rep->GetUser($login, $password);
        $_SESSION["LoginError"] = false;
        header('Location: ../index.php');
    }
    else {
        $_SESSION["LoginError"] = true;
        header('Location: ../auth.php');
    }
}
else{
    $_SESSION["LoginError"] = true;
    header('Location: ../auth.php');
}