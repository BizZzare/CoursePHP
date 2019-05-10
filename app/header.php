<header>
    <div class="header-container">
        <div class="logo">
            <a href="../index.php">
                <img src="../assets/images/Logo2.png" alt="Logo">
            </a>
        </div>
        <input type="checkbox" id="menu-checkbox">
        <nav role="navigation">
            <label for="menu-checkbox" class="toggle-button"
                   data-open="MENU" data-close="CLOSE" onclick></label>
            <ul class="main-menu">
                <?php
                if (!isset($_SESSION["User"]) || $_SESSION["User"] == null)
                    echo '<li><a href="../register.php">РЕГИСТРАЦИЯ</a></li><li><a href="../auth.php">АВТОРИЗАЦИЯ</a></li>';

                echo '<li><a href="../contacts.php">КОНТАКТЫ</a></li>';

                if (isset($_SESSION["User"]) && $_SESSION["User"] != null)
                    echo '<li><a href="../clients.php">КЛИЕНТЫ</a></li><li><a href="../account.php">ЛИЧНЫЙ КАБИНЕТ</a></li>';
                ?>
            </ul>
        </nav>
        <form class="s_form" action="../index.php" method="get">
            <input type="search" name="text">
            <input type="submit" value="Найти">
        </form>
    </div>
</header>