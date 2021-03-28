<?php
require("conn.php");
try{
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $pincode = $_POST["pincode"];
        $namem = $_POST["namem"];
        $addressm = $_POST["addressm"];
        $cat = $_POST["cat"];
        $hd = $_POST["hd"];
        $sql = "insert into shops(pincode,category,name,address,phoneno,namem,addressm,hd) values(?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        if($stmt->execute([$pincode,$cat,$name,$address,$phone,$namem,$addressm,$hd])){
            echo 1;
        }else{
            echo "Error occured";
        }
    }

}catch(PDOException $e)
{
 if($e->getCode() == 23000){
            echo 'Sorry your no is already registered';
        }else{
            echo $e->getMessage();
        }
}

$conn = null;

?>