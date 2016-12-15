<!--
***********************
** StfShfGrp_Add.php **
***********************
-->

<?php session_start(); ?>

<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Add Staff Shift Group</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';
  $rjtMsg = "";

  $ShfGrp = "";
  $ShfNo = 0;
  $ShfGrpDsc = "";
  $StaffID = "";
  $StaffNam = "";
  $TagID = "";
  $valid = true;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $ShfNo = $_POST["ShfNo"];
    $ShfGrpDsc = $_POST["ShfGrpDsc"];
    $StaffID = $_POST["StaffID"];

    $sql1 =
    "SELECT `SH_No`, `SH_Name`
    FROM `shiftPar`
    WHERE `SH_No` = '$ShfNo'";
    // echo $sql1;

    $rst1 = $conn->query($sql1);
    $row1 = $rst1->fetch_assoc();

    if ($row1 > 0)
    {
      $ShfGrpDsc = $row1['SH_Name'];
    }
    else
    {
      $rjtMsg = "* Invalid SHIFT NO. ";
      $valid = false;
    }

    if ($_POST["StaffID"] == "")
    {
      $rjtMsg = "* STAFF ID is required";
      $valid = false;
    }

    $sql2 =
    "SELECT *
    FROM `StaffMaster`
    WHERE `StaffID` = '$StaffID'";

    $rst2 = $conn->query($sql2);
    $row2 = $rst2->fetch_assoc();
    if ($row2 == 0)
    {
      $rjtMsg = "* INVALID STAFF ID";
      $valid = false;
    }
    else
    {
      $StaffNam = $row2["Name"];
      $TagID = $row2["TagID"];
    }

    if($valid)
    {
      $sql3 =
      "INSERT INTO `StfShfGrp` (`ShfGrp`, `ShfNo`, `ShfGrpDsc`, `StaffID`, `TagID`, `StaffNam`)
      VALUES ('$ShfGrp', '$ShfNo', '$ShfGrpDsc', '$StaffID', '$TagID', '$StaffNam');";

      if ($conn->query($sql3) === TRUE)
      {
        $_SESSION['cmpMsg'] = "Staff added to shift group.";
        header('Location:../TimeSheet/StfShfGrp.php');
      }
      else
      {
        $rjtMsg = "Error: " . $sql3 . $conn->error;
        $_SESSION['rjtMsg'] = "Error: " . $sql3 . "<br>" . $conn->error;
        echo $_SESSION['rjtMsg'];
      }

      $conn->close();
    }
  }

  ?>

  <p><span class="reject"><?php echo $rjtMsg; ?></span></p>
  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <table class="frm">
      <thead class="frm_hdr">
        <tr>
          <th class="frm_th" colspan="2">Add Staff Shift Group</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Shift No :</td>
          <td>
            <input type="number" name="ShfNo" value="<?php echo $ShfNo;?>">
            <span class="reject">*</span>
          </td>
        </tr>

        <!-- <tr>
          <td>Shift Group Description :</td>
          <td>
            <input type="text" name="ShfGrpDsc" value="<?php echo $ShfGrpDsc;?>">
            <span class="reject">*</span>
          </td>
        </tr> -->

        <tr>
          <td>Staff ID :</td>
          <td>
            <input type="text" name="StaffID" value="<?php echo $StaffID;?>">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <th class="frm_btn"colspan="2">
            <a href="../TimeSheet/StfShfGrp.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>
