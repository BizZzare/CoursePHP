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

                echo '<li><a href="../contacts.php">О НАС</a></li>';

                if (isset($_SESSION["User"]) && $_SESSION["User"] != null)
                    echo '<li><a href="../clients.php">КЛИЕНТЫ</a></li><li><a href="../account.php">ЛИЧНЫЙ КАБИНЕТ</a></li>';
                ?>

            </ul>

        </nav>
        <?php
        if(isset($_SESSION["User"]) && $_SESSION["User"] != null){
            echo '<div class="user-controls"><img class="topimg" src="data:image/png;base64,' . base64_encode($_SESSION["User"]["Image"]) . '" alt="current image" width="50" height="50">';
            echo '<a><form method="POST"><input class="logoutbutton" type="submit" name="logout" value="Выйти" /></form></a></div>';
        }
        ?>

    </div>
</header>