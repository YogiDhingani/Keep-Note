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
<script>

function validate()
{
  if($('#password').val() != $('#cpassword').val())
  {
    window.alert("Password and confirm password is differet.");
    $('#cpassword').focus();
    return false;
  }
  else{
    window.alert("Registered sucsessfully!!\n Please login on next page.");
    return true;
  }
}

</script>


<html>
<head>
  <style>
  label{
    color: #ffffff;
  }
</style>
</head>
<body>

<div class="header">
    <h1 class="header__heading">Note</h1>
    <hr class="divider">
</div>

    <div class="container">
          <form method="post" id="regform" action="addUser.php" onsubmit="return validate()">
          <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nm" placeholder="Name" name="nm" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPhone" class="col-sm-2 col-form-label">Phone No.</label>
            <div class="col-sm-8">
              <input type="tel" class="form-control" id="phone_no" placeholder="Phone No." name="phone_no" pattern="[0-9]{10}" required/>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" id="eid" placeholder="example@gmail.com" name="eid" required>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="password" placeholder="New Password" name="password" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <!-- <a href="#" class="btn-get-started scrollto">Register</a>-->
              <input id="register" type="submit" class="btn-get-started scrollto" value="Register" name="register">
              <a href="#" class="btn-services scrollto" onclick="window.history.back()">Back to Login</a>
            </div>
          </div>
        </form>
    </div>

</body>
</html>
