<?php include("tab.php");
?>
<html>
<head>
<title>Profile</title>
<style>
	
	a {
    line-height: 1em;
    display: inline-block;
    text-decoration: none;
    padding: 15px;
    margin: 12px;
	}
</style>
<link rel="stylesheet" type="text/css" href="CSS/style.css" title="style" />
<script type="text/javascript">
function pass(lid){
	window.location.href="video.php?lid="+lid;
}
</script>
</head>
<body>
Profile
<!-- check if logged in user is the same user whose history is shown -->
<?php if(isset($_SESSION['login_user'])){
			$uname = $_SESSION["login_user"];
			if(isset($_GET["uname"])){
				$profile_uname = $_GET["uname"];
				if($uname == $profile_uname)
					echo "<a href=\"editProfile.php\">Update Profile</a>";
			}
		}	
		else{
			header("location: login.php");
		}
?>
	<br /><br /><br /><br />
<div class="container">
	<div>
		<h3><?php if(isset($profile_uname)) echo $profile_uname; else echo $uname;?>'s Profile</h3>
	</div>
	<div class="row">
		<div class="panel panel-info col-md-5">
			<div class="panel-heading"><strong>INTERESTS</strong></div>
			<div class="panel-body">
				<strong><?php include("showInterests.php");?></strong>
			</div>
		</div>
		<div class="panel panel-info col-md-6 col-md-offset-1">
			<div class="panel-heading"><strong>TAGS</strong></div>
			<div class="panel-body">
				<strong><?php include("userTags.php");?></strong>
			</div>
		</div>
	</div>
	<?php include("userHistory.php");?>
	<?php ?>
	<div class="panel panel-info">
		<div class="panel-heading"><strong>RATED VIDEOS</strong></div>
		<div class="panel-body">
		<?php
		$html = "";
		if(count($videoArray)>0){
			for($n=0; $n<count($videoArray); $n++){
				$html .= "<div class=\"row\">";
				if(!isset($profile_uname))
					$html .= "<div class=\"col-sm-4 resizable1 col-md-offset-1 text-center\" onclick='pass(".$videoArray[$n]->lid.");'>";
				else
					$html .= "<div class=\"col-sm-4 resizable2 text-center\" onclick='pass(".$videoArray[$n]->lid.");'>";
				$html .= $videoArray[$n]->url;
				$html .= "</div>";
				if(!isset($profile_uname))
					$html .= "<div class=\"col-sm-3 col-md-offset-1 text-center\"><strong>YOU RATED<br />Well explained: ".$videoArray[$n]->profileUserRating[0]."<br />";
				else
					$html .= "<div class=\"col-sm-2 col-md-offset-1 text-center\"><strong>".$profile_uname." RATED<br />Well explained: ".$videoArray[$n]->profileUserRating[0]."<br />";
				$html .= "Complete: ".$videoArray[$n]->profileUserRating[1]."<br />";
				$html .= "Helpful: ".$videoArray[$n]->profileUserRating[2]."<br />";
				$html .= "Good Examples: ".$videoArray[$n]->profileUserRating[3]."</strong>";
				$html .= "</div>";
				if(!isset($profile_uname))
					$html .= "<div class=\"col-sm-3 col-md-offset-1 text-center\"><em>OVERALL RATED AS<br />Well explained: ".$videoArray[$n]->overallRating[0]."<br />";
				else
					$html .= "<div class=\"col-sm-2 col-md-offset-1 text-center\"><em>OVERALL RATED AS<br />Well explained: ".$videoArray[$n]->overallRating[0]."<br />";
				$html .= "Complete: ".$videoArray[$n]->overallRating[1]."<br />";
				$html .= "Helpful: ".$videoArray[$n]->overallRating[2]."<br />";
				$html .= "Good Examples: ".$videoArray[$n]->overallRating[3]."</em>";
				$html .= "</div>";
				if(($videoArray[$n]->loggedUserRating) != null){
					$html .= "<div class=\"col-sm-2 col-md-offset-1 text-center\"><strong><em>YOU RATED<br />Well explained: ".$videoArray[$n]->loggedUserRating[0]."<br />";
					$html .= "Complete: ".$videoArray[$n]->loggedUserRating[1]."<br />";
					$html .= "Helpful: ".$videoArray[$n]->loggedUserRating[2]."<br />";
					$html .= "Good Examples: ".$videoArray[$n]->loggedUserRating[3]."</em></strong>";
					$html .= "</div>";
				}
				if(isset($profile_uname) && ($videoArray[$n]->recommendation) != null){
					$html .= "<div class=\"col-sm-2 col-md-offset-1\"><strong><em>Recommended for you</em></strong><br/>";
					$c = ($videoArray[$n]->recommendation)/100*5;
					for($i=0;$i<5;$i++){
						if($i<$c)
							$html .= "<span class=\"glyphicon glyphicon-star\" style=\"font-size: 2em\"></span>";
						else
							$html .= "<span class=\"glyphicon glyphicon-star-empty\" style=\"font-size: 2em\"></span>";
					}
					$html .= "</div>";
				}
				else if(isset($profile_uname)){
					$html .= "<div class=\"col-sm-2 col-md-offset-1\"><strong><em>Not recommended for you</em></strong></div>";
				}
				$html .= "</div>";
			}
		}
		else{
			$html .= "<div>".$user." has not rated any videos yet.</div>";
		}
		echo $html;
		?>
			</div>
		</div>
	</div>
</div>
</body>
</html>