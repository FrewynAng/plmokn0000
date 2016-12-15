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
            echo "<p><span class='complete'>File Uploaded.</span></p>";
            include "../TimeLog/LoadLogFile.php";
          }
        }
      }

    }

  }

  $conn->close();
  ?>

  <p><span class="reject"><?php echo $rjtMsg; ?></span></p>
  <form method="post" enctype="multipart/form-data" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <table class="frm">
      <thead class="frm_hdr">

        <tr>
          <th class="frm_th">Log File Upload </strong></th>
        </tr>

        <tr>
          <td>Select file<input type="file" name="LogFile_" size="50" /></td>
        </tr>

        <tr>
          <th class="frm_btn" colspan="4">
            <a href="../Staff/Stf_BirthD.php" target="_self"><input type="button" onclick="" value="Cancel"/></a>
            <input type="submit" value="Upload"/>
          </th>
        </tr>

      </tbody>
    </table>
  </form>

</body>
</html>
