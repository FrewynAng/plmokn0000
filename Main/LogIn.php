<!--
***************
** LogIn.php **
***************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Login In</title>
</head>

<body class="lgnBdy">

  <?php
  $_SESSION['UsrID'] = "LogIn";
  $_SESSION['UsrGrp'] = "###";
  $_SESSION['cmpMsg'] = "";
  $_SESSION['rjtMsg'] = "";

  include '../Main/getSysPar.php';

  $_SESSION['UsrID'] = "LogOut";
  $valid = TRUE;

  $UsrID = "admin";
  $UsrPass = "admin";
  $rjtMsg = $_SESSION['rjtMsg'];

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if (empty($_POST["UsrID"]))
    {
      $rjtMsg = "*LOGIN ID is required";
      $valid = false;
    }
    else
    {
      $UsrID = $_POST["UsrID"];
      //echo "ID :" . $UsrID;
    }

    if (empty($_POST["UsrPass"]))
    {
      $rjtMsg = "*LOGIN PASSWORD is required";
      $valid = false;
    }
    else
    {
      $UsrPass = $_POST["UsrPass"];
      //echo "Pass :" . $UsrPass;
    }

    if($valid)
    {
      $sql =
      "SELECT *
      FROM `UsrLogin`
      WHERE `UsrID` = '$UsrID' AND `UsrPass` = '$UsrPass'";

      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

      if ($row > 0)
      {
        //session_regenerate_id();
        $_SESSION['UsrID'] = $row["UsrID"] ;
        $_SESSION['UsrGrp'] = $row["UsrGrp"] ;
        //session_write_close();

        //echo $_SESSION['UsrID'] . $_SESSION['UsrGrp'];
        header('Location:../Main/_main.php');
      }
      else
      {
        //echo "Invalid User ID or Password";
        $rjtMsg = "Invalid User ID or Password";
      }
      $conn->close();
    }
  }
  ?>

  <div align = "center">
    <div style = "width:300px; border: solid 1px #333333; background-color:white;" align = "left">
      <div style = "background-color:#626263; color:#FFFFFF; padding:3px;"><b>Login</b></div>

      <div style = "margin:30px; background-color:white;">
        <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <label class="lgnLbl">User Name  :</label>
          <input type="text" class="lgnBox" name="UsrID" value="<?php echo $UsrID;?>"><br/><br/>
          <label class="lgnLbl">Password  :</label>
          <input type="password" class="lgnBox" name="UsrPass" value="<?php echo $UsrPass;?>"><br/><br/>
          <input type="submit" value=" Submit "/><br/>
        </form>
        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $rjtMsg; ?></div>

      </div>
    </div>
  </div>

</body>
</html>
