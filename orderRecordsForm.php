<!-- This script contains code to build a web page with a form. It includes a PHP code to dynamically generate the html to display one checkbox for each of the toys currently held in the NMC_records database table within the form. The user can select one or more records that they are interested in ordering by clicking the checkboxes. Use the browser to look at the structure of the html generated by the php code.

You MUST NOT in any way change the php code provided OR the code within the FORM tags.

You MAY add Javascript for task 4.
You MAY modify the page to add your own navigation menu and link to your own stylesheet using additional html or php. However, please note that styling will not be marked for this assignment. -->

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order Records</title>
</head>
<body>
<nav>
        <ul>
         <li><a href="home.html">Home</a></li> 
			   <li><a href="loginform.html">Login</a></li> 
			   <li><a href="orderRecordsForm.php">Order Records</a></li> 
			    <li><a href="credits.html">Credits</a></li>
        </ul>
    </nav>
<h1>Order Recordss</h1>

<form id="orderForm" action="javascript:alert('form submitted');" method="get">
	<section id="orderRecords">
		<h2>Select Records</h2>
<?php
try {
	// include the file with the function for the database connection
	require_once('functions.php');
	// get database connection
	$dbConn = getConnection();
	$sqlRecords = 'SELECT recordID, recordTitle, catDesc, pubName, recordPrice FROM nmc_records r INNER JOIN nmc_category c ON r.catID = c.catID INNER JOIN nmc_publisher p ON r.pubID = p.pubID ORDER BY recordTitle';

	// execute the query
	$rsRecords = $dbConn->query($sqlRecords);

	while ($record = $rsRecords->fetchObject()) {
		$recordTitle = $record->recordTitle;
		echo "\t<div class='item'>
				<span class='recordTitle'>".filter_var($recordTitle, FILTER_SANITIZE_SPECIAL_CHARS)."</span>
	            <span class='catDesc'>{$record->catDesc}</span>
	         	<span class='pubName'>{$record->pubName}</span>
	            <span class='recordPrice'>{$record->recordPrice}</span>
	            <span class='chosen'><input type='checkbox' name='record[]' value='{$record->recordID}' data-price='{$record->recordPrice}'></span>
	      		</div>\n";
	}
}
catch (Exception $e) {
	echo "Problem " . $e->getMessage();
}
?>
	</section>
	<section id="collection">
		<h2>Collection method</h2>
		<p>Please select whether you want your chosen record(s) to be delivered to your home address (a charge applies for this) or whether you want to collect them yourself.</p>
		<p>
		Home address - &pound;4.99 <input type="radio" name="deliveryType" value="home" data-price="4.99" checked>&nbsp; | &nbsp;
		Collect from shop - no charge <input type="radio" name="deliveryType" value="shop" data-price="0">
		</p>
	</section>
	<section id="checkCost">
		<h2>Total cost</h2>
		Total <input type="text" name="total" size="10" readonly>
	</section>
	<section id="placeOrder">
		<h2>Place Order</h2>
		<h3>Your details</h3>
		<div id="retCustDetails" class="custDetails">
			Forename <input type="text" name="forename">
			Surname <input type="text" name="surname">
		</div>
		<p style="color: #FF0000; font-weight: bold;" id='termsText'>I have read and agree to the terms and conditions
		<input type="checkbox" name="termsChkbx"></p>
		<p><input type="submit" name="submit" value="Order now!" disabled></p>
	</section>
</form>	
<!-- Here you need to add Javascript or a link to a script (.js file) to process the form as required for task 4 of the assignment -->
<script>
	    window.addEventListener('load', function() {
        'use strict';
		const heading = document.getElementById("termsText");
		let altered = false;
		heading.onclick = function(){
			altered = !altered;
			//changes the colour to black and makes text normal while enabling the submit button
			if (altered) {
				heading.style.color = "#000000";
				heading.style.fontWeight = "normal";
				document.getElementsByName("submit")[0].disabled = false;
			}//Changes back to original
			else {
				heading.style.color = "#FF0000";
				heading.style.fontWeight = "bold";
				document.getElementsByName("submit")[0].disabled = true;
			}
		}
    });

const recordCheckboxes = document.querySelectorAll('input[name="record[]"]');
const totalField = document.querySelector('input[name="total"]');
let total = 0;

// Iterate over each checkbox with the class "recordCheckboxes"
recordCheckboxes.forEach(checkbox => {
  checkbox.addEventListener('change', () => {
    const price = parseFloat(checkbox.getAttribute('data-price'));
    if (checkbox.checked) {
      total += price;
    } else {
      total -= price;
    }
    totalField.value = total.toFixed(2);
  });
});
//gets all of the current buttons with the name delivery type
const deliveryTypeRadios = document.querySelectorAll('input[name="deliveryType"]');
deliveryTypeRadios.forEach(radio => {
  radio.addEventListener('change', () => {
    const price = parseFloat(radio.getAttribute('data-price')); // get ths price of the radios with the data-price
    total += price;
    totalField.value = total.toFixed(2);
  });
})

</script>
</body>
</html>