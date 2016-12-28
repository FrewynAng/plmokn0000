<!--
*******************
** StaffMAst.php **
*******************
-->

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Staff Master</title>
</head>

<body class="lst_bdy">

  <?php
  include '../Main/getSysPar.php';
  $cmpMsg = $_SESSION['cmpMsg'];

  $tbl_name="StaffMaster";
  $adjacents = 1;                               // How many adjacent pages should be shown on each side?
  $targetpage = "../Staff/Stf_BirthD.php";     	//your file name  (the name of this file)
  $limit = 15; 							                   	//how many items to show per page

  $DTFR = date("m-d");
  // echo $DTFR;

  $query =
  "SELECT COUNT(*)
  AS num
  FROM $tbl_name
  WHERE substring(DOB, 6, 5) = '$DTFR'";
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
  "SELECT StaffID, Name, DOB, Gender, PhoneNo
  FROM `StaffMaster`
  WHERE substring(DOB, 6, 5) = '$DTFR'
  ORDER BY Name
  LIMIT $start, $limit";
  $result = $conn->query($sql);

  /* Setup page vars for display. */
  if ($page == 0) $page = 1;				      	//if no page var is given, default to 1.
  $prev = $page - 1;					    	      	//previous page is page - 1
  $next = $page + 1;					          		//next page is page + 1
  $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
  $lpm1 = $lastpage - 1;					        	//last page minus 1

  ?>


  <p><div class="lst_title">BIRTHDAY STAR OF THE DAY</div></p>
  <table class="lst" id="tblList" align="center">
    <thead class="lst_hdr">
      <tr>
        <th class="lst_th">Staff <br> ID</th>
        <th class="lst_th">Name</th>
        <th class="lst_th">Gender</th>
        <th class="lst_th">Date <br> Of Birth</th>
      </tr>
    </thead>

    <tbody class="">

      <?php
      while( $row = $result->fetch_assoc())
      {
        $DOB = date("d-m-Y", strtotime($row["DOB"]));
        //echo "$DOB";

        echo
        "
        <tr class='lst_tr'>
        <td class='lst_id'>{$row['StaffID']}</td>
        <td class='lst_td'>{$row['Name']}</td>
        <td class='lst_td'>{$row['Gender']}</td>
        <td class='lst_dt'>$DOB</td>
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

  function updData()
  {
    //alert("1");
    var tbl = document.getElementById("tblList");
    var getRow = tbl.rows;
    var rowLen = getRow.length;
    var x = 1;
    var y = 0;

    var StaffID = "";

    for (x = 0; x < rowLen; x++)
    {
      getRow[x].onclick = function(e)
      {
        StaffID = this.cells[0].innerText;
        //alert("4");
        //alert(HDate);
        // url = "../Staff/Staff_Dlt.php?StaffID=" + StaffID;
        //window.location = url;
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

    var StaffID = "";

    for (x = 0; x < rowLen; x++)
    {
      getRow[x].onclick = function(e)
      {
        // StaffID = this.cells[0].innerText;
        //alert("4");
        //alert(HDate);
        // url = "../Staff/Staff_Dlt.php?StaffID=" + StaffID;
        // window.location = url;
      };
    }
  }


  </script>

</body>
</html>
