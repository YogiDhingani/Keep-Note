<!DOCTYPE html>
<html lang="en">
<head>
<title>Keep Note!!</title>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/mystyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
<script src="/js/Bin.js"></script>
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">Note</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="">Bin</a>
      </li>
    </ul>
  </nav>

  <div class="row" style="margin-top: 10px;">
    <button class="btn" id="btn-empty_bin">Empty Bin</button>
  </div>

<div style="margin-top:60px;" class="container cards">
  <div class="card-columns">

    <script id="template-addNote" type="text/x-handlebars-template">
      <div class="card" id="card">
        <div class="card-body text-center" id="card-body">
            <textarea class="card-body__textarea form-control card-text" readonly>{{note_value}}</textarea>
            <button  id="btn-delete" class="btn btn-orange">Delete</button>
            <button id="btn-restore" class="btn btn-orange">Restore</button>
        </div>
      </div>
    </script>

    <script id="template-addImage" type="text/x-handlebars-template">
      <div class="card" id="card">
        <div class="card-body text-center" id="card-body">
            <img class="card-body__display_image" id="display_image" src="{{image_title}}"/>
            <button  id="btn-delete" class="btn btn-orange">Delete</button>
            <button id="btn-restore" class="btn btn-orange">Restore</button>
        </div>
      </div>
    </script>

  </div>
</div>

    <div class="modal fade" id="dialog_delete_note" tabindex="-1" role="dialog" aria-labelledby="dialog_delete_note" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            Are you sure you want to delete?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" id="btn-confirm_delete_on_dialog">Yes</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="dialog_empty_bin" tabindex="-1" role="dialog" aria-labelledby="dialog_empty_bin" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            Are you sure you want to empty bin?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" id="btn-empty_bin_on_dialog">Yes</button>
          </div>
        </div>
      </div>
    </div>

    <div class="toast-deleted toast" data-delay="1000">
      <div class="toast-body">
        Task is deleted!!      
        <!-- <button type="button" id="btn-undo">Undo</button> -->
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <i class="fa fa-times-circle icon"></i>
        </button>
      </div>
    </div>

    <div class="toast-restored toast" data-delay="1000">
      <div class="toast-body">
        Task restored successfully!!      
        <!-- <button type="button" id="btn-undo">Undo</button> -->
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <i class="fa fa-times-circle"></i>
        </button>
      </div>
    </div>

</body>

</html>

