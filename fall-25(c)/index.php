<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = " campus_library";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



echo "<h2>Question 1</h2>";

$sql = "SELECT Status, COUNT(*) AS total 
FROM book_loans
GROUP BY Status 
HAVING total>1;
";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "status: " . $row["Status"] . " - totalbook: " . $row["total"] .  "<br>";
    }
} else {
    echo "0 results";
}



echo "<h2>Question 2</h2>";

$sql2 = "UPDATE book_loans SET Status='grace period', PenaltyFee=0
WHERE Status='Overdue' AND DaysOverdue<7";
if ($conn->query($sql2) === TRUE) {
 echo "Record updated successfully";
} else {
 echo "Error updating record: " . $conn->error;
}

echo "<h2>Question 3</h2>";

$sql3 = "UPDATE book_loans SET PenaltyFee=PenaltyFee*1.10 
WHERE PenaltyFee>20 AND (PenaltyFee*1.10)<=50 ";
if ($conn->query($sql3) === TRUE) {
 echo "Record updated successfully";
} else {
 echo "Error updating record: " . $conn->error;
}


echo "<h2>Question 4</h2>";

$sql4 = "SELECT BookTitle,SUM(PenaltyFee) AS totalfee FROM   book_loans

GROUP BY BookTitle
ORDER  BY totalfee DESC";

$result = $conn->query($sql4);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Booktitle: " . $row["BookTitle"] . " - totalpenalty: " . $row["totalfee"] .  "<br>";
    }
} else {
    echo "0 results";
}



$conn->close();

?>