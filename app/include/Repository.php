<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 05.05.2019
 * Time: 16:27
 */

class Repository
{
    private $_dbHost = "localhost";
    private $_dbUserName = "root";
    private $_dbPassword = "";
    private $_databaseName = "antony_pub_agency";

    public function CheckCredentials($login, $password)
    {
        $link = mysqli_connect($this->_dbHost, $this->_dbUserName, $this->_dbPassword, $this->_databaseName);
        $query = "SELECT * FROM Clients WHERE Login = '".$login."' AND Password = '".$password."' LIMIT 1;";

        if(mysqli_connect_errno()){
            echo "Ошибка в подключении к базе данных (".mysqli_connect_errno()."): ".mysqli_connect_error();
            exit();
        }

        $result = mysqli_query($link, $query);

        if(mysqli_num_rows($result) > 0)
            return true;
        return false;
    }

    public function GetUser($login, $password)
    {
        $link = mysqli_connect($this->_dbHost, $this->_dbUserName, $this->_dbPassword, $this->_databaseName);
        $query = "SELECT * FROM Clients WHERE Login = '".$login."' AND Password = '".$password."' LIMIT 1;";

        if(mysqli_connect_errno()){
            echo "Ошибка в подключении к базе данных (".mysqli_connect_errno()."): ".mysqli_connect_error();
            exit();
        }

        $result = mysqli_query($link, $query);

        $user = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

        return $user;
    }

}