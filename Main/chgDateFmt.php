<!--
********************
** chgDateFmt.php **
********************
-->

<?php session_start(); ?>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Change Date Display</title>
</head>

<body>

  <?php

  function chgDateFmt($DateIn)
  {
    $DD = substr("$DateIn",  8, 2);
    $MM = substr("$DateIn",  5, 2);
    $YY = substr("$DateIn",  0, 4);

    //echo "$DD";
    //echo "$MM";
    //echo "$YY";

    $DateIn = $DD . "-" . $MM . "-" . $YY;
    //echo "$DateIn";
    return $DateIn;
  }

  ?>

</body>
</html>
