<?php
// Start the session
session_start();
?>
<?php
require_once("./includes/connection.php");
?>
In updateUserInfo.php
<?php
	if(isset($_SESSION['login_user']))
		$uname = $_SESSION['login_user'];
	else
		header("location: login.php");
	$email = $_POST["email"];
	$password = $_POST["password"];
	$a = $_POST["category"];
	$interests = "";
	if(!empty($a)){
		$n = count($a);
		for($i=0; $i<$n; $i++){
			if($i<$n-1){
				$interests = $interests.$a[$i].",";
			}
			else{
				$interests = $interests.$a[$i];
			}
		}
	}
	$well_explained = $_POST["well_explained"];
	$complete = $_POST["complete"];
	$helpful = $_POST["helpful"];
	$good_examples = $_POST["good_examples"];
	//echo $uname." ".$email." ".$password;
	if(!empty($uname) && !empty($email) && !empty($password)){
		updateUser($uname,$email,$password,$interests,$well_explained,$complete,$helpful,$good_examples);
	}
	function updateUser($uname,$email,$password,$interests,$well_explained,$complete,$helpful,$good_examples){
		global $connection;
		$query = "UPDATE user SET email = '{$email}', password = '{$password}', interests = '{$interests}', recommendation_factor = '{$well_explained},{$complete},{$helpful},{$good_examples}' ";
		$query .= "WHERE uname = '{$uname}'";
		echo $query;
		
		$result = mysqli_query($connection,$query);
		confirm_query($result);

		if(!$connection)
			mysql_close($connection);
		echo "end";
	}
	header("location: home.php");
?>
