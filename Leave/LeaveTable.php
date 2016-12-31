<!--
********************
** LeaveTable.php **
********************
-->

<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/list.css">
  <meta charset="UTF-8">
  <title>LGalaxyTime</title>
</head>

<body class="lst_bdy">

  <?php
  include '../Main/navBar.php';
  $cmpMsg = $_SESSION['cmpMsg'];

  echo "<div class='title'>Leave Table</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  $tbl_name="LeaveTable";
  $adjacents = 1;                               // How many adjacent pages should be shown on each side?
  $targetpage = "../Leave/LeaveTable.php"; 	    //your file name  (the name of this file)
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
  FROM `LeaveTable`
  ORDER BY StaffID, LeaveTyp, DateApl
  LIMIT $start, $limit";
  $result = $conn->query($sql);

  /* Setup page vars for display. */
  if ($page == 0) $page = 1;				      	//if no page var is given, default to 1.
  $prev = $page - 1;					    	      	//previous page is page - 1
  $next = $page + 1;					          		//next page is page + 1
  $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
  $lpm1 = $lastpage - 1;					        	//last page minus 1

  ?>

  <table class="lst" id="tblList">
    <thead class="lst_hdr">
      <tr>
        <th class="lst_th">Staff ID</th>
        <th class="lst_th">Date <br> Appl.</th>
        <th class="lst_th">Leave <br> Type</th>
        <th class="lst_th">Approval</th>
        <th class="lst_th">Leave <br> Status</th>
        <th class="lst_th">Date <br> From</th>
        <th class="lst_th">Date <br> To</th>
        <th class="lst_th">No Of <br> Day Appl.</th>
        <th class="lst_th">AL <br> Bal</th>
        <th class="lst_th">ML <br> Bal</th>
        <th class="lst_th">HL <br> Bal</th>
        <th class="lst_th">EL <br> Appl.</th>
        <th class="lst_th">UL <br> Appl.</th>
        <th class="lst_th" colspan="2"></th>
      </tr>
    </thead>

    <tbody>

      <?php

      while( $row = $result->fetch_assoc())
      {
        $DateApl = date("d-m-Y", strtotime($row["DateApl"]));
        $DateFR = date("d-m-Y", strtotime($row["DateFR"]));
        $DateTO = date("d-m-Y", strtotime($row["DateTO"]));
        //echo "DateApl";

        echo
        "
        <tr class='lst_tr'>
        <td class='lst_id'>{$row['StaffID']}</td>
        <td class='lst_dt'>$DateApl</td>
        <td class='lst_td'>{$row['LeaveTyp']}</td>
        <td class='lst_td'>{$row['Approval']}</td>
        <td class='lst_td'>{$row['Status']}</td>
        <td class='lst_dt'>$DateFR</td>
        <td class='lst_dt'>$DateTO</td>
        <td class='lst_td'>{$row['NoOfDay']}</td>
        <td class='lst_td'>{$row['AL_Bal']}</td>
        <td class='lst_td'>{$row['ML_Bal']}</td>
        <td class='lst_td'>{$row['HL_Bal']}</td>
        <td class='lst_td'>{$row['EL_Apl']}</td>
        <td class='lst_td'>{$row['UL_Apl']}</td>
        <td class='lst_btn' onclick='updData($menu)' style='cursor: pointer;'><a>EDT</a></td>
        <td class='lst_btn' onclick='dltData($menu)' style='cursor: pointer;'><a>DLT</a></td>
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

  <script language="javascript">

  function updData(menu)
  {
    //alert("1");
    var tbl = document.getElementById("tblList");
    var getRow = tbl.rows;
    var rowLen = getRow.length;
    var x = 1;
    var y = 0;

    for (x = 0; x < rowLen; x++)
    {
      getRow[x].onclick = function(e)
      {
        StaffID = this.cells[0].innerText;
        LeaveTyp = this.cells[2].innerText;
        DateFR = this.cells[5].innerText;
        DateTO = this.cells[6].innerText;
        NoOfDay = this.cells[7].innerText;
        //alert("2");
        // alert(NoOfDay);

        url = "../Leave/Leave_Edt.php?menu=" + menu + "&StaffID=" + StaffID + "&LeaveTyp=" + LeaveTyp + "&DateFR=" + DateFR + "&DateTO=" + DateTO + "&NoOfDay=" + NoOfDay;
        // alert(url);
        // window.location = url;
      };
    }
  }

  function dltData(menu)
  {
    //alert("3");
    var tbl = document.getElementById("tblList");
    var getRow = tbl.rows;
    var rowLen = getRow.length;
    var x = 1;
    var y = 0;

    for (x = 0; x < rowLen; x++)
    {
      getRow[x].onclick = function(e)
      {
        StaffID = this.cells[0].innerText;
        LeaveTyp = this.cells[2].innerText;
        DateFR = this.cells[5].innerText;
        DateTO = this.cells[6].innerText;
        NoOfDay = this.cells[7].innerText;
        //alert("4");
        // alert(NoOfDay);

        url = "../Leave/Leave_Dlt.php?menu=" + menu + "&StaffID=" + StaffID + "&LeaveTyp=" + LeaveTyp + "&DateFR=" + DateFR + "&DateTO=" + DateTO + "&NoOfDay=" + NoOfDay;
        // alert(url);
        window.location = url;
      };
    }
  }

  </script>
</div>

</body>
</html>
