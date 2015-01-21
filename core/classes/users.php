<?php
class Users{

    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function update_user($first_name, $last_name, $gender, $bio, $image_location, $id){

        $query = $this->db->prepare("UPDATE `users` SET
								`first_name`	= ?,
								`last_name`		= ?,
								`gender`		= ?,
								`bio`			= ?,
								`image_location`= ?

								WHERE `id` 		= ?
								");

        $query->bindValue(1, $first_name);
        $query->bindValue(2, $last_name);
        $query->bindValue(3, $gender);
        $query->bindValue(4, $bio);
        $query->bindValue(5, $image_location);
        $query->bindValue(6, $id);

        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function getFollowers($id){

        $query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `followers` WHERE `follower_id` = :id");


        $query->bindValue(":id", $id);



        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }
        $rows = $query->fetchColumn();

        return $rows;
    }

    public function change_password($user_id, $password) {

        global $bcrypt;

        /* Two create a Hash you do */
        $password_hash = $bcrypt->genHash($password);

        $query = $this->db->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");

        $query->bindValue(1, $password_hash);
        $query->bindValue(2, $user_id);

        try{
            $query->execute();
            return true;
        } catch(PDOException $e){
            die($e->getMessage());
        }

    }

    public function recover($email, $generated_string) {

        if($generated_string == 0){
            return false;
        }else{

            $query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = ? AND `generated_string` = ?");

            $query->bindValue(1, $email);
            $query->bindValue(2, $generated_string);

            try{

                $query->execute();
                $rows = $query->fetchColumn();

                if($rows == 1){

                    global $bcrypt;

                    $username = $this->fetch_info('username', 'email', $email); // getting username for the use in the email.
                    $user_id  = $this->fetch_info('id', 'email', $email);// We want to keep things standard and use the user's id for most of the operations. Therefore, we use id instead of email.

                    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    $generated_password = substr(str_shuffle($charset),0, 10);

                    $this->change_password($user_id, $generated_password);

                    $query = $this->db->prepare("UPDATE `users` SET `generated_string` = 0 WHERE `id` = ?");

                    $query->bindValue(1, $user_id);

                    $query->execute();

                    mail($email, 'Your password', "Hello " . $username . ",\n\nYour your new password is: " . $generated_password . "\n\nPlease change your password once you have logged in using this password.\n\n-Example team");

                }else{
                    return false;
                }

            } catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }

    public function fetch_info($what, $field, $value){

        $allowed = array('id', 'username', 'first_name', 'last_name', 'gender', 'bio', 'email'); // I have only added few, but you can add more. However do not add 'password' eventhough the parameters will only be given by you and not the user, in our system.
        if (!in_array($what, $allowed, true) || !in_array($field, $allowed, true)) {
            throw new InvalidArgumentException;
        }else{

            $query = $this->db->prepare("SELECT $what FROM `users` WHERE $field = ?");

            $query->bindValue(1, $value);

            try{

                $query->execute();

            } catch(PDOException $e){

                die($e->getMessage());
            }

            return $query->fetchColumn();
        }
    }

    public function confirm_recover($email){

        $username = $this->fetch_info('username', 'email', $email);// We want the 'id' WHERE 'email' = user's email ($email)

        $unique = uniqid('',true);
        $random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0, 10);

        $generated_string = $unique . $random; // a random and unique string

        $query = $this->db->prepare("UPDATE `users` SET `generated_string` = ? WHERE `email` = ?");

        $query->bindValue(1, $generated_string);
        $query->bindValue(2, $email);

        try{

            $query->execute();

            mail($email, 'Recover Password', "Hello " . $username. ",\r\nPlease click the link below:\r\n\r\nhttp://www.example.com/recover.php?email=" . $email . "&generated_string=" . $generated_string . "\r\n\r\n We will generate a new password for you and send it back to your email.\r\n\r\n-- Example team");

        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function user_exists($username) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
        $query->bindValue(1, $username);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch (PDOException $e){
            die($e->getMessage());
        }

    }

    public function email_exists($email) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`= ?");
        $query->bindValue(1, $email);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch (PDOException $e){
            die($e->getMessage());
        }

    }

    public function register($email, $first_name, $password){

        global $bcrypt; // making the $bcrypt variable global so we can use here

        $password   = $bcrypt->genHash($password);

        $query 	= $this->db->prepare("INSERT INTO `users`
        SET email = :email, password = :password, first_name = :first_name");


        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->bindParam(':first_name', $first_name);

        try{
            $query->execute();

            //mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://www.example.com/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function update($email, $first_name, $info, $profile_pic, $location, $id){

        //global $bcrypt; // making the $bcrypt variable global so we can use here

        //$password   = $bcrypt->genHash($password);

        $query 	= $this->db->prepare("UPDATE `users` SET email = :email,
								first_name = :first_name, info = :info
		 WHERE id = :id");


        //$query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->bindParam(':first_name', $first_name);
        $query->bindParam(':info', $info);
        $query->bindParam(':id', $id);


        try{
            $query->execute();

            //mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nhttp://www.example.com/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function activate($email, $email_code) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = ? AND `email_code` = ? AND `confirmed` = ?");

        $query->bindValue(1, $email);
        $query->bindValue(2, $email_code);
        $query->bindValue(3, 0);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){

                $query_2 = $this->db->prepare("UPDATE `users` SET `confirmed` = ? WHERE `email` = ?");

                $query_2->bindValue(1, 1);
                $query_2->bindValue(2, $email);

                $query_2->execute();
                return true;

            }else{
                return false;
            }

        } catch(PDOException $e){
            die($e->getMessage());
        }

    }


    public function email_confirmed($username) {

        $query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username`= ? AND `confirmed` = ?");
        $query->bindValue(1, $username);
        $query->bindValue(2, 1);

        try{

            $query->execute();
            $rows = $query->fetchColumn();

            if($rows == 1){
                return true;
            }else{
                return false;
            }

        } catch(PDOException $e){
            die($e->getMessage());
        }

    }

    public function login($email, $password) {

        global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

        $query = $this->db->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $query->bindValue(1, $email);

        try{

            $query->execute();
            $data 				= $query->fetch();
            $stored_password 	= $data['password']; // stored hashed password
            $id   				= $data['id']; // id of the user to be returned if the password is verified, below.
            $name 				= $data['first_name'];


            if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
                return $data;	// returning the user's id.
            }else{
                return false;
            }

        }catch(PDOException $e){
            die($e->getMessage());
        }

    }

    public function userdata($id) {

        $query = $this->db->prepare("SELECT * FROM `users` WHERE `id`= ?");
        $query->bindValue(1, $id);

        try{

            $query->execute();

            return $query->fetch();

        } catch(PDOException $e){

            die($e->getMessage());
        }

    }

    public function get_users() {

        $query = $this->db->prepare("SELECT * FROM `users` ORDER BY `time` DESC");

        try{
            $query->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }

        return $query->fetchAll();

    }
}