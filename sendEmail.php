<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
date_default_timezone_set('Asia/Kolkata');
//$code = rand(100000, 999999);
$name = $_POST['nm'];
$eid = $_POST['eid'];
$phone_no = $_POST['phone_no'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

  function validPhone($ph){
    return preg_match('/^[0-9]{10}+$/',$ph);
  }

  if (!validPhone($phone_no)) {
    echo "phone";
  }else if($password!==$cpassword){
    echo "Not matched";
  }else{
    include("getConn.php");
    $sql = "SELECT user_id FROM user WHERE email_id = '$eid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "Already";
    }
    else {
      sendemail($eid);
      header('Location:login.php');
    }
  }

function sendemail($eid) {
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'projecttranzit0@gmail.com'; // SMTP username
        $mail->Password = 'hack@2018#TranzIt';          // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;


        //Recipients
        $mail->setFrom('projecttranzit0@gmail.com', 'Comssols');
        // $mail->addAddress($email, 'User');  
        $mail->addAddress(trim($eid, '"'), 'Comssols User'); // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //  $mail->addReplyTo('projectjobportal142627@gmail.com', 'Information');
        //  $mail->addCC('cc@example.com');
        //  $mail->addBCC('bcc@example.com');
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Verification Link';
        $mail->Body = 'Cilck here to verify account keepnote.local/addUser.php?nm="'.$_POST['nm'].'"&eid="'.$_POST['eid'].'"&phone_no="'.$_POST['phone_no'].'"&gender="'.$_POST['gender'].'"&password='.$_POST['password'];
        $mail->AltBody = '';
        $mail->send();

        $response['success'] = true;
        $response['message'] = 'Message has been sent';
        echo json_encode($response);
    } catch (Exception $e) {

        $response['success'] = false;
        $response['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        $response['error'] = $e->errorMessage();
        ;
        echo json_encode($response);
    }
}

?>