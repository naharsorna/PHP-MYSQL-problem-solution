<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uiutech_final";
$conn = new mysqli($servername, $username, $password,
$dbname);
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

echo "<h2>Question 1</h2>";

$sql1 = "SELECT  PerformanceRating ,COUNT(*) AS total 
FROM employee_final
GROUP BY PerformanceRating";
$result1 = $conn->query($sql1);
if($result1->num_rows > 0){
    while($row = $result1->fetch_assoc()){
        echo "Rating: ".$row["PerformanceRating"].
             " | Employees: ".$row["total"]."<br>";
    }
}else{
    echo "No Result";
}


echo "<h2>Question 2</h2>";

$sql2="UPDATE employee_final SET PerformanceRating='M'
WHERE Salary<40000 AND PerformanceRating!='D'";
 if ($conn->query($sql2) === TRUE) {
 echo "Record updated successfully";
}  else {
 echo "Error updating record: " . $conn->error;
}


echo "<h2>Question 3</h2>";
$sql3="UPDATE employee_final SET Salary=Salary+5000 
WHERE Salary>=50000 AND Salary+5000<60000";
if($conn->query($sql3)==TRUE){
    echo "Bonus Added Successfully.<br>";
}else{
    echo "Error: ".$conn->error;
}

echo "<h2>Question 4</h2>";

$sql4 = "SELECT  DepartmentName ,COUNT(*) AS total 
FROM employee_final
GROUP BY DepartmentName
ORDER BY DepartmentName DESC";
$result4 = $conn->query($sql4);

if($result4->num_rows > 0){

    while($row = $result4->fetch_assoc()){

        echo "Department: ".$row["DepartmentName"].
             " | Employees: ".$row["total"]."<br>";

    }

}else{

echo "No Result";

}

$conn->close();


?>