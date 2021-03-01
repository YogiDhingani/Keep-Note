<?php
    include("getConn.php");
    session_start();

    $old_title_val = $_GET['oldTitle'];
    $new_title_val = $_GET['newTitle'];
    $user_id = $_SESSION['user_id'];

    echo $old_title_val;
    echo $new_title_val;
    echo $user_id;

    $sql = "UPDATE all_notes set note_title = '$new_title_val' where note_id = (SELECT DISTINCT note_id FROM all_notes WHERE note_title = '$old_title_val')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location:index.php");
    }

?>