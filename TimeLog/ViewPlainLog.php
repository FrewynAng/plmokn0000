<!--
**********************
** ViewPlainLog.php **
**********************
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/list.css">
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body class="lst_bdy">

  <?php
  include '../Main/navBar.php';
  $cmpMsg = $_SESSION['cmpMsg'];
  $valid = TRUE;

  echo "<div class='title'>View Loaded Log File (Plain Text)</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  $sql = "SELECT * FROM `PlainLog`";
  //execute the SQL query and return records
  $result = $conn->query($sql);

  if ($result->num_rows > 0)
  {
    //output data of each row
    while($row = $result->fetch_assoc())
    {
      echo "Log : <b style='color:blue'>" . $row["Log"]  . "</b>" . " Time : " . $row["TimeLd_"] . "<br>";
    }
  }
  else
  {
    echo "0 results </br>" ;
  }

  $conn->close();
  ?>
</div>


</body>
</html>
