<?php  include('server.php'); ?>

<?php
mysql_connect('localhost','root','') or die ("cannot connect to the database");
mysql_select_db('lgu') or die ("cannot connect to table name");


?>

<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM userinfo_copy WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['Name'];
			$badge = $n['Badgenumber'];
			$address = $n['TITLE'];
		}
	}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Employee details</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
<?php $results = mysql_query("SELECT * FROM userinfo_copy order by Name asc"); ?>


	<form method="post" action="server.php" >
	<input type="hidden" name="id" value="<?php echo $id; ?>">


<input type="text" name="name" value="<?php echo $name; ?>">
<input type="text" name="name" value="<?php echo $badge; ?>">
<input type="text" name="address" value="<?php echo $address; ?>">
<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?>
		</div>
	</form>

	<table>
	<thead>
		<tr>
			<th>Employee Name</th>
			<th>Badge number</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysql_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['Name']; ?></td>
			<td><?php echo $row['Badgenumber'] ?> </td>
			<td><?php echo $row['TITLE']; ?></td>
			<td>
				<a href="index.php?edit=<?php echo $row['ID']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="server.php?del=<?php echo $row['ID']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
</body>
// ...


</html>