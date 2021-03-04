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
  <script src="js/validate.js"></script>
<script>
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
              <input type="text" data-field="name" class="form-control" id="nm" placeholder="Name" name="nm">
            </div>
            <h5 id="namecheck" style="color: red;" > 
                    **Username is missing 
              </h5>
          </div>
          <div class="form-group row">
            <label for="inputPhone" class="col-sm-2 col-form-label">Phone No.</label>
            <div class="col-sm-8">
              <input type="tel" data-field="phone_no" class="form-control" id="phone_no" placeholder="Phone No." name="phone_no" pattern="[0-9]{10}"/>
            </div>
            <h5 id="phonecheck" style="color: red;" > 
                    **Please enter valid phone number.
              </h5>
          </div>
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="email" data-field="eid" class="form-control" id="eid" placeholder="example@gmail.com" name="eid">
            </div>
            <!-- <small style="color:red" id="emailvalid" class="form-text 
                invalid-feedback"> 
                    Your email must be a valid email 
            </small> -->
            <h5 id="emailcheck" style="color: red;" > 
                    **Please enter valid email.
            </h5>
          </div>
          
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-8">
              <input type="password" data-field="password" class="form-control" id="password" placeholder="New Password" name="password">
            </div>
            <h5 id="passcheck" style="color: red;"> 
                **Please Fill the password 
            </h5>
          </div>
          <div class="form-group row">
            <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-8">
              <input type="password" data-field="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword">
            </div>
            <h5 id="conpasscheck" style="color: red;"> 
                  **Password didn't match 
              </h5>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <!-- <a href="#" class="btn-get-started scrollto">Register</a>-->
              <input id="register" type="submit" class="btn-get-started scrollto" value="Register" name="register">
              <a href="#" class="btn-services scrollto" onclick="window.history.back()">Back to Login</a>
            </div>
          </div>
        </form>

        <!-- <div class="jumbotron invisible" id="jumbotron">
          <div class="container">
              <h1 class="display-5">Registration sucessfull.</h3>
              <p class="lead">You have registered and the activation mail is sent to your email. Click the activation link to activate you account.</p>
          </div>
        </div> -->

    </div>

</body>
</html>
