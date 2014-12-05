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


$sql = "SELECT * FROM location WHERE city = :city AND country = :country || city = :city AND state = :state";
   try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":city", $_POST['city']);
    $stmt->bindValue(":state", $_POST['state']);
    $stmt->bindValue(":country", $_POST['country']);

    $stmt->execute();

    $gallery_id = $db->lastInsertId();
    $db = null;

  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }

$city = $stmt->fetch();

if (!empty($city)) {
  $city_id_fk = $city['l_id'];
  //echo $city_id_fk;

} else {
  $sql = "INSERT INTO location SET city = :city, state = :state, country = :country, cont = :region";
      try {
          $db = getConnection();
          $stmt = $db->prepare($sql);
          $stmt->bindParam(":city", $_POST['city']);
          $stmt->bindParam(":state", $_POST['state']);
          $stmt->bindParam(":country", $_POST['country']);
          $stmt->bindParam(":region", $_POST['region']);

          $stmt->execute();

          $city_id_fk = $db->lastInsertId();
          $db = null;

          //echo $city_id_fk;

      } catch(PDOException $e) {
          echo '{"error":{"text":'. $e->getMessage() .'}}';
      }
}



function feed($city_id_fk, $user_id_fk) {

  $sql = "INSERT INTO gallery SET city_id_fk = :city_id_fk, user_id_fk = :user_id_fk";
  try {
      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam(":city_id_fk", $city_id_fk);
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

function addImage($public_id, $user_id_fk, $category, $gallery, $status, $vibe, $city_id_fk, $caption) {

    //$request = Slim::getInstance()->request();
    //$wine = json_decode($request->getBody());
    $sql = "INSERT INTO images SET image_url = :public_id,
    status = :status,
    user_id_fk = :user_id_fk, categories = :category, gallery_id = :gallery, vibes = :vibe, image_l_id = :image_l_id, img_caption = :img_caption";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":public_id", $public_id);
        $stmt->bindParam(":user_id_fk", $user_id_fk);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":gallery", $gallery);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":vibe", $vibe);
        $stmt->bindParam(":image_l_id", $city_id_fk);
        $stmt->bindParam(":img_caption", $caption);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//http://stackoverflow.com/questions/14069421/in-html5-how-to-show-preview-of-image-before-upload

$categories[] = '';
$status[] = '';
$vibe[] = '';

foreach ($_POST['category'] as $key => $value) {

  array_push($categories, $value);
}


foreach ($_POST['status'] as $key => $value) {

  array_push($status, $value);
}

foreach($_POST['vibe'] as $key => $value) {
  array_push($vibe, $value);
}


//////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

function create_photo($file_path, $categories, $gallery_id, $status, $vibe, $city_id_fk, $caption) {
  # Upload the received image file to Cloudinary
  $result = \Cloudinary\Uploader::upload($file_path, array(
   "tags" => $_POST['category'],
  ));

  addImage($result['public_id'], $_SESSION['id'], $categories, $gallery_id, $status, $vibe, $city_id_fk, $caption);
}

//print_r($_FILES);

feed($city_id_fk, $_SESSION['id']);

if (isset($_FILES) && !empty($_FILES)) {

    //print_r($_POST);

    $files = $_FILES["files"];
    $files = is_array($files) ? $files : array($files);
    $files_data = array();


    foreach ($files["tmp_name"] as $index => $value) {
      $num = $index + 1;
      array_push($files_data, create_photo($value, $categories[$num], $gallery_id, $status[$num], $vibe[$num], $city_id_fk, $_POST['caption']));
      //echo $value;
    }

} else if (isset($_POST['instagram'])) {

    print_r($_POST);


    foreach ($_POST['instagram'] as $index => $value) {

        $num = $index + 1;
        echo $value;

        create_photo($value, $categories[$num], $gallery_id, $status[$num], $vibe[$num], $city_id_fk, $_POST['caption']);
        //echo $value;
    }

}

header('Location: ../#/upload');
exit();

?>