	    <!-- Button to trigger modal -->
    <a class="btn btn-primary" href="#myModal" data-toggle="modal">Click Here To Add</a>
	<br>
	<br>
	<br>
    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
<?php
 include('conn.php');

 function dbquery($con1, $query){

    return mysqli_query($con1,$query);
}


function getarray($con1, $query){
    return mysqli_fetch_array(mysqli_query($con1,$query));
}

$result1 = dbquery($con1,("SELECT max(permitNo) as permitNo FROM maclearance"));
while($row1  = mysqli_fetch_array($result1)){
    $use = $row1[permitNo]+1;}
?>
    <h3 id="myModalLabel">Add</h3>
    </div>
    <div class="modal-body">
	
					<form method="post" action="add.php"  enctype="multipart/form-data">
					<table class="table1">
					<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Permit No.</label></td>
							<td width="30"></td>
							<td><input type="text" name="permitNo" placeholder="Permit No." value="<?php echo $use; ?>" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Taxpayer's Name</label></td>
							<td width="30"></td>
							<td><input type="text" name="taxPayer" placeholder="Taxpayer" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Business Name</label></td>
							<td width="30"></td>
							<td><input type="text" name="businessName" placeholder="businessName" /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Address</label></td>
							<td width="30"></td>
							<td><input type="text" name="address" placeholder="Address" /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">CTC No</label></td>
							<td width="30"></td>
							<td><input type="text" name="ctcNo" placeholder="Address" /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Image</label></td>
							<td width="30"></td>
							<td><input type="file" name="image"  /></td>
						</tr>
						
					</table>
					
	
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-primary">Add</button>
    </div>
	

					</form>
    </div>			