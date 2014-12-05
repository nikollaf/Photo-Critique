<?php

class Chat {

	static function fetchMessage() {
		include $_SERVER['DOCUMENT_ROOT'] . '/DB/s_chat_db.php';

		$sql = "SELECT 
		`chat`.`message`,
		`users`.`username`,
		`users`.`first_name`,
		`users`.`id` 
		FROM chat 
		INNER JOIN users
		ON `users`.`id` = `chat`.`user_id_fk`
		ORDER BY `chat`.`timestamp`
		DESC";
		$stmt = $db->query($sql);

		$result = $stmt->fetchAll();
		return $result;
	}

	static function throwMessage($user_id_fk, $message) {
		include $_SERVER['DOCUMENT_ROOT'] . '/DB/s_chat_db.php';
		
		$sql = "INSERT INTO chat SET user_id_fk = :user_id_fk, message = :message";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':user_id_fk', $user_id_fk);
		$stmt->bindValue(':message', $message);
		$stmt->execute();
	}


}

