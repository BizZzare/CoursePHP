<?php
session_start();
if (isset($_POST["logout"])) {
    $_SESSION["User"] = null;
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>webdesign</title>
    <?php require 'app/style_sheet_links.php'; ?>
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/component.css"/>
    <script src="assets/js/modernizr.min.js"></script>
</head>
<body>
<div id="page-container">
    <?php require 'app/header.php'; ?>

    <section id="theme" class="theme">
        <img src="assets/images/Fon02.jpg" class="responsive">
    </section>
    <div id="page-container">

        <section id="photostack-1" class="photostack photostack-start">
            <div>
                <figure>
                    <img width="250" height="250"
                                                                               src="assets/images/1.jpg"
                                                                               alt="img01"/>
                    <figcaption>
                        <h2 class="photostack-title">Serenity Beach</h2>
                    </figcaption>
                </figure>
                <figure>
                    <img width="250" height="250" src="assets/images/2.jpg"
                                                                               alt="img02"/>
                    <figcaption>
                        <h2 class="photostack-title">Happy Days</h2>
                    </figcaption>
                </figure>
                <figure>
                    <img width="250" height="250" src="assets/images/3.jpg"
                                                                               alt="img03"/>
                    <figcaption>
                        <h2 class="photostack-title">Beautywood</h2>
                    </figcaption>
                </figure>
                <figure>
                    <img width="250" height="250" src="assets/images/4.jpg"
                                                                               alt="img04"/>
                    <figcaption>
                        <h2 class="photostack-title">Heaven of time</h2>
                    </figcaption>
                </figure>
                <figure>
                    <img width="250" height="250" src="assets/images/5.jpg"
                                                                               alt="img05"/>
                    <figcaption>
                        <h2 class="photostack-title">Good life</h2>
                    </figcaption>
                </figure>
                <figure>
                    <img width="250" height="250" src="assets/images/6.jpg"
                                                                               alt="img06"/>
                    <figcaption>
                        <h2 class="photostack-title">Forever this</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/7.jpg" alt="img07"/>
                    <figcaption>
                        <h2 class="photostack-title">Lovely Green</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/8.jpg" alt="img08"/>
                    <figcaption>
                        <h2 class="photostack-title">Wonderful</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/9.jpg" alt="img09"/>
                    <figcaption>
                        <h2 class="photostack-title">Love Addict</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/10.jpg" alt="img10"/>
                    <figcaption>
                        <h2 class="photostack-title">Friendship</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/11.jpg" alt="img11"/>
                    <figcaption>
                        <h2 class="photostack-title">White Nights</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/12.jpg" alt="img12"/>
                    <figcaption>
                        <h2 class="photostack-title">Serendipity</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/13.jpg" alt="img13"/>
                    <figcaption>
                        <h2 class="photostack-title">Pure Soul</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/14.jpg" alt="img14"/>
                    <figcaption>
                        <h2 class="photostack-title">Winds of Peace</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/15.jpg" alt="img15"/>
                    <figcaption>
                        <h2 class="photostack-title">Shades of blue</h2>
                    </figcaption>
                </figure>
                <figure data-dummy>
                    <img width="250" height="250" src="assets/images/16.jpg" alt="img16"/>
                    <figcaption>
                        <h2 class="photostack-title">Lightness</h2>
                    </figcaption>
                </figure>
            </div>
        </section>

    </div>
    <?php require 'app/footer.php'; ?>
</div>
<?php require 'app/scripts.php'; ?>
<script src="assets/js/classie.js"></script>
<script src="assets/js/photostack.js"></script>
<script>
    [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );

    new Photostack(document.getElementById('photostack-1'), {
        callback: function (item) {
            //console.log(item)
        }
    });
    new Photostack(document.getElementById('photostack-2'), {
        callback: function (item) {
            //console.log(item)
        }
    });
    new Photostack(document.getElementById('photostack-3'), {
        callback: function (item) {
            //console.log(item)
        }
    });
</script>
</body>
</html>