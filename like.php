<?php
require_once("./includes/session.php");
include("./includes/functions.php");

//include("rfunctions.php");
global $connection;
//current lid watching
$lid =	$_REQUEST["lid"];	// $_SESSION['lid'];
$cid = 	find_category_id($lid);
$uid =	$_SESSION['login_user_uid']; //8;
$q = $_REQUEST["q"];

echo update_like_counts($lid,$cid,$uid,$q);



?>
