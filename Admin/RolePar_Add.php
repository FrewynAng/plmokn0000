<!--
*********************
** RolePar_Add.php **
*********************
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

  echo "<div class='title'>ADD NEW ROLE</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  $valid = TRUE;

  $RoleNo = "";
  $RoleDesc = "";

  $sql1 =
  "SELECT MAX(`RoleNo`) AS max_RoleNo
  FROM `RolePar`";

  $rst1 = $conn->query($sql1);
  $row1 = $rst1->fetch_assoc();

  $RoleNo = $row1["max_RoleNo"] + 1;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // $RoleNo = $_POST["RoleNo"];
    $RoleDesc = $_POST["RoleDesc"];

    if ($RoleDesc == "")
    {
      $valid = FALSE;
      echo "<p><div class='reject_div'> * ROLE NAME is required.</div></p>";
    }

    if($valid)
    {
      $sql2 =
      "INSERT INTO `RolePar` (`RoleNo`, `RoleDesc`)
      VALUES ('$RoleNo', '$RoleDesc');";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "ROLE added.";
        $url = "Location:../Admin/RolePar.php?menu={$menu}";
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
          <th class="frm_th" colspan="2">Add Deparment</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Deparment No. :</td>
          <td>
            <input type="number" name="RoleNo" value="<?php echo $RoleNo;?>" disabled>
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <td>Role Name :</td>
          <td>
            <input type="text" name="RoleDesc" value="<?php echo $RoleDesc;?>" placeholder="Enter Role" autofocus="" required="">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <th class="frm_btn"colspan="2">
            <a href="../Admin/RolePar.php?menu=<?php echo $menu;?>" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>
</div>

</body>
</html>
