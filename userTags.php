<?php
if(isset($profile_uname)){
	$user = $profile_uname;
}
else{
	$user = $uname;
}
displayTags($user);

function displayTags($user){
	global $connection;
	$query = "SELECT tag_cloud FROM user ";
	$query .= "WHERE user.uname = '{$user}'";

	$result = mysqli_query($connection,$query);
	//confirm_query($result);

	while($row = mysqli_fetch_assoc($result)){
		$csv_tag_cloud = $row["tag_cloud"];
		if(!empty($csv_tag_cloud)){
			$tag_cloud = explode(",", $csv_tag_cloud);
			for($n=0;$n<count($tag_cloud);$n++){
				echo $tag_cloud[$n]."&nbsp;&nbsp;&nbsp;";
			}
		}
		else{
			echo $user." has not saved any tags yet.";
		}
	}
}
?>