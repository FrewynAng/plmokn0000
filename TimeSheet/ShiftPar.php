<!--
******************
** ShiftPar.php **
******************
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

  echo "<div class='title'>SHIFT MAINTENANCE</div>";
  echo "<div class='complete'>{$cmpMsg}</div>";

  echo "<div class='container'>";

  $sql = "SELECT * FROM `shiftpar` order by SH_No";
  //execute the SQL query and return records
  $result = $conn->query($sql);
  ?>

  <table class="lst" id="tblList">
    <thead class="lst_hdr">
      <tr>
        <th class="lst_th">Shift <br> Number</th>
        <th class="lst_th">Shift <br> Name</th>
        <th class="lst_th">Shift <br> Working Day</th>
        <th class="lst_th">Shift <br> Working Hour</th>
        <th class="lst_th" colspan="2"></th>
      </tr>
    </thead>

    <tbody>

      <?php
      while($row = $result->fetch_assoc())
      {
        //$HDate = date("d-m-Y", strtotime($row["HDate"]));
        //echo "$HDate";

        echo "
        <tr class='lst_tr'>
        <td class='lst_td'>{$row['SH_No']}</td>
        <td class='lst_td'>{$row['SH_Name']}</td>
        <td class='lst_td'>{$row['SH_WrkDay']}</td>
        <td class='lst_td'>{$row['SH_WrkHour']} Hour(s)</td>
        <td class='lst_btn' onclick='updData($menu)' style='cursor: pointer;'><a>EDT</a></td>
        <td class='lst_btn' onclick='dltData($menu)' style='cursor: pointer;'><a>DLT</a></td>
        </tr>
        ";
      }

      echo
      "
      </tbody>
      </table>
      ";

      $conn->close();
      $_SESSION['cmpMsg'] = "";
      $_SESSION['rjtMsg'] = "";

      ?>

      <script language="javascript">

      function updData(menu)
      {
        // alert("1");
        var tbl = document.getElementById("tblList");
        var getRow = tbl.rows;
        var rowLen = getRow.length;
        var x = 1;
        var y = 0;

        var SH_No = 0;

        for (x = 0; x < rowLen; x++)
        {
          getRow[x].onclick = function(e)
          {
            SH_No = this.cells[0].innerText;
            //alert("2");
            //alert(SH_No);
            url = "../TimeSheet/ShiftPar_Edt.php?menu=" + menu + "&SH_No=" + SH_No;
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

        var SH_No = 9;

        for (x = 0; x < rowLen; x++)
        {
          getRow[x].onclick = function(e)
          {
            SH_No = this.cells[0].innerText;
            //alert("4");
            //alert(SH_No);
            url = "../TimeSheet/ShiftPar_Dlt.php?menu=" + menu + "&SH_No=" + SH_No;
            window.location = url;
          };
        }
      }
      </script>
    </div>

  </body>
  </html>
