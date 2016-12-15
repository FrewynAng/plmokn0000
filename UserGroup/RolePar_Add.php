<!--
*********************
** RolePar_Add.php **
*********************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Add Role</title>
</head>

<body>
  <?php
  include '../Main/getSysPar.php';
  $rjtMsg = "";
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
      $rjtMsg = "* ROLE NAME is required";
      $valid = FALSE;
    }

    if($valid)
    {
      $sql2 =
      "INSERT INTO `RolePar` (`RoleNo`, `RoleDesc`)
      VALUES ('$RoleNo', '$RoleDesc');";

      if ($conn->query($sql2) === TRUE)
      {
        $_SESSION['cmpMsg'] = "ROLE added.";
        header('Location:../UserGroup/RolePar.php');
      }
      else
      {
        $_SESSION['cmpMsg'] = "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    $conn->close();
  }


  ?>

  <p><span class="reject"><?php echo $rjtMsg; ?></span></p>
  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
            <input type="text" name="RoleDesc" value="<?php echo $RoleDesc;?>">
            <span class="reject">*</span>
          </td>
        </tr>

        <tr>
          <th class="frm_btn"colspan="2">
            <a href="../UserGroup/RolePar.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>