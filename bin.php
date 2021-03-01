<?php
    include("getConn.php");
    session_start();

    $title = $_GET['title'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE all_notes SET status = 'binned' WHERE note_id = (SELECT note_id from all_notes WHERE note_title = '$title')";

    if ($conn->query($sql) === TRUE) {
        header("Location:index.php");
    }
?>