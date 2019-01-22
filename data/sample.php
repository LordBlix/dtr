<?php


if (issset($_POST['userid'])){
$_POST['userid']=$userid;
$_POST['Date1']=$d8;
$_POST['Date2']=$d8f;

mysql_connect('localhost','root','' or die ("cannot connect to database"));
mysql_select_db('lgu') or die ("cannot connect to table");

$query = "select * from userinfo-copy where date between '$d8' and '$d8f' order by userid DESC";
$res = mysql_query($query);


while $row (mysql_fetch_array($res){

echo "<p>" $res['userid'] "</p";
echo "<p>" $res['name'] "</p>";

}

class lgu function (){

    public $this->username
    private Date;
    private Date1;
    private date token;
    private data-created;
    



}






} else
{

    echo "POST Failed";
}








?>
