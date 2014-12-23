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

    .banner .dots {
        position: absolute;
        left: 0;
        right: 0;
        bottom: -20px;
    }
</style>

<div class="row">
    <div class="text-center intro">
        <h1>Post Better Photos</h1>

        <p>Get real feedback on your photos, develop your passion for photography, and become part of the community where photography is not only encouraged., but strengthened.</p>

        <a href="/auth/register.php">Register</a>
    </div>
    <p></p>


       
         <!--    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <h4>Come aboard. You can always edit/change your username <small></small></h4>
                <p>
                <?php
             

                ?>
            </p>
           
           
               
           
            <!--
            <div class="form-group">
                <input type="text" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>" name="username" id="username" class="form-control input-lg" placeholder="Username" tabindex="3">
            </div>
          
            <div class="row">
                <div class="form-group small-6 medium-6 columns">
                    <input type="email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>" name="email" id="email" class="form-control" placeholder="Email Address" tabindex="4">
                </div>
                <div class="form-group small-6 medium-6 columns">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" tabindex="5">
                </div>
            </div>
            
            <div class="form-group">
                <h4>Profile Picture</h4>
                <input id="fileupload" type="file" name="file" accept="image/gif, image/jpeg, image/png">
            </div>
          
            <div class="row">
                <div class="small-6 medium-6 columns"><input type="submit" name="submit" value="Register" class="btn btn-register btn-block btn-lg" tabindex="7"></div>
                <div class="small-6 medium-6 columns"></div>
            </div>
            <br>
            <div class="row">
                <div class="large-12 small-9 medium-9 columns">
                    By registering, you agree to the <a href="" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a>.
                </div>
            </div>
        </form> -->

</div>

<div class="container">
    <div class="row">
        <h3 class="text-center">What makes a photo stand out?</h3>

        <div class="row">
            <div class="medium-6">
                <h3>Composure</h3>
                <p>In a strong photo, there should be a sense of overall organization. While entire books are written on composition, at the most basic level, composition is the process of establishing a sense of order for the elements within an image. Note Composition rules or guidelines are a helpful starting point, but they are useful only as long as they enhance the overall image.</p>
            </div>
            <div class="medium-6"></div>
        </div>

        <div class="row">
            <div class="medium-6">
                
            </div>
            <div class="medium-6">
                <h3>Focus</h3>
                <p>In a strong photo, there should be a sense of overall organization. While entire books are written on composition, at the most basic level, composition is the process of establishing a sense of order for the elements within an image. Note Composition rules or guidelines are a helpful starting point, but they are useful only as long as they enhance the overall image.</p>
            </div>
        </div>

        <div class="row">
            <div class="medium-6">
                <h3>Lighting</h3>
                <p>In a strong photo, there should be a sense of overall organization. While entire books are written on composition, at the most basic level, composition is the process of establishing a sense of order for the elements within an image. Note Composition rules or guidelines are a helpful starting point, but they are useful only as long as they enhance the overall image.</p>
            </div>
            <div class="medium-6">
                
            </div>
        </div>

        <div class="row">
            <div class="medium-6">
                
            </div>
            <div class="medium-6">
                <h3>Creativity</h3>
                <p>In a strong photo, there should be a sense of overall organization. While entire books are written on composition, at the most basic level, composition is the process of establishing a sense of order for the elements within an image. Note Composition rules or guidelines are a helpful starting point, but they are useful only as long as they enhance the overall image.</p>
            </div>
        </div>

        <div class="row">
            <div class="medium-6">
                <h3>Story</h3>
                <p>In a strong photo, there should be a sense of overall organization. While entire books are written on composition, at the most basic level, composition is the process of establishing a sense of order for the elements within an image. Note Composition rules or guidelines are a helpful starting point, but they are useful only as long as they enhance the overall image.</p>
            </div>
            <div class="medium-6">
                
            </div>
        </div>
    </div>
</div>


<script>

    //http://tympanus.net/codrops/2011/09/30/scrollbar-visibility-with-jscrollpane/
    // $('.banner').unslider({
    //     speed: 500,               //  The speed to animate each slide (in milliseconds)
    //     delay: 3000,              //  The delay between slide animations (in milliseconds)
    //     complete: function() {},  //  A function that gets called after every slide animation
    //     keys: true,               //  Enable keyboard (left, right) arrow shortcuts
    //     dots: true,               //  Display dot navigation
    //     fluid: false              //  Support responsive design. May break non-responsive designs
    // });
</script>

