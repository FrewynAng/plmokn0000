<!--
****************
** LogOut.php **
****************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Log Out</title>
</head>

<body class="footer">

  <?php
  include '../Main/getSysPar.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {

    $_SESSION['UsrID'] = "LogOut";
    $_SESSION['UsrGrp'] = "000";
    //session_unset();
    session_destroy();
    header('Location:../Main/Login.php');
  }

  $conn->close();
  ?>

  <div class="gmail-nav__nav-links-wrap">
     <a class="gmail-nav__nav-link gmail-nav__nav-link__for-work" ng-click="navCtrl.trackNavClick(&#39;Navigation&#39;, &#39;for work&#39;)" data-g-label="For work" href="https://www.google.com/gmail/about/for-work/" tabindex="3">For Work</a>
     <a class="gmail-nav__nav-link gmail-nav__nav-link__sign-in" ng-click="navCtrl.trackNavClick(&#39;Navigation&#39;, &#39;sign in&#39;)" data-g-label="Sign in" href="https://accounts.google.com/ServiceLogin?service=mail&amp;continue=https://mail.google.com/mail/" tabindex="1">Sign In</a>
     <a class="gmail-nav__nav-link gmail-nav__nav-link__create-account" ng-click="navCtrl.trackNavClick(&#39;Create Account&#39;, &#39;desktop&#39;)" data-g-label="Create an account button" href="https://accounts.google.com/SignUp?service=mail&amp;continue=https://mail.google.com/mail/?pc=topnav-about-en" target="_blank" tabindex="2">Create an account</a>
     <a class="gmail-nav__nav-link gmail-nav__nav-link__get-gmail" ng-click="navCtrl.trackNavClick(&#39;Create Account&#39;, &#39;mobile&#39;)" data-g-label="Create an account button" href="https://accounts.google.com/SignUp?service=mail&amp;continue=https://mail.google.com/mail/?pc=topnav-about-en" target="_blank" tabindex="2">Get Gmail</a>
 </div>

</body>
</html>
