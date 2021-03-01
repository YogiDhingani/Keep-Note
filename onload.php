<?php
    include("getConn.php");
    session_start();

    $status = $_GET['status'];
    $user_id = $_SESSION['user_id'];

    // $sql = "SELECT * from all_notes WHERE status = '$status' and user_id = '$user_id'";
    $sql = "SELECT * from all_notes WHERE status = '$status' AND note_id IN(SELECT note_id from user_note where user_id = '$user_id')";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {

        $array[] = $row;
        
    }
    } else {
    echo "0 results";
    }

    echo json_encode(array_values($array));
    // header("Location:index.php");
?>