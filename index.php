<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>webdesign</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">

</head>
<body>
<div id="page-container">
    <?php require 'app/header.php';?>
    
    <section id="theme" class="theme">
        <img src="assets/images/Fon02.jpg" class="responsive">
    </section>
    <div id="page-container">

    <section id="form3" class="form_message">
        <div class="container">
            <div class="row">
                <h1>Отправить сообщение</h1>
                <form class="m_form" method="post" name="contact" action="mail.php">
                    <div class="form_row_m">
                        <label for="author">Имя:</label>
                        <input type="text" id="author" name="author" class="required input_field" />
                    </div>

                    <div class="form_row_m">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" class="validate-email required input_field" />
                    </div>

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
                        <input type="reset" value="Reset" id="reset" name="reset" class="submit_btn float_r" />
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="profit" class="profit">
        <div class="container">
            <div class="row">
                <div class="item">
                    <div class="item_img"></div>
                    <div class="subtitle">Клиент 1</div>
                    <div class="text">Размещение общей информации о клиенте для дальнейшего ознакомления</div>
                </div>
                <div class="item">
                    <div class="item_img"></div>
                    <div class="subtitle">Клиент 2</div>
                    <div class="text">Размещение общей информации о клиенте для дальнейшего ознакомления</div>
                </div>
                <div class="item">
                    <div class="item_img"></div>
                    <div class="subtitle">Клиент 3</div>
                    <div class="text">Размещение общей информации о клиенте для дальнейшего ознакомления</div>
                </div>
                <div class="item">
                    <div class="item_img"></div>
                    <div class="subtitle">Клиент 4</div>
                    <div class="text">Размещение общей информации о клиенте для дальнейшего ознакомления</div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <?php require 'app/footer.php';?>
</div>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    <script src="assets/js/script.js"></script>
</body>
</html>