<?php

include_once("../connection-pdo.php");
session_start();

if (isset($_REQUEST['id'])) {


$sql = "SELECT * FROM genre_table WHERE id = ?";

$query  = $pdoconn->prepare($sql);

$query->execute([$_REQUEST['id']]);

$arr_all=$query->fetchAll(PDO::FETCH_ASSOC);


if (count($arr_all) > 0) {

	$sql = "DELETE FROM genre_table WHERE id = ?";

	$query  = $pdoconn->prepare($sql);

	$query->execute([$_REQUEST['id']]);

	$_SESSION['error'] = "Record Deleted!";
	header('location: ../../admin/genre-list.php');
	
} else {
	$_SESSION['error'] = "No such Record!";
	header('location: ../../admin/genre-list.php');
}

} else {
	$_SESSION['error'] = "No ID Parameter to Delete!";
	header('location: ../../admin/genre-list.php');
}