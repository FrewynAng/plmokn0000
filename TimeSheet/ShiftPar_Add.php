<!--
*********************
**ShiftPar_Add.php **
*********************
-->

<?php session_start(); ?>

<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Add Shift</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';
  $cmpMsg = "";
  //Initialize Form
  $SH_No = "";
  $SH_Name = "";
  $SH_Grp = "";
  $SH_OT_Cal = "";
  $SH_WrkDay = "";
  $_wrkDay = "";
  $SH_MaxLen = "";
  //Shift Time
  $SH_SunStr = "09:00:00";
  $SH_SunEnd = "18:00:00";
  $SH_MonStr = "09:00:00";
  $SH_MonEnd = "18:00:00";
  $SH_TueStr = "09:00:00";
  $SH_TueEnd = "18:00:00";
  $SH_WedStr = "09:00:00";
  $SH_WedEnd = "18:00:00";
  $SH_ThuStr = "09:00:00";
  $SH_ThuEnd = "18:00:00";
  $SH_FriStr = "09:00:00";
  $SH_FriEnd = "18:00:00";
  $SH_SatStr = "09:00:00";
  $SH_SatEnd = "18:00:00";
  //Lunch Time
  $SunLchStr = "12:00:00";
  $SunLchEnd = "13:00:00";
  $MonLchStr = "12:00:00";
  $MonLchEnd = "13:00:00";
  $TueLchStr = "12:00:00";
  $TueLchEnd = "13:00:00";
  $WedLchStr = "12:00:00";
  $WedLchEnd = "13:00:00";
  $ThuLchStr = "12:00:00";
  $ThuLchEnd = "13:00:00";
  $FriLchStr = "12:00:00";
  $FriLchEnd = "13:00:00";
  $SatLchStr = "12:00:00";
  $SatLchEnd = "13:00:00";
  // Break 1
  $SunBrkStr1 = "10:00:00";
  $SunBrkEnd1 = "10:30:00";
  $MonBrkStr1 = "10:00:00";
  $MonBrkEnd1 = "10:30:00";
  $TueBrkStr1 = "10:00:00";
  $TueBrkEnd1 = "10:30:00";
  $WedBrkStr1 = "10:00:00";
  $WedBrkEnd1 = "10:30:00";
  $ThuBrkStr1 = "10:00:00";
  $ThuBrkEnd1 = "10:30:00";
  $FriBrkStr1 = "10:00:00";
  $FriBrkEnd1 = "10:30:00";
  $SatBrkStr1 = "10:00:00";
  $SatBrkEnd1 = "10:30:00";
  $Break1 = "";
  // Break 2
  $SunBrkStr2 = "15:00:00";
  $SunBrkEnd2 = "15:30:00";
  $MonBrkStr2 = "15:00:00";
  $MonBrkEnd2 = "15:30:00";
  $TueBrkStr2 = "15:00:00";
  $TueBrkEnd2 = "15:30:00";
  $WedBrkStr2 = "15:00:00";
  $WedBrkEnd2 = "15:30:00";
  $ThuBrkStr2 = "15:00:00";
  $ThuBrkEnd2 = "15:30:00";
  $FriBrkStr2 = "15:00:00";
  $FriBrkEnd2 = "15:30:00";
  $SatBrkStr2 = "15:00:00";
  $SatBrkEnd2 = "15:30:00";
  $Break2 = "";

  $sql1 =
  "SELECT MAX(`SH_No`) AS _SH_No
  FROM `ShiftPar`";

  $result = $conn->query($sql1);
  $row = $result->fetch_assoc();
  //echo $row["_UsrGrpSeq"];
  $SH_No = $row["_SH_No"] + 1;
  //echo $UsrGrpSeq;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $SH_No = $_POST["SH_No"];
    $SH_Name = $_POST["SH_Name"];
    $SH_WrkHour = date("h:i:s", strtotime($_POST["SH_WrkHour"] . ":00:00"));
    $SH_LOW = date("H:i:s", strtotime($_POST["SH_LOW"]));
    $SH_MaxLen = "22:00:00";
    $valid = TRUE;

    $_wrkDay = $_POST["wrkDay"];
    foreach ($_wrkDay as $wrkDay)
    {
      $SH_WrkDay = $SH_WrkDay . $wrkDay . ", ";
      // echo $SH_WrkDay . "<br>";
    }

    switch ($_POST["SH_LOW"])
    {
      case 0:
      $SH_LOW = "00:00:00";
      break;

      case 15:
      $SH_LOW = "00:15:00";
      break;

      case 30:
      $SH_LOW = "00:30:00";
      break;

      case 45:
      $SH_LOW = "00:45:00";
      break;

      case 60:
      $SH_LOW = "01:00:00";
      break;

      default:
      $SH_LOW = "00:15:00";
      break;
    }

    $SH_SunStr = date("H:i:s", strtotime($_POST["SH_SunStr"]));
    $SH_SunEnd = date("H:i:s", strtotime($_POST["SH_SunEnd"]));
    $SH_MonStr = date("H:i:s", strtotime($_POST["SH_MonStr"]));
    $SH_MonEnd = date("H:i:s", strtotime($_POST["SH_MonEnd"]));
    $SH_TueStr = date("H:i:s", strtotime($_POST["SH_TueStr"]));
    $SH_TueEnd = date("H:i:s", strtotime($_POST["SH_TueEnd"]));
    $SH_WedStr = date("H:i:s", strtotime($_POST["SH_WedStr"]));
    $SH_WedEnd = date("H:i:s", strtotime($_POST["SH_WedEnd"]));
    $SH_ThuStr = date("H:i:s", strtotime($_POST["SH_ThuStr"]));
    $SH_ThuEnd = date("H:i:s", strtotime($_POST["SH_ThuEnd"]));
    $SH_FriStr = date("H:i:s", strtotime($_POST["SH_FriStr"]));
    $SH_FriEnd = date("H:i:s", strtotime($_POST["SH_FriEnd"]));
    $SH_SatStr = date("H:i:s", strtotime($_POST["SH_SatStr"]));
    $SH_SatEnd = date("H:i:s", strtotime($_POST["SH_SatEnd"]));

    $SunLchStr = date("H:i:s", strtotime($_POST["SunLchStr"]));
    $SunLchEnd = date("H:i:s", strtotime($_POST["SunLchEnd"]));
    $MonLchStr = date("H:i:s", strtotime($_POST["MonLchStr"]));
    $MonLchEnd = date("H:i:s", strtotime($_POST["MonLchEnd"]));
    $TueLchStr = date("H:i:s", strtotime($_POST["TueLchStr"]));
    $TueLchEnd = date("H:i:s", strtotime($_POST["TueLchEnd"]));
    $WedLchStr = date("H:i:s", strtotime($_POST["WedLchStr"]));
    $WedLchEnd = date("H:i:s", strtotime($_POST["WedLchEnd"]));
    $ThuLchStr = date("H:i:s", strtotime($_POST["ThuLchStr"]));
    $ThuLchEnd = date("H:i:s", strtotime($_POST["ThuLchEnd"]));
    $FriLchStr = date("H:i:s", strtotime($_POST["FriLchStr"]));
    $FriLchEnd = date("H:i:s", strtotime($_POST["FriLchEnd"]));
    $SatLchStr = date("H:i:s", strtotime($_POST["SatLchStr"]));
    $SatLchEnd = date("H:i:s", strtotime($_POST["SatLchEnd"]));

    $Break1 = $_POST['Break1'];
    $SunBrkStr1 = date("H:i:s", strtotime($_POST["SunBrkStr1"]));
    $SunBrkEnd1 = date("H:i:s", strtotime($_POST["SunBrkEnd1"]));
    $MonBrkStr1 = date("H:i:s", strtotime($_POST["MonBrkStr1"]));
    $MonBrkEnd1 = date("H:i:s", strtotime($_POST["MonBrkEnd1"]));
    $TueBrkStr1 = date("H:i:s", strtotime($_POST["TueBrkStr1"]));
    $TueBrkEnd1 = date("H:i:s", strtotime($_POST["TueBrkEnd1"]));
    $WedBrkStr1 = date("H:i:s", strtotime($_POST["WedBrkStr1"]));
    $WedBrkEnd1 = date("H:i:s", strtotime($_POST["WedBrkEnd1"]));
    $ThuBrkStr1 = date("H:i:s", strtotime($_POST["ThuBrkStr1"]));
    $ThuBrkEnd1 = date("H:i:s", strtotime($_POST["ThuBrkEnd1"]));
    $FriBrkStr1 = date("H:i:s", strtotime($_POST["FriBrkStr1"]));
    $FriBrkEnd1 = date("H:i:s", strtotime($_POST["FriBrkEnd1"]));
    $SatBrkStr1 = date("H:i:s", strtotime($_POST["SatBrkStr1"]));
    $SatBrkEnd1 = date("H:i:s", strtotime($_POST["SatBrkEnd1"]));

    $Break2 = $_POST['Break2'];
    $SunBrkStr2 = date("H:i:s", strtotime($_POST["SunBrkStr2"]));
    $SunBrkEnd2 = date("H:i:s", strtotime($_POST["SunBrkEnd2"]));
    $MonBrkStr2 = date("H:i:s", strtotime($_POST["MonBrkStr2"]));
    $MonBrkEnd2 = date("H:i:s", strtotime($_POST["MonBrkEnd2"]));
    $TueBrkStr2 = date("H:i:s", strtotime($_POST["TueBrkStr2"]));
    $TueBrkEnd2 = date("H:i:s", strtotime($_POST["TueBrkEnd2"]));
    $WedBrkStr2 = date("H:i:s", strtotime($_POST["WedBrkStr2"]));
    $WedBrkEnd2 = date("H:i:s", strtotime($_POST["WedBrkEnd2"]));
    $ThuBrkStr2 = date("H:i:s", strtotime($_POST["ThuBrkStr2"]));
    $ThuBrkEnd2 = date("H:i:s", strtotime($_POST["ThuBrkEnd2"]));
    $FriBrkStr2 = date("H:i:s", strtotime($_POST["FriBrkStr2"]));
    $FriBrkEnd2 = date("H:i:s", strtotime($_POST["FriBrkEnd2"]));
    $SatBrkStr2 = date("H:i:s", strtotime($_POST["SatBrkStr2"]));
    $SatBrkEnd2 = date("H:i:s", strtotime($_POST["SatBrkEnd2"]));

    switch ($_POST["SH_Grc"])
    {
      case 0:
      $SH_Grc = "00:00:00";
      break;

      case 15:
      $SH_Grc = "00:15:00";
      break;

      case 30:
      $SH_Grc = "00:30:00";
      break;

      case 45:
      $SH_Grc = "00:45:00";
      break;

      case 60:
      $SH_Grc = "01:00:00";
      break;

      default:
      $SH_Grc = "00:15:00";
      break;
    }

    if(isset($_POST["SH_Flx"]) && $_POST["SH_Flx"] == 'Y')
    {
      $SH_Flx = "Y";
    }
    else
    {
      $SH_Flx = "N";
    }

    switch ($_POST["SH_OT_Cal"])
    {
      case '15':
      $SH_OT_Cal = "00:15:00";
      break;

      case '30':
      $SH_OT_Cal = "00:30:00";
      break;

      case '45':
      $SH_OT_Cal = "00:45:00";
      break;

      case '60':
      $SH_OT_Cal = "01:00:00";
      break;

      case '90':
      $SH_OT_Cal = "01:30:00";
      break;

      case '120':
      $SH_OT_Cal = "02:00:00";
      break;
    }

    switch ($_POST["SH_LchDur"])
    {
      case 30:
      $SH_LchDur = "00:30:00";
      break;

      case 60:
      $SH_LchDur = "01:00:00";
      break;

      case 90:
      $SH_LchDur = "01:30:00";
      break;

      case 120:
      $SH_LchDur = "02:00:00";
      break;

      case 150:
      $SH_LchDur = "02:30:00";
      break;

      default:
      $SH_LchDur = "01:00:00";
      break;
    }

    switch ($_POST["SH_LchGrc"])
    {
      case 0:
      $SH_LchGrc = "00:00:00";
      break;

      case 15:
      $SH_LchGrc = "00:15:00";
      break;

      case 30:
      $SH_LchGrc = "00:30:00";
      break;

      case 45:
      $SH_LchGrc = "00:45:00";
      break;

      case 60:
      $SH_LchGrc = "01:00:00";
      break;

      default:
      $SH_LchGrc = "00:15:00";
      break;
    }

    if(isset($_POST["SH_LchFlx"]) && $_POST["SH_LchFlx"] == 'Y')
    {
      $SH_LchFlx = "Y";
    }
    else
    {
      $SH_LchFlx = "N";
    }

    //Form Validation
    if ($_POST["SH_No"] == "")
    {
      $valid = FALSE;
      echo "<div class='reject_div'> * SHIFT NO. is required.</div>";
    }

    if ($_POST["SH_Name"] == "")
    {
      $valid = TRUE;
      echo "<div class='reject_div'> * SHIFT NAME is required.</div>";
    }

    // if($_POST["SH_Grp"] == 0)
    // {
    //   $rjtMsg = "*SHIFT GROUP is required";
    //   $valid = FALSE;
    // }

    if($valid)
    {
      $sql =
      "INSERT INTO `ShiftPar` (`SH_No`, `SH_Name`, `SH_WrkDay`, `SH_WrkHour`, `SH_MaxLen`, `SH_Grp`, `SH_Flx`, `SH_OT_Cal`,
        `SH_SunStr`, `SH_SunEnd`, `SH_MonStr`, `SH_MonEnd`, `SH_TueStr`, `SH_TueEnd`, `SH_WedStr`, `SH_WedEnd`, `SH_ThuStr`, `SH_ThuEnd`, `SH_FriStr`, `SH_FriEnd`, `SH_SatStr`, `SH_SatEnd`,
        `SH_Grc`, `SH_LOW`, `SH_LchDur`,
        `SunLchStr`, `SunLchEnd`, `MonLchStr`, `MonLchEnd`, `TueLchStr`, `TueLchEnd`, `WedLchStr`, `WedLchEnd`, `ThuLchStr`, `ThuLchEnd`, `FriLchStr`, `FriLchEnd`, `SatLchStr`, `SatLchEnd`,
        `SH_LchFlx`, `SH_LchGrc`,
        `SunBrkStr1`, `SunBrkEnd1`, `MonBrkStr1`, `MonBrkEnd1`,
        `TueBrkStr1`, `TueBrkEnd1`, `WedBrkStr1`, `WedBrkEnd1`,
        `ThuBrkStr1`, `ThuBrkEnd1`, `FriBrkStr1`, `FriBrkEnd1`,
        `SatBrkStr1`, `SatBrkEnd1`, `Break1`,
        `SunBrkStr2`, `SunBrkEnd2`, `MonBrkStr2`, `MonBrkEnd2`,
        `TueBrkStr2`, `TueBrkEnd2`, `WedBrkStr2`, `WedBrkEnd2`,
        `ThuBrkStr2`, `ThuBrkEnd2`, `FriBrkStr2`, `FriBrkEnd2`,
        `SatBrkStr2`, `SatBrkEnd2`, `Break2`)
        VALUES ('$SH_No', '$SH_Name', '$SH_WrkDay', '$SH_WrkHour', '$SH_MaxLen', '$SH_Grp', '$SH_Flx', '$SH_OT_Cal',
          '$SH_SunStr', '$SH_SunEnd', '$SH_MonStr', '$SH_MonEnd', '$SH_TueStr', '$SH_TueEnd', '$SH_WedStr', '$SH_WedEnd', '$SH_ThuStr', '$SH_ThuEnd', '$SH_FriStr', '$SH_FriEnd', '$SH_SatStr', '$SH_SatEnd',
          '$SH_Grc', '$SH_LOW', '$SH_LchDur',
          '$SunLchStr', '$SunLchEnd', '$MonLchStr', '$MonLchEnd', '$TueLchStr', '$TueLchEnd', '$WedLchStr', '$WedLchEnd', '$ThuLchStr', '$ThuLchEnd', '$FriLchStr', '$FriLchEnd', '$SatLchStr', '$SatLchEnd',
          '$SH_LchFlx', '$SH_LchGrc',
          '$SunBrkStr1', '$SunBrkEnd1', '$MonBrkStr1', '$MonBrkEnd1',
          '$TueBrkStr1', '$TueBrkEnd1', '$WedBrkStr1', '$WedBrkEnd1',
          '$ThuBrkStr1', '$ThuBrkEnd1', '$FriBrkStr1', '$FriBrkEnd1',
          '$SatBrkStr1', '$SatBrkEnd1', '$Break1',
          '$SunBrkStr2', '$SunBrkEnd2', '$MonBrkStr2', '$MonBrkEnd2',
          '$TueBrkStr2', '$TueBrkEnd2', '$WedBrkStr2', '$WedBrkEnd2',
          '$ThuBrkStr2', '$ThuBrkEnd2', '$FriBrkStr2', '$FriBrkEnd2',
          '$SatBrkStr2', '$SatBrkEnd2', '$Break2' ) ";

          if ($conn->query($sql) === TRUE)
          {
            $_SESSION['cmpMsg'] = "New record created.";
            header('Location:../TimeSheet/ShiftPar.php');
          }
          else
          {
            echo "<div class='reject_div'>Error: " . $sql . "<br>" . $conn->error . "</div>";
          }

          $conn->close();
        }
      }

      ?>

      <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <table class="frm">
          <thead class="frm_hdr">

          </thead>

          <tbody>
            <!--
              <tr>
                <th class="frm_th" colspan="4">Shift Group</th>
              </tr>

              <tr>
                <td>Shift Group</td>
                <td><input type="number" name="SH_Grp" value="<?php echo $SH_Grp;?>"></td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>
            -->

            <tr>
              <th class="frm_th" colspan="4">Add Shift Parameter</th>
            </tr>

            <tr>
              <td>Shift No. :</td>
              <td>
                <input type="number" name="SH_No" value="<?php echo $SH_No;?>">
                <span class="reject">*</span>
              </td>
              <td>Shift Name :</td>
              <td>
                <input type="text" name="SH_Name" value="<?php echo $SH_Name;?>">
                <span class="reject">*</span>
              </td>
            </tr>

            <tr>
              <td>Working Hour :</td>
              <td>
                <select name="SH_WrkHour" value="<?php echo $SH_WrkHour;?>">
                  <option value="01">1 hour</option>
                  <option value="02">2 hours</option>
                  <option value="03">3 hours</option>
                  <option value="04">4 hours</option>
                  <option value="05">5 hours</option>
                  <option value="06">6 hours</option>
                  <option value="07">7 hours</option>
                  <option value="08" selected>8 hours</option>
                  <option value="09">9 hours</option>
                  <option value="10">10 hours</option>
                  <option value="11">11 hours</option>
                  <option value="12">12 hours</option>
                  <option value="13">13 hours</option>
                  <option value="14">14 hours</option>
                  <option value="15">15 hours</option>
                  <option value="16">16 hours</option>
                  <option value="17">17 hours</option>
                  <option value="18">18 hours</option>
                  <option value="19">19 hours</option>
                  <option value="20">20 hours</option>
                  <option value="21">21 hours</option>
                  <option value="22">22 hours</option>
                  <option value="23">23 hours</option>
                  <option value="24">24 hours</option>
                </select>
              </td>
              <td>Flexibility :</td>
              <td>
                <input type="checkbox" name="SH_Flx" value="Y">Yes
              </td>
            </tr>

            <tr>
              <td>Shift Working Day :</td>
              <td colspan="3">
                <input type="checkbox" name="wrkDay[]" id="wrkDay" value="Sunday">Sunday
                <input type="checkbox" name="wrkDay[]" id="wrkDay" value="Monday" checked>Monday
                <input type="checkbox" name="wrkDay[]" id="wrkDay" value="Tuesday" checked>Tuesday
                <input type="checkbox" name="wrkDay[]" id="wrkDay" value="Wednesday" checked>Wednesday
                <input type="checkbox" name="wrkDay[]" id="wrkDay" value="Thursday" checked>Thursday
                <input type="checkbox" name="wrkDay[]" id="wrkDay" value="Friday" checked>Friday
                <input type="checkbox" name="wrkDay[]" id="wrkDay" value="Saturday">Saturday
              </td>
            </tr>

            <tr>
              <td>Working Hour Grace</td>
              <td>
                <select name="SH_Grc" value="<?php echo $SH_Grc;?>">
                  <option value="0">0 minute</option>
                  <option value="15" selected>15 minutes</option>
                  <option value="30">30 minutes</option>
                  <option value="45">45 minutes</option>
                  <option value="60">60 minutes</option>
                </select>
              </td>
              <td>LOW</td>
              <td>
                <select name="SH_LOW" value="<?php echo $SH_LOW;?>">
                  <option value="0">0 minute</option>
                  <option value="15">15 minutes</option>
                  <option value="30">30 minutes</option>
                  <option value="45">45 minutes</option>
                  <option value="60">60 minutes</option>
                </select>
              </td>
            </tr>

            <tr>
              <td>OT Calculation Before and After :</td>
              <td>
                <select name="SH_OT_Cal" value="<?php echo $SH_OT_Cal;?>">
                  <option value="15">15 minutes</option>
                  <option value="30">30 minutes</option>
                  <option value="45" selected>45 minutes</option>
                  <option value="60">60 minutes</option>
                  <option value="90">90 minutes</option>
                  <option value="120">120 minutes</option>
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>

              <!-- Shift Time -->
              <tr>
                <th class="frmbox"></th>
                <th class="frmbox">Shift Start Time</th>
                <th class="frmbox">Shift End Time</th>
                <th class="frmbox"></th>
                <th></th>
              </tr>

              <!-- Sunday -->
              <tr>
                <th class="frmbox">Sunday :</th>
                <td>
                  <input type="time" name="SH_SunStr" value="<?php echo $SH_SunStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SH_SunEnd" value="<?php echo $SH_SunEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Monday -->
              <tr>
                <th class="frmbox">Monday :</th>
                <td>
                  <input type="time" name="SH_MonStr" value="<?php echo $SH_MonStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SH_MonEnd" value="<?php echo $SH_MonEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Tueaday -->
              <tr>
                <th class="frmbox">Tuesday :</th>
                <td>
                  <input type="time" name="SH_TueStr" value="<?php echo $SH_TueStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SH_TueEnd" value="<?php echo $SH_TueEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Wednesday -->
              <tr>
                <th class="frmbox">Wednesday :</th>
                <td>
                  <input type="time" name="SH_WedStr" value="<?php echo $SH_WedStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SH_WedEnd" value="<?php echo $SH_WedEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Thursday -->
              <tr>
                <th class="frmbox">Thursday :</th>
                <td>
                  <input type="time" name="SH_ThuStr" value="<?php echo $SH_ThuStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SH_ThuEnd" value="<?php echo $SH_ThuEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Friday -->
              <tr>
                <th class="frmbox">Friday :</th>
                <td>
                  <input type="time" name="SH_FriStr" value="<?php echo $SH_FriStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SH_FriEnd" value="<?php echo $SH_FriEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Saturday -->
              <tr>
                <th class="frmbox">Saturday :</th>
                <td>
                  <input type="time" name="SH_SatStr" value="<?php echo $SH_SatStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SH_SatEnd" value="<?php echo $SH_SatEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>


              <!-- Lunch Parameter -->
              <tr>
                <th class="frm_th" colspan="4">Lunch Parameters</th>
              </tr>

              <tr>
                <td>Lunch Time Duration :</td>
                <td>
                  <select name="SH_LchDur" value="<?php echo $SH_LchDur;?>">
                    <option value="30">30 minutes</option>
                    <option value="60" selected>60 minutes</option>
                    <option value="90">90 minutes</option>
                    <option value="120">120 minutes</option>
                    <option value="150">150 minutes</option>
                  </select>
                </td>
                <td>Lunch Grace Time :</td>
                <td>
                  <select name="SH_LchGrc" value="<?php echo $SH_LchGrc;?>">
                    <option value="0">0 minute</option>
                    <option value="15" selected>15 minutes</option>
                    <option value="30">30 minutes</option>
                    <option value="45">45 minutes</option>
                    <option value="60">60 minutes</option>
                  </select>
                </td>
              </tr>

              <tr>
                <td>Lunch Time Flexibility :</td>
                <td>
                  <input type="checkbox" name="SH_LchFlx" value="Y" checked>Yes
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>

              <!-- Sunday -->
              <tr>
                <th class="frmbox">Sunday :</th>
                <td>
                  <input type="time" name="SunLchStr" value="<?php echo $SunLchStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SunLchEnd" value="<?php echo $SunLchEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Monday -->
              <tr>
                <th class="frmbox">Monday :</th>
                <td>
                  <input type="time" name="MonLchStr" value="<?php echo $MonLchStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="MonLchEnd" value="<?php echo $MonLchEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Tueaday -->
              <tr>
                <th class="frmbox">Tuesday :</th>
                <td>
                  <input type="time" name="TueLchStr" value="<?php echo $TueLchStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="TueLchEnd" value="<?php echo $TueLchEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Wednesday -->
              <tr>
                <th class="frmbox">Wednesday :</th>
                <td>
                  <input type="time" name="WedLchStr" value="<?php echo $WedLchStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="WedLchEnd" value="<?php echo $WedLchEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Thursday -->
              <tr>
                <th class="frmbox">Thursday :</th>
                <td>
                  <input type="time" name="ThuLchStr" value="<?php echo $ThuLchStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="ThuLchEnd" value="<?php echo $ThuLchEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Friday -->
              <tr>
                <th class="frmbox">Friday :</th>
                <td>
                  <input type="time" name="FriLchStr" value="<?php echo $FriLchStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="FriLchEnd" value="<?php echo $FriLchEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Saturday -->
              <tr>
                <th class="frmbox">Saturday :</th>
                <td>
                  <input type="time" name="SatLchStr" value="<?php echo $SatLchStr;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SatLchEnd" value="<?php echo $SatLchEnd;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>

              <!-- Break 1 Parameter -->
              <tr>
                <th class="frm_th" colspan="4">Break 1 Parameters</th>
              </tr>

              <tr>
                <td>Enable Break 1 :</td>
                <td>
                  <input type="checkbox" name="Break1" value="Y" checked>Yes
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>

              <!-- Sunday -->
              <tr>
                <th class="frmbox">Sunday :</th>
                <td>
                  <input type="time" name="SunBrkStr1" value="<?php echo $SunBrkStr1;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SunBrkEnd1" value="<?php echo $SunBrkEnd1;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Monday -->
              <tr>
                <th class="frmbox">Monday :</th>
                <td>
                  <input type="time" name="MonBrkStr1" value="<?php echo $MonBrkStr1;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="MonBrkEnd1" value="<?php echo $MonBrkEnd1;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Tueaday -->
              <tr>
                <th class="frmbox">Tuesday :</th>
                <td>
                  <input type="time" name="TueBrkStr1" value="<?php echo $TueBrkStr1;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="TueBrkEnd1" value="<?php echo $TueBrkEnd1;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Wednesday -->
              <tr>
                <th class="frmbox">Wednesday :</th>
                <td>
                  <input type="time" name="WedBrkStr1" value="<?php echo $WedBrkStr1;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="WedBrkEnd1" value="<?php echo $WedBrkEnd1;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Thursday -->
              <tr>
                <th class="frmbox">Thursday :</th>
                <td>
                  <input type="time" name="ThuBrkStr1" value="<?php echo $ThuBrkStr1;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="ThuBrkEnd1" value="<?php echo $ThuBrkEnd1;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Friday -->
              <tr>
                <th class="frmbox">Friday :</th>
                <td>
                  <input type="time" name="FriBrkStr1" value="<?php echo $FriBrkStr1;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="FriBrkEnd1" value="<?php echo $FriBrkEnd1;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Saturday -->
              <tr>
                <th class="frmbox">Saturday :</th>
                <td>
                  <input type="time" name="SatBrkStr1" value="<?php echo $SatBrkStr1;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SatBrkEnd1" value="<?php echo $SatBrkEnd1;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>

              <!-- Break 1 Parameter -->
              <tr>
                <th class="frm_th" colspan="4">Break 2 Parameters</th>
              </tr>

              <tr>
                <td>Enable Break 2 :</td>
                <td>
                  <input type="checkbox" name="Break2" value="Y" checked>Yes
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>

              <!-- Sunday -->
              <tr>
                <th class="frmbox">Sunday :</th>
                <td>
                  <input type="time" name="SunBrkStr2" value="<?php echo $SunBrkStr2;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SunBrkEnd2" value="<?php echo $SunBrkEnd2;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Monday -->
              <tr>
                <th class="frmbox">Monday :</th>
                <td>
                  <input type="time" name="MonBrkStr2" value="<?php echo $MonBrkStr2;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="MonBrkEnd2" value="<?php echo $MonBrkEnd2;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Tueaday -->
              <tr>
                <th class="frmbox">Tuesday :</th>
                <td>
                  <input type="time" name="TueBrkStr2" value="<?php echo $TueBrkStr2;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="TueBrkEnd2" value="<?php echo $TueBrkEnd2;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Wednesday -->
              <tr>
                <th class="frmbox">Wednesday :</th>
                <td>
                  <input type="time" name="WedBrkStr2" value="<?php echo $WedBrkStr2;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="WedBrkEnd2" value="<?php echo $WedBrkEnd2;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Thursday -->
              <tr>
                <th class="frmbox">Thursday :</th>
                <td>
                  <input type="time" name="ThuBrkStr2" value="<?php echo $ThuBrkStr2;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="ThuBrkEnd2" value="<?php echo $ThuBrkEnd2;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Friday -->
              <tr>
                <th class="frmbox">Friday :</th>
                <td>
                  <input type="time" name="FriBrkStr2" value="<?php echo $FriBrkStr2;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="FriBrkEnd2" value="<?php echo $FriBrkEnd2;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <!-- Saturday -->
              <tr>
                <th class="frmbox">Saturday :</th>
                <td>
                  <input type="time" name="SatBrkStr2" value="<?php echo $SatBrkStr2;?>">
                  <span class="reject">*</span>
                </td>
                <td>
                  <input type="time" name="SatBrkEnd2" value="<?php echo $SatBrkEnd2;?>">
                  <span class="reject">*</span>
                </td>
              </tr>

              <tr>
                <td colspan="4"><font color="white">/t </font></td>
              </tr>

              <tr>
                <th class="frm_btn"colspan="4">
                  <a href="../TimeSheet/ShiftPar.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
                  <input type="submit" value="Add">
                </th>
              </tr>

            </tbody>
          </table>
        </form>

      </body>
      </html>
