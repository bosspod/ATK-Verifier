<?php
session_start();
$_SESSION["lang"] = $_GET["lang"];
session_write_close();
$page = $_GET["page"];
if($page == 'home'){
	header("location:home");
}else{
	header("location:home");
}
?>