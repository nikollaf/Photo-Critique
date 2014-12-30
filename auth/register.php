<?php 
require '../core/init.php';

//require '../image/main.php';
include 'header.php';



/*
 * require '../api/vendor/cloudinary/src/Cloudinary.php';
require '../api/vendor/cloudinary/src/Uploader.php';
\Cloudinary::config(array(
    "cloud_name" => "world-lens",
    "api_key" => "781845222781788",
    "api_secret" => "oNd9Onx3lFdwo6WIA1wLilO4gww"
));
*/


//error_reporting(E_ALL);
//print_r($_SESSION);

//$general->logged_in_protect();

if (isset($_POST['submit'])) {

	if(empty($_POST['password']) || empty($_POST['email'])){
		$errors[] = 'All fields are required.';
	}else{

        if (strlen($_POST['password']) <6){
            $errors[] = 'Your password must be atleast 6 characters';
        } else if (strlen($_POST['password']) >18){
            $errors[] = 'Your password cannot be more than 18 characters long';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }else if ($users->email_exists($_POST['email']) === true) {
            $errors[] = 'That email already exists.';
        }
	}

	if(empty($errors) === true){
		
		
		$password 	= $_POST['password'];
		$email 		= htmlentities($_POST['email']);
		$first_name = htmlentities($_POST['first_name']);

		$users->register($email, $first_name, $password);

        // Log them in
	    $login = $users->login($_POST['email'], $_POST['password']);
		
		if ($login === false) {
			$errors[] = 'Sorry, that username/password is invalid';
		}else {
			
			session_regenerate_id(true);// destroying the old session id and creating a new one
			
			$full_name = $login['first_name'];
			$_SESSION['id'] =  $login['id'];
			$_SESSION['full_name'] = $full_name;
			$_SESSION['profile_pic'] = $login['profile_pic'];
			header('Location: ../#/world-feed');
            exit();
		}
	}
}

?>

<div class="row">
    <div class="large-6 large-centered columns">
        <div class="row">
            <div class="large-8 small-12 medium-8 columns">
            <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <h2><small>Almost there..</small></h2>
                <p>
                <?php
                if(empty($errors) === false){
                    echo '<p class="text-error">' . implode('</p><p>', $errors) . '</p>';
                }

                ?>
            </p>
            <hr class="colorgraph">
            <div class="row">
                <div class="small-12 large-12 columns">
                    <div class="form-group">
                        <input type="text" value="<?php if(isset($_POST['first_name'])) echo htmlentities($_POST['first_name']); ?>" name="first_name" id="first_name" class="form-control input-lg" placeholder="Name" tabindex="1">
                    </div>
                </div>
            </div>
            <!--
            <div class="form-group">
                <input type="text" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>" name="username" id="username" class="form-control input-lg" placeholder="Username" tabindex="3">
            </div>
            -->
            <div class="form-group">
                <input type="email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
            </div>
            <!--
            <div class="form-group">
                <h4>Profile Picture</h4>
                <input id="fileupload" type="file" name="file" accept="image/gif, image/jpeg, image/png">
            </div>
            -->
            <div class="row">
                <div class="small-6 medium-6 columns"><input type="submit" name="submit" value="Register" class="btn btn-register btn-block btn-lg" tabindex="7"></div>
                <div class="small-6 medium-6 columns"><a href="login.php" class="btn btn-login btn-block btn-lg">Sign In</a></div>
            </div>
            <br>
            <div class="row">
                <div class="large-12 small-9 medium-9 columns">
                    By registering, you agree to the <a href="" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a>.
                </div>
            </div>
            </form>
            </div>
            <div class="large-4 medium-4 columns">
            <h4>Sneak Peek</h4>
            <p>Change your username/password at any time.</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){


        slideReviews();

        function slideReviews() {
            var current = $('.reviews .hide_it');
            var next = current.next().length ? current.next() : current.siblings().first();

            current.hide().removeClass('hide_it');
            next.fadeIn().addClass('hide_it');

            setTimeout(slideReviews, 700);

        }


    });

</script>
<?php
include 'footer.php';
?>

























