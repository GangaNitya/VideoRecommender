<?php

include("connection.php");
/*$user_reputation = 0.5*($u_tag_score)+0.3*($u_category_score)+0.2($u_link_score);
SELECT uid FROM user_link_popularity L,user_category_popularity C WHERE L.uid = C.uid AND C.cid = currentcid ORDER BY (0.5*C.u_tag_score)
*/
$lid = 1; //$_GET['lid'] current lid being watched
$cid = 1; //$_GET['cid'] current category being watched

$reputationarray = array();
$userscore = 0;
$query1 = "SELECT * FROM user_category_popularity WHERE cid={$cid}";
//echo $query1;
$result1 = mysqli_query($connection,$query1);
confirm_query($result1);

	while($row = mysqli_fetch_assoc($result1)){

			$uid = $row['uid'];
			$userscore = 0.5*$row['u_tag_score']+ 0.3*$row['u_category_score'];

			$query2 = "SELECT u_link_score FROM user_link_popularity WHERE uid={$uid} AND lid={$lid}";
			//echo "<br>".$query2."<br>";
			$result2 = mysqli_query($connection,$query2);
			confirm_query($result2);
			$row = mysqli_fetch_assoc($result2);
			$linkscore = $row['u_link_score'];
			$userscore += $linkscore;
			$reputationarray[$uid] = $userscore;


	}

$html = "";
arsort($reputationarray);
//print_r($reputationarray);
$userids = array_keys($reputationarray);
//print_r($userids);
$unames = array();
$i=0;
//only the top 4 users
foreach ($userids as $uid) {
	if($i==4) break;
	$query3 = "SELECT uname FROM user WHERE uid = {$uid}";
//	echo $query3;
	$result3 = mysqli_query($connection,$query3);
	confirm_query($result3);
	$row = mysqli_fetch_assoc($result3);
	//echo $row['uname']."<br>";
		$html .="<a href='otheruser.php?uid=".$uid."'>".$row['uname']."</a>    ";
			$i++;

		}
		echo $html;

?>