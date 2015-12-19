<!DOCTYPE html>
<html>
<?php include("./includes/functions.php"); ?>
<?php include("tab.php");
?>
<?php  require_once("./includes/session.php");?>
<head><title>Watch Video</title>
<style>
	a {
    line-height: 1em;
    display: inline-block;
    text-decoration: none;
    padding: 15px;
    margin: 12px;
}
</style>
<script>
	function add(str) {
		//document.getElementById(str).value = "";
		console.log("this was clicked "+str);
        var lid = document.getElementById('lid').value;  
         var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(str).value = xmlhttp.responseText;
               // document.getElementById("display").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like.php?lid="+lid+"&q=" + str, true);
        xmlhttp.send();
    }
    function subtract(str) {
		//document.getElementById(str).value = "";
		console.log("dislike was clicked "+str);
              var lid = document.getElementById('lid').value;
         var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(str).value = xmlhttp.responseText;
                //document.getElementById("display").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "dislike.php?lid="+lid+"&q=" + str, true);
        xmlhttp.send();
    }
function savetags(){
	var tag1 = document.getElementById("tag1").value;
	var tag2 = document.getElementById("tag2").value;
	var tag3 = document.getElementById("tag3").value;
    var lid = document.getElementById('lid').value;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               // document.getElementById(str).value = xmlhttp.responseText;
                document.getElementById("tagresponse").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "savetags.php?lid="+lid+"&tag1="+tag1+"&tag2="+tag2+"&tag3="+tag3, true);
        xmlhttp.send();


}
function loadlikecounts(){
    var lid = document.getElementById('lid').value;
	console.log(document.getElementById("h_score").value);
	var xmlhttp = new XMLHttpRequest();
	 xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               // document.getElementById(str).value = xmlhttp.responseText;
                var str = xmlhttp.responseText;
                var arr = str.split(",");
                document.getElementById("w_score").value = arr[0];
                document.getElementById("c_score").value = arr[1];
                document.getElementById("h_score").value = arr[2];
                document.getElementById("g_score").value = arr[3];
            }
        }
        xmlhttp.open("GET", "loadcounts.php?lid="+lid,true);
        xmlhttp.send();

}

</script>

</head>
<body onload="loadlikecounts()">
<br /><br /><br /><br /><br /><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-sm-5">
				<?php 
					if(isset($_GET['lid']))
					echo showvideo($_GET['lid']); 
					else
					echo showvideo(1);
				?>
		</div>
		<!-- voting markup -->
		<div class="col-sm-5  col-md-offset-1">
			<form role="form">
			<fieldset>
			<legend>Ratings</legend>
				<div class="form-group">
					<img src="thumbup.png" width="30" height="30" onclick="add('w_score')">
					<img src="thumbdown.png" width="40" height="40" onclick="subtract('w_score')">
					<label for="w_score">Well Explained &nbsp;&nbsp;&nbsp;</label><input type="textarea" id="w_score" disabled class="form-control-static input-sm text-center">
				</div>
				<!-- <textarea rows="5" cols="250" id="w_score"></textarea> -->
				<div class="form-group">
					<img src="thumbup.png" width="30" height="30" onclick="add('c_score')">
					<img src="thumbdown.png" width="40" height="40" onclick="subtract('c_score')">
					<label for="c_score">Completeness &nbsp;&nbsp;&nbsp;</label><input type="text" id="c_score" disabled class="form-control-static input-sm text-center">
				</div>
				<!-- <textarea rows="5" cols="250" id="c_score"></textarea>-->
				<div class="form-group">
					<img src="thumbup.png" width="30" height="30" onclick="add('h_score')">
					<img src="thumbdown.png" width="40" height="40" onclick="subtract('h_score')">
					<label for="h_score">Helpfulness &nbsp;&nbsp;&nbsp;</label><input type="text" id="h_score" disabled class="form-control-static input-sm text-center">
				</div>
				<div class="form-group">
					<img src="thumbup.png" width="30" height="30" onclick="add('g_score')">
					<img src="thumbdown.png" width="40" height="40" onclick="subtract('g_score')">
					<label for="g_score">Good Examples &nbsp;&nbsp;&nbsp;</label><input type="text" id="g_score" disabled class="form-control-static input-sm text-center">
				</div>
				<!--<div class="form-group">
					<label for"lid">Overall &nbsp;&nbsp;&nbsp;</label>
				</div>-->
			</form>
		</div>
	</div>
	<br /><input type="hidden" id="lid" value='<?php echo $_GET['lid'] ?>' disabled class="form-control-static input-sm text-center">
	<div class="row">
		<div class="col-sm-6">
		<form role="form">
			<fieldset>
			<legend>Enter tags to improve recommendation in this category</legend>
			<div class="form-group">
				<input type="text" id="tag1" size="10" placeholder="tag1" class="form-control-static input-lg text-center">&nbsp;&nbsp;&nbsp;
				<input type="text" id="tag2" size="10" placeholder="tag2" class="form-control-static input-lg text-center">&nbsp;&nbsp;&nbsp;
				<input type="text" id="tag3" size="10" placeholder="tag2" class="form-control-static input-lg text-center">&nbsp;&nbsp;&nbsp;
				<input type="button" value="save tags" onclick="savetags()" class="btn btn-info btn-lg">&nbsp;&nbsp;&nbsp;
				<div id="tagresponse"></div>
			</div>
			</fieldset>
		</form>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
		<?php $userArray = socialnavigation();?>
		<form role="form">
				<fieldset>				
					<?php 
						if($userArray != null && count($userArray)!=0){
							echo "<legend>Users who have rated this video</legend>";
							echo "<div class=\"row\">";
							for($n=0;$n<count($userArray);$n++){
								echo "<div class=\"col-sm-3\">";
								echo "<a href=\"./viewProfile.php?uname=".$userArray[$n]."\" class=\"thumbnail\"><img src=\"profilepic.png\" width=\"90\" height=\"90\"></a>";
								echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"./viewProfile.php?uname=".$userArray[$n]."\" class=\"caption btn btn-primary\">".$userArray[$n]."</a>";
								echo "</div>";
							}
							echo "</div>";
						}
					?>
				</fieldset>
		</form>
		</div>
	</div>
	<div class="row">
	<!--<div id="display">-->
		
	</div>
	<div id="counts"></div>
	<!-- voting markup end -->
	<!-- cummatesting -->
	</div>
</div>
</body>
</html>