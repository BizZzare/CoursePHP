<?php
/**
 * Created by PhpStorm.
 * User: bizzzare
 * Date: 10.05.2019
 * Time: 9:49
 */

session_start();
require_once('app/include/Repository.php');
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

                        echo '
<div class="text">
' . ($otherUser["About"] ? 'О себе: <p>' . $otherUser["About"] . '</p><br>' : "") . '
Пол: ' . ($otherUser["Gender"] == 1 ? "Мужской" : "Женский") . '<br>
Город: ' . $otherUser["City"] . '<br>
Страна: ' . $otherUser["Country"] . '
</div>
<button type="button" class="btn btn-primary details-button" data-toggle="modal" data-target="#ModalDetailed"' . $otherUser["Id"] . '>
  Подробнее
</button>';

                        echo '</div>';

                        echo '
<div class="modal fade" id="ModalDetailed"' . $otherUser["Id"] . ' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Контакты</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
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
</body>
</html>
