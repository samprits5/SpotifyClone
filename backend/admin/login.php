<?php
include_once("../connection-pdo.php");


$username=$_POST['email'];
$password=$_POST['password'];


$sql = "SELECT * FROM admin_table WHERE email = ? AND password = ?";

$query  = $pdoconn->prepare($sql);
$query->execute([$username, $password]);
$arr_login=$query->fetchAll(PDO::FETCH_ASSOC);



if(count($arr_login) > 0)
{

	foreach ($arr_login as $key) {
		$tmp_username = $key['name'];
	}



    session_start();
    $_SESSION['username']=$tmp_username;
    header('location: ../../admin/dashboard.php');
}
else
{
    session_start();
    $_SESSION['msg']="Invalid Credentials!";
    header('location: ../../admin/index.php');
}



?>