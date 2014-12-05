<?php
include '../core/init.php';
include 'header.php';

require '../api/vendor/cloudinary/src/Cloudinary.php';
require '../api/vendor/cloudinary/src/Uploader.php';

\Cloudinary::config(array(
    "cloud_name" => "world-lens",
    "api_key" => "781845222781788",
    "api_secret" => "oNd9Onx3lFdwo6WIA1wLilO4gww"
));


if (isset($_SESSION['id'])) {

    $profile_data = $users->userdata($_SESSION['id']);

}

if (isset($_POST['submit'])) {

    print_r($_POST);
    print_r($_FILES);

    if(empty($_POST['email'])){
        $errors[] = 'All fields are required.';
    }else{

        /*
        if (strlen($_POST['password']) <6){
            $errors[] = 'Your password must be atleast 6 characters';
        } else if (strlen($_POST['password']) >18){
            $errors[] = 'Your password cannot be more than 18 characters long';
        }
        */

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter a valid email address';
        }
    }

    if (!empty($_FILES['file']['tmp_name'])) {
        $files = $_FILES["file"];
        $result = \Cloudinary\Uploader::upload($files["tmp_name"]);
        $pic = $result['public_id'];

    } else {
        $pic = $profile_data['profile_pic'];
    }

    if (!empty($_POST['location'])) {
        $location = htmlentities($_POST['location']);
    } else {
        $location = '';
    }

    echo $pic;


    if(empty($errors) === true){


        //$password 	= $_POST['password'];
        $email 			= htmlentities($_POST['email']);
        $first_name = htmlentities($_POST['first_name']);

        $info 			= htmlentities($_POST['info']);


        $users->update($email, $first_name, $info, $pic, $location, $_SESSION['id']);

        header('Location: ../#/world-feed');
        exit();
    }
}

?>

    <div id="row">
        <div class="large-6 small-12 medium-12 large-centered columns">
            <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <h2>Update <small></small></h2>
                <p>
                    <?php
                    if(empty($errors) === false){
                        echo '<p class="text-error">' . implode('</p><p>', $errors) . '</p>';
                    }

                    ?>
                </p>

                <div class="row">
                    <div class="small-6 large-6 columns">
                        <div class="form-group">
                            <input type="text" value="<?php if(isset($_POST['first_name'])) { echo htmlentities($_POST['first_name']); } else { echo $profile_data['first_name']; } ?>" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <input type="email" value="<?php if(isset($_POST['email'])) { echo htmlentities($_POST['email']); } else { echo $profile_data['email']; } ?>" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                </div>

                <div class="form-group">
                    <input type="text" value="<?php if(isset($_POST['location'])) { echo htmlentities($_POST['location']); } else { echo $profile_data['location']; } ?>" name="location" id="email" class="form-control input-lg" placeholder="Your location" tabindex="4">
                </div>
                <!--
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
                </div>
                -->
                <div class="form-group">
                    <h4>Profile Picture</h4>
                    <input id="fileupload" type="file" name="file" accept="image/gif, image/jpeg, image/png">
                </div>

                <div class="form-group">
                 <textarea class="form-control" name="info" rows="5"><?php if(isset($_POST['info'])) { echo htmlentities($_POST['info']); } else { echo $profile_data['info']; } ?></textarea>
                </div>


                <hr class="colorgraph">
                <div class="row">

                    <div class="large-12 columns"><input type="submit" name="submit" value="Submit" class="btn btn-register btn-block btn-lg"></div>
                </div>
            </form>
        </div>
    </div>
<?php include 'footer.php'; ?>