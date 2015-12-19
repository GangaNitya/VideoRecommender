<?php
require_once(".\includes\connection.php");
?>

<?php
//echo "in userHistory";
$uname = $_SESSION["login_user"];
$videoArray = array();
if(isset($profile_uname)){
	//echo "<p>not the same user</p>";
	$user = $profile_uname;
	$watchedVideos = null;
	getWatchedVideos($uname);
	$interests = null;
	$recommendation_factor = null;
	getInterests($uname);
}
else{
	//echo "<p>same user</p>";
	$user = $uname;
}
getRatedVideos($user);

class Video{
	var $lid;
	var $url;
	var $profileUserRating;
	var $loggedUserRating;
	var $recommendation;
	var $overallRating;
	function __construct($lid,$url,$profileUserRating,$loggedUserRating,$recommendation,$overallRating) {
		$this->lid = $lid;
		$this->url = $url;
		$this->profileUserRating = $profileUserRating;
		$this->loggedUserRating = $loggedUserRating;
		$this->recommendation = $recommendation;
		$this->overallRating = $overallRating;
	}
}

function rec_sort($a, $b){
	return $a->recommendation == $b->recommendation? 0 : ($a->recommendation > $b->recommendation)? -1 : 1;
}

function getRatedVideos($user){
	global $connection,$watchedVideos, $map_rec, $videoArray;
	$query = "SELECT links.lid as lid, url, cid, like_history, wellexplained, complete, helpful, goodexamples FROM user, links, user_link_popularity ";
	$query .= "WHERE user.uid = user_link_popularity.uid AND links.lid = user_link_popularity.lid AND user.uname = '{$user}'";
	//echo $query;
	
	$result = mysqli_query($connection,$query);
	//confirm_query($result);
	
	$map_rec = array();
	
	if($result!=null && count($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$lid = $row["lid"];
			$url = $row["url"];
			$csv_like_history = $row["like_history"];
			$like_history = explode(",", $csv_like_history);
			$overallRating = array($row["wellexplained"],$row["complete"],$row["helpful"],$row["goodexamples"]);
			$loggedUserRating = null;
			$recommendation = null;
			
			if($watchedVideos!=null){ 
				if(array_key_exists($row["url"],$watchedVideos)){
					$loggedUserRating = $watchedVideos[$row["url"]];
				}
				else{
					recommendVideo($row["url"],$row["cid"], $like_history);
					if(array_key_exists($row["url"],$map_rec))
						$recommendation = $map_rec[$row["url"]];
				}
			}
			else{
				recommendVideo($row["url"],$row["cid"], $like_history);
				if(array_key_exists($row["url"],$map_rec))
					$recommendation = $map_rec[$row["url"]];
			}
			$video = new Video($lid, $url, $like_history, $loggedUserRating, $recommendation, $overallRating);
			array_push($videoArray,$video);
		}
		//order by the recommendation_factor
		usort($videoArray, 'rec_sort');
	}
	else{
		echo $user." has not rated any videos yet.";
	}
	if(!$connection)
		mysql_close($connection);
}

function getWatchedVideos($uname){
	global $connection, $watchedVideos;
	//get all the watched videos
	$query = "SELECT url, like_history FROM user, links, user_link_popularity ";
	$query .= "WHERE user.uid = user_link_popularity.uid AND links.lid = user_link_popularity.lid AND user.uname = '{$uname}' ";
	//echo $query;
	
	$result = mysqli_query($connection,$query);
	//confirm_query($result);
	
	if($result!=null && count($result)>0){
		$watchedVideos = array();
		//echo "you have watched ";
		while($row = mysqli_fetch_assoc($result)){
			$csv_like_history = $row["like_history"];
			$like_history = explode(",", $csv_like_history);
			//assumes if user didnot give rating then it is 0
			$watchedVideos[$row["url"]] = $like_history;
		}
	}
	else{
		echo "you didnt watch any";
	}
}

function getInterests($uname){
	global $connection, $interests, $recommendation_factor;
	$query = "SELECT interests, recommendation_factor FROM user WHERE user.uname = '{$uname}' ";
	//echo $query;
	$result = mysqli_query($connection,$query);
	if($result!=null && count($result)>0){
		$interests = array();
		$recommendation_factor = array();
		//echo "your interests ";
		while($row = mysqli_fetch_assoc($result)){
			$csv_interests = $row["interests"];
			$interests = explode(",", $csv_interests);
			$csv_recommendation = $row["recommendation_factor"];
			$recommendation_factor = explode(",", $csv_recommendation);
		}
	}
}

function recommendVideo($url,$cid,$like_history){
	global $interests, $recommendation_factor, $map_rec;
	$f = 0;
	if($interests != null && count($interests)>0)
		if(in_array($cid, $interests))
			$f = $f+1;
	for($n=0; $n<count($recommendation_factor); $n++){
		if($recommendation_factor[$n] > 0.5 && $like_history[$n] == 1)
				$f += 1;
		else if($recommendation_factor[$n] > 0.5 && $like_history[$n] == -1){
				$f = $f-1;
		}
	}
	$f = $f * 100 / 5;
	if($f>0)
		$map_rec[$url] = $f;
}
?>