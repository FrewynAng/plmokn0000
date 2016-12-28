<!--
*********************
** UserGrp_Add.php **
*********************
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
  $valid = true;

  $UsrID = "";
  $UsrPass = "";
  $UsrGrp = "";
  $UsrSts = "";
  $valid = TRUE;

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $UsrID = $_POST['UsrID'];
    $UsrPass = $_POST['UsrPass'];
    $UsrGrp = $_POST['UsrGrp'];
    $UsrSts = $_POST['UsrSts'];

    if (empty($_POST["UsrID"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * USER ID is required.</div></p>";
    }

    if (empty($_POST["UsrPass"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * USER PASSWORD is required.</div></p>";
    }

    if (empty($_POST["UsrGrp"]))
    {
      $valid = false;
      echo "<p><div class='reject_div'> * USER GROUP ACCESS is required.</div></p>";
    }

    if($valid)
    {
      echo $sql =
      "INSERT INTO `UsrLogin` (`UsrID`, `UsrPass`, `UsrGrp`, `UsrSts`)
      VALUES ('$UsrID', '$UsrPass', '$UsrGrp', '$UsrSts');";

      if ($conn->query($sql) === TRUE)
      {
        $_SESSION['cmpMsg'] = "User added.";
        header('Location:../Admin/UserLogin.php');
      }
      else
      {
        echo "<div class='reject_div'>Error: " . $sql . "<br>" . $conn->error . "</div>";
      }
      $conn->close();
    }
  }

  ?>

  <form method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <p><div class="lst_title">ADD LOGIN USER</div></p>
    <table class="frm">
      <thead class="frm_hdr">
        <tr>
          <th class="frm_th" colspan="2">Add User</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td class="frm_td">User Login ID :</td>
          <td class="frm_td">
            <input type="text" name="UsrID" value="<?php echo $UsrID;?>" autofocus>
            <span class="reject">*</span>
            <td></td>
            <td></td>
          </td>
        </tr>

        <tr>
          <td class="frm_td">User Login Password :</td>
          <td class="frm_td">
            <input type="password" name="UsrPass" value="<?php echo $UsrPass;?>">
            <span class="reject">*</span>
            <td></td>
            <td></td>
          </td>
        </tr>

        <tr>
          <td class="frm_td">User Access Group :</td>
          <td class="frm_td">
            <select name="UsrGrp">
              <option value="" selected>-- User Access --</option>
              <?php

              echo $sql2 =
              "SELECT UsrGrp, UsrGrpNam
              FROM `UsrGrpPar`
              GROUP BY UsrGrp";
              $result = $conn->query($sql2);

              while( $row2 = $result->fetch_assoc())
              {
                echo "<option value='{$row2['UsrGrp']}'>{$row2['UsrGrp']} - {$row2['UsrGrpNam']}</option>";
              }

              ?>
            </select>
            <span class="reject">*</span>
            <td></td>
            <td></td>
          </td>
        </tr>

        <tr>
          <td class="frm_td">User Account Status :</td>
          <td class="frm_td">
            <select name="UsrSts">
              <option value="A">Actice</option>
              <option value="E">Expired</option>
            </select>
            <span class="reject">*</span>
            <td></td>
            <td></td>
          </td>
        </tr>

        <tr>
          <th class="frm_btn" colspan="4">
            <a href="../Admin/UserLogin.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Add">
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>
