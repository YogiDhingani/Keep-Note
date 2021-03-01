<?php
    include("getConn.php");
    session_start();
    
    $note = $_GET['msg'];
    
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO all_notes(note_title, status, note_type, user_id) VALUES ('$note','active','text','$user_id')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id;
        $sql2 = "INSERT INTO user_note(note_id,user_id) VALUES ('$last_id','$user_id')";
        if($conn->query($sql2) === TRUE){
            header("Location:index.php");
        }
        
    }

?>