<script src="login_logout.js"></script>
<?php session_start();
  if(isset($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
  }
  session_destroy();
  echo "<script>performLogout();</script>"
?>