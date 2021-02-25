<!DOCTYPE html>
<html lang="en">


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

<script src="login_logout.js"></script>

<body>
  <?php

  session_start();
  if(isset($_SESSION['user_id'])){
    echo '<script type="text/javascript">performLogin();</script>';
  }
  ?>

<div class="header">
    <h1 class="header__heading">Note</h1>
    <hr class="divider">
</div>
  
    <div class="container">
        <form method="post" action="checkLogin.php">
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" name="username" placeholder="example@gmail.com">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
            <a href="" style="color:white"/>Forget Password?</a>
          <div class="form-group row">
            <div class="col-sm-10">
              <input type="submit" class="btn-get-started scrollto" value="Login" name="login">
              <a href="signup.php" class="btn-services scrollto">Register</a>
            </div>
          </div>
        </form>
      </div>

    </div>

</body>
</html>
