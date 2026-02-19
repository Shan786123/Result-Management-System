<?php 
require_once 'includess/config.php';

$_SESSION = array();

session_destroy();
header("Location: welcome.php");
exit();
?>



