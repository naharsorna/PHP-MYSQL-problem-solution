<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Fall-25-a</title>
</head>

<body>

    <form action="" method="POST">


        CT1: <input type="number" name="ct1" required> <br>
        CT2: <input type="number" name="ct2" required> <br>
        CT3: <input type="number" name="ct3" required> <br>
        MID: <input type="number" name="mid" required> <br>
        FINAL: <input type="number" name="final" required> <br>

        <input type="submit" name="submit" value="calculate">

    </form>



    <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

        $ct1 = $_POST['ct1'];
        $ct2 = $_POST['ct2'];
        $ct3 = $_POST['ct3'];
        $mid = $_POST['mid'];
        $final = $_POST['final'];


        $ct = $ct1 + $ct2 + $ct3;
        $small = min($ct1, $ct2, $ct3);

        $sum = ($ct - $small) ;

        $total = $sum + $mid + $final;

        if ($total < 54) {
            $status = "fail";
        } else {
            $status = "pass";
        }


        echo "BEST 2 CT TOTAL:" . $sum . "<br>";
        echo "MID :" . $mid . "<br>";
        echo "final :" . $final . "<br>";

        echo "BEST 2 CT TOTAL:" . $total . "<br>";
        echo "STATUS :" . $status . "<br>";
    }
    ?>



</body>

</html>