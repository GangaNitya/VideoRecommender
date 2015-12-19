<?php include("./includes/functions.php"); ?>
<?php  require_once("./includes/session.php");?>
<?php include("tab.php");
?>
<html>
<header>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-    ui.css"rel="stylesheet" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
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
					<ul class="nav nav-pills nav-stacked"">
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
					$ids=$_SESSION['ids'];
					$id_get=$_GET['id'];
					echo "<h3>Videos for ";
					switch($id_get){
						case '1':
							echo "Databases</h3>";
							break;
						case '2':
							echo "Data Structures</h3>";
							break;
						case '3':
							echo "Algorithms</h3>";
							break;
						case '4':
							echo "Networking</h3>";
							break;
						case '5':
							echo "Object Oriented Programming</h3>";
							break;
						case '6':
							echo "Cloud Computing</h3>";
							break;
						case '7':
							echo "Web Technologies</h3>";
							break;
						case '8':
							echo "GIS</h3>";
							break;
						case '9':
							echo "Mobile Development</h3>";
							break;
						case '10':
							echo "English Communication</h3>";
							break;
					}
					$uname=$_SESSION['uname'];
					$factor_array=$_SESSION['factors'];
					if(in_array($id_get,$ids)){
						top_pick($id_get,$factor_array,$uname);
						most_popular($id_get);
						most_watch($id_get);
					}else{
						most_popular($id_get);
						most_watch($id_get);
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>