<?php  require_once("./includes/session.php");?>
<?php
// Start the session
//session_start();
?>
<html>
<head>
	<style>
		a {
			line-height: 1em;
			display: inline-block;
			text-decoration: none;
			padding: 15px;
			margin: 12px;
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="home.php"><strong>Educational Video Recommender</strong></a>
		</div>
		<div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="#"><strong>Welcome 
					<?php
						if(isset($_SESSION['login_user']))
							echo $_SESSION['login_user'];
						else
							header("location: login.php");
					?>!</strong></a></li>
				<li><a href="home.php"><strong>Home</strong></a></li>
				<li><a href="editProfile.php"><strong>Update Profile</strong></a></li>
				<li><a href="viewProfile.php"><strong>View Profile</strong></a></li>			
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;<strong>Logout</strong></a></li>
			</ul>
		</div>
	</div>
</nav>
</body>
</html>