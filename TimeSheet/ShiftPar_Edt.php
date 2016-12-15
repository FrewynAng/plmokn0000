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
  $rjtMsg = "";

  if ($_GET["SH_No"] <> "")
  {
    $SH_No = $_GET["SH_No"];
    // echo $SH_No;

    $sql1 =
    "SELECT *
    FROM `ShiftPar`
    WHERE  `SH_No` = '$SH_No'";

    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    if ($row1 > 0)
    {
      //Initialize Form
      $SH_No = $row1['SH_No'];
      $SH_Name = $row1['SH_Name'];
      $SH_Grp = $row1['SH_Grp'];
      // $SH_WrkDay = $row1['SH_WrkDay'];
      $SH_MaxLen = $row1['SH_MaxLen'];
      //Shift Time
      $SH_SunStr = $row1['SH_SunStr'];
      $SH_SunEnd = $row1['SH_SunEnd'];
      $SH_MonStr = $row1['SH_MonStr'];
      $SH_MonEnd = $row1['SH_MonEnd'];
      $SH_TueStr = $row1['SH_TueStr'];
      $SH_TueEnd = $row1['SH_TueEnd'];
      $SH_WedStr = $row1['SH_WedStr'];
      $SH_WedEnd = $row1['SH_WedEnd'];
      $SH_ThuStr = $row1['SH_ThuStr'];
      $SH_ThuEnd = $row1['SH_ThuEnd'];
      $SH_FriStr = $row1['SH_FriStr'];
      $SH_FriEnd = $row1['SH_FriEnd'];
      $SH_SatStr = $row1['SH_SatStr'];
      $SH_SatEnd = $row1['SH_SatEnd'];
      //Lunch Time
      $SunLchStr = $row1['SunLchStr'];
      $SunLchEnd = $row1['SunLchEnd'];
      $MonLchStr = $row1['MonLchStr'];
      $MonLchEnd = $row1['MonLchEnd'];
      $TueLchStr = $row1['TueLchStr'];
      $TueLchEnd = $row1['TueLchEnd'];
      $WedLchStr = $row1['WedLchStr'];
      $WedLchEnd = $row1['WedLchEnd'];
      $ThuLchStr = $row1['ThuLchStr'];
      $ThuLchEnd = $row1['ThuLchEnd'];
      $FriLchStr = $row1['FriLchStr'];
      $FriLchEnd = $row1['FriLchEnd'];
      $SatLchStr = $row1['SatLchStr'];
      $SatLchEnd = $row1['SatLchEnd'];
      // Break 1
      $SunBrkStr_1 = $row1['SunBrkStr_1'];
      $SunBrkEnd_1 = $row1['SunBrkEnd_1'];
      $MonBrkStr_1 = $row1['MonBrkStr_1'];
      $MonBrkEnd_1 = $row1['MonBrkEnd_1'];
      $TueBrkStr_1 = $row1['TueBrkStr_1'];
      $TueBrkEnd_1 = $row1['TueBrkEnd_1'];
      $WedBrkStr_1 = $row1['WedBrkStr_1'];
      $WedBrkEnd_1 = $row1['WedBrkEnd_1'];
      $ThuBrkStr_1 = $row1['ThuBrkStr_1'];
      $ThuBrkEnd_1 = $row1['ThuBrkEnd_1'];
      $FriBrkStr_1 = $row1['FriBrkStr_1'];
      $FriBrkEnd_1 = $row1['FriBrkEnd_1'];
      $SatBrkStr_1 = $row1['SatBrkStr_1'];
      $SatBrkEnd_1 = $row1['SatBrkEnd_1'];
      $Enable_Brk_1 = $row1['Enable_Brk_1'];
      // Break 2
      $SunBrkStr_2 = $row1['SunBrkStr_2'];
      $SunBrkEnd_2 = $row1['SunBrkEnd_2'];
      $MonBrkStr_2 = $row1['MonBrkStr_2'];
      $MonBrkEnd_2 = $row1['MonBrkEnd_2'];
      $TueBrkStr_2 = $row1['TueBrkStr_2'];
      $TueBrkEnd_2 = $row1['TueBrkEnd_2'];
      $WedBrkStr_2 = $row1['WedBrkStr_2'];
      $WedBrkEnd_2 = $row1['WedBrkEnd_2'];
      $ThuBrkStr_2 = $row1['ThuBrkStr_2'];
      $ThuBrkEnd_2 = $row1['ThuBrkEnd_2'];
      $FriBrkStr_2 = $row1['FriBrkStr_2'];
      $FriBrkEnd_2 = $row1['FriBrkEnd_2'];
      $SatBrkStr_2 = $row1['SatBrkStr_2'];
      $SatBrkEnd_2 = $row1['SatBrkEnd_2'];
      $Enable_Brk_2 = $row1['Enable_Brk_2'];
    }
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // $SH_No = $_POST["SH_No"];
    $SH_Name = $_POST["SH_Name"];
    $SH_WrkHour = date("h:i:s", strtotime($_POST["SH_WrkHour"] . ":00:00"));
    $SH_LOW = date("H:i:s", strtotime($_POST["SH_LOW"]));
    // $SH_Grp = $_POST["SH_Grp"];
    $SH_WrkDay = "";
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

    $SunBrkStr_1 = date("H:i:s", strtotime($_POST["SunBrkStr_1"]));
    $SunBrkEnd_1 = date("H:i:s", strtotime($_POST["SunBrkEnd_1"]));
    $MonBrkStr_1 = date("H:i:s", strtotime($_POST["MonBrkStr_1"]));
    $MonBrkEnd_1 = date("H:i:s", strtotime($_POST["MonBrkEnd_1"]));
    $TueBrkStr_1 = date("H:i:s", strtotime($_POST["TueBrkStr_1"]));
    $TueBrkEnd_1 = date("H:i:s", strtotime($_POST["TueBrkEnd_1"]));
    $WedBrkStr_1 = date("H:i:s", strtotime($_POST["WedBrkStr_1"]));
    $WedBrkEnd_1 = date("H:i:s", strtotime($_POST["WedBrkEnd_1"]));
    $ThuBrkStr_1 = date("H:i:s", strtotime($_POST["ThuBrkStr_1"]));
    $ThuBrkEnd_1 = date("H:i:s", strtotime($_POST["ThuBrkEnd_1"]));
    $FriBrkStr_1 = date("H:i:s", strtotime($_POST["FriBrkStr_1"]));
    $FriBrkEnd_1 = date("H:i:s", strtotime($_POST["FriBrkEnd_1"]));
    $SatBrkStr_1 = date("H:i:s", strtotime($_POST["SatBrkStr_1"]));
    $SatBrkEnd_1 = date("H:i:s", strtotime($_POST["SatBrkEnd_1"]));

    $SunBrkStr_2 = date("H:i:s", strtotime($_POST["SunBrkStr_2"]));
    $SunBrkEnd_2 = date("H:i:s", strtotime($_POST["SunBrkEnd_2"]));
    $MonBrkStr_2 = date("H:i:s", strtotime($_POST["MonBrkStr_2"]));
    $MonBrkEnd_2 = date("H:i:s", strtotime($_POST["MonBrkEnd_2"]));
    $TueBrkStr_2 = date("H:i:s", strtotime($_POST["TueBrkStr_2"]));
    $TueBrkEnd_2 = date("H:i:s", strtotime($_POST["TueBrkEnd_2"]));
    $WedBrkStr_2 = date("H:i:s", strtotime($_POST["WedBrkStr_2"]));
    $WedBrkEnd_2 = date("H:i:s", strtotime($_POST["WedBrkEnd_2"]));
    $ThuBrkStr_2 = date("H:i:s", strtotime($_POST["ThuBrkStr_2"]));
    $ThuBrkEnd_2 = date("H:i:s", strtotime($_POST["ThuBrkEnd_2"]));
    $FriBrkStr_2 = date("H:i:s", strtotime($_POST["FriBrkStr_2"]));
    $FriBrkEnd_2 = date("H:i:s", strtotime($_POST["FriBrkEnd_2"]));
    $SatBrkStr_2 = date("H:i:s", strtotime($_POST["SatBrkStr_2"]));
    $SatBrkEnd_2 = date("H:i:s", strtotime($_POST["SatBrkEnd_2"]));

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
    // if ($_POST["SH_No"] == "")
    // {
    //   $rjtMsg = "*SHIFT NO. is required";
    //   $valid = false;
    // }

    if ($_POST["SH_Name"] == "")
    {
      $rjtMsg = "*SHIFT NAME is required";
      $valid = false;
    }

    // if($_POST["SH_Grp"] == 0)
    // {
    //   $rjtMsg = "*SHIFT GROUP is required";
    //   $valid = false;
    // }

    if($valid)
    {
      $sql2 =
      "UPDATE `ShiftPar`
      SET `SH_Name` = '$SH_Name', `SH_WrkDay` = '$SH_WrkDay', `SH_WrkHour` = '$SH_WrkHour', `SH_Grp` = '$SH_Grp', `SH_Flx` = '$SH_Flx',
      `SH_SunStr` = '$SH_SunStr', `SH_SunEnd` = '$SH_SunEnd', `SH_MonStr` = '$SH_MonStr', `SH_MonEnd` = '$SH_MonEnd',
      `SH_TueStr` = '$SH_TueStr', `SH_TueEnd` = '$SH_TueEnd', `SH_WedStr` = '$SH_WedStr', `SH_WedEnd` = '$SH_WedEnd',
      `SH_ThuStr` = '$SH_ThuStr', `SH_ThuEnd` = '$SH_ThuEnd', `SH_FriStr` = '$SH_FriStr', `SH_FriEnd` = '$SH_FriEnd',
      `SH_SatStr` = '$SH_SatStr', `SH_SatEnd` = '$SH_SatEnd',
      `SH_Grc` = '$SH_Grc', `SH_LOW` = '$SH_LOW', `SH_LchDur` = '$SH_LchDur',
      `SunLchStr` = '$SunLchStr', `SunLchEnd` = '$SunLchEnd', `MonLchStr` = '$MonLchStr', `MonLchEnd` = '$MonLchEnd',
      `TueLchStr` = '$TueLchStr', `TueLchEnd` = '$TueLchEnd', `WedLchStr` = '$WedLchStr', `WedLchEnd` = '$WedLchEnd',
      `ThuLchStr` = '$ThuLchStr', `ThuLchEnd` = '$ThuLchEnd', `FriLchStr` = '$FriLchStr', `FriLchEnd` = '$FriLchEnd',
      `SatLchStr` = '$SatLchStr', `SatLchEnd` = '$SatLchEnd',
      `SH_LchFlx` = '$SH_LchFlx', `SH_LchGrc` = '$SH_LchGrc',
      `SunBrkStr_1` = '$SunBrkStr_1',  `SunBrkEnd_1` = '$SunBrkEnd_1',  `MonBrkStr_1` = '$MonBrkStr_1',  `MonBrkEnd_1` = '$MonBrkEnd_1',
      `TueBrkStr_1` = '$TueBrkStr_1',  `TueBrkEnd_1` = '$TueBrkEnd_1',  `WedBrkStr_1` = '$WedBrkStr_1',  `WedBrkEnd_1` = '$WedBrkEnd_1',
      `ThuBrkStr_1` = '$ThuBrkStr_1',  `ThuBrkEnd_1` = '$ThuBrkEnd_1',  `FriBrkStr_1` = '$FriBrkStr_1',  `FriBrkEnd_1` = '$FriBrkEnd_1',
      `SatBrkStr_1` = '$SatBrkStr_1',  `SatBrkEnd_1` = '$SatBrkEnd_1',  `Enable_Brk_1` = '$Enable_Brk_1',
      `SunBrkStr_2` = '$SunBrkStr_2',  `SunBrkEnd_2` = '$SunBrkEnd_2',  `MonBrkStr_2` = '$MonBrkStr_2',  `MonBrkEnd_2` = '$MonBrkEnd_2',
      `TueBrkStr_2` = '$TueBrkStr_2',  `TueBrkEnd_2` = '$TueBrkEnd_2',  `WedBrkStr_2` = '$WedBrkStr_2',  `WedBrkEnd_2` = '$WedBrkEnd_2',
      `ThuBrkStr_2` = '$ThuBrkStr_2',  `ThuBrkEnd_2` = '$ThuBrkEnd_2',  `FriBrkStr_2` = '$FriBrkStr_2',  `FriBrkEnd_2` = '$FriBrkEnd_2',
      `SatBrkStr_2` = '$SatBrkStr_2',  `SatBrkEnd_2` = '$SatBrkEnd_2',  `Enable_Brk_2` = '$Enable_Brk_2'
      WHERE `SH_No` = '$SH_No'";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "SHIFT PARAMETER updated.";
        header('Location:../TimeSheet/ShiftPar.php');
      }
      else
      {
        $_SESSION['rjtMsg'] = "Error: " . $sql2 . $conn->error;
      }

      $conn->close();
    }
  }

  ?>
  <p><span class="reject"><?php echo $rjtMsg; ?></span></p>
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
            <input type="number" name="SH_No" value="<?php echo $SH_No;?>" disabled>
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

        <!--
          <tr>
          <td>Shift Cut Off Duration :</td>
          <td>
            <select name="SH_MaxLen" value="<?php echo $SH_MaxLen;?>">
              <option value="10">10 hours</option>
              <option value="12">12 hours</option>
              <option value="14">14 hours</option>
              <option value="16">16 hours</option>
              <option value="18">18 hours</option>
              <option value="20">20 hours</option>
              <option value="22" selected>22 hours</option>
            </td>
          </tr>
        -->

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

          <!-- Lunch Time -->
          <tr>
            <th class="frmbox"></th>
            <th class="frmbox">Lunch Start Time</th>
            <th class="frmbox">Lunch End Time</th>
            <th class="frmbox"></th>
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
              <input type="checkbox" name="Enable_Brk_1" value="Y" checked>Yes
            </td>
          </tr>

          <tr>
            <td colspan="4"><font color="white">/t </font></td>
          </tr>

          <!-- Sunday -->
          <tr>
            <th class="frmbox">Sunday :</th>
            <td>
              <input type="time" name="SunBrkStr_1" value="<?php echo $SunBrkStr_1;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="SunBrkEnd_1" value="<?php echo $SunBrkEnd_1;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Monday -->
          <tr>
            <th class="frmbox">Monday :</th>
            <td>
              <input type="time" name="MonBrkStr_1" value="<?php echo $MonBrkStr_1;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="MonBrkEnd_1" value="<?php echo $MonBrkEnd_1;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Tueaday -->
          <tr>
            <th class="frmbox">Tuesday :</th>
            <td>
              <input type="time" name="TueBrkStr_1" value="<?php echo $TueBrkStr_1;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="TueBrkEnd_1" value="<?php echo $TueBrkEnd_1;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Wednesday -->
          <tr>
            <th class="frmbox">Wednesday :</th>
            <td>
              <input type="time" name="WedBrkStr_1" value="<?php echo $WedBrkStr_1;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="WedBrkEnd_1" value="<?php echo $WedBrkEnd_1;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Thursday -->
          <tr>
            <th class="frmbox">Thursday :</th>
            <td>
              <input type="time" name="ThuBrkStr_1" value="<?php echo $ThuBrkStr_1;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="ThuBrkEnd_1" value="<?php echo $ThuBrkEnd_1;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Friday -->
          <tr>
            <th class="frmbox">Friday :</th>
            <td>
              <input type="time" name="FriBrkStr_1" value="<?php echo $FriBrkStr_1;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="FriBrkEnd_1" value="<?php echo $FriBrkEnd_1;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Saturday -->
          <tr>
            <th class="frmbox">Saturday :</th>
            <td>
              <input type="time" name="SatBrkStr_1" value="<?php echo $SatBrkStr_1;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="SatBrkEnd_1" value="<?php echo $SatBrkEnd_1;?>">
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
              <input type="checkbox" name="Enable_Brk_2" value="Y" checked>Yes
            </td>
          </tr>

          <tr>
            <td colspan="4"><font color="white">/t </font></td>
          </tr>

          <!-- Sunday -->
          <tr>
            <th class="frmbox">Sunday :</th>
            <td>
              <input type="time" name="SunBrkStr_2" value="<?php echo $SunBrkStr_2;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="SunBrkEnd_2" value="<?php echo $SunBrkEnd_2;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Monday -->
          <tr>
            <th class="frmbox">Monday :</th>
            <td>
              <input type="time" name="MonBrkStr_2" value="<?php echo $MonBrkStr_2;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="MonBrkEnd_2" value="<?php echo $MonBrkEnd_2;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Tueaday -->
          <tr>
            <th class="frmbox">Tuesday :</th>
            <td>
              <input type="time" name="TueBrkStr_2" value="<?php echo $TueBrkStr_2;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="TueBrkEnd_2" value="<?php echo $TueBrkEnd_2;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Wednesday -->
          <tr>
            <th class="frmbox">Wednesday :</th>
            <td>
              <input type="time" name="WedBrkStr_2" value="<?php echo $WedBrkStr_2;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="WedBrkEnd_2" value="<?php echo $WedBrkEnd_2;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Thursday -->
          <tr>
            <th class="frmbox">Thursday :</th>
            <td>
              <input type="time" name="ThuBrkStr_2" value="<?php echo $ThuBrkStr_2;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="ThuBrkEnd_2" value="<?php echo $ThuBrkEnd_2;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Friday -->
          <tr>
            <th class="frmbox">Friday :</th>
            <td>
              <input type="time" name="FriBrkStr_2" value="<?php echo $FriBrkStr_2;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="FriBrkEnd_2" value="<?php echo $FriBrkEnd_2;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <!-- Saturday -->
          <tr>
            <th class="frmbox">Saturday :</th>
            <td>
              <input type="time" name="SatBrkStr_2" value="<?php echo $SatBrkStr_2;?>">
              <span class="reject">*</span>
            </td>
            <td>
              <input type="time" name="SatBrkEnd_2" value="<?php echo $SatBrkEnd_2;?>">
              <span class="reject">*</span>
            </td>
          </tr>

          <tr>
            <td colspan="4"><font color="white">/t </font></td>
          </tr>

          <tr>
            <th class="frm_btn"colspan="4">
              <a href="../TimeSheet/ShiftPar.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
              <input type="submit" value="Save">
            </th>
          </tr>

        </tbody>
      </table>
    </form>

  </body>
  </html>
