<?php
require 'main.php';
//require '../api/index.php';
# You can add here your custom verification code

# Check for a valid Cloudinary response

$api_secret = Cloudinary::config_get("api_secret");
if (!$api_secret) throw new \InvalidArgumentException("Must supply api_secret");
$existing_signature = \Cloudinary::option_consume($_POST, "signature");
$to_sign = array(
    'public_id' => $_POST['public_id'],
    'version' => $_POST['version'],
);
$calculated_signature = \Cloudinary::api_sign_request($to_sign, $api_secret);




function addImage($public_id, $user_id_fk, $category) {

    //$request = Slim::getInstance()->request();
    //$wine = json_decode($request->getBody());
    $sql = "INSERT INTO images SET image_url = :public_id, user_id_fk = :user_id_fk, categories = :category";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":public_id", $public_id);
        $stmt->bindParam(":user_id_fk", $user_id_fk);
        $stmt->bindParam(":category", $category);
        $stmt->execute();
        $db = null;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function getConnection() {
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="albania1";
    $dbname="worldlens_db";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


addImage($_POST['public_id'], 4, 'food');


if ($existing_signature == $calculated_signature) {
    # Create a model record using the data received (best practice is to save locally
    # only data needed for reaching the image on Cloudinary - public_id and version;
    # and fields that might be needed for your application (e.g.,), width, height)
    $photo = \PhotoAlbum\create_photo_model($_POST);
} else {
    error_log("Received signature verficiation failed (" .
        $existing_signature . " != " . $calculated_signature . "). data: " .
        \PhotoAlbum\ret_var_dump($_POST));
}

?>
