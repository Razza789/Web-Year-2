<?
ini_set("session.save_path", "/home/unn_w20017978/sessionData");session_start();
$_SESSION['logged-in'] = true;
//Takes you to the restricted page to access the record list
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="UTF-8">
<title>Northumbria Music Company Admin</title> 
</head>
<body>
<div class="gridContainer">
    <header>
        <h1>Northumbria Music Company Admin Page</h1>
    </header>
    <nav>
        <ul>
         <li><a href="home.html">Home</a></li> 
			   <li><a href="logout.php">Logout</a></li> 
               <li><a href="recordList.php">Update a Record</a></li> 
			    <li><a href="credits.html">Credits</a></li>
        </ul>
    </nav>
    <main>	
        <h2>Welcome to the Northumbria Music Company Admin Page!</h2>
        <p>Hello and welcome to the Admin Page. Here you can edit the records values. </p>
    </main>

    <footer>
		<p>Contact us at: 07958538492</p>
        <p>Northumbria Music Company  &copy; 2023</p>
            </footer>
        </div>
    
</body> 
</html>