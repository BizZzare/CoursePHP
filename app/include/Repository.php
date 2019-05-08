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
        $query = "SELECT * FROM Clients WHERE Login = '" . $login . "' AND Password = '" . $password . "' LIMIT 1;";

        if (mysqli_connect_errno()) {
            echo "Ошибка в подключении к базе данных (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }

        $result = mysqli_query($link, $query);

        mysqli_close($link);

        if (mysqli_num_rows($result) > 0)
            return true;
        return false;
    }

    public function GetUser($login, $password)
    {
        $link = mysqli_connect($this->_dbHost, $this->_dbUserName, $this->_dbPassword, $this->_databaseName);
        $query = "SELECT * FROM Clients WHERE Login = '" . $login . "' AND Password = '" . $password . "' LIMIT 1;";

        if (mysqli_connect_errno()) {
            echo "Ошибка в подключении к базе данных (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }

        $result = mysqli_query($link, $query);

        $user = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

        mysqli_close($link);

        return $user;
    }

    public function GetAllCities()
    {
        $link = mysqli_connect($this->_dbHost, $this->_dbUserName, $this->_dbPassword, $this->_databaseName);
        $query = "SELECT * FROM Cities;";

        if (mysqli_connect_errno()) {
            echo "Ошибка в подключении к базе данных (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }

        $result = mysqli_query($link, $query);

        $cities = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_close($link);

        return $cities;
    }

    public function CheckLoginExists($login)
    {
        $link = mysqli_connect($this->_dbHost, $this->_dbUserName, $this->_dbPassword, $this->_databaseName);
        $query = "SELECT * FROM Clients WHERE Login='" . $login . "';";

        if (mysqli_connect_errno()) {
            echo "Ошибка в подключении к базе данных (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }

        $result = mysqli_query($link, $query);

        mysqli_close($link);

        if (mysqli_num_rows($result) > 0)
            return true;
        return false;
    }

    public function RegisterUser($login, $password, $firstName, $lastName, $email, $phone, $gender, $city, $about, $image)
    {
        $link = mysqli_connect($this->_dbHost, $this->_dbUserName, $this->_dbPassword, $this->_databaseName);
        $query = "  INSERT INTO `Clients` 
                    (`FirstName`, `LastName`, `Phone`, `Email`, `Gender`, `Login`, `Password`, `CityId` " . ($about ? ", `About`" : "") . ($image ? ", `Image`" : "") . ") 
                    VALUES 
                    ('" . $firstName . "', '" . $lastName . "', '" . $phone . "', '" . $email . "', " . $gender . ", '" . $login . "', '" . $password . "', " . $city . ($about ? ", '" . $about . "'" : "") . ($image ? ", '" . $image . "'" : "") . ")";

        if (mysqli_connect_errno()) {
            echo "Ошибка в подключении к базе данных (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }

        if (mysqli_query($link, $query)) {
            mysqli_close($link);
            return true;
        } else {
            mysqli_close($link);
            return false;
        }
    }

    public function UpdateUser($id, $login, $password, $firstName, $lastName, $email, $phone, $gender, $city, $about, $image)
    {
        $link = mysqli_connect($this->_dbHost, $this->_dbUserName, $this->_dbPassword, $this->_databaseName);
        $query = "UPDATE Clients SET 
                    FirstName = '$firstName', 
                    LastName = '$lastName', 
                    Email = '$email', 
                    Phone = '$phone',
                    Gender = $gender,
                    CityId = $city,
                    About = ".($about ? "'$about'" : "NULL").",
                    Image = ".($image ? "'".$image."'" : "NULL").",
                    Login = '$login',
                    Password = '$password'
                  WHERE Id = $id";

        if (mysqli_connect_errno()) {
            echo "Ошибка в подключении к базе данных (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }

        if (mysqli_query($link, $query)) {
            mysqli_close($link);
            return true;
        } else {
            echo mysqli_error($link);

            mysqli_close($link);
            exit;
            return false;
        }
    }

}