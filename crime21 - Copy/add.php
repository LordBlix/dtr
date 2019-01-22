<?php
	include('db.php');
							
					

						

									
									$location=$_FILES["image"]["name"];
									$permitNo= $_POST['permitNo'];
									$taxPayer= $_POST['taxPayer'];
									$businessName= $_POST['businessName'];
									$address= $_POST['address'];
									$ctcNo= $_POST['ctcNo'];

						mysql_query("insert into maclearance (permitNo, tradeName, client, address, ctcNo) 
						values($permitNo, $taxPayer, $businessName, $address, $ctcNo )")or die(mysql_error());
									
									
										header('location:index.php');
									
							
?>								