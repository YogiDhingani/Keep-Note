<?php
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
    if ($result->num_rows > 0) {
      echo '<h1>You are Already Registered <a href="login.php">click here to login</a></h1>';
    }
    else {
    //   $pass = md5($password);
      $sql = "INSERT INTO user(name,contact_number,email_id,password) VALUES('$name','$phone_no','$eid','$password')";
      if ($conn->query($sql) === TRUE) {
          header("Location:login.php");
      }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
  else{
    echo '<h1>Password and confirm password not match.</h1>';
  }
   // }
  //}
?>