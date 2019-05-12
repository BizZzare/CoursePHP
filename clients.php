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
    <style>
        button {
            border-radius: 5px;
            padding: 15px 25px;
            font-size: 22px;
            text-decoration: none;
            margin: 20px;
            color: #fff;
            position: relative;
            display: inline-block;
            cursor: pointer;
            border: 0;
        }

        button:active {
            transform: translate(0px, 5px);
            -webkit-transform: translate(0px, 5px);
            box-shadow: 0px 1px 0px 0px;
        }

        button:focus {
            outline: none !important
        }



        /* Кнопка */

        .blue_btn {
            background-color: #3E3E3E;
            box-shadow: 0px 5px 0px 0px #3C93D5;
        }

        /* Окно */

        .overlay_popup {
            display:none;
            position:fixed;
            z-index: 999;
            top:0;
            right:0;
            left:0;
            bottom:0;
            background:#000;
            opacity:0.5;
        }

        .popup {
            display: none;
            position: center;
            z-index: 1000;
        }

        /* Ещё немного стилей для popup окна */

        .object{
            background-color: #eee;
            padding: 50px 70px;
        }
    </style>
</head>
<body>

<div id="page-container">

    <?php require 'app/header.php'; ?>

    <section id="theme" class="theme">
        <img src="assets/images/Fon02.jpg" class="responsive">
    </section>

    <section id="profit" class="profit">
        <div class="container">
            <div class="row">

                <form class="s_form" action="../index.php" method="get">
                    <input type="search" name="text">
                    <input type="submit" value="Найти">
                </form>

                <?php

                $user = $_SESSION["User"];
                if (isset($user) && $user != null) {
                    $rep = new Repository();

                    $otherUsers = $rep->GetAllOtherUsers($user["Id"]);

                    foreach ($otherUsers as $otherUser) {


                        echo '<div class="item">';

                        echo '<div class="clients_img">
<img src="' . ($otherUser["Image"] ? 'data:image/png;base64,' . base64_encode($otherUser["Image"]) : "assets/images/no-image.png") . '" alt="' . $otherUser["FirstName"] . ' ' . $otherUser["LastName"] . '" width="200" height="200" >
                            </div>';

                        echo '<div class="subtitle">' . $otherUser["FirstName"] . ' ' . $otherUser["LastName"] . '</div>';

                        $age = null;
                        if($otherUser['DateOfBirth']) {
                            $birthDate = explode("-", $otherUser['DateOfBirth']);
                            //get age from date or birthdate
                            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
                                ? ((date("Y") - $birthDate[0]) - 1)
                                : (date("Y") - $birthDate[0]));
                        }
                        echo '
<div class="text">
' . ($otherUser["About"] ? 'О себе: <p>' . $otherUser["About"] . '</p><br>' : "")
. ( $age ? 'Возраст: ' . $age . '<br>' : "") . '
Пол: ' . ($otherUser["Gender"] == 1 ? "Мужской" : "Женский") . '<br>
Город: ' . $otherUser["City"] . '<br>
Страна: ' . $otherUser["Country"] . '
</div>
<button class="show_popup blue_btn" rel="popup'.$otherUser["Id"].'">Подробнее</button>';

                        echo '</div>';

                        echo '<div class="overlay_popup"></div>
    <div class="popup" id="popup'.$otherUser["Id"].'">
      <div class="object">
        <p>Телефон: ' . $otherUser["Phone"] . '</p>
        <p>Электронный адрес: ' . $otherUser["Email"] . '</p>
        <h3>Отправить сообщение</h3>
                <form class="m_form" method="post" name="contact" action="app/mail.php">
                <input type="number" value="'.$otherUser["Id"].'" name="Id" style="display:none;">
                    <div class="form_row_m">
                        <label for="subject">Тема:</label>
                        <input type="text" class="validate-subject required input_field" name="subject" id="subject"/>
                    </div>
                    <div class="form_row_m">
                        <label for="text">Сообщение:</label>
                        <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                    </div>
                    <div class="form_row_m">
                        <input type="submit" value="Send" id="submit" name="submit" class="submit_btn float_l" />
                    </div>
                </form>
      </div>
    </div>';

                    }

                } else {
                    echo "Ошибка авторизации!";
                    exit();
                }

                ?>


            </div>
        </div>
    </section>

    <?php require 'app/footer.php'; ?>

</div>

<?php require 'app/scripts.php'; ?>
<script>
    $('.show_popup').click(function() { // Вызываем функцию по нажатию на кнопку
        var popup_id = $('#' + $(this).attr("rel")); // Связываем rel и popup_id
        $(popup_id).show(); // Открываем окно
        $('.overlay_popup').show(); // Открываем блок заднего фона
    })
    $('.overlay_popup').click(function() { // Обрабатываем клик по заднему фону
        $('.overlay_popup, .popup').hide(); // Скрываем затемнённый задний фон и основное всплывающее окно
    })
</script>
</body>
</html>
