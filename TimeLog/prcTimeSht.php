<!--
********************
** prcTimeSht.php **
********************
-->

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';

  //-------------------------------------------------------
  $sql1 =
  "SELECT *
  FROM `taglog`
  ORDER BY TagID, TagDate, TagTime, TagMchNo";
  //execute the SQL query and return records
  $result = $conn->query($sql1);
  //-------------------------------------------------------

  $Inz = "Y";
  $count = 0;
  $curID = "";
  $curTag = "";
  $TimeIn_ = "";
  $brk1Str_ = "";
  $brk1End_ = "";
  $brk2Str_ = "";
  $brk2End_ = "";
  $LchOut_ = "";
  $LchIn_ = "";
  $TimeOut_ = "";

  //-------------------------------------------------------
  $TagID = "";
  $StaffID = "";
  $WrkDate = "";
  $DB_OT_IN = "";
  $DB_OT_OUT = "";
  $DB_OT_Dur = "";
  $TimeIn = "";
  $TimeOut = "";
  $WrkHour = "";
  $OT_IN = "";
  $OT_OUT = "";
  $OT_Dur = "";
  $LunchStr = "";
  $LunchEnd = "";
  $LunchDur = "";
  $BreakStr1 = "";
  $BreakEnd1 = "";
  $BreakDur1 = "";
  $BreakStr2 = "";
  $BreakEnd2 = "";
  $BreakDur2 = "";

  while ($row = $result->fetch_assoc())
  {
    $curTag = date("Y-m-d", strtotime($row["TagDate"])) . " " . date("H:i:s", strtotime($row["TagTime"]));
    $curTag = strtotime($curTag);

    if ($Inz == "Y")
    {
      GOTO Inz;
    }

    if (($curTag > $dayEnd) || ($curID <> $row["TagID"]))
    {
      $TagID = $curID;
      $WrkDate = $curDate;
      $count = wrtTSht($conn, $count, $TagID, $WrkDate, $TimeIn_, $brk1Str_, $brk1End_, $LchOut_, $LchIn_, $brk2Str_, $brk2End_, $TimeOut_Str, $TimeOut_, $OTStr_);
      $TimeIn_ = "";
      $brk1Str_ = "";
      $brk1End_ = "";
      $LchOut_ = "";
      $LchIn_ = "";
      $brk2Str_ = "";
      $brk2End_ = "";
      $TimeOut_ = "";

      Inz:
      $Inz = "N";
      $curID = $row["TagID"];
      $curDate = date("Y-m-d", $curTag);
      $shf_Detl = getShfDt($conn, $curID, $curTag);
      $dayStr = $shf_Detl['dayStr'];
      $dayStr = strtotime($dayStr);
      $dayEnd = $shf_Detl['dayEnd'];
      $dayEnd = strtotime($dayEnd);
      $TimeIn_End = $shf_Detl['TimeIn_End'];
      $TimeIn_End = strtotime($TimeIn_End);
      $Brk1_Str = $shf_Detl['Brk1_Str'];
      $Brk1_Str = strtotime($Brk1_Str);
      $Brk1_End = $shf_Detl['Brk1_End'];
      $Brk1_End = strtotime($Brk1_End);
      $LchOut_Str = $shf_Detl['LchOut_Str'];
      $LchOut_Str = strtotime($LchOut_Str);
      $LchIn_Str = $shf_Detl['LchIn_Str'];
      $LchIn_Str = strtotime($LchIn_Str);
      $LchIn_End = $shf_Detl['LchIn_End'];
      $LchIn_End = strtotime($LchIn_End);
      $Brk2_Str = $shf_Detl['Brk2_Str'];
      $Brk2_Str = strtotime($Brk2_Str);
      $Brk2_End = $shf_Detl['Brk2_End'];
      $Brk2_End = strtotime($Brk2_End);
      $TimeOut_Str = $shf_Detl['TimeOut_Str'];
      $TimeOut_Str = strtotime($TimeOut_Str);
      $OTStr_ = $shf_Detl['OTStr_'];
      $OTStr_ = strtotime($OTStr_);

    }
    // echo "current Tag > " . date("Y-m-d H:i:s", $curTag) . "<br>";
    //----------------------------------------------------------------------------
    if(($curTag >= $dayStr) AND ($curTag <= $dayEnd))
    {
      //------ TIME IN ------
      if(($TimeIn_ == "") AND ($curTag <= $LchOut_Str))
      {
        $TimeIn_ = date("Y-m-d H:i:s", $curTag);
        // echo "Time In " . $TimeIn_ . "<br>";
        GOTO readnxt;
      }

      //------ Break 1 Out ------
      if(($brk1Str_ == "") AND ($curTag >= $Brk1_Str) AND ($curTag <= $Brk1_End))
      {
        $brk1Str_ = date("Y-m-d H:i:s", $curTag);
        // echo "Time In " . $TimeIn_ . "<br>";
        GOTO readnxt;
      }

      //------ Break 1 In  ------
      if(($curTag <= $Brk1_End) AND ($curTag >= strtotime($brk1Str_)) AND ($curTag > $Brk1_Str))
      {
        $brk1End_ = date("Y-m-d H:i:s", $curTag);
        // echo "Break 1 End > " . $brk1End_ . "<br>";
        GOTO readnxt;
      }

      //------ LUNCH OUT ------
      if(($curTag >= $LchOut_Str) AND ($curTag <= $LchIn_Str))
      {
        $LchOut_ = date("Y-m-d H:i:s", $curTag);
        // echo "Lunch Out " . $LchOut_ . "<br>";
        GOTO readnxt;
      }

      //------ LUNCH IN ------
      if(($LchIn_ == "") AND ($curTag > strtotime($LchOut_))
      AND ($curTag > $LchIn_Str))
      {
        $LchIn_ = date("Y-m-d H:i:s", $curTag);
        // echo "Lunch In " . $LchIn_ . "<br>";
        GOTO readnxt;
      }

      //------ Break 2 Out ------
      if(($brk2Str_ == "") AND ($curTag >= $Brk2_Str) AND ($curTag <= $Brk2_End))
      {
        $brk2Str_ = date("Y-m-d H:i:s", $curTag);
        // echo "Time In " . $TimeIn_ . "<br>";
        GOTO readnxt;
      }

      //------ Break 2 In  ------
      if(($curTag <= $Brk2_End) AND ($curTag > strtotime($brk2Str_)) AND ($curTag > $Brk2_Str))
      {
        $brk2End_ = date("Y-m-d H:i:s", $curTag);
        // echo "Break 1 End > " . $brk1End_ . "<br>";
        // GOTO readnxt;
      }

      //------ TIME OUT ------
      if(($curTag >= strtotime($LchIn_)))
      {
        $TimeOut_ = date("Y-m-d H:i:s", $curTag);
        // echo "Time Out " . $TimeOut_ . "<br>";
        GOTO readnxt;
      }


      //------ OT Start ------


      //------ OT End ------

    }

    readnxt:
  }

  $TagID = $curID;
  $WrkDate = $curDate;
  $count = wrtTSht($conn, $count, $TagID, $WrkDate, $TimeIn_, $brk1Str_, $brk1End_, $LchOut_, $LchIn_, $brk2Str_, $brk2End_, $TimeOut_Str, $TimeOut_, $OTStr_);
  //-------------------------------------------------------

  function wrtTSht($conn, $count, $TagID, $WrkDate, $TimeIn_, $brk1Str_, $brk1End_, $LchOut_, $LchIn_, $brk2Str_, $brk2End_, $TimeOut_Str, $TimeOut_, $OTStr_)
  {
    $StaffID = "";
    $DB_OT_IN = "";
    $DB_OT_OUT = "";
    $DB_OT_Dur = "";
    $TimeIn = date("H:i:s", strtotime($TimeIn_));
    $TimeOut = date("H:i:s", strtotime($TimeOut_));
    $OT_IN = "";
    $OT_OUT = "";
    $OT_Dur = "";
    $BreakDur1 = "";
    $BreakDur2 = "";

    //-------------------------------------------------------
    // Break 1 Duration
    //-------------------------------------------------------
    if ($brk1Str_ == "")
    {
      $BreakStr1 = "";
    }
    else
    {
      $BreakStr1 = date("H:i:s", strtotime($brk1Str_));
      // echo $BreakStr1;
    }

    if ($brk1End_ == "")
    {
      $BreakEnd1 = "";
    }
    else
    {
      $BreakEnd1 = date("H:i:s", strtotime($brk1End_));
      // echo $BreakEnd1;
    }

    // if (($BreakStr1 == "") OR ($BreakEnd1 == ""))
    // {
    //   $BreakStr1 = "";
    //   $BreakEnd1 = "";
    // }

    if (($BreakStr1 == "") OR ($BreakEnd1 == ""))
    {
      $BreakDur1 = "00:30:00";
    }
    else
    {
      $brk1Str_ = date_create($brk1Str_);
      $brk1End_ = date_create($brk1End_);
      $dur = date_diff($brk1Str_, $brk1End_);
      $BreakDur1 = $dur->format("%H:%I:%S");
    }

    if ((($BreakStr1 == "") AND ($BreakEnd1 == "")))
    {
      $BreakDur1 = "";
    }

    //-------------------------------------------------------
    // Lunch Duration
    //-------------------------------------------------------
    if ($LchOut_ == "")
    {
      $LunchStr = "";
    }
    else
    {
      $LunchStr = date("H:i:s", strtotime($LchOut_));
      // echo $LchOut_;
    }

    if ($LchIn_ == "")
    {
      $LunchEnd = "";
    }
    else
    {
      $LunchEnd = date("H:i:s", strtotime($LchIn_));
    }

    // if (($TimeOut == $LunchStr) OR ($TimeOut == $LunchEnd))
    // {
    //   $LunchStr = "";
    //   $LunchEnd = "";
    // }

    if (($LunchStr == "") OR ($LunchEnd == ""))
    {
      $LunchDur = "01:00:00";
    }
    else
    {
      $LchOut_ = date_create($LchOut_);
      $LchIn_ = date_create($LchIn_);
      $dur = date_diff($LchOut_, $LchIn_);
      $LunchDur = $dur->format("%H:%I:%S");
    }

    //-------------------------------------------------------
    // Break 2 Duration
    //-------------------------------------------------------
    if ($brk2Str_ == "")
    {
      $BreakStr2 = "";
    }
    else
    {
      $BreakStr2 = date("H:i:s", strtotime($brk2Str_));
      // echo $BreakStr1;
    }

    if ($brk2End_ == "")
    {
      $BreakEnd2 = "";
    }
    else
    {
      $BreakEnd2 = date("H:i:s", strtotime($brk2End_));
      // echo $BreakEnd1;
    }

    // if (($BreakStr2 == "") OR ($BreakEnd2 == ""))
    // {
    //   $BreakStr2 = "";
    //   $BreakEnd2 = "";
    // }

    if (($BreakStr2 == "") OR ($BreakEnd2 == ""))
    {
      $BreakDur2 = "00:30:00";
    }
    else
    {
      $brk2Str_ = date_create($brk2Str_);
      $brk2End_ = date_create($brk2End_);
      $dur = date_diff($brk2Str_, $brk2End_);
      $BreakDur2 = $dur->format("%H:%I:%S");
    }

    if ((($BreakStr2 == "") AND ($BreakEnd2 == "")))
    {
      $BreakDur2 = "";
    }

    //-------------------------------------------------------
    // Over Time Duration
    //-------------------------------------------------------
    // echo date("Y-m-d H:i:s", $OTStr_) . "<br>";
    // echo date("Y-m-d H:i:s", strtotime($TimeOut_)) . "<br>";
    if (strtotime($TimeOut_) > $OTStr_)
    {
      $tmptm1 = date("Y-m-d H:i:s", $OTStr_);
      $tmptm1 = date_create($tmptm1);
      $tmptm2 = date("Y-m-d H:i:s", strtotime($TimeOut_));
      $tmptm2 = date_create($tmptm2);

      $dur = date_diff($tmptm1, $tmptm2);
      $OT_Dur = $dur->format("%H:%I:%S");
    }
    else
    {
      $OT_Dur = "";
    }

    //-------------------------------------------------------
    // Working Hour Duration
    //-------------------------------------------------------
    if ($OT_Dur == "")
    {
      $tmptm1 = date("Y-m-d H:i:s", strtotime($TimeIn_));
      $tmptm1 = date_create($tmptm1);
      $tmptm2 = date("Y-m-d H:i:s", strtotime($TimeOut_));
      $tmptm2 = date_create($tmptm2);
    }
    else
    {
      $tmptm1 = date("Y-m-d H:i:s", strtotime($TimeIn_));
      $tmptm1 = date_create($tmptm1);
      $tmptm2 = date("Y-m-d H:i:s", $TimeOut_Str);
      $tmptm2 = date_create($tmptm2);
    }

    $dur = date_diff($tmptm1, $tmptm2);
    $WrkHour = $dur->format("%H:%I:%S");

    if ($LunchDur <> "")
    {
      $hh = date("H", strtotime($LunchDur));
      $mm = date("i", strtotime($LunchDur));
      $min_ = "";
      $min_  = ($hh * 60) + $mm;
    }

    $min_  = "-" . $min_ . "minutes";
    $tmptm1 = date("Y-m-d", strtotime($WrkDate)) . " " . date("H:i:s", strtotime($WrkHour));
    $tmptm1 = strtotime($tmptm1);
    $WrkHour = date("H:i:s", strtotime($min_, $tmptm1));




  //-------------------------------------------------------

  $sql2 =
  "INSERT
  INTO `TimeSheet`
  (`TagID`, `StaffID`, `WrkDate`, `DB_OT_IN`, `DB_OT_OUT`, `DB_OT_Dur`, `TimeIn`, `TimeOut`,
    `WrkHour`, `OT_IN`, `OT_OUT`, `OT_Dur`, `LunchStr`, `LunchEnd`, `LunchDur`,
    `BreakStr1`, `BreakEnd1`, `BreakDur1`, `BreakStr2`,`BreakEnd2`, `BreakDur2`)
    VALUES ('$TagID', '$StaffID', '$WrkDate', '$DB_OT_IN', '$DB_OT_OUT', '$DB_OT_Dur', '$TimeIn', '$TimeOut',
      '$WrkHour', '$OT_IN', '$OT_OUT', '$OT_Dur', '$LunchStr', '$LunchEnd', '$LunchDur',
      '$BreakStr1', '$BreakEnd1', '$BreakDur1', '$BreakStr2', '$BreakEnd2', '$BreakDur2')";
      // echo $sql2;
      //execute the SQL query and return records
      if ($conn->query($sql2) === TRUE)
      {
        $count = $count + 1;
        echo "Recorded Added - " . $count . "<br>";
      }
      else
      {
        echo "error!<br>" . $conn->error . "<br>";
      }

      $LunchDur = "";
      $WrkHour = "";
      $TagID = "";
      $WrkDate = "";
      $TimeIn_ = "";
      $brk1Str_ = "";
      $brk1End_ = "";
      $LchOut_ = "";
      $LchIn_ = "";
      $TimeOut_ = "";

      return $count;
    }

    //-------------------------------------------------------

    function getShfDt($conn, $curID, $curTag)
    {
      $sql3 =
      "SELECT *
      FROM `shiftpar`
      WHERE SH_No =
      (SELECT ShfNo FROM StfShfGrp WHERE TagId = $curID)";
      $result3 = $conn->query($sql3);
      $row3 = $result3->fetch_assoc();

      $shfDur = $row3["SH_WrkHour"];
      $shMaxLen = $row3["SH_MaxLen"];
      $shfGrc = $row3["SH_Grc"];
      $lchDur = $row3["SH_LchDur"];
      $lchGrc = $row3["SH_LchGrc"];
      $SH_OT_Cal = $row3["SH_OT_Cal"];
      $Break1 = $row3['Break1'];
      $Break2 = $row3['Break2'];
      $curDay = date("l", $curTag);
      // echo "Current Tag > " . date("Y-m-d H:i:s l", $curTag) . "<br>";
      // echo $curDay . "<br>";

      switch ($curDay)
      {
        case "Sunday":
        $shfStr = $row3["SH_SunStr"];
        $shfEnd = $row3["SH_SunEnd"];
        $lchStr = $row3["SunLchStr"];
        $lchEnd = $row3["SunLchEnd"];
        $brkStr1 = $row3["SunBrkStr1"];
        $brkEnd1 = $row3["SunBrkEnd1"];
        $brkStr2 = $row3["SunBrkStr2"];
        $brkEnd2 = $row3["SunBrkEnd2"];
        break;

        case "Monday":
        $shfStr = $row3["SH_MonStr"];
        $shfEnd = $row3["SH_MonEnd"];
        $lchStr = $row3["MonLchStr"];
        $lchEnd = $row3["MonLchEnd"];
        $brkStr1 = $row3["MonBrkStr1"];
        $brkEnd1 = $row3["MonBrkEnd1"];
        $brkStr2 = $row3["MonBrkStr2"];
        $brkEnd2 = $row3["MonBrkEnd2"];
        break;

        case "Tuesday":
        $shfStr = $row3["SH_TueStr"];
        $shfEnd = $row3["SH_TueEnd"];
        $lchStr = $row3["TueLchStr"];
        $lchEnd = $row3["TueLchEnd"];
        $brkStr1 = $row3["TueBrkStr1"];
        $brkEnd1 = $row3["TueBrkEnd1"];
        $brkStr2 = $row3["TueBrkStr2"];
        $brkEnd2 = $row3["TueBrkEnd2"];
        break;

        case "Wednesday":
        $shfStr = $row3["SH_WedStr"];
        $shfEnd = $row3["SH_WedEnd"];
        $lchStr = $row3["WedLchStr"];
        $lchEnd = $row3["WedLchEnd"];
        $brkStr1 = $row3["WedBrkStr1"];
        $brkEnd1 = $row3["WedBrkEnd1"];
        $brkStr2 = $row3["WedBrkStr2"];
        $brkEnd2 = $row3["WedBrkEnd2"];
        break;

        case "Thursday":
        $shfStr = $row3["SH_ThuStr"];
        $shfEnd = $row3["SH_ThuEnd"];
        $lchStr = $row3["ThuLchStr"];
        $lchEnd = $row3["ThuLchEnd"];
        $brkStr1 = $row3["ThuBrkStr1"];
        $brkEnd1 = $row3["ThuBrkEnd1"];
        $brkStr2 = $row3["ThuBrkStr2"];
        $brkEnd2 = $row3["ThuBrkEnd2"];
        break;

        case "Friday":
        $shfStr = $row3["SH_FriStr"];
        $shfEnd = $row3["SH_FriEnd"];
        $lchStr = $row3["FriLchStr"];
        $lchEnd = $row3["FriLchEnd"];
        $brkStr1 = $row3["FriBrkStr1"];
        $brkEnd1 = $row3["FriBrkEnd1"];
        $brkStr2 = $row3["FriBrkStr2"];
        $brkEnd2 = $row3["FriBrkEnd2"];
        break;

        case "Saturday":
        $shfStr = $row3["SH_SatStr"];
        $shfEnd = $row3["SH_SatEnd"];
        $lchStr = $row3["SatLchStr"];
        $lchEnd = $row3["SatLchEnd"];
        $brkStr1 = $row3["SatBrkStr1"];
        $brkEnd1 = $row3["SatBrkEnd1"];
        $brkStr2 = $row3["SatBrkStr2"];
        $brkEnd2 = $row3["SatBrkEnd2"];
        break;
      }

      //-------------------------------------------------------
      // Start of Day
      //-------------------------------------------------------
      $dayStr = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfStr)) ;
      $dayStr = strtotime($dayStr);
      $dayStr = date("Y-m-d H:i:s", strtotime("-2 hours", $dayStr));
      // $dayStr = strtotime($dayStr);
      // echo "Day Start > " . $dayStr . "<br>";


      //-------------------------------------------------------
      // End of Day
      //-------------------------------------------------------
      $dayEnd = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfStr)) ;
      $dayEnd = strtotime($dayEnd);
      $dayEnd = date("Y-m-d H:i:s", strtotime("+18 hours", $dayEnd));
      // echo "Day End > " . $dayEnd . "<br><br>";

      //-------------------------------------------------------
      // Time In End
      //-------------------------------------------------------
      $min_ = "";
      $hh = date("H", strtotime($shfGrc));
      $mm = date("i", strtotime($shfGrc));
      $min_  = $min_ + ($hh * 60) + $mm;
      $min_  = "+" . $min_ . "minutes";

      $TimeIn_End = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfStr));
      $TimeIn_End = strtotime($TimeIn_End);
      $TimeIn_End = date("Y-m-d H:i:s", strtotime($min_, $TimeIn_End));

      if (strtotime($TimeIn_End) < strtotime($dayStr))
      {
        $TimeIn_End = strtotime($TimeIn_End);
        $TimeIn_End = date("Y-m-d H:i:s", strtotime("+1 days", $TimeIn_End));
      }
      // echo "Time In End > " . $TimeIn_End . "<br>";

      //-------------------------------------------------------
      // Break 1 Start
      //-------------------------------------------------------
      if ($Break1 == "Y")
      {
        $tmptm1 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfStr));
        $tmptm1 = date_create($tmptm1);
        $tmptm2 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($brkStr1));
        $tmptm2 = date_create($tmptm2);

        $dur = date_diff($tmptm1, $tmptm2);
        $dur_ = $dur->format("%H:%I:%S");
        $hh = date("H", strtotime($dur_));
        $mm = date("i", strtotime($dur_));
        $min_ = "";
        $min_  = ceil(($min_ + ($hh * 60) + $mm) / 2);
        $min_  = "-" . $min_ . "minutes";

        $Brk1_Str = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($brkStr1));
        $Brk1_Str = strtotime($Brk1_Str);
        $Brk1_Str = date("Y-m-d H:i:s", strtotime($min_, $Brk1_Str));

        if (strtotime($Brk1_Str) < strtotime($dayStr))
        {
          $Brk1_Str = strtotime($Brk1_Str);
          $Brk1_Str = date("Y-m-d H:i:s", strtotime("+1 days", $Brk1_Str));
        }
      }
      else
      {
        $Brk1_Str = $dayEnd;
      }
      // echo "Break 1 Start > " . $Brk1_Str . "<br>";

      //-------------------------------------------------------
      // Break 1 End
      //-------------------------------------------------------
      if ($Break1 == "Y")
      {
        $min_ = "";
        $min_  = ceil(($min_ + ($hh * 60) + $mm) / 2);
        $min_  = "+" . $min_ . "minutes";

        $Brk1_End = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($brkEnd1));
        $Brk1_End = strtotime($Brk1_End);
        $Brk1_End = date("Y-m-d H:i:s", strtotime($min_, $Brk1_End));

        if (strtotime($Brk1_End) > strtotime($dayEnd))
        {
          $Brk1_End = strtotime($Brk1_End);
          $Brk1_End = date("Y-m-d H:i:s", strtotime("+1 days", $Brk1_End));
        }
      }
      else
      {
        $Brk1_End = $dayEnd;
      }
      // echo "Break 1 End > " . $Brk1_End . "<br>";

      //-------------------------------------------------------
      // Lunch Out Start
      //-------------------------------------------------------
      $LchOut_Str = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchStr));

      $min_ = "";
      $hh = date("H", strtotime($lchGrc));
      $mm = date("i", strtotime($lchGrc));
      $min_  = $min_ + ($hh * 60) + $mm;
      $min_  = "-" . $min_ . "minutes";

      $LchOut_Str = strtotime($LchOut_Str);
      $LchOut_Str = date("Y-m-d H:i:s", strtotime($min_, $LchOut_Str));

      if (strtotime($LchOut_Str) < strtotime($dayStr))
      {
        $LchOut_Str = strtotime($LchOut_Str);
        $LchOut_Str = date("Y-m-d H:i:s", strtotime("+1 days", $LchOut_Str));
      }
      // echo "Lunch Out Start > " . $LchOut_Str . "<br>";

      //-------------------------------------------------------
      // Lunch Out End
      //-------------------------------------------------------





      //-------------------------------------------------------
      // Lunch In Start
      //-------------------------------------------------------
      $tmptm1 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchStr));
      $tmptm1 = date_create($tmptm1);
      $tmptm2 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchEnd));
      $tmptm2 = date_create($tmptm2);

      $dur = date_diff($tmptm1, $tmptm2);
      $dur_ = $dur->format("%H:%I:%S");
      $hh = date("H", strtotime($dur_));
      $mm = date("i", strtotime($dur_));
      $min_ = "";
      $min_  = ceil(($min_ + ($hh * 60) + $mm) / 2);
      $min_  = "-" . $min_ . "minutes";

      $LchIn_Str = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchEnd));
      $LchIn_Str = strtotime($LchIn_Str);
      $LchIn_Str = date("Y-m-d H:i:s", strtotime($min_, $LchIn_Str));

      if (strtotime($LchIn_Str) < strtotime($dayStr))
      {
        $LchIn_Str = strtotime($LchIn_Str);
        $LchIn_Str = date("Y-m-d H:i:s", strtotime("+1 days", $LchIn_Str));
      }
      // echo "Lunch In Start > " . $LchIn_Str . "<br>";

      //-------------------------------------------------------
      // Lunch In End
      //-------------------------------------------------------
      $LchIn_End = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($lchEnd));

      $min_ = "";
      $hh = date("H", strtotime($lchGrc));
      $mm = date("i", strtotime($lchGrc));
      $min_  = $min_ + ($hh * 60) + $mm;
      $min_  = "+" . $min_ . "minutes";

      $LchIn_End = strtotime($LchIn_End);
      $LchIn_End = date("Y-m-d H:i:s", strtotime($min_, $LchIn_End));

      if (strtotime($LchIn_End) < strtotime($dayStr))
      {
        $LchIn_End = strtotime($LchIn_End);
        $LchIn_End = date("Y-m-d H:i:s", strtotime("+1 days", $LchIn_End));
      }
      // echo "Lunch In End > " . $LchIn_End . "<br>";

      //-------------------------------------------------------
      // Break 2 Start
      //-------------------------------------------------------
      if ($Break2 == "Y")
      {
        $tmptm1 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($LchIn_End));
        $tmptm1 = date_create($tmptm1);
        $tmptm2 = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($brkStr2));
        $tmptm2 = date_create($tmptm2);

        $dur = date_diff($tmptm1, $tmptm2);
        $dur_ = $dur->format("%H:%I:%S");
        $hh = date("H", strtotime($dur_));
        $mm = date("i", strtotime($dur_));
        $min_ = "";
        $min_  = ceil(($min_ + ($hh * 60) + $mm) / 2);
        $min_  = "-" . $min_ . "minutes";

        $Brk2_Str = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($brkStr2));
        $Brk2_Str = strtotime($Brk2_Str);
        $Brk2_Str = date("Y-m-d H:i:s", strtotime($min_, $Brk2_Str));

        if (strtotime($Brk2_Str) < strtotime($dayStr))
        {
          $Brk2_Str = strtotime($Brk2_Str);
          $Brk2_Str = date("Y-m-d H:i:s", strtotime("+1 days", $Brk2_Str));
        }
      }
      else
      {
        $Brk2_Str = $dayEnd;
      }
      // echo "Break 2 Start > " . $Brk2_Str . "<br>";

      //-------------------------------------------------------
      // Break 2 End
      //-------------------------------------------------------
      if ($Break2 == "Y")
      {
        $min_ = "";
        $min_  = ceil(($min_ + ($hh * 60) + $mm) / 2);
        $min_  = "+" . $min_ . "minutes";

        $Brk2_End = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($brkEnd2));
        $Brk2_End = strtotime($Brk2_End);
        $Brk2_End = date("Y-m-d H:i:s", strtotime($min_, $Brk2_End));

        if (strtotime($Brk2_End) < strtotime($dayStr))
        {
          $Brk2_End = strtotime($Brk2_End);
          $Brk2_End = date("Y-m-d H:i:s", strtotime("+1 days", $Brk2_End));
        }
      }
      else
      {
        $Brk2_End = $dayEnd;
      }
      // echo "Break 2 End > " . $Brk2_End . "<br>";

      //-------------------------------------------------------
      // Time Out
      //-------------------------------------------------------
      $TimeOut_Str = date("Y-m-d", $curTag) . " " . date("H:i:s", strtotime($shfEnd));

      if (strtotime($TimeOut_Str) < strtotime($dayStr))
      {
        $TimeOut_Str = strtotime($TimeOut_Str);
        $TimeOut_Str = date("Y-m-d H:i:s", strtotime("+1 days", $TimeOut_Str));
      }
      // echo "Time Out Start > " . $TimeOut_Str . "<br>";

      //-------------------------------------------------------
      // Over Time Start
      //-------------------------------------------------------
      $hh = date("H", strtotime($SH_OT_Cal));
      $mm = date("i", strtotime($SH_OT_Cal));
      $min_ = "";
      $min_  = $min_ + ($hh * 60) + $mm;
      $min_  = "+" . $min_ . "minutes";

      $OTStr_ = strtotime($TimeOut_Str);
      // echo $OTStr_ = date("Y-m-d H:i:s", strtotime($min_, $OTStr_));

      //-------------------------------------------------------
      return
      array('dayStr' => $dayStr,
      'dayEnd' => $dayEnd,
      'TimeIn_End' => $TimeIn_End,
      'Brk1_Str' => $Brk1_Str,
      'Brk1_End' => $Brk1_End,
      'LchOut_Str' => $LchOut_Str,
      'LchIn_Str' => $LchIn_Str,
      'LchIn_End' => $LchIn_End,
      'Brk2_Str' => $Brk2_Str,
      'Brk2_End' => $Brk2_End,
      'TimeOut_Str' => $TimeOut_Str,
      'OTStr_' => $OTStr_);
    }

    $conn->close();
    ?>

  </body>
  </html>
