<?php
session_start();
 ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/Style.css">
    <meta charset="UTF-8">
    <title>Delete Holiday</title>
</head>

<body>

    <?php
    include '../Main/getSysPar.php';

    $SH_No = $_GET["SH_No"];
    //echo $HDate;

    $sql =
    "DELETE FROM `ShiftPar`
     WHERE
     `SH_No` = '$SH_No'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      header('Location:../TimeSheet/ShiftPar.php');
    }
    else
    {
      $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
    }

    $conn->close();
?>

</body>
</html>
