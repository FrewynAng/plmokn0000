<!--
********************
** uplLogFile.php **
********************
-->

<?php session_start(); ?>

<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Upload Log File</title>
</head>

<body>

  <?php
  include '../Main/getSysPar.php';
  $rjtMsg = "";

  if (!empty($_FILES['LogFile_']))
  {
    $file = $_FILES['LogFile_'];
    // print_r($file);

    // file properties
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_err = $file['error'];
    // echo $file['error'];

    // file extension
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allow = array('txt', 'jpg');

    if (in_array($file_ext, $allow))
    {
      if ($file_err == 0)
      {
          if ($file_size <= 2097152)
          {
            // $file_name_new = uniqid('', true) . "." . $file_ext;
            $file_name_new = $file_name . "_" . date("Ymd_His") . "." . $file_ext;
            $_SESSION['LogFile'] = $file_name_new;
            $file_dest = "../Timelog/LogFile/" . $file_name_new;

            if (move_uploaded_file($file_tmp, $file_dest))
            {
              echo "File Uploaded.<br>";
            }
          }
      }

    }

  }

  $conn->close();
  ?>


</body>
</html>
