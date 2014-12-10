<?php

require 'vendor/autoload.php';

require './../core/init.php';


 
$app = new \Slim\Slim();
 
$app->get('/feed', 'getFeed');
$app->get('/feed/:id', 'getImage');
$app->get('/city', 'getCity');
$app->get('/world', 'getWorldFeed');
$app->get('/cities', 'getCities');

$app->post('/image', 'addImage');


$app->get('/image', 'showAllImages');
$app->get('/message', 'getMessage');

$app->post('/message', 'userMessage');

$app->put('/like/:id', 'like');

$app->post('/like', 'likeImage');
$app->put('/like', 'unlikeImage');

$app->get('/city/:id', 'showCity');
$app->put('/city/:id', 'like');

$app->post('/user/:id', 'followUser');
$app->post('/highlight', 'highlight');
$app->put('/highlight', 'unHighlight');

$app->get('/cont/:id', 'getCont');
$app->get('/user/:id', 'getUser');
$app->get('/image/:id', 'showImage');

$app->post('/login', 'login');
$app->post('/register', 'register');

$app->get('/user', 'mainUser');

$app->post('/vote', 'vote');

$app->run();

function register() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    $email = $email->email;
    $password = $password->password;

    $db->getConnection();

    global $bcrypt; // making the $bcrypt variable global so we can use here

        $password   = $bcrypt->genHash($password);

        $query  = $this->db->prepare("INSERT INTO `users`
        SET email = :email, password = :password");


        
        $query->bindParam(':email', $email);
        $query->bindParam(':first_name', $first_name);

        try{
            $query->execute();

             login();

            //mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://www.example.com/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
        }catch(PDOException $e){
            die($e->getMessage());
        }


}


function login() {

    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    $email = $data->email;
    $password = $data->password;

    $db = getConnection();

    global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

    $query = $db->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $query->bindValue(1, $email);


    $query->execute();
    $data 				= $query->fetch();
    $stored_password 	= $data['password']; // stored hashed password


    if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
        //return $data;	// returning the user's id.


        $full_name = $data['first_name'];
        $_SESSION['id'] =  $data['id'];

        $_SESSION['full_name'] = $full_name;
        $_SESSION['profile_pic'] = $data['profile_pic'];


    }else{
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json');
        die('WRONG PASSWORD');
    }

}


/********************************************************/
/*-------------------------------------------------------*/
/*                      ALL IMAGES (GET)               */
/*-------------------------------------------------------*/
/*********************************************************/



function showAllImages() {

    $db = getConnection();

    $images = $db->prepare("SELECT first_name, id, image_url, categories, vibes, img_points, h_points, images.created, image_id, image_l_id
    FROM
        `images`, `users`
    WHERE `images`.`user_id_fk` = `users`.`id`
    AND
    image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)");


    $favorites = $db->prepare("SELECT first_name, id, liked_image, image_url, categories, h_points, image_l_id, vibes, img_points, images.created, image_id
    FROM `favorites`, `images`, `users`
    WHERE `favorites`.`user_id_fk` = :session_id
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)");

    $feature = $db->prepare("SELECT first_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`, `users`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`
    AND image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");

    $full = $db->prepare("SELECT first_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`, `users`, `favorites`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `favorites`.`user_id_fk` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`");


    $favorites->bindValue(":session_id", $_SESSION['id']);
    $feature->bindValue(':session_id', $_SESSION['id']);
    $full->bindValue(':session_id', $_SESSION['id']);
    $images->bindValue(':session_id', $_SESSION['id']);

    try{
        $images->execute();
        $full->execute();
        $favorites->execute();
        $feature->execute();

        $full_images = $full->fetchAll(PDO::FETCH_OBJ);
        $feature_images = $feature->fetchAll(PDO::FETCH_OBJ);
        $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);
        $images_result = $images->fetchAll(PDO::FETCH_OBJ);

    }catch(PDOException $e){
        die($e->getMessage());
    }

    $image_array = array_merge($favorites_results, $images_result, $feature_images, $full_images);


    echo json_encode($image_array);

}

/********************************************************/
/*-------------------------------------------------------*/
/*                        World FEED (GET)               */
/*-------------------------------------------------------*/
/*********************************************************/

function getWorldFeed() {

    $world_array = array();
    $db = getConnection();

    $city = $db->prepare("SELECT  a.l_id, a.points, a.city,
        COUNT(b.image_l_id) uploads,
        SUM(b.h_points) highlights
        FROM  location a
        LEFT JOIN images b
        ON a.l_id = b.image_l_id
        GROUP BY a.l_id
        ORDER BY a.points DESC");



    //$name = $db->prepare("SELECT first_name, last_name, id, profile_pic, id, info FROM `users` WHERE `id` = :id");

    $images = $db->prepare("SELECT first_name, id, image_url, categories, l_id, vibes, img_points, h_points, images.created, image_id, image_l_id   FROM
        `images`, `users`, `location`
    WHERE `images`.`user_id_fk` = `users`.`id`
    AND `images`.`image_l_id` = `location`.`l_id`
    AND
    image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)");


    $favorites = $db->prepare("SELECT first_name, id, liked_image, image_url, categories, h_points, image_l_id, vibes, img_points, images.created, image_id
    FROM `favorites`, `images`, `users`
    WHERE `favorites`.`user_id_fk` = :session_id
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)");

    $feature = $db->prepare("SELECT first_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`, `users`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`
    AND image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");

    $full = $db->prepare("SELECT liked_image, first_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`, `users`, `favorites`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `favorites`.`user_id_fk` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`");


    $favorites->bindValue(":session_id", $_SESSION['id']);


    $feature->bindValue(':session_id', $_SESSION['id']);
    $full->bindValue(':session_id', $_SESSION['id']);
    $images->bindValue(':session_id', $_SESSION['id']);



    try{
        $city->execute();
        $feature->execute();
        $images->execute();

        $favorites->execute();
        $full->execute();
        $cities = $city->fetchAll(PDO::FETCH_OBJ);

        $full_images = $full->fetchAll(PDO::FETCH_OBJ);
        $feature_images = $feature->fetchAll(PDO::FETCH_OBJ);
        $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);
        $images_result = $images->fetchAll(PDO::FETCH_OBJ);

    }catch(PDOException $e){
        die($e->getMessage());
    }

    $image_array = array_merge($favorites_results, $images_result, $feature_images, $full_images);


    $world_info = array(
        'images' => $image_array,
        'cities' => $cities

    );

    $world_array[] = $world_info;

    echo json_encode($world_array);

}

/*-------------------------------------------------------*/
/*                        World FEED (GET)               */
/*-------------------------------------------------------*/
/*********************************************************/


function getCities() {


    $db = getConnection();

    $city = $db->prepare("SELECT * FROM location ORDER BY points DESC");

    $top_image = $db->prepare("SELECT
        image_url
    FROM `images`
    ORDER BY img_points DESC");

    try{
        $city->execute();
        $top_image->execute();
        //$name->execute();
        $cities = $city->fetchAll(PDO::FETCH_OBJ);
        $image = $top_image->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        die($e->getMessage());
    }

    $full_array[] = array_merge($cities, $image);
    echo json_encode($full_array);

}


function mainUser() {

    $user = "SELECT image_id_fk  FROM
        `users`,
        `favorites`
    WHERE
      `users`.`id` = :id
    AND
    `favorites`.`user_id_fk` = `users`.`id`
        ";

    try {
        $db = getConnection();

        $stmt = $db->prepare($user);
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->execute();
        $main_user = $stmt->fetchAll();

        $db = null;
        echo json_encode($main_user);

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    //print_r($feed);
}


function getUser($id) {

    $user_array = array();
    $db = getConnection();

    //$followers = $db->prepare("SELECT COUNT('user_id') FROM `followers` WHERE `follower_id` = :id");
    //$following = $db->prepare("SELECT COUNT('user_id') FROM `followers` WHERE `user_id` = :id");
    $feature_count = $db->prepare("SELECT COUNT(`feature_id`) FROM `feature` WHERE `feature_id` = :id");

    $active_follower = $db->prepare("SELECT `follower_id` FROM `followers` WHERE `follower_id` = :id AND `user_id` = :session_id AND `f_status` = 'Y'");
    $denied_follower = $db->prepare("SELECT `follower_id` FROM `followers` WHERE `follower_id` = :id AND `user_id` = :session_id AND `f_status` = 'N'");
    $waiting = $db->prepare("SELECT `follower_id` FROM `followers` WHERE `follower_id` = :id AND `user_id` = :session_id AND `f_status` = 'W'");


    $name = $db->prepare("SELECT first_name, id, profile_pic, id, info FROM `users` WHERE `id` = :id");

    $feature = $db->prepare("SELECT h_points, image_url, id, first_name FROM `feature`,`images`,`users`
    WHERE `feature`.`feature_user_id` = :id
    AND `feature`.`feature_id` = `users`.`id`
    AND `feature`.`feature_image_id` = `images`.`image_id`");


    // Image Array
    $images = $db->prepare("SELECT h_points, image_url, categories, l_id, vibes, img_points, images.created, image_id
    FROM `gallery`, `images`, `location`, `users`
    WHERE `gallery`.`user_id_fk` = :id
    AND `gallery`.`city_id_fk` = `location`.`l_id`
    AND `images`.`user_id_fk` = `users`.`id`
    AND `gallery`.`image_id_fk` = `images`.`gallery_id`
    AND image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)");


    $favorites = $db->prepare("SELECT h_points, liked_image, image_url, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `favorites`, `images`
    WHERE `favorites`.`user_id_fk` = :session_id
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = :id
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)
    ");

    $feature_images = $db->prepare("SELECT h_points, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `images`.`user_id_fk` = :id
    AND image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");

    $full = $db->prepare("SELECT liked_image, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`, `favorites`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `favorites`.`user_id_fk` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = :id");
    // end of image array

    $following_user = $db->prepare("SELECT first_name, profile_pic FROM `followers`, `users` WHERE user_id = :id AND `followers`.`follower_id` = `users`.`id` AND `f_status` = 'Y'");
    $follower = $db->prepare("SELECT first_name, profile_pic FROM `followers`, `users` WHERE `followers`.`follower_id` = :id AND `followers`.`user_id` = `users`.`id` AND `f_status` = 'Y'");


    $favorites->bindValue(":session_id", $_SESSION['id']);
    $favorites->bindValue(":id", $id);
    $feature_images->bindValue(':session_id', $_SESSION['id']);
    $feature_images->bindValue(':id', $id);
    $full->bindValue(':session_id', $_SESSION['id']);
    $full->bindValue(':id', $id);

    $feature_count->bindValue(":id", $id);

    $following_user->bindValue(":id", $id);
    $follower->bindValue(':id', $id);

    //$followers->bindValue(":id", $id);
    $feature->bindValue(':id', $id);

    $active_follower->bindValue(":session_id", $_SESSION['id']);
    $active_follower->bindValue(":id", $id);

    $denied_follower->bindValue(":session_id", $_SESSION['id']);
    $denied_follower->bindValue(":id", $id);

    $waiting->bindValue(":session_id", $_SESSION['id']);
    $waiting->bindValue(":id", $id);

    $name->bindValue(":id", $id);
    $images->bindValue(":id", $id);
    $images->bindValue(':session_id', $_SESSION['id']);
    //$following->bindValue(":id", $id);

    try{
        //$followers->execute();
        $name->execute();
        $denied_follower->execute();
        $waiting->execute();
        $feature_images->execute();
        $full->execute();
        //$following->execute();
        $images->execute();
        $active_follower->execute();
        $favorites->execute();
        $feature->execute();
        $feature_count->execute();
        $following_user->execute();
        $follower->execute();
        //$rows = $followers->fetchColumn();
        $featured = $feature->fetchAll(PDO::FETCH_OBJ);
        //$following_rows = $following->fetchColumn();
        $session_id = $active_follower->fetch();

        $denied = $denied_follower->fetch();
        $wait = $waiting->fetch();

        $featured_count = $feature_count->fetchColumn();
        $name_result = $name->fetch();
        $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);
        $images_result = $images->fetchAll(PDO::FETCH_OBJ);
        $feature_results = $feature_images->fetchAll(PDO::FETCH_OBJ);
        $full_results = $full->fetchAll(PDO::FETCH_OBJ);
        $following_users = $following_user->fetchAll(PDO::FETCH_OBJ);
        $followers = $follower->fetchAll(PDO::FETCH_OBJ);

    }catch(PDOException $e){
        die($e->getMessage());
    }


    $full_array = array_merge($images_result, $favorites_results, $feature_results, $full_results);

   if (is_array($session_id)) {
       $connected = 'connected';
   } else {
       $connected = '';
   }

    if (is_array($denied)) {
        $denied_user = 'denied';
    } else {
        $denied_user = '';
    }

    if (is_array($wait)) {
        $waiting_user = 'waiting';
    } else {
        $waiting_user = '';
    }

    $user_inf = array(
        'id' => $name_result['id'],
        'name' => $name_result['first_name'],
        'profile_pic' => $name_result['profile_pic'],
        'info' => $name_result['info'],
        'images' => $full_array,
        'active_follower' => $connected,
        'denied_follower' => $denied_user,
        'waiting_follower' => $waiting_user,
        'current_user' => $_SESSION['id'],
        'featured_count' => $featured_count,
        'featured' => $featured,
        'following_users' => $following_users,
        'follower_users' => $followers

    );

    $user_array[] = $user_inf;

    echo json_encode($user_array);

}


function getFeed() {

    $db = getConnection();

    /*
    $users = $db->prepare("SELECT  a.id, a.first_name
        COUNT(b.image_l_id) uploads,
        SUM(b.h_points) highlights
        FROM  users a
        LEFT JOIN images b
        ON a.id = b.user_id_fk
        GROUP BY a.id
        ORDER BY a.points DESC");
    */


    $feed = "SELECT * FROM
        `gallery`,
        `users`,
        `images`,
        `location`
    WHERE
      `users`.`id` = `gallery`.`user_id_fk`
    AND
    `gallery`.`city_id_fk` = `location`.`l_id`
    AND
        `images`.`gallery_id` = `gallery`.`image_id_fk`
    GROUP BY
    `gallery`.`image_id_fk`
    ORDER BY
    `gallery`.`image_id_fk` DESC
    ";

    try {

        //$users->execute();
        //$users_results = $users->fetchAll(PDO::FETCH_OBJ);

        $stmt = $db->prepare($feed);
        $stmt->execute();
        $live_feed = $stmt->fetchAll();

        $db = null;
        echo json_encode($live_feed);

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

function getImage($id) {

    $feed = "SELECT image_url, gallery_id, image_id FROM
        `gallery`,
        `images`
    WHERE
      `images`.`gallery_id` = :id
    AND
        `gallery`.`image_id_fk` = :id
        ";

    try {
        $db = getConnection();
        $stmt = $db->prepare($feed);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $live_feed = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($live_feed);

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }


    //print_r($feed);
}


function getCont($id) {

  $cont_feed = '';
  $image = '';

    $feed = "SELECT * FROM
        `location`
    WHERE
      `location`.`cont` LIKE :id
     ORDER BY points DESC
        ";

    try {
        $db = getConnection();
        $stmt = $db->prepare($feed);
        $stmt->bindValue(':id', '%' . $id . '%');
        $stmt->execute();
        $cont_feed = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    $image = "SELECT `image_id`, `img_points`, `image_url`, `city`, `country`, `first_name`,`cont`,`state` FROM
        `gallery`,
        `location`,
        `images`,
        `users`
    WHERE
      `location`.`cont` LIKE :id
     AND
      `images`.`user_id_fk` = `users`.`id`
     AND
      `gallery`.`city_id_fk` = `location`.`l_id`
    AND
      `gallery`.`image_id_fk` = `images`.`gallery_id`
   GROUP BY
      `image_id`
   ORDER BY
    `img_points` DESC
        ";

    try {
        $db = getConnection();
        $stmt = $db->prepare($image);
        $stmt->bindValue(':id', '%' . $id . '%');
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    $cont_feed[] = $image;

   echo json_encode($cont_feed);

    //print_r($feed);
}




function showImage($id) {

    $db = getConnection();

    $image = $db->prepare("SELECT *
    FROM `images`,`users`, `location`
    WHERE `images`.`image_id` = :id
    AND `images`.`user_id_fk` = `users`.`id`
    AND  `images`.`image_l_id` = `location`.`l_id`");


    $favorites = $db->prepare("SELECT id, created, first_name, id, liked_image
    FROM `favorites`, `users`
    WHERE `favorites`.`user_id_fk` = `users`.`id`
    AND `favorites`.`liked_image` = :id");

    $highlight = $db->prepare("SELECT id, first_name, created, feature_image_id
    FROM `feature`, `users`
    WHERE `feature`.`feature_user_id` = `users`.`id`
    AND `feature`.`feature_image_id` = :id");
/*
    $feature = $db->prepare("SELECT first_name, last_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, created, image_id
    FROM `feature`, `images`, `users`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`
    AND image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");

    $full = $db->prepare("SELECT liked_image, first_name, last_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, created, image_id
    FROM `feature`, `images`, `users`, `favorites`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `favorites`.`user_id_fk` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`");

    */
    $comment = $db->prepare("SELECT id, created, comment, first_name FROM img_comments INNER JOIN users WHERE image_id_fk = :id AND user_id_fk = id");


    $comment->bindParam(":id", $id);
    $favorites->bindParam(':id', $id);
    $image->bindValue(":id", $id);

    $highlight->bindValue(':id', $id);

    try{
        $favorites->execute();
        $comment->execute();
        $image->execute();
        $highlight->execute();
    }catch(PDOException $e){
        die($e->getMessage());
    }
   // $favorites_results = $favorites->fetchAll();

   // $city_results = $city->fetch();
    $image_results = $image->fetch();
    $comments = $comment->fetchAll(PDO::FETCH_OBJ);
    $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);
    $highlights_results = $highlight->fetchAll(PDO::FETCH_OBJ);

    $user_image = $db->prepare("SELECT image_url, image_id
    FROM images
    WHERE user_id_fk = :id
    AND image_id <> :image_id
    ORDER BY img_points DESC
    LIMIT 50
    ");

    $city_image = $db->prepare("SELECT image_url, image_id
    FROM images
    WHERE image_l_id = :id
    AND image_id <> :image_id
    ORDER BY img_points DESC
    LIMIT 50
    ");

    $category = $db->prepare("SELECT image_url, image_id
    FROM images
    WHERE categories = :id
    AND image_id <> :image_id
    ORDER BY img_points DESC
    LIMIT 50
    ");

    $vibe = $db->prepare("SELECT image_url, image_id
    FROM images
    WHERE vibes = :id
    AND image_id <> :image_id
    ORDER BY img_points DESC
    LIMIT 50
    ");

    $user_image->bindValue(":id", $image_results['user_id_fk']);
    $user_image->bindValue(":image_id", $id);

    $city_image->bindValue(":id", $image_results['image_l_id']);
    $city_image->bindValue(":image_id", $id);

    $category->bindValue(':id', $image_results['categories']);
    $category->bindValue(":image_id", $id);

    $vibe->bindValue(':id', $image_results['vibes']);
    $vibe->bindValue(":image_id", $id);

    $city_image->execute();
    $user_image->execute();
    $category->execute();
    $vibe->execute();



    $user_images = $user_image->fetchAll(PDO::FETCH_OBJ);
    $city_images = $city_image->fetchAll(PDO::FETCH_OBJ);
    $categories = $category->fetchAll(PDO::FETCH_OBJ);
    $vibes = $vibe->fetchAll(PDO::FETCH_OBJ);

    $full_feed = array_merge($comments, $favorites_results, $highlights_results);



    $city_inf = array(
        'id' => $image_results['image_id'],
        'image_url' => $image_results['image_url'],
        'points' => $image_results['img_points'],
        'user_name' => $image_results['first_name'],
        'profile_pic' => $image_results['profile_pic'],
        'highlights' => $image_results['h_points'],
        'category' => $image_results['categories'],
        'caption' => $image_results['img_caption'],
        'vibe' => $image_results['vibes'],
        'city' => $image_results['city'],
        'user_id' => $image_results['id'],
        'l_id' => $image_results['image_l_id'],
        'date' => date("Y-m-d H:i:s", strtotime($image_results['created'])),
        'user_image' => $user_images,
        'city_image' => $city_images,
        'feed' => $full_feed,
        'categories' => $categories,
        'vibes' => $vibes
    );

    $city_array = '';

    $city_array[] = $city_inf;

    echo json_encode($city_array);

}




function showCity($id) {

    $db = getConnection();

    $city = $db->prepare("SELECT `points`, `city`, `l_id`, `cont` FROM `location` WHERE `l_id` = :id");
;

    $upload = $db->prepare("SELECT
        COUNT(b.image_l_id) uploads,
        SUM(b.h_points) highlights,
        COUNT(DISTINCT b.user_id_fk) members
        FROM  location a
        LEFT JOIN images b
        ON a.l_id = b.image_l_id
        WHERE a.l_id = :id");

    $images = $db->prepare("SELECT first_name, id, image_url, categories, vibes, img_points, h_points, images.created, image_id, image_l_id   FROM
        `images`, `users`
    WHERE `images`.`user_id_fk` = `users`.`id`
    AND `images`.`image_l_id` = :id
    AND
    image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)");


    $favorites = $db->prepare("SELECT first_name, id, liked_image, image_url, categories, h_points, image_l_id, vibes, img_points, images.created, image_id
    FROM `favorites`, `images`, `users`
    WHERE `favorites`.`user_id_fk` = :session_id
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `image_l_id` = :id
    AND `images`.`user_id_fk` = `users`.`id`
    AND image_id NOT IN(SELECT feature_image_id FROM feature WHERE feature_image_id = image_id AND feature_user_id = :session_id)");

    $feature = $db->prepare("SELECT first_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`, `users`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `image_l_id` = :id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`
    AND image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");

    $full = $db->prepare("SELECT liked_image, first_name, id, feature_image_id, image_url, h_points, categories, image_l_id, vibes, img_points, images.created, image_id
    FROM `feature`, `images`, `users`, `favorites`
    WHERE `feature`.`feature_user_id` = :session_id
    AND `image_l_id` = :id
    AND `favorites`.`user_id_fk` = :session_id
    AND `feature`.`feature_image_id` = `images`.`image_id`
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`");

    try{
        $favorites->bindValue(":session_id", $_SESSION['id']);
        $feature->bindValue(':session_id', $_SESSION['id']);
        $full->bindValue(':session_id', $_SESSION['id']);
        $images->bindValue(':session_id', $_SESSION['id']);
        $favorites->bindValue(":id", $id);
        $feature->bindValue(':id', $id);
        $full->bindValue(':id', $id);
        $images->bindValue(':id', $id);
        $city->bindValue(":id", $id);

        $upload->bindValue(":id", $id);


        $favorites->execute();
        $city->execute();
        $images->execute();
        $full->execute();
        $feature->execute();

        $upload->execute();

    }catch(PDOException $e){
        die($e->getMessage());
    }


    $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);

    $feature_results = $feature->fetchAll(PDO::FETCH_OBJ);
    $full_results = $full->fetchAll(PDO::FETCH_OBJ);
    $city_results = $city->fetch();
    $images_results = $images->fetchAll(PDO::FETCH_OBJ);
    $uploads = $upload->fetch();


    $full_array = array_merge($images_results, $favorites_results, $full_results, $feature_results);

    $near = $db->prepare("SELECT `points`, `city`, `l_id` FROM `location` WHERE cont = :cont
    AND l_id NOT IN (SELECT l_id FROM location WHERE l_id = :id) ORDER BY points DESC");
    $near->bindValue(':cont', $city_results['cont']);
    $near->bindValue(':id', $id);
    $near->execute();
    $near_cities = $near->fetchAll(PDO::FETCH_OBJ);

    $city_inf = array(
        'id' => $city_results['l_id'],
        'city' => $city_results['city'],
        'cont' => $city_results['cont'],
        'points' => $city_results['points'],
        'images' => $full_array,
        'near' => $near_cities,
        'highlights' => $uploads['highlights'],
        'members' => $uploads['members'],
        'uploads' => $uploads['uploads']
    );

    $city_array[] = $city_inf;

    echo json_encode($city_array);

}

function getCity() {
    //$sql = "SELECT * FROM location, images WHERE image_l_id = l_id GROUP BY image_l_id ORDER BY points DESC, img_points DESC";

    $sql = "SELECT  a.l_id, a.points, a.city,
        COUNT(b.image_l_id) uploads,
        SUM(b.h_points) highlights,
        b.image_url,
        b.image_id,
        COUNT(DISTINCT b.user_id_fk) members
        FROM  location a
        LEFT JOIN images b
        ON a.l_id = b.image_l_id
        GROUP BY a.l_id
        ORDER BY b.img_points DESC ";

    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $city = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($city);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addImage() {

    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    $sql = "INSERT INTO img_comments SET comment = :comment, image_id_fk = :image_id_fk, user_id_fk = :user_id_fk";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":comment", $data->comment);
        $stmt->bindParam(":image_id_fk", $data->imageId);
        $stmt->bindParam(":user_id_fk", $_SESSION['id']);
        $stmt->execute();
        $db = null;
        
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/********************************************************/
/*---------------------------------------------------------*/
/*                        FEATURE  (POST)                 */
/*-------------------------------------------------------*/
/*********************************************************/

function feature() {

    try {
        $sql = "INSERT INTO feature
        SET feature_user_id = :session_id, feature_id = :user_id, feature_image_id = :image_id";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":image_id", $_POST['imageId']);
        $stmt->bindParam(":user_id", $_POST['userId']);
        $stmt->bindParam(":session_id", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

/********************************************************/
/*---------------------------------------------------------*/
/*                        LIKE  (PUT)                     */
/*-------------------------------------------------------*/
/*********************************************************/

function like($id) {

    try {
        $sql = "UPDATE location SET points = points + 1 WHERE l_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
       
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        
            } catch(PDOException $e) {
       echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    try {
        $sql = "UPDATE images SET img_points = img_points + 1 WHERE image_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
       
        $stmt->bindParam("id", $_GET['imageId']);
        $stmt->execute();
        $db = null;
        
            } catch(PDOException $e) {
       echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    try {
        $sql = "INSERT INTO favorites SET liked_image = :image_id_fk, user_id_fk = :user_id_fk";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":image_id_fk", $_GET['imageId']);
        $stmt->bindParam(":user_id_fk", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/********************************************************/
/*---------------------------------------------------------*/
/*                        LIKE  (PUT)                     */
/*-------------------------------------------------------*/
/*********************************************************/

function likeImage() {

    try {
        $sql = "UPDATE location SET points = points + 1 WHERE l_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("id", $_GET['cityId']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    try {
        $sql = "UPDATE images SET img_points = img_points + 1 WHERE image_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("id", $_GET['imageId']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    try {
        $sql = "INSERT INTO favorites SET liked_image = :image_id_fk, user_id_fk = :user_id_fk";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":image_id_fk", $_GET['imageId']);
        $stmt->bindParam(":user_id_fk", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


/********************************************************/
/*---------------------------------------------------------*/
/*                        VOTE  (POST)              */
/*-------------------------------------------------------*/
/*********************************************************/
function vote() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    print_r($data);

    try {
        $sql = "INSERT INTO 
                        votes 
                    SET 
                        exposure = :exposure, 
                        focus = :focus, 
                        lighting = :lighting,
                        creativity = :creativity,
                        story = :story,
                        vote_user_id = :vote_user_id,
                        image_id_fk = :image_id_fk";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":exposure", $data->exposure);
        $stmt->bindParam(":focus", $data->focus);
        $stmt->bindParam(":lighting", $data->lighting);
        $stmt->bindParam(":creativity", $data->creativity);
        $stmt->bindParam(":story", $data->story);

        $stmt->bindParam(":image_id_fk", $data->imageIdFk);
        $stmt->bindParam(":vote_user_id", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

function highlight() {

    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    try {
        $sql = "INSERT INTO feature SET feature_image_id = :image_id_fk, feature_id = :user_id, feature_user_id = :feature_user_id";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":image_id_fk", $data->imageId);
        $stmt->bindParam(":user_id", $data->userId);
        $stmt->bindParam(":feature_user_id", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }


    try {
        $sql = "UPDATE images SET h_points = h_points + 1 WHERE image_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $_GET['imageId']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

function unHighlight() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    try {
        $sql = "UPDATE images SET h_points = h_points - 1 WHERE image_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $data->imageId);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    $sql = "DELETE FROM feature WHERE feature_image_id = :feature_image_id AND feature_user_id = :user_id_fk AND feature_id = :feature_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":feature_image_id", $data->imageId);
        $stmt->bindParam(":feature_id", $data->userId);
        $stmt->bindValue(":user_id_fk", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/********************************************************/
/*---------------------------------------------------------*/
/*                        FOLLOW  (POST)                     */
/*-------------------------------------------------------*/
/*********************************************************/


function followUser($id) {

    //$request = Slim::getInstance()->request();
    //$wine = json_decode($request->getBody());
    $sql = "INSERT INTO followers SET follower_id = :follower_id, user_id = :user_id, f_status = :f_status";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":follower_id", $id);
        $stmt->bindValue(":user_id", $_SESSION['id']);
        $stmt->bindValue(":f_status", 'W');

        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



function getMessage() {

    $sql = "SELECT first_name, id FROM followers INNER JOIN users
    WHERE follower_id = :session_id AND user_id = id AND f_status = 'W'";

    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":session_id", $_SESSION['id']);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($messages);

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function userMessage() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());


    echo $data->id;
    echo $data->status;

    $sql = "UPDATE followers SET f_status = :f_status WHERE user_id = :user_id AND follower_id = :follower_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":user_id", $data->id);
        $stmt->bindValue(":follower_id", $_SESSION['id']);
        $stmt->bindValue(":f_status", $data->status);

        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function unlikeImage() {
    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());


    try {
        $sql = "UPDATE location SET points = points + 1 WHERE l_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $data->cityId);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    try {
        $sql = "UPDATE images SET img_points = img_points - 1 WHERE image_id=:id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $data->imageId);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    $sql = "DELETE FROM favorites WHERE liked_image = :liked_image AND user_id_fk = :user_id_fk";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":liked_image", $data->imageId);
        $stmt->bindValue(":user_id_fk", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

// Message

 
?>