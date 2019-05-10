<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 08.05.2019
 * Time: 10:42
 */
session_start();

if (isset($_POST["discard"])) {
    header('Location: index.php');
}
if (isset($_POST["logout"])) {
    $_SESSION["User"] = null;
    header('Location: index.php');
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <?php require 'app/style_sheet_links.php';?>
</head>
<body>

<div id="page-container">

    <?php require 'app/header.php'; ?>

    <section id="theme" class="theme">
        <img src="assets/images/Fon02.jpg" class="responsive">
    </section>

    <section id="form6" class="form_account">
        <div class="container">
            <div class="row">
                <h1>Мой профиль</h1>
                <?php
                require_once('app/include/Repository.php');
                $rep = new Repository();

                $user = $_SESSION["User"];
                if ($user) {
                    echo '<form class="r_form" action="app/account_edit.php" method="post" enctype="multipart/form-data" >';
                    echo '<div class="form_row">
                        <label for="login">Логин: </label>
                        <input type="text" id="login" name="Login" value="' . $user["Login"] . '"/>
                    </div >';
                    echo '<div class="form_row">
                        <label for="pass1">Пароль: </label>
                        <input type="password" id="pass1" name="Password"/>
                    </div >';
                    echo '<div class="form_row">
                        <label for="pass2">Повторите пароль: </label>
                        <input type="password" id="pass2" name="p2"/>
                    </div ><hr>';
                    echo '<div class="form_row">
                        <label for="f_name">Имя: </label>
                        <input type="text" id="f_name" name="FirstName"  value="' . $user["FirstName"] . '"/>
                    </div >';
                    echo '<div class="form_row">
                        <label for="s_name">Фамилия: </label>
                        <input type="text" id="s_name" name="LastName"  value="' . $user["LastName"] . '"/>
                    </div>';
                    echo '<div class="form_row">
                        <label for="form_email">Email: </label>
                        <input type="email" id="form_email" name="Email"  value="' . $user["Email"] . '"/>
                    </div>';
                    echo '<div class="form_row">
                        <label for="form_phone">Телефон: </label>
                        <input type="text" id="form_phone" name="Phone"  value="' . $user["Phone"] . '"/>
                    </div>';
                    echo '<div class="form_row">
                        <label for="form_info">Кратко о себе:</label>
                        <input type="text" name="About" id="form_info"  value="' . $user["About"] . '"/>
                    </div>';
                    echo '<hr>
                    <div class="form_row img">
                        <label for="form_image">Добавить Фотографию:</label>
                        <input type="file" name="Image" id="form_image"/>
                    </div>
                    <img src="data:image/png;base64,' . base64_encode($user["Image"]) . '" alt="current image" width="200" height="200">
                    <hr>';
                    echo '<div class="form_row">
                        <label for="Gender" >Укажите Ваш пол:</label> <br>
                        <input type="radio" name="Gender" value="1"' . ($user["Gender"] == 1 ? " checked " : "") . '/> Мужской <br>
                        <input type="radio" name="Gender" value="0"' . ($user["Gender"] == 0 ? " checked " : "") . ' /> Женский
                    </div>';
                    echo '<div class="form_row">
                        <label for="form_city">Ваш город:</label>';

                    $cities = $rep->GetAllCities();
                    echo '<select name="City" id="form_city">';
                    foreach ($cities as &$city) {
                        echo '<option ' . ($user["CityId"] == $city["Id"] ? 'selected="selected"' : "") . 'value="' . $city["Id"] . '">' . $city["Name"] . '</option>';
                    }
                    echo "</select>";
                    echo '</div>
                    <div class="form_row">
                        <input type="submit" value="Сохранить изменения"/>
                    </div>';
                    echo '</form>';

                    echo '<form method="POST"><input type="submit" name="discard" value="Отменить изменения" /></form>';
                    echo '<form method="POST"><input type="submit" name="logout" value="Выйти" /></form>';
                }

                if (isset($_SESSION["UpdateError"])) {
                    // 0 - no Errors
                    // 1 - login exists
                    // 2 - passwords do not match
                    // 3 - login or password are null or empty
                    // 4 - some necessary fields were empty
                    // 5 - db error

                    if ($_SESSION["UpdateError"] == 1)
                        echo '<div class="login-error">Такой логин уже существует!</div>';
                    if ($_SESSION["UpdateError"] == 2)
                        echo '<div class="login-error">Пароли не совпадают!</div>';
                    if ($_SESSION["UpdateError"] == 3)
                        echo '<div class="login-error">Логин и пароль не могут быть пустыми или пробелом!</div>';
                    if ($_SESSION["UpdateError"] == 4)
                        echo '<div class="login-error">Заполните все нужные поля!</div>';
                    if ($_SESSION["UpdateError"] == 5)
                        echo '<div class="login-error">Ошибка базы данных!</div>';

                }
                ?>
            </div>
        </div>
    </section>


    <?php require 'app/footer.php'; ?>

</div>

<?php require 'app/scripts.php';?>
</body>
</html>