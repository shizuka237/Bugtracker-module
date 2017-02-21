<?php
 include 'clickjacking.php';

session_start();
if(isset($_SESSION['userid'])){
//	print 'hey';

session_destroy();
header("location:index.html");
}
?>
