<?php
require_once("connection.php");
?>

<?php
function confirm_query($result_set){
//test to check if the query has errors
if(!$result_set)
die("Database query failed."); 
}
?>

<?php


function list_all_recipes_under($cuisine_option){
global $connection;
	$query = "SELECT rid,rname FROM recipes WHERE ";
$query .= "cid = {$cuisine_option}";
echo $query;
$result = mysqli_query($connection,$query);

confirm_query($result);
$html ="";
while($row = mysqli_fetch_assoc($result)){

		$html .= "<h4><a href='recipedisplay.php?rid=".$row['rid']."&rname=".$row["rname"]."'>".$row["rname"]."</a></h4>";
		//$html .= "<br>";
}
return $html;
}
?>
<?php
function get_recipe_ingredientsAndquantity($rid){


global $connection;
	$query = "SELECT ingredients,quantities FROM recipes WHERE ";
$query .= "rid = {$rid}";
echo $query;
$result = mysqli_query($connection,$query);

confirm_query($result);
$html ="";
while($row = mysqli_fetch_assoc($result)){

	$ingredientsArray = explode(',',$row['ingredients']);
	$quantitiesArray = explode(',',$row['quantities']) ;
	for($i=0;$i<count($ingredientsArray);$i++){
		$html .= "<h4>".$ingredientsArray[$i]."---".$quantitiesArray[$i]."</h4>";
	}

		
		//$html .= "<br>";
}
return $html;




}

function get_recipe_method($rid){


global $connection;
	$query = "SELECT method FROM recipes WHERE ";
$query .= "rid = {$rid}";
echo $query;
$result = mysqli_query($connection,$query);

confirm_query($result);
$html ="";
while($row = mysqli_fetch_assoc($result)){

		$html .= "<h4>".$row['method']."</h4>";
		//$html .= "<br>";
}
return $html;

}
?>