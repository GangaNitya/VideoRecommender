<?php  require_once("./includes/session.php");?>

<?php include("tab.php");
?>

<?php include("./includes/functions.php"); ?>
<html>
<header>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css"rel="stylesheet" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/style.css" title="style" />
	<script type="text/javascript">
	function pass(lid){
	  window.location.href="video.php?lid="+lid;
	}
	</script>
</header>
<body>
	<br /><br /><br /><br />
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="sidebar-nav-fixed affix">
					<h3>Category</h3>
					<ul class="nav nav-pills nav-stacked">
						<li><a href="catergory.php?id=1"><strong>Databases</strong></a></li>
						<li><a href="catergory.php?id=2"><strong>Data Structures</strong></a></li>
						<li><a href="catergory.php?id=3"><strong>Algorithms</strong></a></li>
						<li><a href="catergory.php?id=4"><strong>Networking</strong></a></li>
						<li><a href="catergory.php?id=5"><strong>Object Oriented Programming</strong></a></li>
						<li><a href="catergory.php?id=6"><strong>Cloud Computing</strong></a></li>
						<li><a href="catergory.php?id=7"><strong>Web Technologies</strong></a></li>
						<li><a href="catergory.php?id=8"><strong>GIS</strong></a></li>
						<li><a href="catergory.php?id=9"><strong>Mobile Development</strong></a></li>
						<li><a href="catergory.php?id=10"><strong>English Communication</strong></a></li>
				  </ul>
				</div>
			</div>
			<!--<div class="video_container">-->
			<div class="col-md-9">
				<?php
					global $connection;
					if(isset($_SESSION['login_user_uid']))
						$uid = $_SESSION['login_user_uid'];
					else
						header("location: login.php");//error FIXIT
					$sql0="select * from user where uid='".$uid."'";
					$result=mysqli_query($connection,$sql0);
					
					$uname=mysqli_fetch_array($result,MYSQLI_NUM)[1];
					$result1=mysqli_query($connection,$sql0);
					$interests=mysqli_fetch_array($result1,MYSQLI_NUM)[4];
					$result2=mysqli_query($connection,$sql0);
					$r_factor=mysqli_fetch_array($result2,MYSQLI_NUM)[5];
					if($interests != null)
						$int_array=explode(',',$interests,3);
					else
						$int_array=array();
					if($r_factor != null)
						$factor_array=explode(',',$r_factor,4);
					else
						$factor_array=array();
					$_SESSION['ids']=$int_array;
					$_SESSION['factors']=$factor_array;
					$_SESSION['uname']=$uname;
					
					echo "<h3>Top picks for {$uname}</h3>";
					$ids=join(',',$int_array);
					top_picks($ids,$factor_array,$uname);
				?>
				<h3>Most Popular</h3>
				<?php 
					echo most_populars($ids);
				?>
				<h3>Most Watched</h3>
				<?php 
					$sql7="SELECT * from links where cid in ($ids) order by click desc";
					$result7=mysqli_query($connection,$sql7);
					echo "<div style='overflow:hidden'>";
					if($result7!=null)
						while($row=mysqli_fetch_array($result7,MYSQLI_ASSOC)){
							echo "<div class='resizable' onclick='pass({$row['lid']})'>";
							echo $row["url"];
							echo "</div>";
						}
					else{
						$sql7="SELECT * from links order by click desc limit 16";
						$result7=mysqli_query($connection,$sql7);
						echo "<div style='overflow:hidden'>";
						if($result7!=null)
						while($row=mysqli_fetch_array($result7,MYSQLI_ASSOC)){
							echo "<div class='resizable' onclick='pass({$row['lid']})'>";
							echo $row["url"];
							echo "</div>";
						}
						
					}
					echo "</div>";
				?>
				<!--video container-->
			</div>
		</div>
	</div>
</body>
</html>