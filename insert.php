<?php
session_start();
include('conn.php');
$ip = get_client_ip();
$sql = "select dayordercount from checkavailability where phoneno=? and date = CURDATE()";
$stmt = $conn->prepare($sql);
$stmt->execute([$_POST["phone"]]);
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
if($stmt->rowCount() > 0){
    foreach ($result as $data) {
        if($data->dayordercount<2){
           $ipadd = get_client_ip();
           $name = $_POST["name"];
           $phoneno1 = $_POST["phone"];
           $order = $_POST["order"];
           $query = "insert into `userinfo` (`name`, `phoneno`, `orderdetails`) VALUES (?,?,?);";
           $stmt = $conn->prepare($query);
            if($stmt->execute([$name,$phoneno1,$order])){
                $_SESSION["name"] = $name;
                $_SESSION["phoneno"] = $phoneno1;
                $_SESSION["order"] = $order;
                $sql = "update checkavailability set dayordercount=? where phoneno=?";
                $stmt = $conn->prepare($sql);
                if($stmt->execute([$data->dayordercount+1,$_POST["phone"]])){
                    echo 1;
                }else{
                    echo 'Got Some Error';
                }
            }else{
                echo "Sorry you are not allowed to get the liquor";
            }
        }else{
            echo 'Sorry your daily quota is finished come back tomorrow';   
        }
    }
}else{
    try {
   
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           $ipadd = get_client_ip();
           $name = $_POST["name"];
           $phoneno1 = $_POST["phone"];
           $order = $_POST["order"];
        //    if($_COOKIE["ipadd"] == $ipadd){

        //    }else{

        //    }
           $query = "insert into `userinfo` (`name`, `phoneno`, `orderdetails`) VALUES (?,?,?);";
           $query2 = "insert into `checkavailability` (`phoneno`,`ipaddress`,`dayordercount`,`date`) values(?,?,1,?)";
           $stmt2 = $conn->prepare($query2);
           $stmt = $conn->prepare($query);

           if($stmt2->execute([$phoneno1,$ipadd,date("Y-m-d")])){
            if($stmt->execute([$name,$phoneno1,$order])){
                $_SESSION["name"] = $name;
                $_SESSION["phoneno"] = $phoneno1;
                $_SESSION["order"] = $order;
                // setcookie("ipadd", $ipadd, time() + (85400), "/");
                echo 1;
            }else{
                echo "error";
            }
            }
            else{
                echo 'Error';
            }
        
        }
    
        }
    catch(PDOException $e)
        {
        if($e->getCode() == 23000){
            echo 'Sorry your daily quota is finished, you cannot book any order from this device come back tomorrow';
            session_unset();

        // destroy the session
            session_destroy();
        }else{
            echo $e->getMessage();
        }
        }
    
    $conn = null;
}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


?>