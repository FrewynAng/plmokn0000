<!--
**********************
** ShfGrp.php **
**********************
-->

<!doctype html>
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

  echo "<div class='title'>SHIFT GROUP</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  $tbl_name="StfShfGrp";
  $adjacents = 1;                               // How many adjacent pages should be shown on each side?
  $targetpage = "../TimeSheet/StfShfGrp.php"; 	//your file name  (the name of this file)
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
  ORDER BY `ShfNo`, `StaffID`
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
        <th class="lst_th">Shift <br> No.</th>
        <th class="lst_th">Shift <br> Desc</th>
        <th class="lst_th">Staff <br> ID</th>
        <th class="lst_th">Tagging <br> ID</th>
        <th class="lst_th">Staff <br> Name</th>
        <th class="lst_th" colspan="2"></th>
      </tr>
    </thead>

    <tbody>
      <?php
      //include '../Main/chgDateFmt.php';

      while($row = $result->fetch_assoc())
      {
        echo "
        <tr class='lst_tr'>
        <td class='lst_td'>{$row['ShfNo']}</td>
        <td class='lst_td'>{$row['ShfGrpDsc']}</td>
        <td class='lst_id'>{$row['StaffID']}</td>
        <td class='lst_id'>{$row['TagID']}</td>
        <td class='lst_td'>{$row['StaffNam']}</td>
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

  <script language="javascript">

  function updData(menu)
  {
    //alert("1");
    var tbl = document.getElementById("tblList");
    var getRow = tbl.rows;
    var rowLen = getRow.length;
    var x = 1;
    var y = 0;

    var ShfNo = "";
    var StaffID = "";

    for (x = 0; x < rowLen; x++)
    {
      getRow[x].onclick = function(e)
      {
        ShfNo = this.cells[0].innerText;
        StaffID = this.cells[2].innerText;
        //alert("2");
        //alert(ShfGrp);
        url = "../TimeSheet/StfShfGrp_Edt.php?menu=" + menu + "&ShfNo=" + ShfNo + "&StaffID=" + StaffID;
        window.location = url;
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

    var ShfNo = "";
    var StaffID = "";

    for (x = 0; x < rowLen; x++)
    {
      getRow[x].onclick = function(e)
      {
        ShfNo = this.cells[0].innerText;
        StaffID = this.cells[2].innerText;
        //alert("4");
        //alert(ShfGrp);
        url = "../TimeSheet/ShfGrp_Dlt.php?menu=" + menu + "&ShfNo=" + ShfNo + "&StaffID=" + StaffID;
        window.location = url;
      };
    }
  }

  </script>
</div>

</body>
</html>
