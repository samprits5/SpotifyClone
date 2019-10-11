<?php

include_once("./connection-pdo.php");

if (isset($_POST['action'])) {


	switch ($_POST['action']) {

		case '1':

			if (isset($_POST['uid']) && isset($_POST['sid'])) {

				$sql = "INSERT INTO favorites_table (user_id, song_id) VALUES (?, ?)";


				$query  = $pdoconn->prepare($sql);

				$query->execute([$_POST['uid'], $_POST['sid']]);

				echo "1";
				exit();

				
			} else {

				echo "Invalid Parameters!4";
				exit();

			}
			break;


		case '2':

			if (isset($_POST['uid']) && isset($_POST['sid'])) {

				$sql = "DELETE FROM favorites_table WHERE user_id = ? AND song_id = ?";


				$query  = $pdoconn->prepare($sql);

				$query->execute([$_POST['uid'], $_POST['sid']]);

				echo "1";

				
			} else {

				echo "Invalid Parameters!3";
				exit();

			}
			break;
		
		default:
			echo "Invalid Parameters!2";
			exit();
			break;
	}



	
} else {

	echo "Invalid Parameters!1";
	exit();
}