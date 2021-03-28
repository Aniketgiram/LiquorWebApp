<?php 
session_start();
if (!(isset($_SESSION['phoneno']) && $_SESSION['phoneno'] != '')) {

   header ("Location: index.php");
   
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> Liquor Shop Appoinment</title>
      <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">      <style type="text/css">
      </style>
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
         <h4 class="lang" key="opt">दुकान निवडा</h4>
         <div class="row">
            <div class="col-md-4 mt-3">
               <div class="card">
                  <div class="card-body">
                     <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="shop" id="defaultChecked1" value="1234567890" name="defaultExampleRadios">
                     <label class="custom-control-label lang" key="shop1" for="defaultChecked1">दुकान 1</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 mt-3">
               <div class="card">
                  <div class="card-body">
                     <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="shop" id="defaultChecked2" value="0987654321" name="defaultExampleRadios">
                     <label class="custom-control-label lang" key="shop2" for="defaultChecked2">दुकान 2</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 mt-3">
               <div class="card">
                  <div class="card-body">
                     <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" name="shop" id="defaultChecked3" value="5644544654" name="defaultExampleRadios">
                     <label class="custom-control-label lang" key="shop3" for="defaultChecked3">दुकान 3</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      
         <div class="row mt-4">
         <div class="col-md"></div>
         <div class="col-md"></div>
         <div class="col-md text-right">
         <button class="btn btn-primary lang" key="sub" onclick="send()">बटन दाबा</button>
         </div>
         </div>
      </div>
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
        'opt': 'Select Shop',
        'shop1': 'Shop 1',
        'shop2': 'Shop 2',
        'shop3': 'Shop 3',
        'sub' : 'Submit',
        'logo':'Liquor Purchase Portal'
      },
      'mr': {
        'opt': 'दुकान निवडा',
        'shop1': 'दुकान 1',
        'shop2': 'दुकान 2',
        'shop3': 'दुकान 3',
        'sub': 'बटन दाबा',
        'logo':'मद्य दुकान खरेदी'
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
  </script>
<script>
function send(){
   let shop = "";
   var ele = document.getElementsByName('shop'); 
              
   for(i = 0; i < ele.length; i++) { 
      if(ele[i].checked) 
      shop = ele[i].value; 
   } 

   if(shop == ""){
      alert("Select shop")
   }else{
      $.ajax({
            method:"POST",
            data:{shop:shop},
            url:"selectshop.php",
            success:function(res){
               if(res == 1){
                    location.href = "timeslot.php";
                }
            }
        });
   }
      
}
</script>
</body>
</html>