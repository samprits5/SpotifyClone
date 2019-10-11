<?php
include_once("./connection-pdo.php");

$user_id = $_POST['user_id'];


$fileTmpPath = $_FILES['file']['tmp_name'];
$fileName = $_FILES['file']['name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));



$allowedfileExtensions = array('jpg', 'png');

if (!in_array($fileExtension, $allowedfileExtensions)) {


	$arr = array('key' => '0', 'msg' => 'Invalid File Type!');

	echo json_encode($arr);

	exit();

}


$uploadFileDir = '../images/profile-pic/';
$dest_path = $uploadFileDir . $fileName;

$upload_path_data = '../images/profile-pic/'.$fileName;

if(move_uploaded_file($fileTmpPath, $dest_path))
{

  	$sql = "UPDATE users_table SET path = ? WHERE id = ?";

	$query  = $pdoconn->prepare($sql);
	$query->execute([$upload_path_data, $user_id]);

	$arr = array('key' => '1', 'msg' => $upload_path_data);

	echo json_encode($arr);


}
else
{

  	$arr = array('key' => '0', 'msg' => 'There was some error moving the file to upload directory.');

	echo json_encode($arr);

	exit();
}






