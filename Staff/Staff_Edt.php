<!--
*******************
** Staff_Add.php **
*******************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Edit Staff</title>
</head>

<body>
  <?php
  include '../Main/getSysPar.php';
  $rjtMsg = "";
  $cmpMsg = "";

  if ($_GET["StaffID"] <> "")
  {
    $StaffID = $_GET["StaffID"];
    //echo $StaffID;

    $sql1 =
    "SELECT *
    FROM `StaffMaster`
    WHERE
    `StaffID` = '$StaffID'";

    $result = $conn->query($sql1);
    $row = $result->fetch_assoc();
    if ($row > 0)
    {
      $StaffID = $row['StaffID'];
      $TagID = $row['TagID'];
      //$IDCardNo = $_POST["IDCardNo"];
      $Name = $row['Name'];
      $ICNo = $row['ICNo'];
      $Gender = $row['Gender'];
      $DOB = $row['DOB'];
      $PhoneNo = $row['PhoneNo'];
      $Email = $row['Email'];
      $Address1 = $row['Address1'];
      $Address2 = $row['Address2'];
      $Address3 = $row['Address3'];
      $State = $row['State'];
      $Country = $row['Country'];
      $PostCode = $row['PostCode'];
      $Race = $row['Race'];
      $Religion = $row['Religion'];
      //$Nationality = $_POST["Nationality"];
      $MaritalSts = $row['MaritalSts'];
      $EmergencyCnt = $row['EmergencyCnt'];
      $Relation = $row['Relation'];
      $Department = $row['Department'];
      $Position = $row['Position'];
      $DateJoin = $row['DateJoin'];
      $EmpSts = $row['EmpSts'];
      $ALEnt = $row['ALEnt'];
      $MLEnt = $row['MLEnt'];
      $HLEnt = $row['HLEnt'];
      $Paid = $row['Paid'];
      $DateLeft = $row['DateLeft'];
      $Remark1 = $row['Remark1'];
      $Remark2 = $row['Remark2'];
      $Remark3 = $row['Remark3'];
      $Remark = $Remark1 . $Remark2 . $Remark3;


    }
  }
  //------------------------------------------


  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $valid = TRUE;

    $Name = $_POST["Name"];
    $ICNo = $_POST["ICNo"];
    $Gender = $_POST["Gender"];
    $DOB = $_POST["DOB"];
    $PhoneNo = $_POST["PhoneNo"];
    $Email = $_POST["Email"];
    $Address1 = $_POST["Address1"];
    $Address2 = $_POST["Address2"];
    $Address3 = $_POST["Address3"];
    $State = $_POST["State"];
    $Country = $_POST["Country"];
    $PostCode = $_POST["PostCode"];
    $Race = $_POST["Race"];
    $Religion = $_POST["Religion"];
    //$Nationality = $_POST["Nationality"];
    $MaritalSts = $_POST["MaritalSts"];
    $EmergencyCnt = $_POST["EmergencyCnt"];
    $Relation = $_POST["Relation"];
    $Department = $_POST["Department"];
    $Position = $_POST["Position"];
    $DateJoin = $_POST["DateJoin"];
    $EmpSts = $_POST["EmpSts"];
    $ALEnt = $_POST["ALEnt"];
    $MLEnt = $_POST["MLEnt"];
    $HLEnt = $_POST["HLEnt"];
    $Paid = $_POST["Paid"];
    $DateLeft = $_POST["DateLeft"];
    $Remark = $_POST["Remark"];
    $Remark1 = substr("$Remark",  1,  40);
    $Remark2 = substr("$Remark", 41,  80);
    $Remark3 = substr("$Remark", 81, 120);

    if ($StaffID == "")
    {
      $valid = false;
      echo "<div class='reject_div'> * STAFF ID is required.</div>";
    }

    if ($Name == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * NAME is required.</div>";
    }

    if ($ICNo == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * IDENTITY NO. is required.</div>";
    }

    if ($PhoneNo == "")
    {
      $rjtMsg = "* CONTACT NO. is required.";
      $valid = false;
      echo "<div class='reject_div'> * IDENTITY NO. is required.</div>";
    }

    if ($Address1 == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * ADDRESS is required.</div>";
    }

    if ($State == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * STATE is required.</div>";
    }

    if ($Country == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * COUNTRY is required.</div>";
    }

    if ($PostCode == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * POSTCODE is required.</div>";
    }

    if ($Race == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * RACE is required.</div>";
    }

    if ($Religion == "")
    {
      $rjtMsg = "* .";
      $valid = false;
      echo "<div class='reject_div'> * RACE is required.</div>";
    }

    if($valid)
    {
      $sql2 =
      "UPDATE `StaffMaster`
      SET `Name` = '$Name', `ICNo` = '$ICNo', `Gender` = '$Gender',
      `DOB` = '$DOB', `PhoneNo` = '$PhoneNo', `Email` = '$Email', `Address1` = '$Address1', `Address2` = '$Address2',
      `Address3` = '$Address3', `State` = '$State', `Country` = '$Country', `PostCode` = '$PostCode', `Race` = '$Race',
      `Religion` = '$Religion', `MaritalSts` = '$MaritalSts', `EmergencyCnt` = '$EmergencyCnt', `Relation` = '$Relation',
      `Department` = '$Department', `Position` = '$Position', `DateJoin` = '$DateJoin', `EmpSts` = '$EmpSts',
      `ALEnt` = '$ALEnt', `MLEnt` = '$MLEnt', `HLEnt` = '$HLEnt', `Paid` = '$Paid', `DateLeft` = '$DateLeft',
      `Remark1` = '$Remark1', `Remark2` = '$Remark2', `Remark3` = '$Remark3'
      WHERE `StaffID` = '$StaffID'";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "STAFF updated successfully";
        header('Location:../Staff/StaffMast.php');
      }
      else
      {
        echo "<div class='reject_div'>Error: " . $sql2 . "<br>" . $conn->error . "</div>";
      }
      $conn->close();
    }
  }

  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <table class="frm">
      <thead>
      </thead>

      <tbody>
        <!--Staff Detail-->
        <tr>
          <th  class="frm_th" colspan="4">Staff Detail</th>
        </tr>

        <tr>
          <td class="frm_td">Staff ID :</td>
          <td class="frm_td">
            <input type="text" name="StaffID" value="<?php echo $StaffID;?>" disabled>
            <span class="reject">*</span>
          </td>
          <td class="frm_td">Tag ID :</td>
          <td class="frm_td">
            <input type="number" name="TagID" value="<?php echo $TagID;?>" diabled>
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td class="frm_td">Name :</td>
          <td class="frm_td">
            <input type="text" name="Name" value="<?php echo $Name;?>">
            <span class="reject">*</span>
          </td>
          <td class="frm_td">IC No. :</td>
          <td class="frm_td">
            <input type="text" name="ICNo" value="<?php echo $ICNo;?>">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td class="frm_td">Date Of Birth :</td>
          <td class="frm_td">
            <input type="date" name="DOB" value="<?php echo $DOB;?>">
            <span class="reject">*</span>
          </td>
          <td class="frm_td">Gender :</td>
          <td class="frm_td">
            <input type="radio" name="Gender" value="M" checked=""> Male
            <input type="radio" name="Gender" value="F"> Female
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td class="frm_td">Mobile No. :</td>
          <td class="frm_td">
            <input type="text" name="PhoneNo" value="<?php echo $PhoneNo;?>">
            <span class="reject">*</span>
          </td>
          <td class="frm_td">Email Address :</td>
          <td class="frm_td"><input type="text" name="Email" value="<?php echo $Email;?>"></td>
        </tr>

        <tr>
          <td class="frm_td">Address :</td>
          <td class="frm_td">
            <input type="text" name="Address1" value="<?php echo $Address1;?>">
            <span class="reject">*</span>
          </td>
          <td class="frm_td">State :</td>
          <td class="frm_td">
            <input type="text" name="State" value="<?php echo $State;?>">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td></td>
          <td class="frm_td"><input type="text" name="Address2" value="<?php echo $Address2;?>"></td>
          <td class="frm_td">Country :</td>
          <td class="frm_td">
            <input type="text" name="Country" value="<?php echo $Country;?>">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td></td>
          <td class="frm_td"><input type="text" name="Address3" value="<?php echo $Address3;?>"></td>
          <td class="frm_td">Post Code :</td>
          <td class="frm_td">
            <input type="text" name="PostCode" value="<?php echo $PostCode;?>">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td class="frm_td">Race :</td>
          <td class="frm_td">
            <select name="Race">
              <option value=" "</option>
                <option value="M">Malay</option>
                <option value="C">Chinese</option>
                <option value="I">Indian</option>
                <option value="O">Others</option>
              </select>
              <span class="reject">*</span>
            </td>
            <td class="frm_td">Religion :</td>
            <td class="frm_td">
              <select name="Religion">
                <option value=" "</option>
                  <option value="I">Islam</option>
                  <option value="B">Budhist</option>
                  <option value="H">Hindu</option>
                  <option value="C">Christian</option>
                  <option value="O">Others</option>
                </select>
                <span class="reject">*</span>
              </td>
            </tr>

            <tr>
              <td class="frm_td">Marital Status :</td>
              <td class="frm_td">
                <select name="MaritalSts">
                  <option value="S">Single</option>
                  <option value="M">Married</option>
                  <option value="D">Divorced</option>
                </select>
                <span class="reject">*</span>
              </td>
              <td class="frm_td" colspan="2"></td>
            </tr>

            <tr>
              <td class="frm_td">Emergency Contact :</td>
              <td class="frm_td">
                <input type="text" name="EmergencyCnt" value="<?php echo $EmergencyCnt;?>">
                <span class="reject">*</span>
              </td>
              <td class="frm_td">Relation :</td>
              <td class="frm_td">
                <input type="text" name="Relation" value="<?php echo $Relation;?>">
                <span class="reject">*</span>
              </td>
            </tr>

            <tr>
              <td colspan="4"><font color="white">/t </font></td>
            </tr>

            <!--Employment Detail-->
            <tr>
              <th  class="frm_th" colspan="5">Employment Detail</th>
            </tr>

            <tr>
              <td class="frm_td">Department :</td>
              <td class="frm_td">
                <input type="text" name="Department" value="<?php echo $Department;?>">
                <span class="reject">*</span>
              </td>
              <td class="frm_td">Position :</td>
              <td class="frm_td">
                <input type="text" name="Position" value="<?php echo $Position;?>">
                <span class="reject">*</span>
              </td>
            </tr>

            <tr>
              <td class="frm_td">Group :</td>
              <td class="frm_td">
                <select name="UsrGrpSeq">
                  <option value="1">Admim</option>
                  <span class="reject">*</span>
                </td>
                <td class="frm_td">Employment Status :</td>
                <td class="frm_td">
                  <select name="EmpSts">
                    <option value="E">Employed</option>
                    <option value="P">Probation</option>
                    <option value="T">Tranee</option>
                    <option value="R">Resigned</option>
                    <span class="reject">*</span>
                  </td>
                </tr>

                <tr>
                  <td class="frm_td">Annual Leave Entitle :</td>
                  <td class="frm_td">
                    <input type="text" name="ALEnt" value="<?php echo $ALEnt;?>">
                    <span class="reject">*</span>
                  </td>
                  <td class="frm_td">Date Join :</td>
                  <td class="frm_td">
                    <input type="date" name="DateJoin" value="<?php echo $DateJoin;?>">
                    <span class="reject">*</span>
                  </td>
                </tr>

                <tr>
                  <td class="frm_td">Medical Leave Entitle :</td>
                  <td class="frm_td">
                    <input type="text" name="MLEnt" value="<?php echo $MLEnt;?>">
                    <span class="reject">*</span>
                  </td>
                  <td class="frm_td">Date Left :</td>
                  <td class="frm_td"><input type="date" name="DateLeft" value="<?php echo $DateLeft;?>"></td>
                </tr>

                <tr>
                  <td class="frm_td">Hospitalize Leave Entitle :</td>
                  <td class="frm_td">
                    <input type="text" name="HLEnt" value="<?php echo $HLEnt;?>">
                    <span class="reject">*</span>
                  </td>
                  <td class="frm_td">Paid :</td>
                  <td class="frm_td">
                    <input type="number" name="Paid" value="<?php echo $Paid;?>">
                    <span class="reject">*</span>
                  </td>
                </tr>

                <tr>
                  <td class="frm_td">Remark :</td>
                  <td class="frm_td">
                    <textarea name="Remark" rows="4" cols="40" value="<?php echo $Remark;?>"></textarea>
                  </td>
                </tr>

                <tr>
                  <th class="frm_btn"colspan="4">
                    <a href="../Staff/StaffMast.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
                    <input type="submit" value="Save">
                  </th>
                </tr>

              </tbody>
            </table>
          </form>

        </body>
        </html>
