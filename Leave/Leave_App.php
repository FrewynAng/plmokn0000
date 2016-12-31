<!--
*******************
** Leave_App.php **
*******************
-->

<!DOCTYPE HTML>
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

  echo "<div class='title'>Apply New Leave</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  $StaffID = "";
  $DateApl = date("d-m-Y");
  $LeaveTyp = "";
  $Approval = "";
  $Status = "APL";
  $DateFR = "";
  $DateTO = "";
  $NoOfDay = "";
  $AL_Ent = "";
  $AL_Apl = "";
  $AL_Bal = "";
  $ML_Ent = "";
  $ML_Apl = "";
  $ML_Bal = "";
  $HL_Ent = "";
  $HL_Apl = "";
  $HL_Bal = "";
  $EL_Apl = "";
  $UL_Apl = "";
  $Remark = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $StaffID = $_POST["StaffID"];
    $LeaveTyp = $_POST["LeaveTyp"];
    $Approval = $_POST["Approval"];
    $DateFR = $_POST["DateFR"];
    $DateTO = $_POST["DateTO"];
    $NoOfDay = $_POST["NoOfDay"];
    $Remarks = $_POST["Remarks"];
    $Status = "";

    if (empty($_POST["StaffID"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * STAFF ID is required.</div></p>";
    }

    $sql1 =
    "SELECT *
    FROM `StaffMaster`
    WHERE `StaffID` = '$StaffID'";

    $result = $conn->query($sql1);
    $row1 = $result->fetch_assoc();
    if ($row1 == 0)
    {
      $valid = false;
      echo "<p><div class='reject_div'> * INVALID STAFF ID.</div></p>";
    }

    $leav_Det = getLeaveDtl($conn, $StaffID, $LeaveTyp);
    // echo $leav_Det['AL_Apl'];

    switch ($LeaveTyp)
    {
      case "AL":
      if (($leav_Det['AL_Bal'] > 0) OR ($leav_Det['UL_Apl'] > 0))
      {
        // echo $row2['ML_Bal'] . "<br>";
        $AL_Ent = $leav_Det['AL_Ent'];
        $AL_Bal = $leav_Det['AL_Bal'] - $NoOfDay;
        $AL_Apl = $AL_Ent - $AL_Bal;
        $UL_Apl = $leav_Det['UL_Apl'];
      }
      else
      {
        $AL_Ent = $row1["MLEnt"];
        $AL_Apl = $NoOfDay;
        $AL_Bal = $AL_Ent - $NoOfDay;
      }
      break;

      case "EL":
      if (($leav_Det['AL_Bal'] > 0) OR ($leav_Det['UL_Apl'] > 0))
      {
        // echo $row2['ML_Bal'] . "<br>";
        $AL_Ent = $leav_Det['AL_Ent'];
        $AL_Bal = $leav_Det['AL_Bal'] - $NoOfDay;
        $AL_Apl = $AL_Ent - $AL_Bal;
        $UL_Apl = $leav_Det['UL_Apl'];
        $EL_Apl = $NoOfDay;
      }
      else
      {
        $AL_Ent = $row1["MLEnt"];
        $AL_Apl = $NoOfDay;
        $AL_Bal = $AL_Ent - $NoOfDay;
      }
      break;

      case "ML":
      if (($leav_Det['ML_Bal'] > 0) OR ($leav_Det['UL_Apl'] > 0))
      {
        // echo $row2['ML_Bal'] . "<br>";
        $ML_Ent = $leav_Det['ML_Ent'];
        $ML_Bal = $leav_Det['ML_Bal'] - $NoOfDay;
        $ML_Apl = $ML_Ent - $ML_Bal;
        $UL_Apl = $leav_Det['UL_Apl'];
      }
      else
      {
        $ML_Ent = $row1["MLEnt"];
        $ML_Apl = $NoOfDay;
        $ML_Bal = $ML_Ent - $NoOfDay;
      }
      break;

      case "HL":
      if (($leav_Det['HL_Bal'] > 0) OR ($leav_Det['UL_Apl'] > 0))
      {
        // echo $row2['ML_Bal'] . "<br>";
        $HL_Ent = $leav_Det['HL_Ent'];
        $HL_Bal = $leav_Det['HL_Bal'] - $NoOfDay;
        $HL_Apl = $HL_Ent - $HL_Bal;
      }
      else
      {
        $HL_Ent = $row1["HLEnt"];
        $HL_Apl = $NoOfDay;
        $HL_Bal = $HL_Ent - $NoOfDay;
      }

      break;
    }

    if($AL_Bal < 0)
    {
      $AL_Bal = 0;
      $UL_Apl = $UL_Apl + 1;
    }

    if($ML_Bal < 0)
    {
      $ML_Bal = 0;
      $UL_Apl = $UL_Apl + 1;
    }

    if($HL_Bal < 0)
    {
      $HL_Bal = 0;
      $UL_Apl = $UL_Apl + 1;
    }

    if (empty($_POST["LeaveTyp"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * LEAVE TYPE is required.</div></p>";
    }

    if (empty($_POST["Approval"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * APPROVAL is required.</div></p>";
    }

    if (date("d-m-Y", strtotime($DateTO)) < date("d-m-Y", strtotime($DateFR)))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * DATE TO cannot less than DATE FROM.</div></p>";
    }

    if (empty($_POST["DateFR"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * LEAVE DATE FROM is required.</div></p>";
    }

    if (empty($_POST["DateTO"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * LEAVE DATE TO is required.</div></p>";
    }

    if (empty($_POST["NoOfDay"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * NO OF DAY is required.</div></p>";
    }

    if($valid)
    {
      $sql4 =
      "INSERT INTO `LeaveTable`
      (`StaffID`, `DateApl`, `LeaveTyp`, `Approval`, `Status`, `DateFR`, `DateTO`, `NoOfDay`,
        `AL_Ent`, `AL_Apl`, `AL_Bal`, `ML_Ent`, `ML_Apl`, `ML_Bal`, `HL_Ent`, `HL_Apl`, `HL_Bal`,
        `EL_Apl`, `UL_Apl`, `Remarks`)
        VALUES ('$StaffID', '$DateApl', '$LeaveTyp', '$Approval', '$Status', '$DateFR', '$DateTO',
          '$NoOfDay', '$AL_Ent', '$AL_Apl', '$AL_Bal', '$ML_Ent', '$ML_Apl', '$ML_Bal', '$HL_Ent', '$HL_Apl', '$HL_Bal',
          '$EL_Apl', '$UL_Apl', '$Remarks');";

          if ($conn->query($sql4) === TRUE)
          {
            $_SESSION['cmpMsg'] = "Leave Application created successfully";
            $url = "Location:../Leave/LeaveTable.php?menu={$menu}";
            header($url);
          }
          else
          {
            echo "<div class='reject_div'>Error: " . $sql4 . "<br>" . $conn->error . "</div>";
          }

          $conn->close();

        }
      }
      //-------------------------------------------------------
      function getLeaveDtl($conn, $StaffID, $LeaveTyp)
      {
        $sql2 =
        "SELECT max(UL_Apl) as UL_Apl
        FROM `LeaveTable`
        WHERE `StaffID` = '$StaffID'";

        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();

        if ($row2 > 0)
        {
          $UL_Apl = $row2['UL_Apl'];
        }

        switch ($LeaveTyp)
        {
          case 'AL':
          case 'EL':
          $sql3 =
          "SELECT min(AL_Bal) as AL_Bal, AL_Ent
          FROM `LeaveTable`
          WHERE `StaffID` = '$StaffID' AND (`LeaveTyp` = 'AL' OR `LeaveTyp` = 'EL')";

          $result2 = $conn->query($sql3);
          $row2 = $result2->fetch_assoc();

          return array(
            'AL_Bal' => $row2['AL_Bal'],
            'AL_Ent' => $row2['AL_Ent'],
            'UL_Apl' => $UL_Apl);
            break;

            # Medical Leave
            case 'ML':
            $sql3 =
            "SELECT min(ML_Bal) as ML_Bal, ML_Ent
            FROM `LeaveTable`
            WHERE `StaffID` = '$StaffID' AND `LeaveTyp` = '$LeaveTyp'";

            $result2 = $conn->query($sql3);
            $row2 = $result2->fetch_assoc();

            return array(
              'ML_Bal' => $row2['ML_Bal'],
              'ML_Ent' => $row2['ML_Ent'],
              'UL_Apl' => $UL_Apl);
              break;

              # Medical Leave
              case 'HL':
              $sql3 =
              "SELECT min(HL_Bal) as HL_Bal, HL_Ent
              FROM `LeaveTable`
              WHERE `StaffID` = '$StaffID' AND `LeaveTyp` = '$LeaveTyp'";

              $result2 = $conn->query($sql3);
              $row2 = $result2->fetch_assoc();

              return array(
                'HL_Bal' => $row2['HL_Bal'],
                'HL_Ent' => $row2['HL_Ent'],
                'UL_Apl' => $UL_Apl);
                break;
              }

            }
            ?>

            <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>

              <table class="frm">
                <thead class="frm_hdr">
                  <tr>
                    <th class="frm_th" colspan="2">Leave Application</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td class="frm_td">Staff ID :</td>
                    <td class="frm_td">
                      <input type="text" name="StaffID" value="<?php echo $StaffID;?>" autofocus required="">
                      <span class="reject">*</span>
                    </td>
                  </tr>

                  <tr>
                    <td class="frm_td">Leave Type :</td>
                    <td class="frm_td">
                      <select name="LeaveTyp" value="<?php echo $LeaveTyp;?>">
                        <option value="AL">Annual Leave</option>
                        <option value="ML">Medical Leave</option>
                        <option value="HL">Hospialize Leave</option>
                        <option value="EL">Emergency Leave</option>
                        <option value="UL">Unpaid Leave</option>
                      </select>
                      <span class="reject">*</span>
                    </td>
                  </tr>

                  <tr>
                    <td class="frm_td">Approval :</td>
                    <td class="frm_td">
                      <input type="text" name="Approval" value="<?php echo $Approval;?>" required="">
                      <span class="reject">*</span>
                    </td>
                  </tr>

                  <tr>
                    <td class="frm_td">Date From :</td>
                    <td class="frm_td">
                      <input type="date" name="DateFR" value="<?php echo $DateFR;?>" required="">
                      <span class="reject">*</span>
                    </td>
                  </tr>

                  <tr>
                    <td class="frm_td">Date To :</td>
                    <td class="frm_td">
                      <input type="date" name="DateTO" value="<?php echo $DateTO;?>" required="">
                      <span class="reject">*</span>
                    </td>
                  </tr>

                  <tr>
                    <td class="frm_td">No. Of Day :</td>
                    <td class="frm_td">
                      <input type="number" name="NoOfDay" value="<?php echo $NoOfDay;?>" required="">
                      <span class="reject">*</span>
                    </td>
                  </tr>

                  <tr>
                    <td class="frm_td">Remark :</td>
                    <td class="frm_td"><input type="text" name="Remarks"value="<?php echo $Remark;?>"></td>
                  </tr>

                  <tr>
                    <th class="frm_btn" colspan="2">
                      <a href="../Leave/LeaveTable.php?menu=<?php echo $menu;?>" target="_self"><input type="button" onclick="" value="Cancel"/></a>
                      <input type="submit" value="Apply">
                    </th>
                  </tr>

                </tbody>


              </table>
            </form>
          </div>

        </body>
        </html>
