<?php 
session_start();
include("header.php");
mysql_connect('localhost','root','') or die ("cannot connect to the database");
mysql_select_db('lgu') or die ("cannot connect to table name");

$query3="select * from rank;";
$res3=mysql_query($query3);
$options = "                             ";
$options1="";
while($row0 = mysql_fetch_array($res3))
{
 if(isset($_POST['go'])){ $op=$_POST['go'];
     $options1=$options1."<option>$op</option>";
 } else { 
    $options1 = $options1."<option>$row0[1]</option>";}
}

$query="select ID, Date1, Date2 from dtrme order by ID Desc limit 1;";

$res=mysql_query($query);

list($userid, $Date1, $Date2)=mysql_fetch_array($res);
$update=false;

if(isset($_POST['go'])){
 $go=$_POST['go'];
 $update = true;

 $query2="select id from rank where Status='$go';";
 $res5=mysql_query($query2);
 list($title)=mysql_fetch_array($res5);


$query1="SELECT * FROM dep_head ;";

$res1=mysql_query($query1);


while($row2 = mysql_fetch_array($res1))
{
    $options = $options."<option>$row2[1]</option>";
}
}




?>
<html>

<link rel="stylesheet" href="jquery-ui.css">
<script language="javascript" src="jquery-1.10.2.js"></script>
<script language="javascript" src="jquery-ui.js"></script>

<script>
$(function(){
    $( "#date1" ).datepicker({dateFormat: 'yy-mm-dd'});
    $( "#date1" ).datepicker("show");
    $( "#date2" ).datepicker({dateFormat: 'yy-mm-dd'});
    $( "#date2" ).datepicket("show");
});
</script>



<h1>DTR</h1>
<body>
<form method="POST" action="data/mobiles.php" style="width:200px">
<table bgcolor="#99CCFF">
	<td><td>
		<strong>DTR</strong> <br /><br />
Enter Date1: <input type="text" id="date1" name="Date1" required="required" value="<?php echo $Date1; ?>"><br>
Enter Date2: <input type="text" id="date2" name="Date2" required="required" value="<?php echo $Date2; ?>"><br>
USERID     : <br>

<?php if ($update == true): ?>

<select name="userid" type="text" value="<?php echo $options ?>">
            <?php echo $options; ?>
			<input type="submit" value="Enter" name="submit"><br>
        </select><br>
<?php else:?>	
<?php endif ?>	



</form>
<form method="POST" action="" style="width:200px">


<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
    
<?php else: ?>
<select name="go" type="text" value="<?php echo $options1 ?>">
<?php echo $options1;?>

</select>

	<button class="btn" type="submit" name="save" >Select</button>
<?php endif ?>
</form>
</table>
</body>
</html>