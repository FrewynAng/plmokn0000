<!--
************************
** Department_Dlt.php **
************************
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
    $dpt_No = $_GET["dpt_No"];
    $dpt_desc = $_GET["dpt_desc"];

    $sql =
    "DELETE FROM `department`
     WHERE
     `dpt_No` = '$dpt_No' AND `dpt_desc` = '$dpt_desc'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      $url = "Location:../Admin/Department.php?menu={$menu}";
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
