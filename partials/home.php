<?php
require '../core/session.php';

if (!empty($_SESSION['id'])) {
    //header("Location: http://localhost/projects/worldlens-dev2/#/world-feed");
    //exit();
}

?>

<style>
    .banner { position: relative; overflow: auto; }
    .banner li { list-style: none; }
    .banner ul li { float: left; }

    .banner .dots li {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin: 0 4px;
        text-indent: -999em;
        border: 2px solid #555;
        border-radius: 6px;
        cursor: pointer;
        opacity: .4;
        -webkit-transition: background .5s, opacity .5s;
        -moz-transition: background .5s, opacity .5s;
        transition: background .5s, opacity .5s;
    }

    .banner .dots {
        position: absolute;
        left: 0;
        right: 0;
        bottom: -20px;
    }
</style>

<div class="row">
    <div class="banner">
        <ul>
            <li>
                <h4>Popular</h4>
                <p>View the best photographs from all over the world</p>
            </li>
            <li>
                <h4>Vibes</h4>
                <p>A fun way to express your feelings
                    <br>Show others how each photograph makes you feel</small>
                </p>
            </li>
            <li>
                <h4>Highlights</h4>
                <p>Display your favorite photographs
                    <br>Show others how each photograph makes you feel</p>
                </p>
            </li>
            <li>
                <h4>Chance</h4>
                <p>Look at a variety of photographs with one click
                    <br>Compare and contrast different categories from different cities
                </p>
            </li>
        </ul>
    </div>
</div>

<script>

    //http://tympanus.net/codrops/2011/09/30/scrollbar-visibility-with-jscrollpane/
    $('.banner').unslider({
        speed: 500,               //  The speed to animate each slide (in milliseconds)
        delay: 3000,              //  The delay between slide animations (in milliseconds)
        complete: function() {},  //  A function that gets called after every slide animation
        keys: true,               //  Enable keyboard (left, right) arrow shortcuts
        dots: true,               //  Display dot navigation
        fluid: false              //  Support responsive design. May break non-responsive designs
    });
</script>

