<!--
************************
** Department_Add.php **
************************
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

  echo "<div class='title'>ADD NEW DEPARTMENT</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  $dpt_No = "";
  $dpt_desc = "";

  $sql1 =
  "SELECT MAX(`dpt_No`) AS max_dpt_No
  FROM `department`";

  $rst1 = $conn->query($sql1);
  $row1 = $rst1->fetch_assoc();

  $dpt_No = $row1["max_dpt_No"] + 1;

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
      "INSERT INTO `department` (`dpt_No`, `dpt_desc`)
      VALUES ('$dpt_No', '$dpt_desc');";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "DEPARTMENT added.";
        $url = "Location:../Admin/Department.php?menu={$menu}";
        header($url);
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
          <th class="frm_th" colspan="2">Add Department</th>
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
            <input type="text" name="dpt_desc" value="<?php echo $dpt_desc;?>" placeholder="Enter Department Name" autofocus="" required="">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <th class="frm_btn"colspan="2">
            <a href="../Admin/Department.php?menu=<?php echo $menu;?> " target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>
</div>

</body>
</html>
