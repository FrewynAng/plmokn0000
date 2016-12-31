<!--
***********************
** UserLogin_Dlt.php **
***********************
-->

<?php session_start(); ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <meta charset="UTF-8">
    <title>GalaxyTime</title>
</head>

<body>

    <?php
    include '../Main/navBar.php';
    $UsrID = $_GET["UsrID"];

    $sql =
    "DELETE FROM `UsrLogin`
     WHERE
     `UsrID` = '$UsrID'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      $url = "Location:../Admin/UserLogin.php?menu={$menu}";
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
