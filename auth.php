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

    <?php require 'header.php'; ?>

    <section id="theme" class="theme">
        <img src="assets/images/Fon02.jpg" class="responsive">
    </section>

    <section id="form2" class="form_autoris">
        <div class="container">
            <div class="row">
                <h1>Авторизация на сайте</h1>
                <form class="a_form" action="authorization.php" method="post">
                    <div class="form_row_a">
                        <label for="login">Логин: </label>
                        <input type="text" id="Login" name="Login" placeholder="Логин"/>
                    </div>
                    <div class="form_row_a">
                        <label for="password">Пароль: </label>
                        <input type="password" id="password" name="Password" placeholder="Пароль"/>
                    </div>
                    <div class="form_row_a">
                        <input type="submit" value="Авторизация"/>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php require 'footer.php'; ?>

</div>

</body>
</html>