<?php
mysql_connect('localhost','root','') or die ("cannot connect to the database");
mysql_select_db("lgu") or die ("cannot connect database name");

if(isset($_POST['userid'])){

$user=$_POST['userid'];
$Date1=$_POST['Date1'];
$Date2=$_POST['Date2'];

$query="SELECT id FROM userinfo_copy WHERE NAME='$user';";
$res=mysql_query($query);
list($name1)=mysql_fetch_array($res);

$query="insert into dtrme (`dtr`, `Date1`, `Date2`) values ('$name1','$Date1', '$Date2');";
if(mysql_query($query)){

    header('location:mobiles3.php');	
    
    
    }

    }

//

?>