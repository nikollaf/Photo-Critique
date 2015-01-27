<?php
require '../core/session.php';

if (!empty($_SESSION['id'])) {
    header("Location: http://localhost/projects/worldlens-dev2/#/world-feed");
    exit();
}



?>

<style>
    .banner { position: relative; overflow: auto; }
    .banner li { list-style: none; }
    .banner ul li { float: left; }

    body {
        background-color: white;
    }

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

    #bg {
        background-image: url('./background.png');
        height: 440px;
        color: white;
    }

    #bg h1 {
        color: white;
    }

    #bg .intro {
        padding: 5em 0;
    }

    #bg p {
        font-size: 22px;
    }

    .banner .dots {
        position: absolute;
        left: 0;
        right: 0;
        bottom: -20px;
    }

    .intro {
        text-align: center;
        color: black;
        display: block;
        margin-left: auto;
        margin-right: auto;
        float: none;
        padding: 5em 0;
    }

    .intro h1 {
        color: black
    }

    .cycle {
      background-image: url(http://i.imgur.com/cxAGkCf.jpg);
      height: 415px;
      cursor: move;
    }
</style>

<script>
    $(document).ready(function($) {
        $('.cycle').cyclotron();

        $(".cycle").css('cursor', 'url(http://i.imgur.com/FrQFOJo.png),auto');
    });

</script>

<div class="cycle">
   <div class="large-centered large-6 medium-8 intro">
            <h1>Post Better Photos</h1>

            <p>Get real feedback on your photos, develop your passion for photography, and become part of the community where photography is not only encouraged., but developed.</p>

            <a role="button" href="auth/register.php" class="button large expand alert">Register</a>
        </div>
</div> <!-- /.cycle -->




<div class="container">
    <div class="row">
        <h3 class="text-center">What makes a photo stand out?</h3>

        <div class="row">
            <div class="medium-3 columns">
                <h3>Composure</h3>
                <p>There should be a sense of overall organization. Composition is the process of establishing a sense of order for the elements within an image.</p>
            </div>
          
          
            <div class="medium-3 columns">
                <h3>Focus</h3>
                <p>Is the sharpest point in the image on the center of interest of the subject of the photo? Does the depth of field enhance the subject, mood, or look of the image or does it distract from it?</p>
            </div>
  
            <div class="medium-3 columns">
                <h3>Lighting</h3>
                <p>Light should be used to its maximum potential to reveal what's important in the image and to set the overall tone of the photo. Is light used to enhance the overall mood and intent of the image and subject?</p>
            </div>
           
            <div class="medium-3 columns">
                <h3>Creativity</h3>
                <p></p>
            </div>
   
            <div class="medium-3 columns" style="float: left;">
                <h3>Story</h3>
                <p>In a strong photo, there should be a sense of overall organization. While entire books are written on composition, at the most basic level, composition is the process of establishing a sense of order for the elements within an image. Note Composition rules or guidelines are a helpful starting point, but they are useful only as long as they enhance the overall image.</p>
            </div>
          
        </div>
    </div>
</div>




