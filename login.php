<?php
  include 'functions.php';
  ini_set("session.save_path", "/home/unn_w20017978/sessionData");
  session_start();
?>
<!doctype html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<?php
// Gets the username and password from the login form
$username = filter_has_var(INPUT_POST, 'username') ? $_POST['username']:null;
$username = trim($username);
$password = filter_has_var(INPUT_POST, 'password') ? $_POST['password']:null;
$password = trim($password);

// Checks if they are empty
if(empty($username) || empty($password)){
    echo "<p> You need to provide a username and a password. Please try <a href='loginform.html'>again</a>. </p>\n";
}
// Fetches the username and passwword from the database
else{
    try{

        unset($_SESSION['username']);
        unset($_SESSION['logged-in']);

        $dbConn = getConnection();

        $querySQL = "SELECT passwordHash FROM nmc_users WHERE username = :username";
        $stmt = $dbConn->prepare($querySQL);
        $stmt->execute(array(':username' => $username));
        $user = $stmt->fetchObject();
// Verifies the username and password and logs them in creating a session
        if($user){
            if(password_verify($password, $user->passwordHash)){
                echo "<p?> Logon Successful</p>\n";
                echo "<a href='restricted.php'> Restricted page</a>";

                $_SESSION['logged-in'] = true;
                $_SESSION['username'] = $username;
            } else{
                echo "<p>The username or password were incorrect. Please try <a href='loginform.html'>again</a>. </p>\n";
            }
        } 
        } catch(Exception $e){
            echo "Record not found" . $e-> getMessage();
    }
}
?>
</body>
</html>
