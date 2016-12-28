<!--
************************
** Department_Add.php **
************************
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
  $valid = TRUE;

  if (($_GET["dpt_No"] <> "") AND ($_GET["dpt_desc"] <> ""))
  {
    $dpt_No = $_GET["dpt_No"];
    $dpt_desc = $_GET["dpt_desc"];

    $sql1 =
    "SELECT *
    FROM `department`
    WHERE `dpt_No` = '$dpt_No' AND `dpt_desc` = '$dpt_desc'";

    $rst1 = $conn->query($sql1);
    $row1 = $rst1->fetch_assoc();

    if ($row1 > 0)
    {
      $dpt_No = $row1['dpt_No'];
      $dpt_desc = $row1['dpt_desc'];
      $old_dpt_desc = $row1['dpt_desc'];
    }
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // $dpt_No = $_POST["dpt_No"];
    $dpt_desc = $_POST["dpt_desc"];

    if ($dpt_desc == "")
    {
      $valid = FALSE;
      echo "<p><div class='reject_div'> * DEPARTMENT NAME is required.</div></p>";
    }

    if($valid)
    {
      $sql2 =
      "UPDATE `department`
      SET  `dpt_desc` = '$dpt_desc'
      WHERE `dpt_No` = '$dpt_No'";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "DEPARTMENT updated.";
        header('Location:../Admin/Department.php');
      }
      else
      {
        echo "<div class='reject_div'>Error: " . $sql2 . "<br>" . $conn->error . "</div>";
      }
    }

    $conn->close();
  }
  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <table class="frm">
      <thead class="frm_hdr">
        <tr>
          <th class="frm_th" colspan="2">Edit Department</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Department No. :</td>
          <td>
            <input type="number" name="dpt_No" value="<?php echo $dpt_No;?>" disabled>
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td>Department Name :</td>
          <td>
            <input type="text" name="dpt_desc" value="<?php echo $dpt_desc;?>" placeholder="Enter Department Name">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <th class="frm_btn"colspan="2">
            <a href="../Admin/Department.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Save">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>
