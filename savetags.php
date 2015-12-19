<?php
require_once("./includes/session.php");
include("./includes/functions.php");

$tag1 = $_REQUEST["tag1"];
$tag2 = $_REQUEST["tag2"];
$tag3 = $_REQUEST["tag3"];

$uid = $_SESSION['login_user_uid']; //find the current user
$lid =	$_REQUEST["lid"];
$cid = 	find_category_id($lid); //find the current category the user is in
//echo $tag1.",".$tag2.",".$tag3;


echo save_tags($tag1,$tag2,$tag3,$uid,$lid,$cid);




?>