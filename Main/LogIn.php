<!--
***************
** LogIn.php **
***************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/login.css">
  <meta charset="UTF-8">
  <title>GalaxyTime </title>
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
  $valid = TRUE;
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
      // print_r($row);

      if ($row > 0)
      {
        session_regenerate_id();
        $_SESSION['UsrID'] = $row["UsrID"] ;
        $_SESSION['UsrGrp'] = $row["UsrGrp"] ;

        header('Location:../Staff/Stf_BirthD.php');
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

  <!-- <div class="login_box"> -->
  <div class="login_box_main">
    <div class="login_title">LOG IN</div>

    <div class="login_box">
      <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
        <!-- <div><label class="lgnLbl">User Name :</label></div> -->
        <div><input type="text" class="lgnBox" name="UsrID" placeholder="Enter User ID" value="<?php echo $UsrID;?>" autofocus required></div>
        <!-- <div><label class="lgnLbl">Password :</label></div> -->
        <div><input type="password" class="lgnBox" name="UsrPass" placeholder="Enter User Password" autocomplete="off" value="<?php echo $UsrPass;?>" required></div>
        <div><input type="submit" class="lgn_btn" value="Log In"></div>
      </form>
    </div>
    <div class="login_box_msg"><?php echo $rjtMsg; ?></div>
  </div>
  <!-- </div> -->

</body>
</html>
