<?php
session_start();
if (!(isset($_SESSION['phone']) && $_SESSION['phone'] != '')) {

  header ("Location: login.php");
  
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>
<nav class="navbar" style="border-radius:0px!important;">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Liquor Shop</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="#">Hello <?php echo $_SESSION["phone"]?></a></li>
    </ul>
  </div>
</nav>
    <div class="container" style="margin-top:55px;">
    <div id="mydiv">
    <p style="text-align:center;">Loading Data...</p>
    
    </div>
    </div>
    <script>
    $(document).ready(function() {
        setInterval(call, 3000);
    });
    function call(){
        jQuery.ajax({
            url: 'getData.php', //Define your script url here ...
            method: 'POST', //Makes sense only if you passing data
            success: function(answer) {
                jQuery('#mydiv').html(answer);//update your div with new content, yey ....
                inProcess = false;//Queue is free, guys ;)
            },
            error: function() {
                //unknown error occorupted
                inProcess = false;//Queue is free, guys ;)
            }
        });
    }
    
    </script>
</body>
</html>