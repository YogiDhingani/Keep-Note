<!DOCTYPE html>
<html lang="en">
<head>
<title>Keep Note!!</title>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/mystyle.css">
<!-- <link rel="stylesheet" href="mystyle.css" type="text/css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
<script src="/js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="login_logout.js"></script>
  
  <?php
session_start();
include("getConn.php");
if(!isset($_SESSION['user_id'])){
  echo '<script type="text/javascript">performLogout();</script>';
}
?>
</head>

<body>

  <div class="header">
    <h1 class="header__heading">Note</h1>
    <!-- <input class="float-right" type="checkbox" data-toggle="toggle" data-on="Dark" data-off="Light"> -->
    <div class="btn-group btn-group-md float-right">
      <button id="btn-dark" type="button" class="btn btn-dark">Dark</button>
      <button id="btn-light" type="button" class="btn btn-light">Light</button>
    </div>
    <div class="logout">
      <button id="btn-logout" onClick ="logout()" class="logout__button btn">Logout</button>
    </div>
    <hr class="divider">
  </div>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Note</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Bin_page.php">Bin</a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <div class="row col-sm-12">
        <textarea id="note" class="form-control note" placeholder="Take a note..."></textarea>
        <div class="image-upload">
          <label for="file-input">
            <img class="image-upload__logo-upload-image" id="logo_upload_image" src="image/upload_image.png"/>
          </label>
          <input id="file-input" type="file" accept="image/*"/>
        </div>
      </div>
  </div>

  <div class="container">
    <div class="card-columns">
      <script id="template-addNote" type="text/x-handlebars-template">
        <div class="card" id="card">
          <div class="card-body text-center" id="card-body">
              <textarea class="card-body__textarea form-control card-text">{{note_value}}</textarea>
              <button  id="btn-delete" class="btn btn-orange">Delete</button>
          </div>
        </div>
      </script>
	  
	  <script id="template-addImage" type="text/x-handlebars-template">
        <div class="card" id="card">
          <div class="card-body text-center" id="card-body">
              <img class="card-body__display_image" id="display_image" src="{{image_title}}"/>
              <button  id="btn-delete" class="btn btn-orange">Delete</button>
          </div>
        </div>
    </script>
	  
    </div>
  </div>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-primary" id="btn-confirm_delete">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <div class="toast" data-delay="3000">
    <div class="toast-body">
      Task is deleted!!      
      <button type="button" class="toast-body__btn-undo" id="btn-undo">Undo</button>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <i class="fa fa-times-circle"></i>
      </button>
    </div>
  </div>

</body>

</html>

