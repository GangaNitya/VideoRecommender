<html>
<head>
	<title>Welcome to Educational Video Recommender</title>
	<script type="text/javascript">
	function validatePassword(){
		var password = document.getElementById("password");
		var confirm_password = document.getElementById("confirm_password");
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords Don't Match");
		} else {
			confirm_password.setCustomValidity('');
		}
	}
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="jumbotron">
<h1>Educational Video Recommender</h1>
<p>Your guide to better programming!<p>
</div>
	<div class="row">
	<div class="col-md-4 col-md-offset-2">
	<form action="validatelogin.php" method="post" role="form" class="">
		<fieldset>
			<legend>Login</legend>
			<div class="form-group">
			<label for="uname">Username:</label><input type="text" name="uname" placeholder="Username" required="required" class="form-control">
			</div>
			<div class="form-group">
			<label for="password">Password:</label><input type="password" name="password" placeholder="Password" required="required" class="form-control">
			</div>
			<input type="submit" value="Login" class="btn btn-info btn-lg"/>
		</fieldset>
	</form>
	</div>
	<div class="col-md-4">
	<form action="insertUser.php" method="post" class="">
		<fieldset>
			<legend>New User? Create a New Account!</legend>
			<div class="form-group">
			<label for="uname">Username:</label><input type="text" name="uname" placeholder="Username" required="required" class="form-control">
			</div>
			<div class="form-group">
			<label for="email">Email address:</label><input type="email" name="email" placeholder="Email address" required="required" class="form-control">
			</div>
			<div class="form-group">
			<label for="password">Password:</label><input type="password" name="password" id="password" placeholder="Password" required="required" onblur="validatePassword()" class="form-control">
			</div>
			<div class="form-group">
			<label for="confirm_password">Confirm password:</label><input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required" onblur="validatePassword()" class="form-control">
			</div>
			
			<input type="submit" value="Sign Up" class="btn btn-info btn-lg"/>
		</fieldset>
	</form>
	</div>
	</div>
</div>
</body>
</html>