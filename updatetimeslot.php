<?php
session_start();
include('conn.php');
date_default_timezone_set("Asia/Kolkata");
$t=time();
try {
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $timeslot = $_POST["selectedslot"];
        $slot = $_POST["slot"];
       
        $sql = "UPDATE userinfo SET timeslot='$timeslot',slot='$slot' WHERE phoneno=".$_SESSION['phoneno']." order by id desc limit 1";
         // use exec() because no results are returned
          // Prepare statement
        $stmt = $conn->prepare($sql);

        // execute the query
        if($stmt->execute()){
            $_SESSION["timeslot"] = $timeslot;
            $_SESSION["datetime"] = date("d-m-Y h:i:s",$t);
            echo 1;
            exit; 
        }
        
     }
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>