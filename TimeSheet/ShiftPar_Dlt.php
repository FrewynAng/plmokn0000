<!--
**********************
** ShiftPar_Dlt.php **
**********************
-->

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <meta charset="UTF-8">
    <title>GalaxyTime</title>
</head>

<body>

    <?php
    include '../Main/navBar.php';
    $cmpMsg = $_SESSION['cmpMsg'];

    $SH_No = $_GET["SH_No"];
    //echo $HDate;

    $sql =
    "DELETE FROM `shiftpar`
     WHERE
     `SH_No` = '$SH_No'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      $url = "Location:../TimeSheet/ShiftPar.php?menu={$menu}";
      header($url);
    }
    else
    {
      $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
    }

    $conn->close();
?>

</body>
</html>
