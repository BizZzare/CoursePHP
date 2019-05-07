<header>
    <div class="header-container">
        <div class="logo">
            <img src="../assets/images/Logo2.png" alt="Logo">
        </div>
        <input type="checkbox" id="menu-checkbox">
        <nav role="navigation">
            <label for="menu-checkbox" class="toggle-button"
                   data-open="MENU" data-close="CLOSE" onclick></label>
            <ul class="main-menu">
                <?php
                if (!isset($_SESSION["User"]))
                    echo '<li><a href="#form1">РЕГИСТРАЦИЯ</a></li><li><a href="../auth.php">АВТОРИЗАЦИЯ</a></li>';

                echo '<li><a href="#form3">КОНТАКТЫ</a></li>';

                if (isset($_SESSION["User"]))
                    echo '<li><a href="#profit">КЛИЕНТЫ</a></li><li><a href="">ЛИЧНЫЙ КАБИНЕТ</a></li>';
                ?>
            </ul>
        </nav>
        <form class="s_form" action="../index.php" method="get">
            <input type="search" name="text">
            <input type="submit" value="Найти">
        </form>
    </div>
</header>