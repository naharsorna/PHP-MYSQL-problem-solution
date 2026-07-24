<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sundarban";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

echo "<h2>Question 1: Total Revenue Per Category</h2>";

$sql1 = "SELECT CategoryName, SUM(Revenue) AS TotalRevenue
         FROM sales_data
         GROUP BY CategoryName";

$result1 = $conn->query($sql1);

if($result1->num_rows > 0){
    while($row = $result1->fetch_assoc()){
        echo "Category: ".$row["CategoryName"].
             " | Total Revenue: ".$row["TotalRevenue"]."<br>";
    }
}else{
    echo "No Result";
}

echo "<hr>";

echo "<h2>Question 2: Update Low Performing Category</h2>";

$sql2 = "UPDATE sales_data
         SET CategoryName='Low Performing'
         WHERE Revenue < 40000";

if($conn->query($sql2)==TRUE){
    echo "Category Updated Successfully.<br>";
}else{
    echo "Error: ".$conn->error;
}

echo "<hr>";

echo "<h2>Question 3: Add 10% Bonus Revenue</h2>";

$sql3 = "UPDATE sales_data
         SET Revenue = Revenue + (Revenue * 0.10)
         WHERE Revenue > 70000";

if($conn->query($sql3)==TRUE){
    echo "Revenue Updated Successfully.<br>";
}else{
    echo "Error: ".$conn->error;
}

echo "<hr>";

echo "<h2>Question 4: Product Status</h2>";

$sql4 = "SELECT s1.ProductName,
                s1.CategoryName,
                s1.Revenue,
                (SELECT AVG(s2.Revenue)
                 FROM sales_data s2
                 WHERE s2.CategoryName = s1.CategoryName) AS AvgRevenue
         FROM sales_data s1";

$result4 = $conn->query($sql4);

if($result4->num_rows > 0){

    while($row = $result4->fetch_assoc()){

        if($row["Revenue"] > $row["AvgRevenue"]){
            $label = "Top Seller";
        }else{
            $label = "Regular Seller";
        }

        echo "Product: ".$row["ProductName"].
             " | Category: ".$row["CategoryName"].
             " | ".$label."<br>";

    }

}else{

    echo "No Result";

}

$conn->close();

?>