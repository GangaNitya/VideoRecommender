<?php
// Start the session
session_start();
?>
<?php
require_once("./includes/connection.php");
?>
<br />
In signup.php
<br />
<?php
$uname = $_POST["uname"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
if(!empty($uname) && !empty($email) && !empty($password) && !empty($confirm_password)){
	if($password == $confirm_password){
		insertUser($uname,$email,$password);
	}
	else{
		$error = "Passwords do not match!";
	}
}
function insertUser($uname,$email,$password){
	global $connection;
	$query = "INSERT INTO user (uname, email, password) VALUES ";
	$query .= "('{$uname}', '{$email}', '{$password}')";
	echo $query;
	
	$result = mysqli_query($connection,$query);
	confirm_query($result);
	if($result){
		$_SESSION['login_user'] = $uname;
		$query = "SELECT uid FROM user WHERE ";
		$query .= "uname = '{$uname}'";
		$result = mysqli_query($connection,$query);
		$rows = mysqli_num_rows($result);
		if($rows == 1){
			while($row = mysqli_fetch_assoc($result)){
				$_SESSION['login_user_uid'] = $row["uid"];
			}
		}
		header("location: editProfile.php");
	}
	else{
		$error = "Username already exists";
	}

	if(!$connection)
		mysql_close($connection);
	echo "end";
}
?>