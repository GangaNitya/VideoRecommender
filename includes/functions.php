       
<?php require_once("connection.php"); ?>
<?php
      function most_populars($ids){
           global $connection;
                $sql5="SELECT * from links where cid in ($ids) ";
                $result5=mysqli_query($connection,$sql5);
                $rank_score2=array();
				if($result5!=null)
					while($row=mysqli_fetch_array($result5,MYSQLI_ASSOC)){
						$w=$row['wellexplained'];
						$c=$row['complete'];
						$h=$row['helpful'];
						$g=$row['goodexamples'];
						$sum=$w+$c+$h+$g;
						$rank_score2[$row['lid']]=$sum;  
					}
				else{
					$sql5="SELECT * from links limit 16";
					$result5=mysqli_query($connection,$sql5);
					$rank_score2=array();
					while($row=mysqli_fetch_array($result5,MYSQLI_ASSOC)){
						$w=$row['wellexplained'];
						$c=$row['complete'];
						$h=$row['helpful'];
						$g=$row['goodexamples'];
						$sum=$w+$c+$h+$g;
						$rank_score2[$row['lid']]=$sum;  
					}
				}
                arsort($rank_score2,SORT_NUMERIC);
                $rank4_all=array_slice($rank_score2,0,4,true);
                //print_r($rank4_all);

                $rank4_lid_all=array_keys($rank4_all);

                $lids_all=join(',',$rank4_lid_all);

                   $sql6="SELECT * from links where lid in ($lids_all) ";
                 
                   $result6=mysqli_query($connection,$sql6);
                    echo "<div style='overflow:hidden'>";
				if($result6!=null)
                   while($row=mysqli_fetch_array($result6,MYSQLI_ASSOC)){
                      echo "<div class='resizable' onclick='pass({$row['lid']})'>";
                    echo $row['url'];
                    echo "</div>";
                   }    
                        echo "</div>";
      }
?>
<?php
    function top_picks($ids,$factor_array,$uname){
        global $connection;
        $sql3="SELECT * from links where cid in ($ids) ";
        $result3=mysqli_query($connection,$sql3);
        $rank_score=array();
		if($result3!=null)
			while($row=mysqli_fetch_array($result3,MYSQLI_ASSOC)){ 
				$w=$row['wellexplained'];
				$c=$row['complete'];
				$h=$row['helpful'];
				$g=$row['goodexamples'];
				$sum=$factor_array[0]*$w+$factor_array[1]*$c+$factor_array[2]*$h+$factor_array[3]*$g;
				$rank_score[$row['lid']]=$sum;
			   // echo $row['lid']."rank".$rank_score[$row['lid']]."  ";
			}
		else{
			$sql3="SELECT * from links limit 16 ";
			$result3=mysqli_query($connection,$sql3);
			$rank_score=array();
			while($row=mysqli_fetch_array($result3,MYSQLI_ASSOC)){ 
				$w=$row['wellexplained'];
				$c=$row['complete'];
				$h=$row['helpful'];
				$g=$row['goodexamples'];
				$sum=$factor_array[0]*$w+$factor_array[1]*$c+$factor_array[2]*$h+$factor_array[3]*$g;
				$rank_score[$row['lid']]=$sum;
			   // echo $row['lid']."rank".$rank_score[$row['lid']]."  ";
			}
		}
        //foreach($rank_score as $key =>$val){}
        arsort($rank_score,SORT_NUMERIC);

        $rank4=array_slice($rank_score,0,4,true);
        //print_r($rank4);

        $rank4_lid=array_keys($rank4);

        $lids=join(',',$rank4_lid);
        //print_r array_values($rank_score); 
           $sql4="SELECT * from links where lid in ($lids) ";
         
           $result4=mysqli_query($connection,$sql4);
           //$i=0;
            echo "<div style='overflow:hidden'>";
			if($result4!=null)
           while($row=mysqli_fetch_array($result4,MYSQLI_ASSOC)){
              echo "<div class='resizable'  onclick='pass({$row['lid']})' >";

            echo $row['url'];
             
             echo "</div>";
             //$i++;
           }    
            echo "</div>";
              }
   
      function top_pick($id_get,$factor_array,$uname){
  global $connection;
      echo "<h3>Top pick for {$uname}</h3>";
 
      $sql3="SELECT * from links where cid ={$id_get} ";
      $result3=mysqli_query($connection,$sql3);
      $rank_score=array();
      while($row=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
          
          $w=$row['wellexplained'];
          $c=$row['complete'];
          $h=$row['helpful'];
          $g=$row['goodexamples'];
          $sum=$factor_array[0]*$w+$factor_array[1]*$c+$factor_array[2]*$h+$factor_array[3]*$g;

          $rank_score[$row['lid']]=$sum;
         // echo $row['lid']."rank".$rank_score[$row['lid']]."  ";
        
      }
      //foreach($rank_score as $key =>$val){}
      arsort($rank_score,SORT_NUMERIC);

      $rank4=array_slice($rank_score,0,4,true);
      //print_r($rank4);

      $rank4_lid=array_keys($rank4);

      $lids=join(',',$rank4_lid);
      //print_r array_values($rank_score); 
         $sql4="SELECT * from links where lid in ($lids) ";
       
         $result4=mysqli_query($connection,$sql4);
          echo "<div style='overflow:hidden'>";
         while($row=mysqli_fetch_array($result4,MYSQLI_ASSOC)){
            echo "<div class='resizable'  onclick='pass({$row['lid']})' >";
          echo $row['url'];
           echo "</div>";
         }    
          echo "</div>";
 

      }

      function most_popular($id_get){
          global $connection;
        $sql5="SELECT * from links where cid in ($id_get) ";
      $result5=mysqli_query($connection,$sql5);
      $rank_score2=array();
      echo "<h3>Most Popular</h3>";
      while($row=mysqli_fetch_array($result5,MYSQLI_ASSOC)){
          
          $w=$row['wellexplained'];
          $c=$row['complete'];
          $h=$row['helpful'];
          $g=$row['goodexamples'];
          $sum=$w+$c+$h+$g;

          $rank_score2[$row['lid']]=$sum;

        
      }
      arsort($rank_score2,SORT_NUMERIC);
      $rank4_all=array_slice($rank_score2,0,4,true);
      //print_r($rank4_all);

      $rank4_lid_all=array_keys($rank4_all);

      $lids_all=join(',',$rank4_lid_all);

         $sql6="SELECT * from links where lid in ($lids_all) ";
       
         $result6=mysqli_query($connection,$sql6);
          echo "<div style='overflow:hidden'>";
         while($row=mysqli_fetch_array($result6,MYSQLI_ASSOC)){
            echo "<div class='resizable' onclick='pass({$row['lid']})'>";
          echo $row['url'];
          echo "</div>";
         }    
              echo "</div>";
      }

      function most_watch($id_get){
          global $connection;
      $sql7="SELECT * from links where cid ={$id_get} order by click desc limit 4";
       $result7=mysqli_query($connection,$sql7);
             echo "<h3>Most Watched</h3>";
            echo "<div style='overflow:hidden' >";
       while($row=mysqli_fetch_array($result7,MYSQLI_ASSOC)){
        echo "<div class='resizable' onclick='pass({$row['lid']})'>";
          echo $row["url"];
          echo "</div>";
       }
      echo "</div>";
      }
?>
      

<?php
/*$user_reputation = 0.5*($u_tag_score)+0.3*($u_category_score)+0.2($u_link_score);
SELECT uid FROM user_link_popularity L,user_category_popularity C WHERE L.uid = C.uid AND C.cid = currentcid ORDER BY (0.5*C.u_tag_score)
*/

/*function to calculate social navigation */

function socialnavigation(){
$lid = 1; //$_GET['lid'] current lid being watched
$cid = 1; //$_GET['cid'] current category being watched
global $connection;
$userArray = array();
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
//  echo $query3;
  $result3 = mysqli_query($connection,$query3);
  confirm_query($result3);
  $row = mysqli_fetch_assoc($result3);
  //echo $row['uname']."<br>";
    $html .="<a href='otheruser.php?uname=".$row['uname']."'>".$row['uname']."</a>    ";
	array_push($userArray,$row['uname']);
      $i++;
    }
  return $userArray;
}
?>

<?php
/*function to show the video */
function showvideo($lid){
global $connection;
  //$lid = 1;

$query = "SELECT url FROM links WHERE lid={$lid}";
$result = mysqli_query($connection,$query);
confirm_query($result);
$row = mysqli_fetch_assoc($result);
return $row['url'];
  
}
?>

<?php
/*function to find the category id of the given link id*/
function find_category_id($lid){
  global $connection;
$query = "SELECT cid FROM links WHERE lid={$lid}";
$result = mysqli_query($connection,$query);
confirm_query($result);
$row = mysqli_fetch_assoc($result);
return $row['cid'];

}
?>

<?php
/*<!-- function to update like counts -->*/
function update_like_counts($lid,$cid,$uid,$q){
  //update all the 3 tables
//checking if user already liked this link or not and validating
global $connection;
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
  //echo "ins1: ".$insert1;
  $i1result = mysqli_query($connection,$insert1);
  confirm_query($i1result);

  //before inserting into user category table, check if user record already exists, insert only if he does not exist already
    $checksql = "SELECT * FROM user_category_popularity WHERE uid = {$uid}";
    $checkresult = mysqli_query($connection,$checksql);
    $row = mysqli_fetch_assoc($checkresult);

    if(!$row)
    {
    $insert2 = "INSERT INTO user_category_popularity(uid,cid,u_category_score,u_tag_score) VALUES({$uid},{$cid},0,0)";
  //  echo "<br>ins2: ".$insert2;
    $i2result = mysqli_query($connection,$insert2);
    confirm_query($i2result);
    }
}

//echo "<br>lh==".$like_history."<br>";
$like_array = array();
$like_array = explode(",",$like_history);
//print_r($like_array);
//echo "<br>";
//like_array[0] = wellexplained
//like_array[1] = complete
//like_array[2] = helpful
//like_array[3] = goodexamples

//query for updating the score count in the front end

$query1 = "";

if($q=='w_score')
  {
    //the very first time the user likes the video
    if($like_array[0]==0){
//    echo "<br>w-score<br>";
    $query1 .= "UPDATE links SET wellexplained = wellexplained + 1 WHERE lid = {$lid}";
      }
    // the user had disliked the video in the past but now likes the video
    if($like_array[0]==-1){
//    echo "<br>w-score<br>";
    $query1 .= "UPDATE links SET wellexplained = wellexplained + 2 WHERE lid = {$lid}";
      }
    //either ways like implies that the like history has a value 1
    $like_array[0] = 1;
    $query4 = "SELECT wellexplained AS updatedcount from links WHERE lid={$lid}";
  }
else if($q=='c_score')
  {   
        if($like_array[1]==0){
//          echo "<br>c-score<br>";
        $query1 .= "UPDATE links SET complete = complete + 1 WHERE lid = {$lid}";
            }
      if($like_array[1]==-1){
//          echo "<br>c-score<br>";
        $query1 .= "UPDATE links SET complete = complete + 2 WHERE lid = {$lid}";
            }
    $like_array[1] = 1;
    $query4 = "SELECT complete AS updatedcount from links WHERE lid={$lid}";
  }
else if($q=='h_score')
  {
    if($like_array[2]==0){
//      echo "<br>h-score<br>";
    $query1 .="UPDATE links SET helpful = helpful + 1 WHERE lid = {$lid}";
      }
    if($like_array[2]==-1){
//      echo "<br>h-score<br>";
    $query1 .="UPDATE links SET helpful = helpful + 2 WHERE lid = {$lid}";
      }
    $like_array[2] = 1;
    $query4 = "SELECT helpful AS updatedcount from links WHERE lid={$lid}";
  }
else if($q=='g_score')
  {
    if($like_array[3]==0){
//      echo "<br>g-score<br>";
      $query1 .="UPDATE links SET goodexamples = goodexamples + 1 WHERE lid = {$lid}";
      }
    if($like_array[3]==-1){
//      echo "<br>g-score<br>";
      $query1 .="UPDATE links SET goodexamples = goodexamples + 2 WHERE lid = {$lid}";
      }
    $like_array[3] = 1;
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
//  echo $query1."<br>";
  $result1 = mysqli_query($connection,$query1);
  confirm_query($result1);

//update the like history in the table
$likestring = implode(",",$like_array);
//echo "like string=".$likestring;
$query6 = "UPDATE user_link_popularity SET like_history = '{$likestring}' WHERE lid={$lid} AND uid={$uid}";
$result6 = mysqli_query($connection,$query6);
//echo $query6."<br>";
confirm_query($result6);


//update the link score for the current link for the current user

$linkscore = $like_array[0]+$like_array[1]+$like_array[2]+$like_array[3];
$query2 = "UPDATE user_link_popularity SET u_link_score = {$linkscore} WHERE lid = {$lid} and uid={$uid}";
//echo $query2."<br>";
$result2 = mysqli_query($connection,$query2);
confirm_query($result2);

//updating the category score for the user based on the number of videos he has watched and rated in the current category

$links_watched_incategory = find_links_watched_in_current_category($cid,$lid,$uid);
$query3 = "UPDATE user_category_popularity SET u_category_score = {$links_watched_incategory} WHERE cid={$cid} AND uid={$uid}";
//echo $query3."<br>";
$result3 = mysqli_query($connection,$query3);
confirm_query($result3);


}
//finally retrieving the score count from the links table
//echo $query4."<br>";
$result4 = mysqli_query($connection,$query4);
confirm_query($result4);

$row = mysqli_fetch_assoc($result4);
return $row['updatedcount'];

}

?>

<?php
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
<?php
function update_dislike_counts($lid,$cid,$uid,$q){

//update all the 3 tables

//checking if user already liked this link or not and validating
  global $connection;
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
  //echo "ins1: ".$insert1;
  $i1result = mysqli_query($connection,$insert1);
  confirm_query($i1result);

  //before inserting into user category table, check if user record already exists, insert only if he does not exist already
    $checksql = "SELECT * FROM user_category_popularity WHERE uid = {$uid}";
    $checkresult = mysqli_query($connection,$checksql);
    $row = mysqli_fetch_assoc($checkresult);

    if(!$row)
    {
    $insert2 = "INSERT INTO user_category_popularity(uid,cid,u_category_score,u_tag_score) VALUES({$uid},{$cid},0,0)";
  //  echo "<br>ins2: ".$insert2;
    $i2result = mysqli_query($connection,$insert2);
    confirm_query($i2result);
    }
}

//echo "<br>lh==".$like_history."<br>";
$like_array = array();
$like_array = explode(",",$like_history);
//print_r($like_array);
//echo "<br>";
//like_array[0] = wellexplained
//like_array[1] = complete
//like_array[2] = helpful
//like_array[3] = goodexamples

//query for updating the score count in the front end

$query1 = "";

if($q=='w_score')
  {
      //if he dislikes the very first time
    if($like_array[0]==0)
        {
//    echo "<br>w-score<br>";
    $query1 .= "UPDATE links SET wellexplained = wellexplained - 1 WHERE lid = {$lid}";
        }
    //if he had liked in the past but now dislikes
    if($like_array[0]==1)
      {
//    echo "<br>w-score<br>";
    $query1 .= "UPDATE links SET wellexplained = wellexplained - 2 WHERE lid = {$lid}";
      }
      //either ways dislike implies a value of -1 in the like history
    $like_array[0] = -1;
    $query4 = "SELECT wellexplained AS updatedcount from links WHERE lid={$lid}";
  }
else if($q=='c_score')
  {   
        if($like_array[1]==0){
//          echo "<br>c-score<br>";
        $query1 .= "UPDATE links SET complete = complete - 1 WHERE lid = {$lid}";
                  }

        if($like_array[1]==1){
//          echo "<br>c-score<br>";
        $query1 .= "UPDATE links SET complete = complete - 2 WHERE lid = {$lid}";
                  }
        $like_array[1] = -1;
        $query4 = "SELECT complete AS updatedcount from links WHERE lid={$lid}";
  }
else if($q=='h_score')
  {
    if($like_array[2]==0){
//      echo "<br>h-score<br>";
    $query1 .="UPDATE links SET helpful = helpful - 1 WHERE lid = {$lid}";
              }
    if($like_array[2]==1){
//      echo "<br>h-score<br>";
    $query1 .="UPDATE links SET helpful = helpful - 2 WHERE lid = {$lid}";
              }
    $like_array[2] = -1;
    $query4 = "SELECT helpful AS updatedcount from links WHERE lid={$lid}";
  }
else if($q=='g_score')
  {
    if($like_array[3]==0){
//      echo "<br>g-score<br>";
      $query1 .="UPDATE links SET goodexamples = goodexamples - 1 WHERE lid = {$lid}";
              }
    if($like_array[3]==1){
//      echo "<br>g-score<br>";
      $query1 .="UPDATE links SET goodexamples = goodexamples - 2 WHERE lid = {$lid}";
              }
    $like_array[3] = -1;
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
//  echo $query1."<br>";
  $result1 = mysqli_query($connection,$query1);
  confirm_query($result1);

//update the like history in the table
$likestring = implode(",",$like_array);
//echo "like string=".$likestring;
$query6 = "UPDATE user_link_popularity SET like_history = '{$likestring}' WHERE lid={$lid} AND uid={$uid}";
$result6 = mysqli_query($connection,$query6);
//echo $query6."<br>";
confirm_query($result6);


//update the link score for the current link for the current user

$linkscore = $like_array[0]+$like_array[1]+$like_array[2]+$like_array[3];
$query2 = "UPDATE user_link_popularity SET u_link_score = {$linkscore} WHERE lid = {$lid} and uid={$uid}";
//echo $query2."<br>";
$result2 = mysqli_query($connection,$query2);
confirm_query($result2);

//updating the category score for the user based on the number of videos he has watched and rated in the current category

$links_watched_incategory = find_links_watched_in_current_category($cid,$lid,$uid);
$query3 = "UPDATE user_category_popularity SET u_category_score = {$links_watched_incategory} WHERE cid={$cid} AND uid={$uid}";
//echo $query3."<br>";
$result3 = mysqli_query($connection,$query3);
confirm_query($result3);

}
//finally retrieving the score count from the links table
//echo $query4."<br>";
$result4 = mysqli_query($connection,$query4);
confirm_query($result4);

$row = mysqli_fetch_assoc($result4);
return $row['updatedcount'];


}
?>
<?php
/*function that saves tags to the database*/
function save_tags($tag1,$tag2,$tag3,$uid,$lid,$cid){

global $connection;
$save = 0;
 // First checking if the tags already exist in the respective tables
//category table

$ctagarray = array();
$utagarray = array();
$i=0;
$j=0;
$tagscore = 0;
if(!empty($tag1) && strlen($tag1)>=3){

  if(tag_exists($tag1,$cid,0,"category")==0)
    { $ctagarray[$i] = $tag1; $i+=1;}
  if(tag_exists($tag1,0,$uid,"user")==0)
    { $utagarray[$j] = $tag1; $j+=1;}
}
if(!empty($tag2 && strlen($tag2)>=3)){

  if(tag_exists($tag2,$cid,0,"category")==0)
    { $ctagarray[$i] = $tag2; $i+=1;}
  if(tag_exists($tag2,0,$uid,"user")==0)
    { $utagarray[$j] = $tag2; $j+=1;}
}
if(!empty($tag3 && strlen($tag3)>=3)){

  if(tag_exists($tag3,$cid,0,"category")==0)
    { $ctagarray[$i] = $tag3; $i+=1;}
  if(tag_exists($tag3,0,$uid,"user")==0)
    { $utagarray[$j] = $tag3; $j+=1;}
}

//print_r($ctagarray);
//print_r($utagarray);
//updating to category table
if(!empty($ctagarray))
{
  //first fetch the existing tag string for this category and then append
  $query1 = "SELECT tags from category WHERE cid={$cid}";
  $result1 = mysqli_query($connection,$query1);
  confirm_query($result1);
  $row = mysqli_fetch_assoc($result1);

  if(!empty($row['tags']))
  $ctagstring = $row['tags'].",".implode(",",$ctagarray);
  else
  $ctagstring = implode(",",$ctagarray);
  $query2 = "UPDATE category SET tags ='{$ctagstring}' WHERE cid={$cid}";
//  echo "<br>".$query2;
  $result2 = mysqli_query($connection,$query2);
  confirm_query($result2);
  $save = 1;
  
}
if(!empty($utagarray))
{
  //first fetch teh existing tag cloud string for this user and then append
  $query3 = "SELECT tag_cloud from user WHERE uid={$uid}";
  $result3 = mysqli_query($connection,$query3);
  confirm_query($result3);
  $row = mysqli_fetch_assoc($result3);
  if(!empty($row['tag_cloud']))
  $utagstring =$row['tag_cloud'].",".implode(",",$utagarray);
  else
  $utagstring = implode(",",$utagarray);

  $query4 = "UPDATE user SET tag_cloud ='{$utagstring}' WHERE uid={$uid}";
//  echo "<br>".$query4;
  $result4 = mysqli_query($connection,$query4);
  confirm_query($result4);
  //update the user tag score

  $tagarray = explode(",", $utagstring);
  $tagscore = count($tagarray);

  $query5 = "UPDATE user_category_popularity SET u_tag_score = {$tagscore} WHERE uid = {$uid}";
//  echo "scoring..".$query5;
  $result5 = mysqli_query($connection,$query5);
  confirm_query($result5);

  $save = 1;

}

if($save==1)
return "<br/><span class=\"label label-success\" style=\"font-size: 1.5em;\">Your tags are saved!</span>";
//need to update 3 tables after
//user_category_popularity

}
?>

<?php
/*function to check if a tag already exists in the category*/
function tag_exists($tag,$cid,$uid,$tablename){
global $connection;

$returnflag = 0;
if($uid==0)
{
  $query = "SELECT tags from {$tablename} WHERE cid={$cid}";
  $result = mysqli_query($connection,$query);
  confirm_query($result);
  $row = mysqli_fetch_assoc($result);
  if(empty($row['tags']))
    { $returnflag = 0;}
  else{

    $tagsarray = explode(",",$row['tags']);

    foreach($tagsarray as $t){
      if($tag==$t)
        {  $returnflag = 1; break; }
    }
  
  }


}
else if($cid==0)
{
  $query = "SELECT tag_cloud from {$tablename} WHERE uid={$uid}";
  $result = mysqli_query($connection,$query);
  confirm_query($result);
  $row = mysqli_fetch_assoc($result);
  if(empty($row['tag_cloud']))
    { $returnflag = 0;}
  else{

    $tagsarray = explode(",",$row['tag_cloud']);

    foreach($tagsarray as $t){
      if($tag==$t)
        {  $returnflag = 1; break; }
    }
  
  }

}
//echo "<br>in function---".$query;

return $returnflag;

}

?>