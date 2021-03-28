<?php
require("conn.php");
session_start();
$sql = "select * from userinfo where phoneno=? order by id desc limit 1";
$stmt = $conn->prepare($sql);
$stmt->execute([$_POST["phone"]]);
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
if($stmt->rowCount() > 0){
    foreach ($result as $data) {
        $_SESSION["name"] = $data->name;
        $_SESSION["timeslot"] = $data->timeslot;
        $_SESSION["phoneno"] = $data->phoneno;
        $_SESSION["shop"] = $data->shop;
        $_SESSION["datetime"] = $data->datetime;
    }
    echo 1;
}else{
     echo "No Past Record Found";
}
?>