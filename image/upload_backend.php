<?php

require '../core/session.php';
require '../core/connect/database.php';
require '../api/vendor/cloudinary/src/Cloudinary.php';
require '../api/vendor/cloudinary/src/Uploader.php';


\Cloudinary::config(array(
    "cloud_name" => "world-lens",
    "api_key" => "781845222781788",
    "api_secret" => "oNd9Onx3lFdwo6WIA1wLilO4gww"
));

//\Cloudinary\Uploader::upload('http://www.example.com/image.jpg');



function feed($user_id_fk) {

  $sql = "INSERT INTO gallery SET user_id_fk = :user_id_fk";
  try {
      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":user_id_fk", $user_id_fk);

      $stmt->execute();

      global $gallery_id;

      $gallery_id = $db->lastInsertId();

      return $gallery_id;

      $db = null;

  } catch(PDOException $e) {
      echo '{"error":{"GALLERY":'. $e->getMessage() .'}}';
  }
}

function addImage($public_id, $user_id_fk, $category, $gallery, $caption) {

    //$request = Slim::getInstance()->request();
    //$wine = json_decode($request->getBody());
    $sql = "INSERT INTO 
                    images 
                SET image_url = :public_id,
             
                    user_id_fk = :user_id_fk, 
                    categories = :category, 
                    gallery_id = :gallery,
                    img_caption = :img_caption";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":public_id", $public_id);
        $stmt->bindParam(":user_id_fk", $user_id_fk);
       
        $stmt->bindParam(":gallery", $gallery);
        $stmt->bindParam(":category", $category);
      
        $stmt->bindParam(":img_caption", $caption);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//http://stackoverflow.com/questions/14069421/in-html5-how-to-show-preview-of-image-before-upload

$categories[] = '';



foreach ($_POST['category'] as $key => $value) {

  array_push($categories, $value);
}







//////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

function create_photo($file_path, $categories, $gallery_id, $caption) {
  # Upload the received image file to Cloudinary
  $result = \Cloudinary\Uploader::upload($file_path, array(
   "tags" => $_POST['category']
  ));

  addImage($result['public_id'], $_SESSION['id'], $categories, $gallery_id, $caption);
}

//print_r($_FILES);

feed($_SESSION['id']);

if (empty($_FILES['files']['size'] != 0)) {



    $files = $_FILES["files"];
    $files = is_array($files) ? $files : array($files);
    $files_data = array();


    foreach ($files["tmp_name"] as $index => $value) {

      print_r($_FILES);
    

      $num = $index + 1;
      array_push($files_data, create_photo($value, $categories[$num], $gallery_id, $_POST['caption']));
      echo $_POST['caption'];

    
    }

} else if (isset($_POST['instagram'])) {

    
    foreach ($_POST['instagram'] as $index => $value) {

        $num = $index + 1;
        echo $value;

        create_photo($value, $categories[$num], $gallery_id, $_POST['caption']);
        //echo $value;
    }

}

header('Location: ../#/upload');
exit();

?>