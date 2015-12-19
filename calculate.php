<?php
include("connection.php");
include("rfunctions.php");
global $connection;
//current lid watching
$lid =	1;	// $_SESSION['lid'];
$cid = 	1;	//$_SESSION['cid'];
$uid =	1;		//$_SESSION['uid'];
$q = $_REQUEST["q"];


//update all the 3 tables

//checking if user already liked this link or not and validating
$query5 = "SELECT like_history FROM user_link_popularity WHERE lid={$lid} and uid={$uid}";
$result5 = mysqli_query($connection,$query5);

confirm_query($result5);

$row = mysqli_fetch_assoc($result5);
$like_history = $row['like_history'];


//for the very first time the user visits this video, you need to create new records in the link and category popularity
if(empty($like_history))
{
	$like_history="0,0,0,0";
	$insert1 = "INSERT INTO user_link_popularity(uid,lid,u_link_score,like_history) VALUES({$uid},{$lid},0,'{$like_history}')";
	echo "ins1: ".$insert1;
	$i1result = mysqli_query($connection,$insert1);
	confirm_query($i1result);

	//before inserting into user category table, check if user record already exists, insert only if he does not exist already
		$checksql = "SELECT * FROM user_category_popularity WHERE uid = {$uid}";
		$checkresult = mysqli_query($connection,$checksql);
		$row = mysqli_fetch_assoc($checkresult);

		if(!$row)
		{
		$insert2 = "INSERT INTO user_category_popularity(uid,cid,u_category_score,u_tag_score) VALUES({$uid},{$cid},0,0)";
		echo "<br>ins2: ".$insert2;
		$i2result = mysqli_query($connection,$insert2);
		confirm_query($i2result);
		}
}

echo "<br>lh==".$like_history."<br>";
$like_array = array();
$like_array = explode(",",$like_history);
print_r($like_array);
echo "<br>";
//like_array[0] = wellexplained
//like_array[1] = complete
//like_array[2] = helpful
//like_array[3] = goodexamples

//query for updating the score count in the front end

$query1 = "";

if($q=='w_score')
	{

		if($like_array[0]==0){
		echo "<br>w-score<br>";
		$query1 .= "UPDATE links SET wellexplained = wellexplained + 1 WHERE lid = {$lid}";
		$like_array[0] = 1;
			}
		$query4 = "SELECT wellexplained AS updatedcount from links WHERE lid={$lid}";
	}
else if($q=='c_score')
	{		
				if($like_array[1]==0){
					echo "<br>c-score<br>";
				$query1 .= "UPDATE links SET complete = complete + 1 WHERE lid = {$lid}";
				$like_array[1] = 1;
					}
		$query4 = "SELECT complete AS updatedcount from links WHERE lid={$lid}";
	}
else if($q=='h_score')
	{
		if($like_array[2]==0){
			echo "<br>h-score<br>";
		$query1 .="UPDATE links SET helpful = helpful + 1 WHERE lid = {$lid}";
		$like_array[2] = 1;
		}
		$query4 = "SELECT helpful AS updatedcount from links WHERE lid={$lid}";
	}
else if($q=='g_score')
	{
		if($like_array[3]==0){
			echo "<br>g-score<br>";
			$query1 .="UPDATE links SET goodexamples = goodexamples + 1 WHERE lid = {$lid}";
			$like_array[3] = 1;
			}
		$query4 = "SELECT goodexamples AS updatedcount from links WHERE lid={$lid}";
	}


/*echo "<br>".$query1."<br>";
echo $query2."<br>";
echo $query3."<br>";
echo $query4."<br>";
*/

/*if($emptyflag)
{

}*/
//update the global score in the links table; execute query1 and query4
if(!empty($query1))
{
	echo $query1."<br>";
	$result1 = mysqli_query($connection,$query1);
	confirm_query($result1);

//update the like history in the table
$likestring = implode(",",$like_array);
echo "like string=".$likestring;
$query6 = "UPDATE user_link_popularity SET like_history = '{$likestring}' WHERE lid={$lid} AND uid={$uid}";
$result6 = mysqli_query($connection,$query6);
echo $query6."<br>";
confirm_query($result6);


//update the link score for the current link for the current user

$linkscore = $like_array[0]+$like_array[1]+$like_array[2]+$like_array[3];
$query2 = "UPDATE user_link_popularity SET u_link_score = {$linkscore} WHERE lid = {$lid} and uid={$uid}";
echo $query2."<br>";
$result2 = mysqli_query($connection,$query2);
confirm_query($result2);

//updating the category score for the user based on the number of videos he has watched and rated in the current category

$links_watched_incategory = find_links_watched_in_current_category($cid,$lid,$uid);
$query3 = "UPDATE user_category_popularity SET u_category_score = {$links_watched_incategory} WHERE cid={$cid} AND uid={$uid}";
echo $query3."<br>";
$result3 = mysqli_query($connection,$query3);
confirm_query($result3);

//finally retrieving the score count from the links table
echo $query4."<br>";
$result4 = mysqli_query($connection,$query4);
confirm_query($result4);

$row = mysqli_fetch_assoc($result4);
echo $row['updatedcount'];

}

function find_links_watched_in_current_category($cid,$lid,$uid){
global $connection;

$query = "SELECT count(*) AS lcount FROM links WHERE cid = {$cid} AND lid in(SELECT lid from user_link_popularity WHERE uid={$uid} AND u_link_score != 0)";
//echo $query."<br>";
$result = mysqli_query($connection,$query);
confirm_query($result);
$row = mysqli_fetch_assoc($result);
//echo "links watched=".$row['lcount']."<br>";
return $row['lcount'];

}
?>
