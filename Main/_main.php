<!--
***************
** _main.php **
***************
-->

<?php session_start(); ?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <title>Galaxy Time System</title>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
</head>

<frameset rows="12%,5%,*" bordercolor="#6699cc" border="0" framespacing="0" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
  <frame name="Head" src="../Main/Header.php" scrolling="no" target="_self">
  <frame name="Foot" src="../Main/LogOut.php" scrolling="no" target="_self">

  <frameset cols="12%,*" bordercolor="#6699cc" border="0" framespacing="0" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
    <frameset rows="30px,*," border="0" bordercolor="#6699cc">
      <frame name="MenuHeader" src="../Main/MenuHdr.php" scrolling="auto" target="_self">
      <frame name="Menu" src="../Main/Menu.php" scrolling="no" target="_self">
    </frameset>

    <frameset style="border-width:50px" bordercolor="#6699cc">
      <frame name="cdMain" src="../Staff/Stf_BirthD.php" scrolling="auto" target="_self">
    </frameset>


  </frameset>

</frameset>


</html>
