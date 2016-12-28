<!--
********************
** Department.php **
********************
-->

<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/list.css">
  <meta charset="UTF-8">
  <title>Holiday Table</title>
</head>

<body class="lst_bdy">

  <?php
  include '../Main/getSysPar.php';
  $cmpMsg = $_SESSION['cmpMsg'];

  $tbl_name = "department";
  $adjacents = 1;                               // How many adjacent pages should be shown on each side?
  $targetpage = "../UserGroup/Department.php";   	//your file name  (the name of this file)
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
  FROM `department`
  ORDER BY dpt_No
  LIMIT $start, $limit";
  $result = $conn->query($sql);

  /* Setup page vars for display. */
  if ($page == 0) $page = 1;				      	//if no page var is given, default to 1.
  $prev = $page - 1;					    	      	//previous page is page - 1
  $next = $page + 1;					          		//next page is page + 1
  $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
  $lpm1 = $lastpage - 1;					        	//last page minus 1

  ?>

  <p><div class="lst_title">DEPARTMENT TABLE</div></p>
  <a href="../Admin/Department_Add.php" target="cdMain">Add Department</a></br></br>
  <p><span class="complete"><?php echo $cmpMsg; ?></span></p>
  <table class="lst" id="tblList">
    <thead class="lst_hdr">
      <tr>
        <th class="lst_th">Department <br>No. </th>
        <th class="lst_th">Department <br> </th>
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
        <td class='lst_td'>{$row['dpt_No']}</td>
        <td class='lst_td'>{$row['dpt_desc']}</td>
        <td class='lst_btn' onclick='updData()' style='cursor: pointer;'><a>EDT</a></td>
        <td class='lst_btn' onclick='dltData()' style='cursor: pointer;'><a>DLT</a></td>
        </tr>
        ";
      }

      echo
      "
      </tbody>
      </table>
      ";

      include '../Main/pagination.php';
      $conn->close();
      $_SESSION['cmpMsg'] = "";
      $_SESSION['rjtMsg'] = "";
      ?>


      <script language="javascript">

      function updData()
      {
        // alert("1");
        var tbl = document.getElementById("tblList");
        var getRow = tbl.rows;
        var rowLen = getRow.length;
        var x = 1;
        var y = 0;

        var dpt_No = 0;
        var dpt_desc = "";

        for (x = 0; x < rowLen; x++)
        {
          getRow[x].onclick = function(e)
          {
            dpt_No = this.cells[0].innerText;
            dpt_desc = this.cells[1].innerText;
            //alert("2");
            //alert(UsrAccSeq);
            url = "../UserGroup/Department_Edt.php?dpt_No=" + dpt_No + "&dpt_desc=" + dpt_desc;
            //alert(url)
            window.location = url;
          };
        }
      }

      function dltData()
      {
        //alert("3");
        var tbl = document.getElementById("tblList");
        var getRow = tbl.rows;
        var rowLen = getRow.length;
        var x = 1;
        var y = 0;

        var dpt_No = 0;
        var dpt_desc = "";

        for (x = 0; x < rowLen; x++)
        {
          getRow[x].onclick = function(e)
          {
            dpt_No = this.cells[0].innerText;
            dpt_desc = this.cells[1].innerText;
            //alert("3");
            //alert(UsrAccSeq);
            url = "../UserGroup/Department_Dlt.php?dpt_No=" + dpt_No + "&dpt_desc=" + dpt_desc;
            //alert(url)
            window.location = url;
          };
        }
      }
      </script>

    </body>
    </html>
