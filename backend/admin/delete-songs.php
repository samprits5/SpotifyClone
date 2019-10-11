<?php

include_once("../connection-pdo.php");
session_start();

if (isset($_REQUEST['id'])) {


$sql = "SELECT path FROM songs_table WHERE id = ?";

$query  = $pdoconn->prepare($sql);

$query->execute([$_REQUEST['id']]);

$arr_all=$query->fetchAll(PDO::FETCH_ASSOC);

foreach ($arr_all as $key) {

	$file_to_delete = $key['path'];
}

if (file_exists('../../'.$file_to_delete)) {

	unlink('../../'.$file_to_delete);

	$sql = "DELETE FROM songs_table WHERE id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$_REQUEST['id']]);

	$_SESSION['error'] = "File is already Deleted! Cleared The Record!";
	header('location: ../../admin/songs-list.php');

} else {

	$sql = "DELETE FROM songs_table WHERE id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$_REQUEST['id']]);

	$_SESSION['error'] = "File is already Deleted! Cleared The Record!";
	header('location: ../../admin/songs-list.php');
}


	
} else {

	$_SESSION['error'] = "No ID Parameter to Delete!";
	header('location: ../../admin/songs-list.php');

}