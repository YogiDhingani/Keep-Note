<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="/css/mystyle.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<?php

  use PHPMailer\PHPMailer\PHPMailer; 
  use PHPMailer\PHPMailer\Exception; 

  require 'vendor/autoload.php';

  $mail = new PHPMailer(true);

  $name=$_POST['nm'];
  $eid=$_POST['eid'];
  $phone_no=$_POST['phone_no'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];

  /*function validPhone($ph){
    return preg_match('/^[0-9]{10}+$/',$ph);
  }
  if (!validPhone($phone_no)) {
    echo "phone";
  }else if($password!==$cpassword){
    echo "Not matched";
  }else{*/
    if($password==$cpassword)
    {
        include("getConn.php");
        $sql = "SELECT user_id FROM user WHERE email_id = '$eid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
          echo '<h1 style="color:white">You are Already Registered <a href="login.php">click here to login</a></h1>';
        }
        else 
        {
        //   $pass = md5($password);
              $sql = "INSERT INTO user(name,contact_number,email_id,password) VALUES('$name','$phone_no','$eid','$password')";
              if ($conn->query($sql) === TRUE) 
              {
                $last_id = $conn->insert_id;
                if(!empty($last_id)) 
                {
                  date_default_timezone_set("Asia/Kolkata"); // set time_zone according to your location
                  $created = date('Y-m-d H:i');
                  // echo '<h1 style="color: red">'.$created.'</h1>';
                  

                    $actual_link = "http://$_SERVER[HTTP_HOST]/";
                
                    $message = '<html><head>
                      <title>Email Verification</title>
                      </head>
                      <body>';
                    $message .= '<h1>Hi ' . $name . '!</h1>';
                    $message .= '<p><a href="'.$actual_link.'activate.php?id=' . base64_encode($last_id) . '&created='.$created.'">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
                    $message .= "</body></html>";
                    
                    $mail = new PHPMailer(true);
                    
                    $mail->IsSMTP();
                    
                    $mail->SMTPAuth = true;   
                    
                    $mail->SMTPSecure = "ssl"; 
                    
                    $mail->Host = "smtp.gmail.com"; 
                    
                    $mail->Port = 465; 
                    
                    $mail->Username = 'dhinganiyogi120720@gmail.com';
                    $mail->Password = 'yogi1234';
                    
                    $mail->Subject = trim("Email Verifcation");
                    
                    $mail->SetFrom('dhinganiyogi120720@gmail.com', 'Yogi Dhingani');
                    
                    $mail->AddAddress($eid);
                    
                    $mail->MsgHTML($message);

                    try {
                      $mail->send();
                    
                      // echo '
                      // <div class="jumbotron" id="jumbotron">
                      // <div class="container">
                      //     <h1 class="display-5">Registration sucessfull.</h3>
                      //     <p class="lead">You have registered and the activation mail is sent to your email. Click the activation link to activate you account.</p>
                      // </div>
                      // </div>
                      // ';
                      // header('Location:signup.php');
                      echo'<script type="text/javascript">alert("You have registered and the activation mail is sent to your email. Click the activation link to activate you account.");window.history.back();</script>';
                      
                    } catch (Exception $ex) {
                      echo $msg = $ex->getMessage();
                    }
                  // header("Location:login.php");
                }
              }
        }
      }
?>



