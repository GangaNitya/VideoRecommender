<?php
require_once("./includes/connection.php");
?>
<?php
//echo "in showInterests";
$uname = $_SESSION["login_user"];
if(isset($profile_uname)){
	//echo "<p>not the same user</p>";
	$user = $profile_uname;
}
else{
	//echo "<p>same user</p>";
	$user = $uname;
}
showInterests($user);
function showInterests($user){
	global $connection;
	$query = "SELECT interests FROM user ";
	$query .= "WHERE user.uname = '{$user}'";
	//echo $query;
	
	$result = mysqli_query($connection,$query);

	while($row = mysqli_fetch_assoc($result)){
		$csv_interests = $row["interests"];
		if($csv_interests != null){
			$interests = explode(",", $csv_interests);
			foreach ($interests as $interest_id) {
				$query = "SELECT c_name FROM category ";
				$query .= "WHERE category.cid = {$interest_id}";
				//echo $query;
		
				$result = mysqli_query($connection,$query);
				confirm_query($result);
				while($row = mysqli_fetch_assoc($result)){
					echo "<a href=\"catergory.php?id=".$interest_id."\" class=\"btn btn-info\" role=\"button\"><strong>".$row["c_name"]."</strong></a> &nbsp;&nbsp;&nbsp;";
				}
			}
		}
		else{
			echo $user." has no selected interests";
		}
	}
	
	if(!$connection)
		mysql_close($connection);
	//echo "end";
}
?>