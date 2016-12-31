<!--
*********************
** UserGrp_Add.php **
*********************
-->

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/form.css">
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body class="form_body">

  <?php
  include '../Main/navBar.php';
  $cmpMsg = $_SESSION['cmpMsg'];
  $valid = TRUE;

  echo "<div class='title'>ADD USER ACCESS</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";
  echo "</div>";

  echo "<div class='container'>";
  
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
          $UsrAccLink = "../Staff/Staff_Add.php?menu=1";
          $UsrAccDsc = "Add new Staff";
          break;

          case 1.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Staff/StaffMast.php?menu=1";
          $UsrAccDsc = "Staff Master";
          break;

          case 2.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/ShiftPar_Add.php?menu=2";
          $UsrAccDsc = "Add new Shift";
          break;

          case 2.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/ShiftPar.php?menu=2";
          $UsrAccDsc = "Shift Master";
          break;

          case 2.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/ShfGrp_Add.php?menu=2";
          $UsrAccDsc = "Staff Enrollment";
          break;

          case 2.4:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/ShfGrp.php?menu=2";
          $UsrAccDsc = "Staff Shift Managment";
          break;

          case 3.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/uplLogFile.php?menu=3";
          $UsrAccDsc = "Upload Log File";
          break;

          case 3.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeSheet/TimeSheet.php?menu=3";
          $UsrAccDsc = "Attendance Sheet";
          break;

          case 3.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Leave/Leave_App.php?menu=3";
          $UsrAccDsc = "Leave Application";
          break;

          case 3.4:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Leave/LeaveTable.php?menu=3";
          $UsrAccDsc = "Leave Maintenance";
          break;

          case 4.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/uplLogFile.php?menu=4";
          $UsrAccDsc = "Upload Log File";
          break;

          case 4.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/TimeLog.php?menu=4";
          $UsrAccDsc = "View Loaded Log File";
          break;

          case 4.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/ViewPlainLog.php?menu=4";
          $UsrAccDsc = "View Loaded Log File (Plain Text)";
          break;

          case 4.4:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../TimeLog/ClrPlainLog.php?menu=4";
          $UsrAccDsc = "Clear Loaded Log File";
          break;

          case 5.1:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/Department.php?menu=5";
          $UsrAccDsc = "Department Maintenance";
          break;

          case 5.2:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/RolePar.php?menu=5";
          $UsrAccDsc = "Role Maintenance";
          break;

          case 5.3:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Holiday/HolidayTable.php?menu=5";
          $UsrAccDsc = "Holiday Table Maintenance";
          break;

          case 5.4:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/UserGrp.php?menu=5";
          $UsrAccDsc = "User Group Access";
          break;

          case 5.5:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/UserLogin.php?menu=5";
          $UsrAccDsc = "User Login Maintenance";
          break;

          case 5.6:
          $UsrAccSeq = $Acc;
          $UsrAccLink = "../Admin/db_Reset.php?menu=5";
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

      $url = "Location:../Admin/UserGrp.php?menu={$menu}";
      header($url);
      $conn->close();
    }
  }

  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <table class="frm">
      <thead class="frm_hdr">
        <tr>
          <th class="frm_th" colspan="4">Add User Access Group</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td class="frm_td">User Group Name :</td>
          <td class="frm_td">
            <input type="text" name="UsrGrpNam" value="<?php echo $UsrGrpNam;?>" placeholder="Enter User Access Group Name" autofocus="" required="">
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
          <td><input type="checkbox" name="Acc[]" id="Acc" value="2.3">Shift Enrollment</td>
          <td><input type="checkbox" name="Acc[]" id="Acc" value="2.4">Staff Shift Managment</td>
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
            <a href="../Admin/UserGrp.php?menu=<?php echo $menu;?>" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>
</div>

</body>
</html>
