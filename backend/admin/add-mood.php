<?php
include_once("../connection-pdo.php");

if(!isset($_POST['name']) || !isset($_POST['description'])){

    session_start();
    $_SESSION['msg'] = "Parameters are missing!";
    header('location: ../../admin/mood-add.php');

    exit();

} else {

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?*]+$/', $_POST['name'])){

        session_start();
        $_SESSION['error'] = "Invalid Mood Name!";
        header('location: ../../admin/mood-add.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['description'])){

        session_start();
        $_SESSION['error'] = "Invalid Mood Description!";
        header('location: ../../admin/mood-add.php');

        exit();

    }

    date_default_timezone_set('Asia/Calcutta');

    $name = $_POST['name'];

    $description = $_POST['description'];


    $timest = date('Y-m-d H:i:s');



    $sql = "INSERT INTO mood_table (name, description, timestamp) VALUES (?, ?, ?)";

    $query  = $pdoconn->prepare($sql);

    if($query->execute([$name, $description, $timest])){

        session_start();
        $_SESSION['msg'] = "Data Inserted Successfully!";
        header('location: ../../admin/mood-list.php');

    } else {
        session_start();
        $_SESSION['msg'] = "There was an Internal Server Error! Please try aagain!";
        header('location: ../../admin/mood-add.php');
    }
    

    
}


