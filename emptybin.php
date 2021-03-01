<?php
    include("getConn.php");
    session_start();

    // $title = $_GET['title'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM all_notes WHERE status = 'binned' AND user_id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location:Bin_page.php");
    }
?>