<?php

include("getConn.php");
session_start();

$email = $_GET['email'];
$title = $_GET['title'];

$sql = "SELECT user_id FROM user WHERE email_id = '$email'";
$result = $conn->query($sql);

$sql2 = "SELECT note_id FROM all_notes WHERE note_title = '$title'";
$result2 = $conn->query($sql2);

if ($result->num_rows > 0 and $result2->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $row2 = mysqli_fetch_assoc($result2);
    $user_id = $row['user_id'];
    $note_id = $row2['note_id'];
    $sql3 = "INSERT INTO user_note(user_id,note_id) VALUES ('$user_id', '$note_id')";
    if ($conn->query($sql3) === TRUE) {
        header("Location:index.php");
    }
}
    
else
{
    echo false;
}
?>