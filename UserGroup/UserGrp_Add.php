<!--
*********************
** UserGrp_Add.php **
*********************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Leave Application</title>
</head>

<body>
  <?php
  include '../Main/getSysPar.php';
  $valid = true;

  $UsrGrp = "";
  $UsrGrpNam = "User Group#";
  $UsrAccSeq = 0;
  $UsrAccLink = "";
  $UsrAccDsc = "";
  $AccDsc = "";
  $AccDsc_ = "";
  $AccLink_ = "";
  $x = 0;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $AccLink_ =
    array("../Staff/Stf_BirthD.php",
    "../Staff/StaffMast.php",
    "../Leave/LeaveTable.php",
    "../Holiday/HolidayTable.php",
    "../TimeSheet/ShiftPar.php",
    "../TimeSheet/ShfGrp.php",
    "../TimeSheet/TimeSheet.php",
    "../TimeLog/uplLogFile.php",
    "../TimeLog/TimeLog.php",
    "../UserGroup/UserGrp.php",
    "../UserGroup/Department.php",
    "../UserGroup/RolePar.php",
    "../Main/db_Reset.php");

    $AccDsc_ =
    array("Home", "Staff Table", "Leave Table", "Holiday Table",
    "Shift Parameter", "Shift Group", "Time Sheet", "Upload Log File", "View Log File",
    "User Group", "Department", "Role Parameter", "Reset Database");

    if (empty($_POST["UsrGrpNam"]))
    {
      $valid = false;
      echo "<div class='reject_div'> * USER GROUP NAME is required.</div>";
    }
    else
    {
      $UsrGrp = $_POST["UsrGrpNam"];
    }

    if($valid)
    {
      # retrieve user group sequence number
      $sql =
      "SELECT MAX(`UsrGrp`) AS maxUsrGrp
      FROM `UsrGrpPar`
      WHERE `UsrGrp`< 888";

      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      //echo $row["_UsrGrp"];
      $UsrGrp = $row["maxUsrGrp"] + 1;
      //echo $UsrGrp;

      # load user access
      $AccDsc = $_POST["Acc"];
      foreach ($AccDsc as $Acc)
      {
        $UsrAccSeq = $UsrAccSeq + 1;
        $UsrAccDsc = $AccDsc_[$Acc];
        $UsrAccLink = $AccLink_[$Acc];
        //echo $UsrGrp . " + " . $UsrGrpNam . " + " . $UsrAccSeq . " + " . $UsrAccDsc . " + " . $UsrAccLink ."<br>";

        $sql =
        "INSERT INTO `UsrGrpPar` (`UsrGrp`, `UsrGrpNam`, `UsrAccSeq`, `UsrAccLink`, `UsrAccDsc`)
        VALUES ('$UsrGrp', '$UsrGrpNam', '$UsrAccSeq', '$UsrAccLink', '$UsrAccDsc');";

        if ($conn->query($sql) === TRUE)
        {
          $_SESSION['cmpMsg'] = "User Group added.";
        }
        else
        {
          echo "<div class='reject_div'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
      }

      header('Location:../UserGroup/UserGrp.php');
      $conn->close();
    }
  }

  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table class="frm">
      <thead class="frm_hdr">
        <tr>
          <th colspan="4" class="frm_th">Add User Group</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td class="frm_td">User Group Name :</td>
          <td class="frm_td">
            <input type="text" name="UsrGrpNam" value="<?php echo $UsrGrpNam;?>">
            <span class="reject">*</span>
            <td></td>
            <td></td>
          </td>
        </tr>

        <tr>
          <td>User Access :</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="0" checked>Home</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="1" checked>Staff Master</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="2" checked>Leave Table</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="3" checked>Holiday Table</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="4">Shift Parameter</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="5">Staff Shift Group</td>
          <td></td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="6" checked>Time Sheet</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="7" checked>Upload Log</td>
          <td></td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="8">View Scanned Log</td>
          <td></td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="9">User Group</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="10">Department</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="11">Role</td>
        </tr>

        <tr>
          <td></td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="12">Reset Database</td>
        </tr>

        <tr>
          <th class="frm_btn" colspan="4">
            <a href="../UserGroup/UserGrp.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>
