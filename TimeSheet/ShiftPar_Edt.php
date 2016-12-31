<!--
*********************
**ShiftPar_Edt.php **
*********************
-->

<?php session_start(); ?>

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

  echo "<div class='title'>EDIT SHIFT</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  if ($_GET["SH_No"] <> "")
  {
    $SH_No = $_GET["SH_No"];
    // echo $SH_No;

    $sql1 =
    "SELECT *
    FROM `shiftpar`
    WHERE  `SH_No` = '$SH_No'";

    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    if ($row1 > 0)
    {
      //Initialize Form
      $SH_No = $row1['SH_No'];
      $SH_Name = $row1['SH_Name'];
      $SH_Grp = $row1['SH_Grp'];
      $SH_OT_Cal = $row1['SH_OT_Cal'];
      $SH_WrkHour = $row1['SH_WrkHour'];
      $SH_Grc = $row1['SH_Grc'];
      $SH_LOW = $row1['SH_LOW'];
      $SH_Flx = $row1['SH_Flx'];
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
      $SH_LchDur = $row1['SH_LchDur'];
      $SH_LchFlx = $row1['SH_LchFlx'];
      $SH_LchGrc = $row1['SH_LchGrc'];
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
      $SunBrkStr1 = $row1['SunBrkStr1'];
      $SunBrkEnd1 = $row1['SunBrkEnd1'];
      $MonBrkStr1 = $row1['MonBrkStr1'];
      $MonBrkEnd1 = $row1['MonBrkEnd1'];
      $TueBrkStr1 = $row1['TueBrkStr1'];
      $TueBrkEnd1 = $row1['TueBrkEnd1'];
      $WedBrkStr1 = $row1['WedBrkStr1'];
      $WedBrkEnd1 = $row1['WedBrkEnd1'];
      $ThuBrkStr1 = $row1['ThuBrkStr1'];
      $ThuBrkEnd1 = $row1['ThuBrkEnd1'];
      $FriBrkStr1 = $row1['FriBrkStr1'];
      $FriBrkEnd1 = $row1['FriBrkEnd1'];
      $SatBrkStr1 = $row1['SatBrkStr1'];
      $SatBrkEnd1 = $row1['SatBrkEnd1'];
      $Break1 = $row1['Break1'];
      // Break 2
      $SunBrkStr2 = $row1['SunBrkStr2'];
      $SunBrkEnd2 = $row1['SunBrkEnd2'];
      $MonBrkStr2 = $row1['MonBrkStr2'];
      $MonBrkEnd2 = $row1['MonBrkEnd2'];
      $TueBrkStr2 = $row1['TueBrkStr2'];
      $TueBrkEnd2 = $row1['TueBrkEnd2'];
      $WedBrkStr2 = $row1['WedBrkStr2'];
      $WedBrkEnd2 = $row1['WedBrkEnd2'];
      $ThuBrkStr2 = $row1['ThuBrkStr2'];
      $ThuBrkEnd2 = $row1['ThuBrkEnd2'];
      $FriBrkStr2 = $row1['FriBrkStr2'];
      $FriBrkEnd2 = $row1['FriBrkEnd2'];
      $SatBrkStr2 = $row1['SatBrkStr2'];
      $SatBrkEnd2 = $row1['SatBrkEnd2'];
      $Break2 = $row1['Break2'];
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
    // if ($_POST["SH_No"] == "")
    // {
    //   $rjtMsg = "*SHIFT NO. is required";
    //   $valid = false;
    // }

    if ($_POST["SH_Name"] == "")
    {
      $valid = false;
      echo "<div class='reject_div'> * SHIFT NAME is required.</div>";
    }

    // if($_POST["SH_Grp"] == 0)
    // {
    //   $rjtMsg = "*SHIFT GROUP is required";
    //   $valid = false;
    // }

    if($valid)
    {
      $sql2 =
      "UPDATE `shiftpar`
      SET `SH_Name` = '$SH_Name', `SH_WrkDay` = '$SH_WrkDay', `SH_WrkHour` = '$SH_WrkHour', `SH_Grp` = '$SH_Grp', `SH_Flx` = '$SH_Flx', `SH_OT_Cal` = '$SH_OT_Cal',
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
      `SunBrkStr1` = '$SunBrkStr1',  `SunBrkEnd1` = '$SunBrkEnd1',  `MonBrkStr1` = '$MonBrkStr1',  `MonBrkEnd1` = '$MonBrkEnd1',
      `TueBrkStr1` = '$TueBrkStr1',  `TueBrkEnd1` = '$TueBrkEnd1',  `WedBrkStr1` = '$WedBrkStr1',  `WedBrkEnd1` = '$WedBrkEnd1',
      `ThuBrkStr1` = '$ThuBrkStr1',  `ThuBrkEnd1` = '$ThuBrkEnd1',  `FriBrkStr1` = '$FriBrkStr1',  `FriBrkEnd1` = '$FriBrkEnd1',
      `SatBrkStr1` = '$SatBrkStr1',  `SatBrkEnd1` = '$SatBrkEnd1',  `Break1` = '$Break1',
      `SunBrkStr2` = '$SunBrkStr2',  `SunBrkEnd2` = '$SunBrkEnd2',  `MonBrkStr2` = '$MonBrkStr2',  `MonBrkEnd2` = '$MonBrkEnd2',
      `TueBrkStr2` = '$TueBrkStr2',  `TueBrkEnd2` = '$TueBrkEnd2',  `WedBrkStr2` = '$WedBrkStr2',  `WedBrkEnd2` = '$WedBrkEnd2',
      `ThuBrkStr2` = '$ThuBrkStr2',  `ThuBrkEnd2` = '$ThuBrkEnd2',  `FriBrkStr2` = '$FriBrkStr2',  `FriBrkEnd2` = '$FriBrkEnd2',
      `SatBrkStr2` = '$SatBrkStr2',  `SatBrkEnd2` = '$SatBrkEnd2',  `Break2` = '$Break2'
      WHERE `SH_No` = '$SH_No'";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "SHIFT PARAMETER updated.";
        $url = "Location:../TimeSheet/ShiftPar.php?menu={$menu}";
        header($url);
      }
      else
      {
        $_SESSION['rjtMsg'] = "Error: " . $sql2 . $conn->error;
        echo "<div class='reject_div'>Error: " . $sql2 . "<br>" . $conn->error . "</div>";
      }

      $conn->close();
    }
  }

  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>

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
    <input type="text" name="SH_Name" value="<?php echo $SH_Name;?>" autofocus required="">
    <span class="reject">*</span>
  </td>
</tr>

<tr>
  <td>Working Hour : ></td>
  <td>
    <select name="SH_WrkHour" value="<?php echo $SH_WrkHour;?>">
      <option value="01" <?php if(date("H", strtotime($SH_WrkHour)) == "01") echo 'selected="selected"'; ?>>1 hour</option>
      <option value="02" <?php if(date("H", strtotime($SH_WrkHour)) == "02") echo 'selected="selected"'; ?>>2 hours</option>
      <option value="03" <?php if(date("H", strtotime($SH_WrkHour)) == "03") echo 'selected="selected"'; ?>>3 hours</option>
      <option value="04" <?php if(date("H", strtotime($SH_WrkHour)) == "04") echo 'selected="selected"'; ?>>4 hours</option>
      <option value="05" <?php if(date("H", strtotime($SH_WrkHour)) == "05") echo 'selected="selected"'; ?>>5 hours</option>
      <option value="06" <?php if(date("H", strtotime($SH_WrkHour)) == "06") echo 'selected="selected"'; ?>>6 hours</option>
      <option value="07" <?php if(date("H", strtotime($SH_WrkHour)) == "07") echo 'selected="selected"'; ?>>7 hours</option>
      <option value="08" <?php if(date("H", strtotime($SH_WrkHour)) == "08") echo 'selected="selected"'; ?>>8 hours</option>
      <option value="09" <?php if(date("H", strtotime($SH_WrkHour)) == "09") echo 'selected="selected"'; ?>>9 hours</option>
      <option value="10" <?php if(date("H", strtotime($SH_WrkHour)) == "10") echo 'selected="selected"'; ?>>10 hours</option>
      <option value="11" <?php if(date("H", strtotime($SH_WrkHour)) == "11") echo 'selected="selected"'; ?>>11 hours</option>
      <option value="12" <?php if(date("H", strtotime($SH_WrkHour)) == "12") echo 'selected="selected"'; ?>>12 hours</option>
      <option value="13" <?php if(date("H", strtotime($SH_WrkHour)) == "13") echo 'selected="selected"'; ?>>13 hours</option>
      <option value="14" <?php if(date("H", strtotime($SH_WrkHour)) == "14") echo 'selected="selected"'; ?>>14 hours</option>
      <option value="15" <?php if(date("H", strtotime($SH_WrkHour)) == "15") echo 'selected="selected"'; ?>>15 hours</option>
      <option value="16" <?php if(date("H", strtotime($SH_WrkHour)) == "16") echo 'selected="selected"'; ?>>16 hours</option>
      <option value="17" <?php if(date("H", strtotime($SH_WrkHour)) == "17") echo 'selected="selected"'; ?>>17 hours</option>
      <option value="18" <?php if(date("H", strtotime($SH_WrkHour)) == "18") echo 'selected="selected"'; ?>>18 hours</option>
      <option value="19" <?php if(date("H", strtotime($SH_WrkHour)) == "19") echo 'selected="selected"'; ?>>19 hours</option>
      <option value="20" <?php if(date("H", strtotime($SH_WrkHour)) == "20") echo 'selected="selected"'; ?>>20 hours</option>
      <option value="21" <?php if(date("H", strtotime($SH_WrkHour)) == "21") echo 'selected="selected"'; ?>>21 hours</option>
      <option value="22" <?php if(date("H", strtotime($SH_WrkHour)) == "22") echo 'selected="selected"'; ?>>22 hours</option>
    </select>
  </td>
  <td>Flexibility :</td>
  <td>
    <input type="checkbox" name="SH_Flx" value="Y" <?php if($SH_Flx == "Y") echo 'checked="chechked"'; ?>>Yes
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

      <?php
      $hh = date("H", strtotime($SH_Grc));
      $mm = date("i", strtotime($SH_Grc));
      $min = ($hh * 60) + $mm;
      ?>

      <option value="0" <?php if($min == "0") echo 'selected="selected"'; ?>>0 minute</option>
      <option value="15" <?php if($min == "15") echo 'selected="selected"'; ?>>15 minutes</option>
      <option value="30" <?php if($min == "30") echo 'selected="selected"'; ?>>30 minutes</option>
      <option value="45" <?php if($min == "45") echo 'selected="selected"'; ?>>45 minutes</option>
      <option value="60" <?php if($min == "60") echo 'selected="selected"'; ?>>60 minutes</option>
    </select>
  </td>
  <td>LOW</td>
  <td>
    <select name="SH_LOW" value="<?php echo $SH_LOW;?>">

      <?php
      $hh = date("H", strtotime($SH_LOW));
      $mm = date("i", strtotime($SH_LOW));
      $min = ($hh * 60) + $mm;
      ?>

      <option value="0" <?php if($min == "0") echo 'selected="selected"'; ?>>0 minute</option>
      <option value="15" <?php if($min == "15") echo 'selected="selected"'; ?>>15 minutes</option>
      <option value="30" <?php if($min == "30") echo 'selected="selected"'; ?>>30 minutes</option>
      <option value="45" <?php if($min == "45") echo 'selected="selected"'; ?>>45 minutes</option>
      <option value="60" <?php if($min == "60") echo 'selected="selected"'; ?>>60 minutes</option>
    </select>
  </td>
</tr>

<tr>
  <td>OT Calculation Before and After :</td>
  <td>
    <select name="SH_OT_Cal" value="<?php echo $SH_OT_Cal;?>">

      <?php
      $hh = date("H", strtotime($SH_OT_Cal));
      $mm = date("i", strtotime($SH_OT_Cal));
      $min = ($hh * 60) + $mm;
      ?>

      <option value="15" <?php if($min == "15") echo 'selected="selected"'; ?>>15 minutes</option>
      <option value="30" <?php if($min == "30") echo 'selected="selected"'; ?>>30 minutes</option>
      <option value="45" <?php if($min == "45") echo 'selected="selected"'; ?>>45 minutes</option>
      <option value="60" <?php if($min == "60") echo 'selected="selected"'; ?>>60 minutes</option>
      <option value="90" <?php if($min == "90") echo 'selected="selected"'; ?>>90 minutes</option>
      <option value="120" <?php if($min == "120") echo 'selected="selected"'; ?>>120 minutes</option>
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

        <?php
        $hh = date("H", strtotime($SH_LchDur));
        $mm = date("i", strtotime($SH_LchDur));
        $min = ($hh * 60) + $mm;
        ?>

        <option value="30" <?php if($min == "30") echo 'selected="selected"'; ?>>30 minutes</option>
        <option value="60" <?php if($min == "60") echo 'selected="selected"'; ?>>60 minutes</option>
        <option value="90" <?php if($min == "90") echo 'selected="selected"'; ?>>90 minutes</option>
        <option value="120" <?php if($min == "120") echo 'selected="selected"'; ?>>120 minutes</option>
        <option value="150" <?php if($min == "150") echo 'selected="selected"'; ?>>150 minutes</option>
      </select>
    </td>
    <td>Lunch Grace Time :</td>
    <td>
      <select name="SH_LchGrc" value="<?php echo $SH_LchGrc;?>">

        <?php
        $hh = date("H", strtotime($SH_LchGrc));
        $mm = date("i", strtotime($SH_LchGrc));
        $min = ($hh * 60) + $mm;
        ?>

        <option value="0" <?php if($min == "0") echo 'selected="selected"'; ?>>0 minute</option>
        <option value="15" <?php if($min == "15") echo 'selected="selected"'; ?>>15 minutes</option>
        <option value="30" <?php if($min == "30") echo 'selected="selected"'; ?>>30 minutes</option>
        <option value="45" <?php if($min == "45") echo 'selected="selected"'; ?>>45 minutes</option>
        <option value="60" <?php if($min == "60") echo 'selected="selected"'; ?>>60 minutes</option>
      </select>
    </td>
  </tr>

  <tr>
    <td>Lunch Time Flexibility :</td>
    <td>
      <input type="checkbox" name="SH_LchFlx" value="Y" <?php if($SH_LchFlx == "Y") echo 'checked="checked"'; ?>>Yes
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
      <input type="checkbox" name="Break1" value="Y" <?php if($Break1 == "Y") echo 'checked="checked"'; ?>>Yes
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
      <input type="checkbox" name="Break2" value="Y" <?php if($Break2 == "Y") echo 'checked="checked"'; ?>>Yes
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
      <a href="../TimeSheet/ShiftPar.php?menu=<?php echo $menu;?>" target="_self"><input type="button" onclick="" value="Cancel"/></a>
      <input type="submit" value="Save">
    </th>
  </tr>

</tbody>
</table>
</form>
</div>
</body>
</html>
