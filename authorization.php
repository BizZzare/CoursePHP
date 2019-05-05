<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 05.05.2019
 * Time: 15:38
 */

require_once('Repository.php');

if(isset($_POST["Login"]) && isset($_POST["Password"])){

    $login = $_POST["Login"];
    $password = $_POST["Password"];

    $rep = new Repository();
    $rep->CheckCredentials($login, $password);
}
else{

}