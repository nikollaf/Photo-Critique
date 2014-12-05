<?php
require '../core/init.php';
include 'header.php';

$general->logged_in_protect();

if (empty($_POST) === false) {

	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	if (empty($email) === true || empty($password) === true) {
		$errors[] = 'PLease enter your email and password.';
	//} else if ($users->user_exists($username) === false) {
		//$errors[] = 'Sorry that username doesn\'t exists.';
		/*
	} else if ($users->email_confirmed($email) === false) {
		$errors[] = 'Sorry, but you need to activate your account. 
					 Please check your email.';
					 */
	} else if (strlen($password) > 18)
    {
        $errors[] = 'The password should be less than 18 characters, without spacing.';
    }


		
    $login = $users->login($email, $password);

    if ($login === false) {

        $errors[] = 'Sorry, that username/password is invalid';

    }else if (empty($errors)) {


        //session_regenerate_id(true);// destroying the old session id and creating a new one

        $full_name = $login['first_name'] . ' ' . $login['last_name'];
        $_SESSION['id'] =  $login['id'];

        $_SESSION['full_name'] = $full_name;
        $_SESSION['profile_pic'] = $login['profile_pic'];
        header('Location: ../#/world-feed');
        exit();
    }

} 



?>
<div class="row">
	<div class="medium-6 medium-centered login columns">
		<h3>Log In</h3>

		<?php 
		if(empty($errors) === false){
			echo '<p>' . implode('</p><p>', $errors) . '</p>';	
		}
		?>
		<div class="form-box">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="row">
                    <div class="medium-2 columns">
                        <h4>Username:</h4>
                    </div>
                    <div class="medium-9 columns">
                        <input type="text" class="form-control" name="email" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email']); ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="medium-2 columns">
                        <h4>Password:</h4>
                    </div>
                    <div class="medium-9 columns">
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>
				<br>
				<input type="submit" class="btn btn-default" value="Login" name="submit" />
			</form>
		</div>
		<br>
		<a href="confirm-recover.php">Forgot your username/password?</a>
		<h3>Don't have an account? <a href="register.php">Register here</a>

	</div>
</div>
<?php
include 'footer.php';
?>