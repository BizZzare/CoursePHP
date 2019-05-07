<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorization</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
</head>
<body>

<div id="page-container">

    <?php require 'app/header.php'; ?>

    <section id="theme" class="theme">
        <img src="assets/images/Fon02.jpg" class="responsive">
    </section>

    <section id="form1" class="form_reg">
        <div class="container">
            <div class="row">
                <h1>Регистрация</h1>
                <form class="r_form" action="app/registration.php" method="post" enctype="multipart/form-data" >

                    <div class="form_row">
                        <label for="login">Логин: </label>
                        <input type="text" id="login" name="Login" required/>
                    </div >
                    <div class="form_row">
                        <label for="pass1">Пароль: </label>
                        <input type="password" id="pass1" name="Password" required/>
                    </div >
                    <div class="form_row">
                        <label for="pass2">Повторите пароль: </label>
                        <input type="password" id="pass2" name="p2" required/>
                    </div >
                    <hr>
                    <div class="form_row">
                        <label for="f_name">Имя: </label>
                        <input type="text" id="f_name" name="FirstName" required/>
                    </div >
                    <div class="form_row">
                        <label for="s_name">Фамилия: </label>
                        <input type="text" id="s_name" name="LastName" required/>
                    </div>
                    <div class="form_row">
                        <label for="form_email">Email: </label>
                        <input type="email" id="form_email" name="Email" required/>
                    </div>
                    <div class="form_row">
                        <label for="form_phone">Телефон: </label>
                        <input type="text" id="form_phone" name="Phone" required/>
                    </div>
                    <div class="form_row">
                        <label for="form_info">Кратко о себе:</label>
                        <input type="text" name="About" id="form_info"/>
                    </div>
                    <hr>

                    <div class="form_row img">
                        <label for="form_image">Добавить Фотографию:</label>
                        <input type="file" name="Image" id="form_image"/>
                    </div>
                    <hr>

                    <div class="form_row">
                        <label for="Gender" >Укажите Ваш пол:</label> <br>
                        <input type="radio" name="Gender" value="1" checked/> Мужской <br>
                        <input type="radio" name="Gender" value="0" /> Женский
                    </div>
                    <div class="form_row">
                        <label for="form_city">Ваш город:</label>

                        <?php
                        require_once('app/include/Repository.php');

                        $rep = new Repository();
                        $cities = $rep->GetAllCities();

                        echo '<select name="City" id="form_city">';
                        foreach ($cities as &$city){
                            echo '<option value="'.$city["Id"].'">'.$city["Name"].'</option>';
                        }
                        echo "</select>";
                        ?>

                    </div>
                    <div class="form_row">
                        <input type="submit" value="Зарегистрироваться"/>
                    </div>
                </form>
            </div>
            <?php
            if( isset($_SESSION["RegisterError"])){
                // 0 - noErrors
                // 1 - login exists
                // 2 - passwords do not match
                // 3 - login or password are null or empty
                // 4 - some necessary fields were empty
                // 5 - db error

                if($_SESSION["RegisterError"] == 1)
                    echo '<div class="login-error">Такой логин уже существует!</div>';
                if($_SESSION["RegisterError"] == 2)
                    echo '<div class="login-error">Пароли не совпадают!</div>';
                if($_SESSION["RegisterError"] == 3)
                    echo '<div class="login-error">Логин и пароль не могут быть пустыми или пробелом!</div>';
                if($_SESSION["RegisterError"] == 4)
                    echo '<div class="login-error">Заполните все нужные поля!</div>';
                if($_SESSION["RegisterError"] == 5)
                    echo '<div class="login-error">Ошибка базы данных!</div>';

            }
            ?>
        </div>
    </section>



    <?php require 'app/footer.php'; ?>

</div>

</body>
</html>