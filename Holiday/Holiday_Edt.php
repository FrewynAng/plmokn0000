<!--
*********************
** Holiday_Add.php **
*********************
-->

<?php session_start(); ?>

<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Add Holiday</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';
  $rjtMsg = "";

  if ($_GET["HDate"] <> "")
  {
    $HDate = date("Y-m-d", strtotime($_GET["HDate"]));
    // echo $HDate;

    $sql1 =
    "SELECT *
    FROM `HolidayTable`
    WHERE `HDate` = '$HDate'";

    $result = $conn->query($sql1);
    $row = $result->fetch_assoc();
    if ($row > 0)
    {
      $HDate = $row['HDate'];
      $HType = $row['HType'];
      $HDesc = $row['HDesc'];

    }
  }
  //------------------------------------------

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $HDate = $_POST["HDate"];
    $HType = $_POST["HType"];
    $HDesc = $_POST["HDesc"];
    $valid = true;

    if (empty($_POST["HDate"]))
    {
      $valid = false;
      echo "<div class='reject_div'> * DATE is required.</div>";
    }

    if($valid)
    {
      $sql2 =
      "UPDATE `HolidayTable`
      SET `HType` = '$HType', `HDesc` = '$HDesc'
      WHERE `HDate` = '$HDate'";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "Holiday Updated.";
        header('Location:../Holiday/HolidayTable.php');
      }
      else
      {
        echo "<div class='reject_div'>Error: " . $sql1 . "<br>" . $conn->error . "</div>";
      }

      $conn->close();
    }
  }

  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <table class="frm">
      <thead class="frm_hdr">
        <tr>
          <th class="frm_th" colspan="2">Add Holiday</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Holiday Date :</td>
          <td>
            <input type="date" name="HDate" value="<?php echo $HDate;?>" disabled>
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td>Holiday Type :</td>
          <td>
            <select name="HType" value="<?php echo $HType;?>">
              <option value="PH">Public Holiday</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Description :</td>
          <td><input type="text" name="HDesc" value="<?php echo $HDesc;?>"></td>
        </tr>

        <tr>
          <th class="frm_btn"colspan="2">
            <a href="../Holiday/HolidayTable.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Save">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>
