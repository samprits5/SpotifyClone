<?php
include_once("../connection-pdo.php");

if(!isset($_POST['id']) || !isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['length']) || !isset($_POST['artist']) || !isset($_POST['genre']) || !isset($_POST['mood'])){

    session_start();
    $_SESSION['msg'] = "Parameters are missing!";
    header('location: ../../admin/songs-list.php');

    exit();

} 
if(!isset($_FILES['file']) || $_FILES['file']['tmp_name'] == "") {

    // session_start();
    // $_SESSION['msg'] = $_FILES['file']['tmp_name']."A";
    // header('location: ../../admin/dashboard.php');

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s?\.?\-?_?*]+$/', $_POST['title'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['description'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Description!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^\d{2}:\d{2}$/', $_POST['length'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Length!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['artist'])){

        session_start();
        $_SESSION['error'] = "Invalid Artist Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['genre'])){

        session_start();
        $_SESSION['error'] = "Invalid Genre Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['mood'])){

        session_start();
        $_SESSION['error'] = "Invalid Mood Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    $id = $_POST['id'];

    $name = $_POST['title'];

    $description = $_POST['description'];

    $length = $_POST['length'];

    $artist = $_POST['artist'];

    $genre = $_POST['genre'];

    $mood = $_POST['mood'];

    $sql = "UPDATE songs_table SET name = ?, description = ?, length = ?, artist_id = ?, genre_id = ?, mood_id = ? WHERE id = ?";

    $query  = $pdoconn->prepare($sql);

    if($query->execute([$name, $description, $length, $artist, $genre, $mood, $id])){

        session_start();
        $_SESSION['msg'] = "Data Updated Successfully!";
        header('location: ../../admin/songs-list.php');

    } else {

        session_start();
        $_SESSION['msg'] = "There was an Internal Server Error! Please try aagain!";
        header('location: ../../admin/songs-list.php');
    }


} else {

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));


    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s?\.?\-?_?*]+$/', $_POST['title'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['description'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Description!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^\d{2}:\d{2}$/', $_POST['length'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Length!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['artist'])){

        session_start();
        $_SESSION['error'] = "Invalid Artist Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['genre'])){

        session_start();
        $_SESSION['error'] = "Invalid Genre Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['mood'])){

        session_start();
        $_SESSION['error'] = "Invalid Mood Name!";
        header('location: ../../admin/songs-list.php');

        exit();

    }

    $allowedfileExtensions = array('mp3', 'wav');
    if (!in_array($fileExtension, $allowedfileExtensions)) {
        
        session_start();
        $_SESSION['error'] = "Invalid File!";
        header('location: ../../admin/songs-list.php');

        exit();
    }

    $id = $_POST['id'];

    $name = $_POST['title'];

    $description = $_POST['description'];

    $length = $_POST['length'];

    $artist = $_POST['artist'];

    $genre = $_POST['genre'];

    $mood = $_POST['mood'];

    $sql = "UPDATE songs_table SET name = ?, description = ?, length = ?, artist_id = ?, genre_id = ?, mood_id = ? WHERE id = ?";

    $query  = $pdoconn->prepare($sql);

    if($query->execute([$name, $description, $length, $artist, $genre, $mood, $id])){

        $uploadFileDir = __DIR__ . '/../../files/songs/';
        $trimmed_file_name = str_replace(" ", "", trim($fileName));
        $dest_path = $uploadFileDir . $trimmed_file_name;
        
        if(move_uploaded_file($fileTmpPath, $dest_path)) {

            $sql = "UPDATE songs_table SET path = ? WHERE id = ?";

            $query  = $pdoconn->prepare($sql);

            if($query->execute(['files/songs/'.$trimmed_file_name, $id])){
                $message ='File is successfully uploaded. Record Updated!';
            } else {
                $message ='There were some problems in uploading the file!';
            }


        }
        else {
            $message = "There were some problems in uploading the file!";
        }

        session_start();
        $_SESSION['msg'] = $message;
        header('location: ../../admin/dashboard.php');

    } else {
        session_start();
        $_SESSION['msg'] = "There was an Internal Server Error! Please try aagain!";
        header('location: ../../admin/songs-list.php');
    }
    

    
}


