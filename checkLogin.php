<script src="login_logout.js"></script>
<?php
include("getConn.php");
session_start();
if(isset($_POST['login'])) {

  $myusername = $_POST['username'];
  $mypassword = $_POST['password'];

  $sql = "SELECT user_id FROM user WHERE email_id = '$myusername' and password = '$mypassword'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){

      $sql2 = "SELECT user_id FROM user WHERE email_id = '$myusername' and password = '$mypassword' and active='1'";
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
          $_SESSION['user_id']=$row2['user_id'];
          echo '<script type="text/javascript">performLogin();</script>';
        }
      }
      else
      {
        echo '<script type="text/javascript">alert("Account not activated!! Please activate account by clicking on link which is provided by us on your mail.");window.history.back();</script>';    
      }
     
  }
  else {
    echo '<script type="text/javascript">alert("Username or password wrong");window.history.back();</script>';
  }
}

?>