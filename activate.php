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
    include("getConn.php");
    session_start();

    if(isset($_GET["id"])) 
    {
        $id = intval(base64_decode($_GET["id"]));

        date_default_timezone_set("Asia/Kolkata");

        $created = ($_GET['created']);
        // echo '<h1 style="color: red">'.$created.'</h1>';

        $expire_date = date('Y-m-d H:i',strtotime('+5 minutes',strtotime($created)));
        // echo '<h1 style="color: blue">'.$expire_date.'</h1>';

        $now = date("Y-m-d H:i"); 
        // echo '<h1 style="color: white">'.$now.'</h1>';

        if ($now>$expire_date) { //if current time is greater then created time

            echo '<h1 style="color: white">Your link is expired</h1>';
        }
        else  //still has a time
        {
          echo " link is still alive";
        
            $sql = "UPDATE user set active = '1' WHERE user_id = '$id'";
            if ($conn->query($sql) === TRUE) {
                $message = "Your account is activated.";
                echo'
                <div class="jumbotron" id="jumbotron">
                        <div class="container">
                            <h1 class="display-5">Account activated.</h3>
                            <p class="lead"><a href="login.php">click here to login</a></p>
                        </div>
                </div>
                ';
            }
            else 
            {
                    $message = "Problem in account activation.";
            }
        }
    }
?>