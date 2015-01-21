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
$app->get('/image/game', 'showImages');

$app->get('/message', 'getMessage');

$app->post('/message', 'userMessage');

$app->put('/like/:id', 'like');

$app->post('/like', 'likeImage');
$app->put('/like', 'unlikeImage');

$app->get('/city/:id', 'showCity');
$app->put('/city/:id', 'like');

$app->post('/user/:id', 'followUser');
$app->post('/highlight', 'upvote');
$app->put('/highlight', 'removeVote');


$app->get('/user/:id', 'getUser');
$app->get('/image/:id', 'showImage');

$app->post('/login', 'login');
$app->post('/register', 'register');

$app->get('/user', 'mainUser');

$app->get('/users', 'getUsers');

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

    $images = $db->prepare("SELECT first_name, id, image_url, categories, img_points, images.created, image_id
    FROM
        `images`, `users`
    WHERE `images`.`user_id_fk` = `users`.`id`
    AND
    image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)
    ");

    

    $full = $db->prepare("SELECT first_name, id, image_url, categories, img_points, images.created, image_id
    FROM `images`, `users`, `favorites`
    WHERE
     `favorites`.`user_id_fk` = :session_id
   
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`");

    
    $full->bindValue(':session_id', $_SESSION['id']);
    $images->bindValue(':session_id', $_SESSION['id']);

    try{
        $images->execute();
        $full->execute();
        $full_images = $full->fetchAll(PDO::FETCH_OBJ);
        $images_result = $images->fetchAll(PDO::FETCH_OBJ);

    }catch(PDOException $e){
        die($e->getMessage());
    }

    $image_array = array_merge($favorites_results, $images_result, $full_images);


    echo json_encode($image_array);

}

function showImages() {

    $db = getConnection();

    $images = $db->prepare("SELECT first_name, id, image_url, categories, img_points, images.created, image_id
    FROM `images`, `users`
    WHERE `images`.`user_id_fk` = `users`.`id`
    AND image_id 
    NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");


    $images->bindValue(':session_id', $_SESSION['id']);

    try
    {
        $images->execute();
        $images_result = $images->fetchAll(PDO::FETCH_OBJ);
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }

    //$image_array = array_merge($favorites_results, $images_result, $full_images);
    echo json_encode($images_result);

}

/********************************************************/
/*-------------------------------------------------------*/
/*                        World FEED (GET)               */
/*-------------------------------------------------------*/
/*********************************************************/

function getWorldFeed() {

    $world_array = array();
    $db = getConnection();

    $images = $db->prepare("SELECT img_caption, first_name, id, image_url, categories,img_points, images.created, image_id, average  FROM
        `images`, `users`
    WHERE `images`.`user_id_fk` = `users`.`id`
   
    AND
    image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");



    $full = $db->prepare("SELECT img_caption, liked_image, first_name, id, image_url, categories, img_points, images.created, image_id,average
    FROM  `images`, `users`, `favorites`
    WHERE `favorites`.`user_id_fk` = :session_id
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`");


    
    $full->bindValue(':session_id', $_SESSION['id']);
    $images->bindValue(':session_id', $_SESSION['id']);

    try{
        $images->execute();
       
        $full->execute();
        $full_images = $full->fetchAll(PDO::FETCH_OBJ);
 
        $images_result = $images->fetchAll(PDO::FETCH_OBJ);

    }catch(PDOException $e){
        die($e->getMessage());
    }

    $image_array = array_merge($images_result, $full_images);

    echo json_encode($image_array);

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

function getUsers() {


    $db = getConnection();

    

    $user = $db->prepare("SELECT
        id, first_name, points, info
    FROM `users`
    ");

    try{
        $user->execute();
        $users = $user->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $e){
        die($e->getMessage());
    }

    echo json_encode($users);

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
 

    $active_follower = $db->prepare("SELECT `follower_id` FROM `followers` WHERE `follower_id` = :id AND `user_id` = :session_id AND `f_status` = 'Y'");
    $denied_follower = $db->prepare("SELECT `follower_id` FROM `followers` WHERE `follower_id` = :id AND `user_id` = :session_id AND `f_status` = 'N'");
    $waiting = $db->prepare("SELECT `follower_id` FROM `followers` WHERE `follower_id` = :id AND `user_id` = :session_id AND `f_status` = 'W'");


    $name = $db->prepare("SELECT first_name, id, profile_pic, id, info FROM `users` WHERE `id` = :id");

    // Image Array
    $images = $db->prepare("SELECT image_url, categories, img_points, images.created, image_id
    FROM `gallery`, `images`, `users`
    WHERE `gallery`.`user_id_fk` = :id
    AND `images`.`user_id_fk` = `users`.`id`
    AND `gallery`.`image_id_fk` = `images`.`gallery_id`
    AND image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");


    $favorites = $db->prepare("SELECT liked_image, image_url, categories, img_points, images.created, image_id
    FROM `favorites`, `images`
    WHERE `favorites`.`user_id_fk` = :session_id
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = :id
    ");

    // end of image array

    $following_user = $db->prepare("SELECT first_name, profile_pic FROM `followers`, `users` WHERE user_id = :id AND `followers`.`follower_id` = `users`.`id` AND `f_status` = 'Y'");
    $follower = $db->prepare("SELECT first_name, profile_pic FROM `followers`, `users` WHERE `followers`.`follower_id` = :id AND `followers`.`user_id` = `users`.`id` AND `f_status` = 'Y'");


    $favorites->bindValue(":session_id", $_SESSION['id']);
    $favorites->bindValue(":id", $id);
    
    $following_user->bindValue(":id", $id);
    $follower->bindValue(':id', $id);

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
      
       
        //$following->execute();
        $images->execute();
        $active_follower->execute();
        $favorites->execute();
        
       
        $following_user->execute();
        $follower->execute();
        //$rows = $followers->fetchColumn();
        
        //$following_rows = $following->fetchColumn();
        $session_id = $active_follower->fetch();

        $denied = $denied_follower->fetch();
        $wait = $waiting->fetch();

       
        $name_result = $name->fetch();
        $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);
        $images_result = $images->fetchAll(PDO::FETCH_OBJ);
        
       
        $following_users = $following_user->fetchAll(PDO::FETCH_OBJ);
        $followers = $follower->fetchAll(PDO::FETCH_OBJ);

    }catch(PDOException $e){
        die($e->getMessage());
    }


    $full_array = array_merge($images_result, $favorites_results);

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
        'following_users' => $following_users,
        'follower_users' => $followers

    );

    $user_array[] = $user_inf;

    echo json_encode($user_array);

}


function getFeed() {

    $db = getConnection();

    $feed = "SELECT * FROM
        `gallery`,
        `users`,
        `images`,
        `location`
    WHERE
      `users`.`id` = `gallery`.`user_id_fk`
    AND
        `images`.`gallery_id` = `gallery`.`image_id_fk`
    GROUP BY
        `gallery`.`image_id_fk`
    ORDER BY
        `gallery`.`image_id_fk` 
    DESC
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





function showImage($id) {

    $db = getConnection();

    $image = $db->prepare("SELECT *
    FROM `images`,`users`
    WHERE `images`.`image_id` = :id
    AND `images`.`user_id_fk` = `users`.`id`");

    $favorites = $db->prepare("SELECT id, created, first_name, id, liked_image
    FROM `favorites`, `users`
    WHERE `favorites`.`user_id_fk` = `users`.`id`
    AND `favorites`.`liked_image` = :id");

    $vote = $db->prepare("SELECT exposure, focus, lighting, creativity, story
    FROM `votes`, `users`
    WHERE `votes`.`vote_id_fk` = :session_id
    AND `votes`.`vote_img_id` = :id");

    $user_comment = $db->prepare("SELECT id, created, comment, first_name, com_img_id, votes, cv_img_id
    FROM `img_comments`, `users`, `com_votes`
    WHERE `img_comments`.`image_id_fk` = :id
    AND `img_comments`.`image_id_fk` = `com_votes`.`master_img_id`
    AND `img_comments`.`com_img_id` = `com_votes`.`cv_img_id`
    AND `com_votes`.`cv_user_id` = :session_id
    AND `img_comments`.`user_id_fk` = `users`.`id`
    AND `img_comments`.`com_img_id`");

    $comment = $db->prepare("SELECT id, created, comment, first_name, com_img_id, votes
    FROM `img_comments`, `users` 
    WHERE `img_comments`.`image_id_fk` = :id 
    AND `img_comments`.`user_id_fk` = `users`.`id`
    AND `img_comments`.`com_img_id` 
    NOT IN(SELECT cv_img_id FROM com_votes WHERE master_img_id = :id AND cv_user_id = :session_id)");


    $user_comment->bindParam(":id", $id);
    $user_comment->bindParam(":session_id", $_SESSION['id']);
    $comment->bindParam(":id", $id);
    $comment->bindParam(":session_id", $_SESSION['id']);
    $favorites->bindParam(':id', $id);
    $image->bindValue(":id", $id);
    $vote->bindValue(':id', $id);
    $vote->bindParam(":session_id", $_SESSION['id']);

    try{
        $favorites->execute();
        $comment->execute();
        $user_comment->execute();
        $image->execute();
        $vote->execute();
    }catch(PDOException $e){
        die($e->getMessage());
    }

    $image_results = $image->fetch();
    $comments = $comment->fetchAll(PDO::FETCH_OBJ);
    $user_comments = $user_comment->fetchAll(PDO::FETCH_OBJ);
    $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);
    $vote_results = $vote->fetchAll(PDO::FETCH_OBJ);

    $user_image = $db->prepare("SELECT image_url, image_id
    FROM images
    WHERE user_id_fk = :id
    AND image_id <> :image_id
    ORDER BY img_points DESC
    LIMIT 30");

    $category = $db->prepare("SELECT image_url, image_id
    FROM images
    WHERE categories = :id
    AND image_id <> :image_id
    ORDER BY img_points DESC
    LIMIT 30");

    $user_image->bindValue(":id", $image_results['user_id_fk']);
    $user_image->bindValue(":image_id", $id);

    $category->bindValue(':id', $image_results['categories']);
    $category->bindValue(":image_id", $id);

    $user_image->execute();
    $category->execute();
    
    $user_images = $user_image->fetchAll(PDO::FETCH_OBJ);
    $categories = $category->fetchAll(PDO::FETCH_OBJ);
    

    $full_feed = array_merge($comments, $user_comments);
    $vote_feed = $vote_results;

    $city_inf = array(
        'id' => $image_results['image_id'],
        'image_url' => $image_results['image_url'],
        'points' => $image_results['img_points'],
        'user_name' => $image_results['first_name'],
        'profile_pic' => $image_results['profile_pic'],
        'category' => $image_results['categories'],
        'caption' => $image_results['img_caption'],
        'user_id' => $image_results['id'],
        'date' => date("Y-m-d H:i:s", strtotime($image_results['created'])),
        'user_image' => $user_images,
        'feed' => $full_feed,
        'votes' => $vote_feed,
        'categories' => $categories
    );

    $city_array = '';

    $city_array[] = $city_inf;

    echo json_encode($city_array);

}




function showCity($id) {

    $db = getConnection();

    $city = $db->prepare("SELECT `points`, `city`, `l_id`, `cont` FROM `location` WHERE `l_id` = :id");


    $upload = $db->prepare("SELECT
        COUNT(b.image_l_id) uploads,
        COUNT(DISTINCT b.user_id_fk) members
        FROM  location a
        LEFT JOIN images b
        ON a.l_id = b.image_l_id
        WHERE a.l_id = :id");

    $images = $db->prepare("SELECT first_name, id, image_url, categories, img_points, images.created, image_id, image_l_id   FROM
        `images`, `users`
    WHERE `images`.`user_id_fk` = `users`.`id`
    AND `images`.`image_l_id` = :id
    AND
    image_id NOT IN (SELECT liked_image FROM favorites WHERE liked_image = image_id AND user_id_fk = :session_id)");


    

    

    $full = $db->prepare("SELECT liked_image, first_name, id, image_url, categories, image_l_id, img_points, images.created, image_id
    FROM `images`, `users`, `favorites`
    WHERE `image_l_id` = :id
    AND `favorites`.`user_id_fk` = :session_id
   
    AND `favorites`.`liked_image` = `images`.`image_id`
    AND `images`.`user_id_fk` = `users`.`id`");

    try{
        $favorites->bindValue(":session_id", $_SESSION['id']);
        
        $full->bindValue(':session_id', $_SESSION['id']);
        $images->bindValue(':session_id', $_SESSION['id']);
        $favorites->bindValue(":id", $id);
        
        $full->bindValue(':id', $id);
        $images->bindValue(':id', $id);
        $city->bindValue(":id", $id);

        $upload->bindValue(":id", $id);


        $favorites->execute();
        $city->execute();
        $images->execute();
        $full->execute();
        

        $upload->execute();

    }catch(PDOException $e){
        die($e->getMessage());
    }


    $favorites_results = $favorites->fetchAll(PDO::FETCH_OBJ);

    
    $full_results = $full->fetchAll(PDO::FETCH_OBJ);
    $city_results = $city->fetch();
    $images_results = $images->fetchAll(PDO::FETCH_OBJ);
    $uploads = $upload->fetch();


    $full_array = array_merge($images_results, $favorites_results, $full_results);

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

    //print_r($data);

    $sum_data = $data->exposure + $data->focus + $data->lighting + $data->creativity + $data->story;



  
    
    if ($row['average'])
        try {
            $sql = "INSERT INTO 
                            votes 
                        SET 
                            exposure = :exposure, 
                            focus = :focus, 
                            lighting = :lighting,
                            creativity = :creativity,
                            story = :story,
                            vote_id_fk = :vote_id_fk,
                            vote_img_id = :vote_img_id";
            $db = getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":exposure", $data->exposure);
            $stmt->bindParam(":focus", $data->focus);
            $stmt->bindParam(":lighting", $data->lighting);
            $stmt->bindParam(":creativity", $data->creativity);
            $stmt->bindParam(":story", $data->story);

            $stmt->bindParam(":vote_img_id", $data->imageIdFk);
            $stmt->bindParam(":vote_id_fk", $_SESSION['id']);
            $stmt->execute();
            $db = null;

        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }

    try 
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT average FROM images WHERE image_id = :imageId");
        $statement->bindParam(":imageId", $data->imageIdFk);
        $statement->execute();

        $row = $statement->fetch();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }


    if ($row['average'] == 0.00) {
        $average = $sum_data;
    } else {
        $average = ($sum_data + $row['average']) / 2;
    }

    //print_r($row);
    //echo $average;
    //echo $sum_data;

     try {
        $sql = "UPDATE images SET average = :average WHERE image_id = :id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":average", $average);
        $stmt->bindParam(":id", $data->imageIdFk);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }


}



function upvote() {

    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    print_r($data);

    try {
        $sql = "INSERT INTO 
                    com_votes 
                SET cv_user_id = :cv_user_id, cv_img_id = :cv_img_id, master_img_id = :master_img_id";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":cv_img_id", $data->id);
        $stmt->bindParam(":master_img_id", $data->imageId);
        $stmt->bindParam(":cv_user_id", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
     
        header("HTTP/1.0 404 Not Found");
        header('HTTP', true, 500);
        die();
    }


    try {
        $sql = "UPDATE img_comments SET votes = votes + 1 WHERE com_img_id = :id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $data->id);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

    try {
        $sql = "UPDATE users SET points = points + 1 WHERE id = :id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $data->userid);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

function removeVote() {

    $request = \Slim\Slim::getInstance()->request();
    $data = json_decode($request->getBody());

    print_r($data);

    try {
        $sql = "DELETE FROM 
                    com_votes 
                WHERE cv_user_id = :cv_user_id AND cv_img_id = :cv_img_id";
        $db = getConnection();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":cv_img_id", $data->id);
        
        $stmt->bindParam(":cv_user_id", $_SESSION['id']);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
     
        header("HTTP/1.0 404 Not Found");
        header('HTTP', true, 500);
        die();
    }


    try {
        $sql = "UPDATE img_comments SET votes = votes - 1 WHERE com_img_id = :id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $data->id);
        $stmt->execute();
        $db = null;

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

     try {
        $sql = "UPDATE users SET points = points - 1 WHERE id = :id";
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $data->userid);
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