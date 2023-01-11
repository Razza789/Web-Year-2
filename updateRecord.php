<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<title>Record Updated</title>
</head>
<body>
<?php
include 'functions.php';
$dbConn = getConnection();
// Retrieve the form data
$recordTitle = filter_has_var(INPUT_GET, 'recordTitle') ? $_GET['recordTitle'] : null;
$recordYear = filter_has_var(INPUT_GET, 'recordYear') ? $_GET['recordYear'] : null;
$recordPrice = filter_has_var(INPUT_GET, 'recordPrice') ? $_GET['recordPrice'] : null;
$catDesc = filter_has_var(INPUT_GET, 'catDesc') ? $_GET['catDesc'] : null;
$pubName = filter_has_var(INPUT_GET, 'pubName') ? $_GET['pubName'] : null;
$recordID = filter_has_var(INPUT_GET, 'recordID') ? $_GET['recordID'] : null;

// The SQL UPDATE statement
if(empty($recordTitle) || empty($recordYear) || empty($recordPrice) || empty($catDesc) || empty($pubName)){
	echo"There has been error, 1 or more fields is empty";
}
// Couldn't get the records to actually update in the database
else{
	$sqlUpdate = "UPDATE nmc_records 
				  SET recordTitle = '$recordTitle', recordYear = '$recordYear', recordPrice = '$recordPrice', catDesc = '$catDesc', pubName = '$pubName'
				  WHERE recordID = '$recordID'";

// Execute the update statement
$dbConn->exec($sqlUpdate);
}
?>
</body>
</html>