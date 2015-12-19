<?php
require_once("./includes/connection.php");
?>
<?php include("tab.php");
?>
<?php
	$uname = $_SESSION["login_user"];
	getUser($uname);
	function getUser($uname){
		global $connection,$email,$password,$interests,$rec;
		$query = "SELECT uname, email, password, interests, recommendation_factor, tag_cloud FROM user ";
		$query .= "WHERE user.uname = '{$uname}'";
		//echo $query;
		$result = mysqli_query($connection,$query);
		confirm_query($result);
		$rows = mysqli_num_rows($result);
		if($rows == 1){
			while($row = mysqli_fetch_assoc($result)){
				$email = $row["email"];
				$password = $row["password"];
				$i = $row["interests"];
				if($i != null){
					$interests = explode(",",$i);
				}
				$recommendation_factor = $row["recommendation_factor"];
				if($recommendation_factor != null){
					$rec = explode(",", $recommendation_factor);
				}
				$tag_cloud = $row["tag_cloud"];
			}
		}
	}
?>
<html>
<head>
<title>Edit Profile</title>
</head>
<body onload="valueUpdate();">
<br /><br /><br /><br /><br /><br />
<div class="container">
<div class="row">
<div class = "col-md-6 col-md-offset-2">
<form action="updateUserInfo.php" method="post" role="form">
	<fieldset>
	<legend>Update Profile Information</legend>
		<div class="form-group">
			<strong>
				Username: <?php
				if(isset($_SESSION['login_user']))
					echo $_SESSION['login_user'];
				else
					header("location: login.php");
				?>
			</strong>
		</div>
		<div class="form-group">
			<label for="email">Email address: </label><input type="email" name="email" placeholder="Email address" value="<?php if(isset($email)) echo $email; ?>" required="required" class="form-control">
		</div>
		<div class="form-group">
			<label for="password">Change password: </label><input type="password" name="password" id="password" placeholder="Password" required="required" value="<?php if(isset($password)) echo $password; ?>" class="form-control">
		</div>
		<div class="form-group">
			<label for="category[]">Interests:  </label>
			<div class="row">
			<div class = "col-md-6">
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="1" <?php if($interests!=null && in_array(1,$interests)) echo "checked"; ?>>Databases</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="2" <?php if($interests!=null && in_array(2,$interests)) echo "checked"; ?>>Data Structures</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="3" <?php if($interests!=null && in_array(3,$interests)) echo "checked"; ?>>Algorithms</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="4" <?php if($interests!=null && in_array(4,$interests)) echo "checked"; ?>>Networking</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="5" <?php if($interests!=null && in_array(5,$interests)) echo "checked"; ?>>Object Oriented Programming</label>
			</div>
			</div>
			<div class = "col-md-6">
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="6" <?php if($interests!=null && in_array(6,$interests)) echo "checked"; ?>>Cloud Computing</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="7" <?php if($interests!=null && in_array(7,$interests)) echo "checked"; ?>>Web Technologies</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="8" <?php if($interests!=null && in_array(8,$interests)) echo "checked"; ?>>GIS</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="9" <?php if($interests!=null && in_array(9,$interests)) echo "checked"; ?>>Mobile Development</label>
			</div>
			<div class="checkbox">
			<label style="font-style:italic;font-weight:bold"><input type="checkbox" name="category[]" value="10" <?php if($interests!=null && in_array(10,$interests)) echo "checked"; ?>>English Communication</label>
			</div>
			</div>
			</div>
		</div>
			<label>Recommendation Factor:</label>
			<br/>
			<label for="well_explained">Well-explained </label><input type="range" name="well_explained" id="well_explained" min="0" max="1" step="0.1" value="<?php if(isset($rec[0])) echo $rec[0]; else echo "0";?>" onchange="valueUpdate();"><span id="we" class="label label-info"></span><br /><br />
			<label for="complete">Complete </label><input type="range" name="complete" id="complete" min="0" max="1" step="0.1" value="<?php if(isset($rec[1])) echo $rec[1]; else echo "0";?>" onchange="valueUpdate();"><span id="c" class="label label-info"></span><br /><br />
			<label for="helpful">Helpful </label><input type="range" name="helpful" id="helpful" min="0" max="1" step="0.1" value="<?php if(isset($rec[2])) echo $rec[2]; else echo "0";?>" onchange="valueUpdate();"><span id="h" class="label label-info"></span><br /><br />
			<label for="good_examples">Good examples </label><input type="range" name="good_examples" id="good_examples" min="0" max="1" step="0.1" value="<?php if(isset($rec[3])) echo $rec[3]; else echo "0";?>" onchange="valueUpdate();"><span id="ge" class="label label-info"></span><br /><br />
		<input type="submit" value="Update Profile" class="btn btn-info btn-lg"/>
	</fieldset>
</form>
</div>
</div>
</div>
<script type="text/javascript">
	function valueUpdate(){
		var well_explained = document.getElementById("well_explained");
		document.getElementById("we").innerHTML = well_explained.value;
		var complete = document.getElementById("complete");
		document.getElementById("c").innerHTML = complete.value;
		var helpful = document.getElementById("helpful");
		document.getElementById("h").innerHTML = helpful.value;
		var good_examples = document.getElementById("good_examples");
		document.getElementById("ge").innerHTML = good_examples.value;
	}
</script>
</body>
</html>