<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<title>updateRecordForm.php - creating hyperlinks to click on to edit a movie</title>
</head>
<body>
<nav>
        <ul>
         <li><a href="home.html">Home</a></li> 
			   <li><a href="orderRecordsForm.php">Order Records</a></li> 
			   <li><a href="logout.php">Logout</a></li> 
			    <li><a href="credits.html">Credits</a></li>
        </ul>
    </nav>
<h1>All Records.</h1>
<?php
try {
	require_once("functions.php");
	$dbConn = getConnection();

	//SQL statement which gets the data from the database
	$sqlQuery = "SELECT recordID, recordTitle, recordYear, recordPrice, nmc_category.catDesc, nmc_publisher.pubName
				 FROM nmc_records
				 INNER JOIN nmc_category on nmc_records.catID = nmc_category.catID
				 INNER JOIN nmc_publisher on nmc_records.pubID = nmc_publisher.pubID
				 ORDER BY recordTitle";
	$queryResult = $dbConn->query($sqlQuery);
//Displays all of the records from the database 
	while ($rowObj = $queryResult->fetchObject()) {
		echo "<div class='record'>\n
				   <span class='title'><a href='updateRecordForm.php?recordID={$rowObj->recordID}'>{$rowObj->recordTitle}</a></span>\n
				   <br>
				   <span class='recordID'>ID {$rowObj->recordID},</span>\n
				   <span class='recordYear'>Year {$rowObj->recordYear},</span>\n
				   <span class='recordPrice'>Price £{$rowObj->recordPrice},</span>\n
				   <span class='category'>Category: {$rowObj->catDesc}, </span>\n
				   <span class='publisher'>Publisher: {$rowObj->pubName}</span>\n
				   <br>
				   <br>
			  </div>\n";
	}
}
catch (Exception $e){
	echo "<p>Query failed: ".$e->getMessage()."</p>\n";
}
?>

</body>
</html>