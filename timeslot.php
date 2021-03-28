<?php
session_start();
if (!(isset($_SESSION['phoneno']) && $_SESSION['phoneno'] != '')) {

    header ("Location: index.php");
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeslot</title>
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">  
  <style type="text/css">
        
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
      <div class="container mt-4">
         <div class="row ">
            <div class="col-md-2"></div>
            <div class=" col-md-8 ">
               <div class="card ">
                <div class="card-body">
                  <label for="sel1" class="lang" key="sel">यादी निवडा:</label>
                    <select class="form-control" name="timeslot" id="selectslot">
<?php 
date_default_timezone_set("Asia/Kolkata");
include('conn.php');

function date2hrmin(){
    $date1 = strtotime("08:00:00");  
    $date2 = strtotime("20:00:00");  
    
    // Formulate the Difference between two dates 
    $diff = abs($date2 - $date1);  
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
    $hours = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24) / (60*60));  
    $minutes = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60)/ 60);  
    $min = $hours * 60 + $minutes;
    return $min;
}

$totalmin = date2hrmin();  
$n = 2;
$gap = 30;
$slots = $totalmin/$gap;
// echo $slots;



try {
   
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    // echo "Connection failed: " . $e->getMessage();
    }

$stmt = $conn->prepare("select slot,count(*) from userinfo GROUP BY slot");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();

// echo $result[1]['slot'];
$finalslots = array();
$flag = false;
for($i=1;$i<=$slots;$i++){
    $flag = true;
    foreach ($result as $key => $value) {
        if($value['slot'] == $i){
            $flag = false;
            if($value['count(*)']<$n){
                array_push($finalslots,$i);
            }
            break;
        }
    }
    if($flag){
        array_push($finalslots,$i);
    }
}
$ampm = 'AM';
// print_r($finalslots);
foreach ($finalslots as $key => $value) {
    
    $temp = $value * $gap;

    // echo $temp.'<br>';
    $h = floor($temp / 60);
    // echo $h."<br>";
    $m = $temp%60;
    $date1 = strtotime("08:00:00");  
    $date2 = strtotime($h.":".$m.":00");  
   
    // echo date('H', $date1);

    $m = $m + date('i', $date1);
    $h = $h + date('H', $date1);
    $c = $m - 60;

    if ($c >= 1) {
        $m = $c;
        $h = $h + 1;
    }

    if($h>=12){
        if($h>12)
        $h = $h-12;
        $ampm = "PM";
       
    }

    if($h>=24){
        $h = $h - 24;
        $ampm = "AM";
    }
    if($m < 9){
        $m = '0'.$m;
    }
?>

<option value="<?php echo startingtime($h,$m,$gap,$ampm); echo ' - '.$h.':'.$m.$ampm.'|'.$value  ?>">
<?
    echo startingtime($h,$m,$gap,$ampm);
    
    echo ' - '.$h.':'.$m.$ampm; 
    ?>
</option>
    <?php
}

function startingtime($h,$i,$gap,$ampm){
    $newampm = $ampm;
    $hr = floor($gap / 60);
    $mn = $gap % 60;
    if ($mn > $i) {
        $mn = 60 - $mn + $i;
        $hr = $h - $hr - 1;
    }else{
        $mn = $i - $mn;
        $hr = $h - $hr;
    }

    if($hr <= 0){
        if($hr<0){
            $newampm = ($ampm == 'AM') ? "PM":"AM";
        }
        $hr = $hr+12;
    }
    if($h == 12 && $hr < 12){
        $newampm = ($ampm == 'AM') ? "PM":"AM";
    }
    if($mn < 9){
        $mn = '0'.$mn;
    }
    return $hr.':'.$mn.''.$newampm;
}

?>
                    </select>
                    <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary lang" key="sub" onclick="send()">बटन दाबा</button>
                    </div>
                  </div>
               </div>
            </div>
            <div class="col-md-2"></div>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script></body>
<script type="text/javascript">
    var arrLang = {
      'en': {
        'opt': 'Select Shop',
        'sel': 'Select Slot:',
        'sub' : 'Submit',
        'logo':'Liquor Purchase Portal'
      },
      'mr': {
        'opt': 'दुकान निवडा',
        'sel': 'यादी निवडा:',
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
function send() {
    let selectedslot = "";
    let slot;
    var e = document.getElementById("selectslot");
    selectedslot = e.options[e.selectedIndex].value;
    let splitslot = selectedslot.split("|");
    slot = splitslot[1];
    selectedslot = splitslot[0];
    if(selectedslot == ""){
      alert("Select shop")
   }else{
      $.ajax({
            method:"POST",
            data:{selectedslot:selectedslot,slot:slot},
            url:"updatetimeslot.php",
            success:function(res){
               if(res == 1){
                    location.href = "thankyou.php";
                }
            }
        });
   }
    
}
</script>
</html>