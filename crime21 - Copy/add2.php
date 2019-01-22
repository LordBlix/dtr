<?php
	include('db.php');
	$ID=$_GET['id'];
		$permitNo= htmlspecialchars($_POST['taxPayer']);
	$paid= $_POST['paid'];



	
mysql_query("UPDATE maclearance SET paid=$paid, permitNo='".$_POST['taxPayer']."', action='1' WHERE id=$ID")or die(mysql_error());
	
		header('location:index.php');
									
							
?>								