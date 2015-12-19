<?php
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","video_recommender");



$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if(mysqli_connect_errno())
{
die("Database connection failed".mysqli_connect_error()."(".mysqli_connect_errno().")");
}
else
{
	//echo "Connection is successful";
}

/*$insert_sql = "INSERT INTO recipes(cid,rname,ingredients,quantities,method) VALUES(1,'{$rname}','{$ingredients}','{$quantities}','{$method}')";
echo $insert_sql;
*/

//mysqli_query($connection,$insert_sql);


?>
<?php
function confirm_query($result_set){
//test to check if the query has errors
if(!$result_set)
die("Database query failed."); 
}
?>
