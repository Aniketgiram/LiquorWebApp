<?php
session_start();
session_unset();

// destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tp</title>
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
<div class="container">
<!-- Navbar brand -->
<a class="navbar-brand" href="#">मद्य दुकान खरेदी</a>

<!-- Collapse button -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
  aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<!-- Collapsible content -->
<div class="collapse navbar-collapse" id="basicExampleNav">

  <!-- Links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="#">Hello
        <span class="sr-only">(current)</span>
      </a>
    </li>
  </ul>
  <!-- Links -->
</div>
<!-- Collapsible content -->
</div>
</nav>
<!--/.Navbar-->
<div class="container mt-5">
<div class="row">
<div class="col-md"></div>
<div class="col-md-5">
<div class="card">
<div class="card-header">
<h3 class="m-0"><div class="text-center">
माहिती भरा
</div></h3>
</div>
<div class="card-body">
<div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert">
  <strong id="alertmsg">Alert</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    <div class="md-form">
    <input type="text" maxlength="10" id="mobile" class="form-control">
    <label for="mobile">Phone no</label>
    </div>
    <div class="md-form">
    <input type="password" id="password" class="form-control">
    <label for="mobile">Password</label>
    </div>
    <div class="text-right">
    <button class="btn btn-primary" onclick="send()">बटन दाबा</button>
    </div>
</div>
</div>
</div>
<div class="col-md"></div>
</div>
</div>
<div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="http://helixstack.in/" target="_blank"> helixstack.in</a>
  </div>
    <!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script>
<script>
$("#alert").hide();
function send(){
    let phone = document.getElementById("mobile").value;
    let pass = document.getElementById("password").value;
    let err = [];
    if(pass == ''){
        err.push("Enter Password");
    }else{
        $(".alert").hide();
    }
    if(phone == ''){
        err.push(" Enter Phone");
    }else{
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if(phone.match(phoneno))
        {
            $(".alert").hide();
        }
        else
        {
            err.push("Enter Valid No");
        }
    }

    if(err.length > 0){
        $("#alertmsg").html(err.toString());
        $(".alert").show();
    }else{
    
        $(".alert").hide();
        console.log(phone,pass);
        $.ajax({
            method:"POST",
            data:{phone:phone,pass:pass},
            url:"validateuser.php",
            success:function(res){
                if(res == 1){
                    location.href = "admin.php";
                }else{
                    $("#alertmsg").html(res);
                  $(".alert").show();
                }
            }
        });
    }
}
</script>
</body>
</html>