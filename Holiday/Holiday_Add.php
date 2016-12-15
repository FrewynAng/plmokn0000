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

  $HDate = "";
  $HType = "";
  $HDesc = "";
  $valid = true;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $HDate = $_POST["HDate"];
    $HType = $_POST["HType"];
    $HDesc = $_POST["HDesc"];

    if (empty($_POST["HDate"]))
    {
      $rjtMsg = "* DATE` is required";
      $valid = false;
    }

    if($valid)
    {
      $sql =
      "INSERT INTO `HolidayTable`
      (HDate, HType, HDesc)
      VALUES
      ('$HDate', '$HType', '$HDesc')";

      if ($conn->query($sql) === TRUE)
      {
        $_SESSION['cmpMsg'] = "Holiday added.";
        header('Location:../Holiday/HolidayTable.php');
      }
      else
      {
        $_SESSION['rjtMsg'] = "Error: " . $sql . $conn->error;
        echo $_SESSION['rjtMsg'];
      }

      $conn->close();
    }
  }

  ?>

  <p><span class="reject"><?php echo $rjtMsg; ?></span></p>
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
            <input type="date" name="HDate" value="<?php echo $HDate;?>">
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
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>