<!DOCTYPE html>
<html>
<?php include("rfunctions.php"); ?>

<head><title>Watch Video</title>
<style>
	
	a {
    line-height: 1em;
    display: inline-block;
    text-decoration: none;
    padding: 15px;
    left: 50px;
    margin: 12px;
}
#videodiv{
	width:800px; margin:0 auto;
}
#display{
width:800px; margin:0 auto;	
}
</style>
<script>
	function add(str) {
		console.log("this was clicked "+str);
              
         var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(str).value = xmlhttp.responseText;
               // document.getElementById("display").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "like.php?q=" + str, true);
        xmlhttp.send();
    }
    function subtract(str) {
		console.log("dislike was clicked "+str);
              
         var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(str).value = xmlhttp.responseText;
                //document.getElementById("display").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "dislike.php?q=" + str, true);
        xmlhttp.send();
    }
function savetags(){
	var tag1 = document.getElementById("tag1").value;
	var tag2 = document.getElementById("tag2").value;
	var tag3 = document.getElementById("tag3").value;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               // document.getElementById(str).value = xmlhttp.responseText;
                document.getElementById("tagresponse").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "savetags.php?tag1="+tag1+"&tag2="+tag2+"&tag3="+tag3, true);
        xmlhttp.send();


}
function loadlikecounts(){
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
        xmlhttp.open("GET", "loadcounts.php?lid=1",true);
        xmlhttp.send();

}

</script>

</head>
<body onload="loadlikecounts()">
<div id="videodiv">
<div id="showvideo">
	<?php 
	//if(isset($_GET['lid']))
	//echo showvideo($_GET['lid']); 
	echo showvideo(1); 
	?>
</div>
<!-- voting markup -->

<div id="voting">
<img src="thumbup.png" width="30" height="30" onclick="add('w_score')">
<img src="thumbdown.png" width="40" height="40" onclick="subtract('w_score')">
<label for="w_score">Well Explained</label><input type="text" id="w_score" size="6" disabled><br>
<br>
<img src="thumbup.png" width="30" height="30" onclick="add('c_score')">
<img src="thumbdown.png" width="40" height="40" onclick="subtract('c_score')">
<label for="c_score">Completeness</label><input type="text" id="c_score" size="6" disabled><br>
<br>
<img src="thumbup.png" width="30" height="30" onclick="add('h_score')">
<img src="thumbdown.png" width="40" height="40" onclick="subtract('h_score')">
<label for="h_score">Helpfulness   </label><input type="text" id="h_score" size="6" disabled><br>
<br>
<img src="thumbup.png" width="30" height="30" onclick="add('g_score')">
<img src="thumbdown.png" width="40" height="40" onclick="subtract('g_score')">
<label for="g_score">Good Examples</label><input type="text" id="g_score" size="6" disabled><br><br>
</div>
<div id="tagsdiv">
<p>Enter tags to improve recommendation in this category</p>
<input type="text" id="tag1" size="10" placeholder="tag1">
<input type="text" id="tag2" size="10" placeholder="tag2">
<input type="text" id="tag3" size="10" placeholder="tag2">
<input type="button" value="save tags" onclick="savetags()">
<div id="tagresponse"></div>
</div>
<br><br>
<div id="socialnavigation">
<img src="profilepic.png" width="90" height="90">
<img src="profilepic.png" width="90" height="90">
<img src="profilepic.png" width="90" height="90">
<img src="profilepic.png" width="90" height="90">
<br>
</div>

</div>
<div id="display">
<?php echo socialnavigation(); ?>
</div>

<!-- voting markup end -->

</body>
</html>