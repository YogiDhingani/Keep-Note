<script src="login_logout.js"></script>
<?php
include("getConn.php");
session_start();
if(isset($_POST['login'])) {
  $myusername = $_POST['username'];
  $mypassword = $_POST['password'];

  $sql = "SELECT user_id FROM user WHERE email_id = '$myusername' and password = '$mypassword'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $_SESSION['user_id']=$row['user_id'];
      echo '<script type="text/javascript">performLogin();</script>';
    }
  }
  else {
    echo '<script type="text/javascript">alert("Username or password wrong");window.history.back();</script>';
  }
}
?>