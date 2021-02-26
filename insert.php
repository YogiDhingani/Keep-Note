<?php
    include("getConn.php");
    session_start();
    
    $note = $_GET['msg'];
    
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO all_notes(note_title, status, note_type, user_id) VALUES('$note','active','text','$user_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location:index.php");
    }

?>