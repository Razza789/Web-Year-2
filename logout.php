<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Northumbria Music Company</title>
</head>
<body>
<?php 
//Logs out of the session and detroys it
ini_set("session.save_path", "/home/unn_w20017978/sessionData");session_start();$_SESSION = array();session_destroy();

echo "<p> You have been logged out. Please return <a href='home.html'>home</a>. </p>\n";
?>
</body>
</html>
