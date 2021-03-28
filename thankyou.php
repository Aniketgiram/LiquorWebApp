<?php
session_start();

if (!(isset($_SESSION['phoneno']) && $_SESSION['phoneno'] != '')) {

  header ("Location: index.php");
  
  }
?>
<?php

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> Liquor Shop Appoinment</title>
      <!-- Latest compiled and minified CSS -->
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

<!-- Collapsible content -->
<div class="collapse navbar-collapse" id="basicExampleNav">

  <!-- Links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="nav-link" href="#">Hello <?php echo $_SESSION["name"] ?>
        <span class="sr-only">(current)</span>
      </a>
    </li>
  </ul>
  <!-- Links -->
</div>
<!-- Collapsible content -->
</div>
</nav>
<nav class="navbar">
<div class="container">
<button id="en" class="btn white btn-sm translate">English</button>
<button id="mr" class="btn white btn-sm translate">मराठी</button>
</div>
</nav>
<!--/.Navbar-->
      <div class="container mt-4">
          <div class="text-center">
          <h3 class="lang" key="info">दुकान मालकास दर्शविण्यासाठी या तपशीलांचा स्क्रीनशॉट घ्या</h3>
          </div>
          
         <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class=" col-md-8 ">
               <div class="card">
               <div class="card-body">
               <div class="row">
                    <div class="col-md-6">
                         <h3><span class="lang" key="time">वेळ :</span> <?php echo $_SESSION["timeslot"]?></h3>
                     </div>
                     
                     <div class="col-md-6">
                         <h3><span class="lang" key="date">तारीख :</span> <?php echo $_SESSION["datetime"] ?></h3>
                     </div>
                    
                 </div>
                 <div class="row">
                 <div class="col-md-6">
                         <h3><span class="lang" key="name">नाव :</span> <?php echo $_SESSION["name"] ?></h3>
                     </div>
                 <div class="col-md-6">
                         <h3><span class="lang" key="mobile">दूरध्वनी क्रमांक :</span> <?php echo $_SESSION["phoneno"]?></h3>
                     </div> 
                 </div>
                 <div class="row">
                 <div class="col-md-6">
                         <h3><span class="lang" key="shop">दुकान :</span> <?php echo $_SESSION["shop"] ?></h3>
                     </div>
                 </div>
               </div>
                 
               </div>
            </div>
            <div class="col-md-2"></div>
         </div>
         <div class="text-center mt-3">
          <h3 class="lang" key="info2">दुकान मालकास दर्शविण्यासाठी या तपशीलांचा स्क्रीनशॉट घ्या</h3>
          <button class="btn btn-primary lang" key="goback" onclick="goback()"></button>
          </div>
      </div>
      <!-- Footer -->
      <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="http://helixstack.in/" target="_blank"> helixstack.in</a>
  </div>
      <!-- Footer -->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
         <!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script>
<script type="text/javascript">
    var arrLang = {
      'en': {
        'info': 'Take a screenshot of these details to show the shop owner',
        'name': 'Name : ',
        'mobile': 'Phone No : ',
        'shop': 'Shop : ',
        'date' : 'Date : ',
        'time' : 'Time : ',
        'logo':'Liquor Purchase Portal',
        'info2':'Please carry identity proof like aadhar card to verify the details',
        'goback':'Go back to Home Page'
      },
      'mr': {
        'info': 'दुकान मालकास दर्शविण्यासाठी या तपशीलांचा स्क्रीनशॉट घ्या',
        'name': 'नाव : ',
        'mobile': 'दूरध्वनी क्रमांक : ',
        'shop': 'दुकान : ',
        'date' : 'तारीख : ',
        'time' : 'वेळ : ',
        'logo':'मद्य दुकान खरेदी',
        'info2':'तपशीलांची पडताळणी करण्यासाठी कृपया आधार कार्ड प्रमाणे ओळखपत्र ठेवा',
        'goback':'मुख्यपृष्ठावर परत जा'
      }
    };

    $(function() {
      var lang = sessionStorage.getItem("lang");
      $('.lang').each(function(index, item) {
          $(this).text(arrLang[lang][$(this).attr('key')]);
      });
    });

    // Process translation
    $(function() {
      $('.translate').click(function() {
        var lang = $(this).attr('id');
        sessionStorage.setItem("lang", lang);
        $('.lang').each(function(index, item) {
          $(this).text(arrLang[lang][$(this).attr('key')]);
        });
      });
    });

    function goback(){
      location.href="index.php";
      <?php
        session_unset();

        // destroy the session
        session_destroy();
        ?>
    }
  </script>
</body>
</html>
