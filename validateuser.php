<?php
session_start();
include("conn.php");

if(!empty($_POST["phone"])) {
    $phone = $_POST["phone"];
    $pass = $_POST["pass"];
    $sql ="SELECT username FROM  admin_logins WHERE username=:uname AND password=:pass";
    $query= $conn -> prepare($sql);
    $query-> bindParam(':uname', $phone, PDO::PARAM_STR);
    $query-> bindParam(':pass', $pass, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
        $_SESSION["phone"] = $phone;
        echo 1;
    } else{
    echo "<span style='color:green'> Invalid details</span>";
    }
}

?>