<?php
include("conn.php");
session_start();
    echo '
    <div class="table-responsive">          
        <table class="table table-striped table-bordered" id="example">
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone No</th>
                <th>Order</th>
                <th>Slot</th>
            </tr>
            </thead>
            <tbody>
    ';

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 



try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT name, phoneno, orderdetails, timeslot FROM userinfo where shop=".$_SESSION["phone"]); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo ' </tbody>
</table>
</div>
';?>
<script>

</script>
