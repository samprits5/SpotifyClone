<?php
include_once("../connection-pdo.php");

if(!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['id'])){

    session_start();
    $_SESSION['msg'] = "Parameters are missing!";
    header('location: ../../admin/genre-edit.php');

    exit();

} else {

    if(!is_numeric(intval($_POST['id']))){

        session_start();
        $_SESSION['error'] = "Invalid ID!";
        header('location: ../../admin/genre-edit.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?*]+$/', $_POST['name'])){

        session_start();
        $_SESSION['error'] = "Invalid Genre Name!";
        header('location: ../../admin/genre-edit.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['description'])){

        session_start();
        $_SESSION['error'] = "Invalid Genre Description!";
        header('location: ../../admin/genre-edit.php');

        exit();

    }

    $id = $_POST['id'];

    $name = $_POST['name'];

    $description = $_POST['description'];


    $sql = "UPDATE genre_table SET name= ?, description= ? WHERE id = ?";

    $query  = $pdoconn->prepare($sql);

    try {
        if($query->execute([$name, $description, $id])){

            session_start();
            $_SESSION['msg'] = "Data Updated Successfully!";
            header('location: ../../admin/genre-list.php');

        } else {
            session_start();
            $_SESSION['msg'] = "There was an Internal Server Error! Please try aagain!";
            header('location: ../../admin/genre-edit.php');
        }
    } catch (Exception $e) {
        echo $e;
    }

    
    

    
}


