<?php
session_start();
include('conn.php');

try {
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $shop = $_POST["shop"];
       
        $sql = "UPDATE userinfo SET shop='$shop' WHERE phoneno=".$_SESSION['phoneno'];
         // use exec() because no results are returned
          // Prepare statement
        $stmt = $conn->prepare($sql);

        // execute the query
        if($stmt->execute()){
            $_SESSION["shop"] = $shop;
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