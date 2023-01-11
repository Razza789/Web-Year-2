<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Northumbria Music Company</title>
</head>
<body>
<?php ini_set("session.save_path", "/home/unn_w20017978/sessionData");session_start();
if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
}
    else {
        echo "<p>Session no set</p>\n";
    }
?>
</body>
</html>
