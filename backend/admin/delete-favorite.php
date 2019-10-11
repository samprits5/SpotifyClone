<?php

include_once("../connection-pdo.php");
session_start();

if (isset($_REQUEST['sid']) && isset($_REQUEST['uid'])) {


$sql = "SELECT * FROM favorites_table WHERE user_id = ? AND song_id = ?";

$query  = $pdoconn->prepare($sql);

$query->execute([$_REQUEST['uid'], $_REQUEST['sid']]);

$arr_all=$query->fetchAll(PDO::FETCH_ASSOC);


if (count($arr_all) > 0) {

	$sql = "DELETE FROM favorites_table WHERE user_id = ? AND song_id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$_REQUEST['uid'], $_REQUEST['sid']]);

	$_SESSION['error'] = "Record Deleted!";
	header('location: ../../admin/favorite-list-user.php');
	
} else {
	$_SESSION['error'] = "No such Record!";
	header('location: ../../admin/favorite-list-user.php');
}

} else {
	$_SESSION['error'] = "No ID Parameter to Delete!";
	header('location: ../../admin/favorite-list-user.php');
}