<?php
    include("getConn.php");
    session_start();

    $title = $_GET['title'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM all_notes WHERE note_id = (SELECT note_id from all_notes WHERE note_title = '$title' AND user_id = '$user_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location:Bin_page.php");
    }

    // $sql = "SELECT note_id from all_notes WHERE note_title = '$title' AND user_id = '$user_id'";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) 
    // {
    //     while($row = $result->fetch_assoc())
    //     {

    //         $sql2 = "DELETE FROM all_notes WHERE note_id = $row AND status = 'binned'";

    //         if ($conn->query($sql2) === TRUE) 
    //         {
    //             $sql3 = "DELETE FROM user_note WHERE user_id = '$user_id' AND note_id = $row";
    //             if($conn->query($sql3) === TRUE)
    //             {
    //                 header("Location:Bin_page.php");
    //             }
    //         }
    //     }  
    // }
?>