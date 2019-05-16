<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 10.05.2019
 * Time: 9:49
 */

session_start();
require_once('app/include/Repository.php');
if (isset($_POST["logout"])) {
    $_SESSION["User"] = null;
    header('Location: index.php');
}
if (isset($_POST["discard"]))
    $_POST = null;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacts</title>

    <?php require 'app/style_sheet_links.php'; ?>
    <link rel="stylesheet" href="css/popup.css">
</head>
<body>

<div id="page-container">

    <?php require 'app/header.php'; ?>

    <section id="theme" class="theme">
        <img src="assets/images/Fon02.jpg" class="responsive">
    </section>

    <section class="profit">
        <form class="s_form" action="clients.php" method="post">
            Поиск по имени: <input type="search" name="text" value="<?php echo $_POST["text"] ?>"><br>
            <input type="radio" name="gender" value="1" <?php if ($_POST["gender"] == 1) echo 'checked' ?>/> Мужской
            <input type="radio" name="gender" value="0" <?php if ($_POST["gender"] == 0) echo 'checked' ?>/> Женский
            <br>
            Возраст от: <input type="number" name="ageFrom" value="<?php echo $_POST["ageFrom"] ?>"> <br>
            Возраст до: <input type="number" name="ageTo" value="<?php echo $_POST["ageTo"] ?>"> <br>
            <?php

            $rep = new Repository();

            $cities = $rep->GetAllCities();
            echo 'Город: <select name="city"><option value=""></option>';
            foreach ($cities as &$city) {
                echo '<option ' . ($_POST['city'] == $city["Id"] ? 'selected="selected"' : "") . 'value="' . $city["Id"] . '">' . $city["Name"] . '</option>';
            }
            echo "</select><br>";

            $countries = $rep->GetAllCountries();
            echo 'Страна: <select name="country"><option value=""></option>';
            foreach ($countries as &$country) {
                echo '<option ' . ($_POST['country'] == $country["Id"] ? 'selected="selected"' : "") . 'value="' . $country["Id"] . '">' . $country["Name"] . '</option>';
            }
            echo "</select><br>";
            ?>


            <input type="submit" value="Найти">
        </form>
        <form action="clients.php">
            <input type="submit" value="Сбросить фильтры" name="discard">
        </form>
    </section>

    <section id="profit" class="profit">
        <div class="container">
            <div class="row">
                <?php require 'app/get_clients.php'; ?>
            </div>
        </div>
    </section>

    <?php require 'app/footer.php'; ?>
</div>
<?php require 'app/scripts.php'; ?>

<script src="assets/js/popup.js"></script>
</body>
</html>
