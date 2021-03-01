<?php
$dir = "image/";
move_uploaded_file($_FILES["image"]["tmp_name"], $dir. $_FILES["image"]["name"]);

    include("getConn.php");
    session_start();

    $path = $_GET['path'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO all_notes(note_title, status, note_type, user_id) VALUES('$path','active','image','$user_id')";

    // if ($conn->query($sql) === TRUE) {
    //     header("Location:index.php");
    // }

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
        $sql2 = "INSERT INTO user_note(note_id,user_id) VALUES ('$last_id','$user_id')";
        if($conn->query($sql2) === TRUE){
            header("Location:index.php");
        }
    }

?>