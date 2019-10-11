<?php
include_once("../connection-pdo.php");

if(!isset($_POST['name']) || !isset($_POST['artist']) || !isset($_POST['song'])){

    session_start();
    $_SESSION['msg'] = "Parameters are missing!";
    header('location: ../../admin/homepage-edit.php');

    exit();

} else {

    if(!is_numeric(intval($_POST['song']))){

        session_start();
        $_SESSION['error'] = "Invalid Song ID!";
        header('location: ../../admin/genre-edit.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?*]+$/', $_POST['name'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Name!";
        header('location: ../../admin/genre-edit.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['artist'])){

        session_start();
        $_SESSION['error'] = "Invalid Artist Name!";
        header('location: ../../admin/genre-edit.php');

        exit();

    }

    $id = $_POST['id'];

    $name = $_POST['name'];

    $artist = $_POST['artist'];

    $song = $_POST['song'];


    $sql = "UPDATE home_table SET name= ?, artist= ?, song_id = ? WHERE id = ?";

    $query  = $pdoconn->prepare($sql);

    try {
        if($query->execute([$name, $artist, $song, $id])){

            session_start();
            $_SESSION['msg'] = "Data Updated Successfully!";
            header('location: ../../admin/homepage-list.php');

        } else {
            session_start();
            $_SESSION['msg'] = "There was an Internal Server Error! Please try aagain!";
            header('location: ../../admin/homepage-edit.php');
        }
    } catch (Exception $e) {
        echo $e;
    }

    
    

    
}


