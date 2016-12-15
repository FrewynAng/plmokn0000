<!--
*****************
** TimeLog.php **
*****************
-->

<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Log File</title>
</head>

<body class="lst_bdy">

  <?php
  include '../Main/getSysPar.php';
  $cmpMsg = $_SESSION['cmpMsg'];

  $tbl_name="TagLog";
  $adjacents = 1;                               // How many adjacent pages should be shown on each side?
  $targetpage = "../TimeLog/TimeLog.php";     	//your file name  (the name of this file)
  $limit = 15; 							                   	//how many items to show per page

  $query = "SELECT COUNT(*) as num FROM $tbl_name";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  $total_pages = $row["num"];
  // echo $total_pages;

  if (isset($_GET["page"]))
  {
    $page = $_GET['page'];
  }
  else
  {
    $page = 1;
  }

  if($page)
  {
    $start = ($page - 1) * $limit;          //first item to display on this page
  }
  else
  {
    $start = 0;                             //if no page var is given, set start to 0
  }

  /* Get data. */
  $sql =
  "SELECT *
  FROM `TagLog`
  ORDER BY TagID, TagDate, TagTime, TagMchNo
  LIMIT $start, $limit";
  $result = $conn->query($sql);

  /* Setup page vars for display. */
  if ($page == 0) $page = 1;				      	//if no page var is given, default to 1.
  $prev = $page - 1;					    	      	//previous page is page - 1
  $next = $page + 1;					          		//next page is page + 1
  $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
  $lpm1 = $lastpage - 1;					        	//last page minus 1

  ?>

  <a href="../TimeLog/uplLogFile.php" target="cdMain">*Upload Log File* </a>
  <a href="../TimeLog/LoadLogFile.php" target="cdMain">*Load Log File*  </a>
  <a href="../TimeLog/ViewPlainLog.php" target="cdMain">*View Loaded File* </a>
  <a href="../TimeLog/ClrPlainLog.php" target="cdMain">*Clear Loaded File* </a></br>

  <p><span class="complete"><?php echo $cmpMsg; ?></span></p>
  <table class="lst">
    <thead>
      <tr>
        <th class="lst_th">Date <br> Loaded</th>
        <th class="lst_th">Tag <br> ID</th>
        <th class="lst_th">Name <br> </th>
        <th class="lst_th">Tag <br> Date</th>
        <th class="lst_th">Tag <br> Time</th>
        <th class="lst_th">Machibe <br> No.</th>
        <th class="lst_th">Tag <br> Method</th>

      </tr>
    </thead>

    <tbody>

      <?php
      while ($row = $result->fetch_assoc())
      {

        $DateIn = $row["TagDate"];
        $TagDate = date("d-m-Y", strtotime($DateIn));
        $DateIn = $row["LoadDate"];
        $LoadDate = date("d-m-Y", strtotime($DateIn));
        //echo "$TagDate";

        echo
        "
        <tr  class='lst_tr'>
        <td class='lst_dt'>$LoadDate</td>
        <td class='lst_td'>{$row['TagID']}</td>
        <td class='lst_td'>{$row['TagName']}</td>
        <td class='lst_dt'>$TagDate</td>
        <td class='lst_td'>{$row['TagTime']}</td>
        <td class='lst_td'>{$row['TagMchNo']}</td>
        <td class='lst_td'>{$row['TagMod']}</td>
        </tr>
        ";
      }


      $conn->close();
      $_SESSION['cmpMsg'] = "";
      $_SESSION['rjtMsg'] = "";

      ?>

    </tbody>
  </table>
  <?php include '../Main/pagination.php'; ?>

</body>
</html>
