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
    <title>Liquor Purchase Portal</title>
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
<a class="navbar-brand lang" key="logo" href="#">मद्य दुकान खरेदी</a>

<!-- Collapse button -->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
  aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

</div>
</nav>
<!--/.Navbar-->
<nav class="navbar">
<div class="container">
<button id="en" class="btn white btn-sm translate">English</button>
<button id="mr" class="btn white btn-sm translate">मराठी</button>
</div>
</nav>
<div class="container mt-5">
<div class="row">
<div class="col-md"></div>
<div class="col-md-5">
<div class="card">
<div class="card-header">
<h3 class="m-0"><div class="text-center lang" key="info">
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
    <input type="text" id="name" class="form-control">
    <label for="name" class="lang" key="name">नाव</label>
    </div>
    <div class="md-form">
    <input type="text" maxlength="10" id="mobile" class="form-control">
    <label for="mobile" class="lang" key="no">मोबाइल नंबर</label>
    </div>
    <div class="md-form">
    <textarea id="order" class="form-control md-textarea" length="120" rows="3"></textarea>
    <label for="order" class="lang" key="odr">ऑर्डर</label>
    </div>
    <div class="text-right">
    <button class="btn btn-primary lang" key="sub" onclick="send()">बटन दाबा</button>
    </div>
</div>
</div>
</div>
<div class="col-md"></div>
</div>
<div class="text-center mt-3">
<button class="btn btn-primary lang" key="pastorder" data-toggle="modal" data-target="#basicExampleModal">View Past Order</button>
</div>

<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title lang" key="mtitle" id="exampleModalLabel">मोबाइल क्रमांक प्रविष्ट करा</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="alert alert-warning alert-dismissible fade show" id="pastalert" role="alert">
  <strong id="pastalertmsg">Alert</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <div class="md-form">
    <input type="text" maxlength="10" id="pastmobile" class="form-control">
    <label for="mobile" class="lang" key="no">मोबाइल नंबर</label>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary lang" key="close" data-dismiss="modal" onclick="clmodel()">बंद करा</button>
        <button type="button" class="btn btn-primary lang" key="sub" onclick="viewPastData()">बटन दाबा</button>
      </div>
    </div>
  </div>
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
  getLocation();
  function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }

  function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  }
}
</script>
<script type="text/javascript">
    var arrLang = {
      'en': {
        'info': 'Fill Information',
        'name': 'Name',
        'no': 'Phone no',
        'odr': 'Order',
        'sub': 'Submit',
        'logo':'Liquor Purchase Portal',
        'pastorder':'View Past Order',
        'mtitle':'Enter Mobile No',
        'close': 'Go back'
      },
      'mr': {
        'info': 'माहिती भरा',
        'name': 'नाव',
        'no': 'मोबाइल नंबर',
        'odr': 'ऑर्डर',
        'sub': 'बटन दाबा',
        'logo':'मद्य दुकान खरेदी',
        'pastorder':'मागील ऑर्डर पहा',
        'mtitle':'मोबाइल क्रमांक प्रविष्ट करा',
        'close':'मागे जा'
      }
    };

    // Process translation
    $(function() {
      console.log(this);
      
      $('.translate').click(function() {
        var lang = $(this).attr('id');
        sessionStorage.setItem("lang", lang);
        $('.lang').each(function(index, item) {
          $(this).text(arrLang[lang][$(this).attr('key')]);
        });
      });
    });
  </script>
<script>
$("#alert").hide();
$("#pastalert").hide();
function send(){
    let name = document.getElementById("name").value;
    let phone = document.getElementById("mobile").value;
    let order = document.getElementById("order").value;
    let err = [];
    if(name == ''){
        err.push("Enter Name");
    }else{
        $(".alert").hide();
    }
    if(phone == ''){
        err.push(" Enter Phone");
    }else{
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if(phone.match(phoneno))
        {
            // $(".alert").hide();
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
        $("#pastalert").hide();
        $(".alert").hide();
        console.log(name,phone,order);
        $.ajax({
            method:"POST",
            data:{name:name,phone:phone,order:order},
            url:"insert.php",
            success:function(res){
                if(res == 1){
                    location.href = "options.php";
                }else{
                    $("#alertmsg").html(res);
                $(".alert").show();
                }
            }
        });
    }
}
</script>
<script>
function viewPastData(){
  let phone = $("#pastmobile").val();
  let err = [];
  if(phone == ''){
        err.push(" Enter Phone");
    }else{
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if(phone.match(phoneno))
        {
            $("#pastalert").hide();
            $(".alert").hide();
        }
        else
        {
            err.push("Enter Valid No");
        }
    }

    if(err.length > 0){
        $("#pastalertmsg").html(err.toString());
        $("#pastalert").show();
    }else{
    
        $("#pastalert").hide();
        console.log(phone);
        $.ajax({
            method:"POST",
            data:{phone:phone},
            url:"pastorder.php",
            success:function(res){
                if(res == 1){
                    location.href = "thankyou.php";
                }else{
                    $("#alertmsg").html(res);
                    $(".alert").show();
                    $("#pastalertmsg").html(res);
                    $("#pastalert").show();
                }
            }
        });
    }

}

function clmodel(){
  $(".alert").hide();
  $("#pastalert").hide();
}
</script>
</body>
</html>