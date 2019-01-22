<?php
	include('db.php');
							
					

						

									
									$location=$_FILES["image"]["name"];
									$permitNo= $_POST['permitNo'];
									$taxPayer= $_POST['taxPayer'];
									$businessName= $_POST['businessName'];
									$address= $_POST['address'];
									$email= $_POST['email'];
									$orNo= $_POST['orNo'];
									$ctcDate = $_POST['Date2'];
									$orDate = $_POST['Date1'];
									$ctcNo = $_POST['ctcNo'];


									
						mysql_query("insert into maclearance (taxpayer) 
						values('dddd')")or die(mysql_error());
									
										header('location:index.php');
									
							
?>								