<!--
*******************
** TimeSheet.php **
*******************
-->

<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Time Sheet</title>
</head>

<body class="lst_bdy">

  <?php
  include '../Main/getSysPar.php';

  $tbl_name="TimeSheet";
  $adjacents = 1;                               // How many adjacent pages should be shown on each side?
  $targetpage = "../TimeSheet/TimeSheet.php"; 	//your file name  (the name of this file)
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
  FROM $tbl_name
  ORDER BY TagID, WrkDate
  LIMIT $start, $limit";
  $result = $conn->query($sql);

  /* Setup page vars for display. */
  if ($page == 0) $page = 1;				      	//if no page var is given, default to 1.
  $prev = $page - 1;					    	      	//previous page is page - 1
  $next = $page + 1;					          		//next page is page + 1
  $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
  $lpm1 = $lastpage - 1;					        	//last page minus 1


  ?>

  <div class="lst_div">
    <p><div class="lst_title">TIME SHEET</div></p>
    <table class="lst" width="auto">
      <thead>
        <tr class='lst_tr'>
          <th class="lst_th">Staff <br> ID</th>
          <th class="lst_th">Date <br> </th>
          <th class="lst_th">Time <br> In</th>
          <th class="lst_th">Break 1<br> Out</th>
          <th class="lst_th">Break 1<br> In</th>
          <th class="lst_th">Lunch <br> Out</th>
          <th class="lst_th">Lunch <br> In</th>
          <th class="lst_th">Break 2<br> Out</th>
          <th class="lst_th">Break 2<br> In</th>
          <th class="lst_th">Time <br> Out</th>
          <th class="lst_th">Working <br> Dur.</th>
          <th class="lst_th">Over Time<br> Duration</th>
          <th class="lst_th">Lunch <br> Dur.</th>
          <th class="lst_th">Break 1<br> Dur.</th>
          <th class="lst_th">Break 2<br> Dur.</th>
        </tr>
      </thead>

      <tbody>
        <?php

        while( $row = $result->fetch_assoc())
        {
          $DateIn = $row["WrkDate"];
          $WrkDate = date("d-m-Y", strtotime($DateIn));
          //echo "$ScanDate";

          echo
          "
          <tr class='lst_tr'>
          <td class='lst_td'>{$row['TagID']}</td>
          <td class='lst_dt'>$WrkDate</td>
          <td class='lst_dt'>{$row['TimeIn']}</td>
          <td class='lst_dt'>{$row['BreakStr1']}</td>
          <td class='lst_dt'>{$row['BreakEnd1']}</td>
          <td class='lst_dt'>{$row['LunchStr']}</td>
          <td class='lst_dt'>{$row['LunchEnd']}</td>
          <td class='lst_dt'>{$row['BreakStr2']}</td>
          <td class='lst_dt'>{$row['BreakEnd2']}</td>
          <td class='lst_dt'>{$row['TimeOut']}</td>
          <td class='lst_dt'>{$row['WrkHour']}</td>
          <td class='lst_dt'>{$row['OT_Dur']}</td>
          <td class='lst_dt'>{$row['LunchDur']}</td>
          <td class='lst_dt'>{$row['BreakDur1']}</td>
          <td class='lst_dt'>{$row['BreakDur2']}</td>
          </tr>
          ";
        }

        $conn->close();

        ?>

      </tbody>
    </table>
  </div>
  <?php include '../Main/pagination.php'; ?>

</body>
</html>
