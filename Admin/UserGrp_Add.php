<!--
*********************
** UserGrp_Add.php **
*********************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/form.css">
  <meta charset="UTF-8">
  <title>Leave Application</title>
</head>

<body>
  <?php
  include '../Main/getSysPar.php';
  $valid = true;

  $UsrGrp = "";
  $UsrGrpNam = "";
  $UsrAccSeq = 0;
  $UsrAccLink = "";
  $UsrAccDsc = "";
  $AccDsc = "";
  $AccDsc_ = "";
  $AccLink_ = "";
  $x = 0;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if (empty($_POST["UsrGrpNam"]))
    {
      $valid = false;
      echo "<div class='reject_div'> * USER GROUP NAME is required.</div>";
    }
    else
    {
      $UsrGrpNam = $_POST["UsrGrpNam"];
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
        switch ($Acc)
        {
          case 1.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Staff/Staff_Add.php";
          $UsrAccDsc = "Add new Staff";
          break;

          case 1.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Staff/StaffMast.php";
          $UsrAccDsc = "Staff Master";
          break;

          case 2.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/ShiftPar_Add.php";
          $UsrAccDsc = "Add new Shift";
          break;

          case 2.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/ShiftPar.php";
          $UsrAccDsc = "Shift Master";
          break;

          case 2.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/ShfGrp.php";
          $UsrAccDsc = "Staff Shift Managment";
          break;

          case 3.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/uplLogFile.php";
          $UsrAccDsc = "Upload Log File";
          break;

          case 3.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/TimeSheet.php";
          $UsrAccDsc = "Attendance Sheet";
          break;

          case 3.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Leave/Leave_App.php";
          $UsrAccDsc = "Leave Application";
          break;

          case 3.4:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Leave/LeaveTable.php";
          $UsrAccDsc = "Leave Maintenance";
          break;

          case 4.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/uplLogFile.php";
          $UsrAccDsc = "Upload Log File";
          break;

          case 4.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/TimeLog.php";
          $UsrAccDsc = "View Loaded Log File";
          break;

          case 4.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/ViewPlainLog.php";
          $UsrAccDsc = "View Loaded Log File (Plain Text)";
          break;

          case 4.4:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/ClrPlainLog.php";
          $UsrAccDsc = "Clear Loaded Log File";
          break;

          case 5.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/Department.php";
          $UsrAccDsc = "Department Maintenance";
          break;

          case 5.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/RolePar.php";
          $UsrAccDsc = "Role Maintenance";
          break;

          case 5.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Holiday/HolidayTable.php";
          $UsrAccDsc = "Holiday Table Maintenance";
          break;

          case 5.4:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/UserGrp.php";
          $UsrAccDsc = "User Group Access";
          break;

          case 5.5:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/UserLogin.php";
          $UsrAccDsc = "User Login Maintenance";
          break;

          case 5.6:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/db_Reset.php";
          $UsrAccDsc = "Reset Database";
          break;

          default:
          $UsrAccSeq = 0;
          $UsrAccLink = "";
          $UsrAccDsc = "";
          break;
        }

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

      header('Location:../Admin/UserGrp.php');
      $conn->close();
    }
  }

  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <p><div class="lst_title">ADD USER ACCESS</div></p>
    <table class="frm">
      <thead class="frm_hdr">
      <tr>
        <th class="frm_th" colspan="2">Add User Access Group</th>
      </tr>
    </thead>

      <tbody>
        <tr>
          <td class="frm_td">User Group Name :</td>
          <td class="frm_td">
            <input type="text" name="UsrGrpNam" value="<?php echo $UsrGrpNam;?>" placeholder="Enter User Access Group Name">
            <span class="reject">*</span>
            <td></td>
            <td></td>
          </td>
        </tr>

        <tr>
          <th colspan="4" class="frm_th">Staff Managment</th>
        </tr>
        <tr>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="1.1">Add new Staff</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="1.2">Staff Master</td>
        </tr>

        <tr>
          <th colspan="4" class="frm_th">Shift Managment</th>
        </tr>
        <tr>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="2.1">Add Shift</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="2.2">Shift Master</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="2.3">Staff Shift Managment</td>
        </tr>

        <tr>
          <th colspan="4" class="frm_th">Attendance Sheet</th>
        </tr>
        <tr>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="3.1" checked>Upload Log</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="3.2" checked>Attendance Sheet</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="3.3" checked>Leave Application</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="3.4" checked>Leave Maintenance</td>
        </tr>

        <tr>
          <th colspan="4" class="frm_th">Attendance Log</th>
        </tr>
        <tr>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="4.1" checked>Upload Log</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="4.2">View Loaded Log File</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="4.3">View Loaded Log File (Plain Text)</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="4.4">Clear Log File</td>
        </tr>

        <tr>
          <th colspan="4" class="frm_th">System Setting</th>
        </tr>
        <tr>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="5.1">Department Maintenance</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="5.2">Role Maintenance</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="5.3" checked>Holiday Table Maintenance</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="5.4">User Group Access</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="5.5">User Login Maintenance</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="5.6">Reset Database</td>
        </tr>

        <tr>
          <th class="frm_btn" colspan="4">
            <a href="../Admin/UserGrp.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>
