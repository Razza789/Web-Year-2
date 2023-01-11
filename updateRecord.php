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
// Retrieve the form data and makes sure theres stuff in the field
$recordTitle = filter_has_var(INPUT_GET, 'recordTitle') ? $_GET['recordTitle'] : null;
$recordYear = filter_has_var(INPUT_GET, 'recordYear') ? $_GET['recordYear'] : null;
$recordPrice = filter_has_var(INPUT_GET, 'recordPrice') ? $_GET['recordPrice'] : null;
$catDesc = filter_has_var(INPUT_GET, 'catDesc') ? $_GET['catDesc'] : null;
$pubName = filter_has_var(INPUT_GET, 'pubName') ? $_GET['pubName'] : null;
$recordID = filter_has_var(INPUT_GET, 'recordID') ? $_GET['recordID'] : null;

// Checks if the fields are empty or not
if(empty($recordTitle) || empty($recordYear) || empty($recordPrice) || empty($catDesc) || empty($pubName)){
	echo"There has been error, 1 or more fields is empty";
}
// Updates the database
else{
	$sqlUpdate = "UPDATE nmc_records
	JOIN nmc_category on nmc_records.catID = nmc_category.catID
	JOIN nmc_publisher on nmc_records.pubID = nmc_publisher.pubID
	SET nmc_records.recordTitle = '$recordTitle',
		nmc_records.recordYear = '$recordYear',
		nmc_records.recordPrice = '$recordPrice',
		nmc_category.catDesc = '$catDesc',
		nmc_publisher.pubName = '$pubName'
	WHERE nmc_records.recordID = '$recordID'";

// Execute the update statement
$dbConn->exec($sqlUpdate);
echo"Database updated, return to the <a href='recordList.php'>record list</a>.";
}
?>
</body>
</html>