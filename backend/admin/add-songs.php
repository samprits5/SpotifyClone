<?php
include_once("../connection-pdo.php");

if(!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['length']) || !isset($_POST['artist']) || !isset($_POST['genre']) || !isset($_POST['mood']) || !isset($_FILES['file'])){

    session_start();
    $_SESSION['msg'] = "Parameters are missing!";
    header('location: ../../admin/songs-add.php');

    exit();

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
        header('location: ../../admin/songs-add.php');

        exit();

    }

    if(!preg_match('/^[(A-Z)?(a-z)?(0-9)?\s\.?\-?!?*]+$/', $_POST['description'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Description!";
        header('location: ../../admin/songs-add.php');

        exit();

    }

    if(!preg_match('/^\d{2}:\d{2}$/', $_POST['length'])){

        session_start();
        $_SESSION['error'] = "Invalid Song Length!";
        header('location: ../../admin/songs-add.php');

        exit();

    }

    $allowedfileExtensions = array('mp3', 'wav');
    if (!in_array($fileExtension, $allowedfileExtensions)) {
        
        session_start();
        $_SESSION['error'] = "Invalid File!";
        header('location: ../../admin/songs-add.php');

        exit();
    }

    date_default_timezone_set('Asia/Calcutta');

    $name = $_POST['title'];

    $description = $_POST['description'];

    $length = $_POST['length'];

    $artist = $_POST['artist'];

    $genre = $_POST['genre'];

    $mood = $_POST['mood'];

    $timest = date('Y-m-d H:i:s');



    $sql = "INSERT INTO songs_table (name, description, length, artist_id, genre_id, mood_id, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $query  = $pdoconn->prepare($sql);

    if($query->execute([$name, $description, $length, $artist, $genre, $mood, $timest])){

        $uploadFileDir = __DIR__ . '/../../files/songs/';
        $trimmed_file_name = str_replace(" ", "", trim($fileName));
        $dest_path = $uploadFileDir . $trimmed_file_name;
        
        if(move_uploaded_file($fileTmpPath, $dest_path)) {

            $tmp_id = $pdoconn->lastInsertId();

            $sql = "UPDATE songs_table SET path = ? WHERE id = ?";

            $query  = $pdoconn->prepare($sql);

            if($query->execute(['files/songs/'.$trimmed_file_name, $tmp_id])){
                $message ='File is successfully uploaded. Record Inserted!';
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
        header('location: ../../admin/genre-add.php');
    }
    

    
}


