<?php
  include 'functions.php';

?>

<!doctype html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8">
    <title>Results</title>
</head>
<body>
<?php
try{
	$recordID = filter_has_var(INPUT_GET,'recordID') ? $_GET['recordID']:null;
	require_once("functions.php");
	$dbConn = getConnection();

	// The SQL statement which gathers the records from the database
	$sqlQuery = "SELECT recordID, recordTitle, recordYear, recordPrice, nmc_category.catDesc, nmc_publisher.pubName
	FROM nmc_records 
	INNER JOIN nmc_category on nmc_records.catID = nmc_category.catID
	INNER JOIN nmc_publisher on nmc_records.pubID = nmc_publisher.pubID
	WHERE recordID = $recordID ORDER BY recordTitle";

	$queryResult = $dbConn->query($sqlQuery);

	//Form which will show the records information which can be changed
	while ($rowObj = $queryResult->fetchObject()) {
	echo "
	<h1>Update '{$rowObj->recordTitle}'</h1>
	<form action='updateRecord.php' method='get'>
		<p>recordID <input type='text' name='recordID' value='{$rowObj->recordID}' readonly/></p>
		<p>recordTitle <input type='text' name='recordTitle' size='50' value='{$rowObj->recordTitle}' /></p>
		<p>recordYear <input type='text' name='recordYear' value='{$rowObj->recordYear}' /></p>
		<p>recordPrice <input type='text' name='recordPrice' value='{$rowObj->recordPrice}' /></p>
		<p>catDesc <input type='text' name='catDesc' value='{$rowObj->catDesc}' /></p>
		<p>pubName <input type='text' name='pubName' value='{$rowObj->pubName}' /></p>
		<br />
		<p><input type='submit' name='submit' value='Update record'></p>
	</form>";
	}
}
catch(Exception $e){
	echo "<p>record details not found: ".$e->getMessage()."</p>\n";
}

?>
</body>
</html>