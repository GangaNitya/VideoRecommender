<?php
include("./includes/connection.php");
if(isset($_REQUEST["lid"]))
$lid = $_REQUEST["lid"];
else
$lid = 1;

$scorearray = array();

global $connection;

$scorestring = "";
$query = "SELECT * FROM links WHERE lid={$lid}";
$result = mysqli_query($connection,$query);
confirm_query($result);
$row = mysqli_fetch_assoc($result);
$scorearray[0] = $row['wellexplained'];
$scorearray[1] = $row['complete'];
$scorearray[2] = $row['helpful'];
$scorearray[3] = $row['goodexamples'];

$scorestring = implode(",",$scorearray);
echo $scorestring;

$query2 = "UPDATE links SET click = click + 1 WHERE lid = {$lid}";
$result = mysqli_query($connection,$query2);
confirm_query($result);



?>