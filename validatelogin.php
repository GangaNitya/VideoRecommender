<?php
// Start the session
session_start();
?>
<?php
require_once("./includes/connection.php");
?>
<br />
In login.php
<br />
<?php
$uname = $_POST["uname"];
$password = $_POST["password"];
if(!empty($uname) && !empty($password)){
	validateUser($uname,$password);
}
function validateUser($uname, $password){
	global $connection;
	$query = "SELECT uid, uname, password FROM user WHERE ";
	$query .= "uname = '{$uname}' AND password = '{$password}'";
	echo $query;
	
	$result = mysqli_query($connection,$query);
	confirm_query($result);
	$rows = mysqli_num_rows($result);
	if($rows == 1){
		$_SESSION['login_user'] = $uname;
		while($row = mysqli_fetch_assoc($result)){
			$_SESSION['login_user_uid'] = $row["uid"];
		}
		header("location: home.php");
	}
	else{
		$error = "Username or password is invalid";
		header("location: login.php");
	}

	if(!$connection)
		mysql_close($connection);
	echo "end";
}
?>