	    <!-- Button to trigger modal -->

    <!-- Modal -->
    <div id="myModaledit<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">

    <h3 id="myModalLabel">Add</h3>
    </div>
    <div class="modal-body">
	<?php ?>
	
					<form method="post" action="edit.php"  enctype="multipart/form-data">
					<table class="table1">
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">TradeName</label></td>
							<td width="30"></td>
							<td><input type="text" name="fname" placeholder="TradeName" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">MiddleName</label></td>
							<td width="30"></td>
							<td><input type="text" name="mname" placeholder="MiddleName" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">LastName</label></td>
							<td width="30"></td>
							<td><input type="text" name="lname" placeholder="LastName" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Address</label></td>
							<td width="30"></td>
							<td><input type="text" name="address" placeholder="Address" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Email</label></td>
							<td width="30"></td>
							<td><input type="email" name="email" placeholder="Email" required /></td>
						</tr>
						<tr>
							<td><label style="color:#3a87ad; font-size:18px;">Image</label></td>
							<td width="30"></td>
							<td><input type="file" name="image" required /></td>
						</tr>
						
					</table>
					
	
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button type="submit" name="Submit" class="btn btn-primary">Add</button>
    </div>
	

					</form>
    </div>			