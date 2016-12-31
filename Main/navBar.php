<!--
****************
** navBar.php **
****************
-->

<?php
session_start();
include '../Main/getSysPar.php';
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/navBar.css">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>GalaxyTime</title>
</head>

<body class="nsv_body">
  <?php
  if (isset($_GET["menu"]))
  {
    $menu = $_GET['menu'];
  }
  else
  {
    $menu = 0;
  }
  ?>

  <div class="nav_div">

    <ul class="topnav">
      <li class="menu_btn"><a href="http://galaxytime.online">GalaxyTime</a></li>
      <?php if ($menu == 0)
      {
        echo "<li class='active menu_btn'>";
      }
      else
      {
        echo "<li class='menu_btn'>";
      }
      ?>
      <a href="../Staff/Stf_BirthD.php">Home</a></li>

      <?php if ($menu == 1)
      {
        echo "<li class='dropdown active'>";
      }
      else
      {
        echo "<li class='dropdown'>";
      }
      ?>
      <a href="javascript:void(0)" class="dropbtn">Staff Managment</a>
      <div class="dropdown-content">
        <?php
        $sql =
        "SELECT *
        FROM `UsrGrpPar`
        WHERE `UsrGrp` = '{$_SESSION['UsrGrp']}' AND 	`UsrAccSeq` >= 1 AND 	`UsrAccSeq` < 2
        ORDER BY UsrGrp, UsrAccSeq";
        //execute the SQL query and return records
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc())
        {
          // $url ="<a href='" . $row['UsrAccLink'] . "' target='cdMain'>" . $row['UsrAccDsc'] . "</a><br>";
          $url ="<a class='' href={$row['UsrAccLink']}>{$row['UsrAccDsc']}</a>";
          echo $url;
        }
        ?>
      </div>
    </li>

    <?php if ($menu == 2)
    {
      echo "<li class='dropdown active'>";
    }
    else
    {
      echo "<li class='dropdown'>";
    }
    ?>
    <a href="javascript:void(0)" class="dropbtn">Shift Managment</a>
    <div class="dropdown-content">
      <?php
      $sql =
      "SELECT *
      FROM `UsrGrpPar`
      WHERE `UsrGrp` = '{$_SESSION['UsrGrp']}' AND 	`UsrAccSeq` >= 2 AND 	`UsrAccSeq` < 3
      ORDER BY UsrGrp, UsrAccSeq";
      //execute the SQL query and return records
      $result = $conn->query($sql);

      while($row = $result->fetch_assoc())
      {
        if ($row['UsrAccSeq'] == 2.3)
        {
          // echo "<li class='divider'></li>";
        }
        // $url ="<a href='" . $row['UsrAccLink'] . "' target='cdMain'>" . $row['UsrAccDsc'] . "</a><br>";
        $url ="<a class='' href={$row['UsrAccLink']}>{$row['UsrAccDsc']}</a>";
        echo $url;
      }
      ?>
    </div>
  </li>

  <?php if ($menu == 3)
  {
    echo "<li class='dropdown active'>";
  }
  else
  {
    echo "<li class='dropdown'>";
  }
  ?>
  <a href="javascript:void(0)" class="dropbtn">Attendance Sheet</a>
  <div class="dropdown-content">
    <?php
    $sql =
    "SELECT *
    FROM `UsrGrpPar`
    WHERE `UsrGrp` = '{$_SESSION['UsrGrp']}' AND 	`UsrAccSeq` >= 3 AND 	`UsrAccSeq` < 4
    ORDER BY UsrGrp, UsrAccSeq";
    //execute the SQL query and return records
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc())
    {
      // $url ="<a href='" . $row['UsrAccLink'] . "' target='cdMain'>" . $row['UsrAccDsc'] . "</a><br>";
      $url ="<a class='' href={$row['UsrAccLink']}>{$row['UsrAccDsc']}</a>";
      echo $url;
    }
    ?>
  </div>
</li>

<?php if ($menu == 4)
{
  echo "<li class='dropdown active'>";
}
else
{
  echo "<li class='dropdown'>";
}
?>
<a href="javascript:void(0)" class="dropbtn">Attendance Log</a>
<div class="dropdown-content">
  <?php
  $sql =
  "SELECT *
  FROM `UsrGrpPar`
  WHERE `UsrGrp` = '{$_SESSION['UsrGrp']}' AND 	`UsrAccSeq` >= 4 AND 	`UsrAccSeq` < 5
  ORDER BY UsrGrp, UsrAccSeq";
  //execute the SQL query and return records
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc())
  {
    // $url ="<a href='" . $row['UsrAccLink'] . "' target='cdMain'>" . $row['UsrAccDsc'] . "</a><br>";
    $url ="<a class='' href={$row['UsrAccLink']}>{$row['UsrAccDsc']}</a>";
    echo $url;
  }
  ?>
</div>
</li>

<?php if ($menu == 5)
{
  echo "<li class='dropdown active'>";
}
else
{
  echo "<li class='dropdown'>";
}
?>
<a href="javascript:void(0)" class="dropbtn">System Setting</a>
<div class="dropdown-content">
  <?php
  $sql =
  "SELECT *
  FROM `UsrGrpPar`
  WHERE `UsrGrp` = '{$_SESSION['UsrGrp']}' AND 	`UsrAccSeq` >= 5 AND 	`UsrAccSeq` < 6
  ORDER BY UsrGrp, UsrAccSeq";
  //execute the SQL query and return records
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc())
  {
    // $url ="<a href='" . $row['UsrAccLink'] . "' target='cdMain'>" . $row['UsrAccDsc'] . "</a><br>";
    $url ="<a class='' href={$row['UsrAccLink']}>{$row['UsrAccDsc']}</a>";
    echo $url;
  }
  ?>
</div>
</li>

<li class="nav_right"><a class="logout" href="../Main/LogOut.php?LogOut=LogOut">Log Out</a></li>

</ul>

</div>


</body>
</html>
