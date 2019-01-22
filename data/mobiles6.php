<?php
	 include("../mpdf/MPDF57/mpdf.php");
	 include('conn.php');
	ini_set("memory_limit","1024M");
	ini_set("max_execution_time",0);
	
	//$cutoff = $_REQUEST['cutoff'];
	//if($_REQUEST['ee'] != "") { $x1 = " and a.emp_id='$_REQUEST[ee]' "; }
	//list($dtf,$dt2, $dtf1, $dt21, $code) = mysql_fetch_array(mysql_query("select dtf, dt2, date_format(dtf,'%m/%d/%Y'), date_format(dt2,'%m/%d/%Y'), date_format(dt2,'%m%d%Y') as code from payroll_cutoffs where cutoff = '$cutoff';"));
	//$q = mysql_query("SELECT emp_id, ename, BIRTHDATE, BDAY, D_HIRED, SHIFT, DESG, BASIC_RATE, ALLOWANCE, TWORK AS HRS, ROUND(TWORK/8,2) AS TWORK, ROUND(ROUND(TWORK/8,2) * BASIC_RATE,2) AS BASIC_PAY, ROUND(ROUND(BASIC_RATE/8,2) * OT,2) AS OT, SSS_CONTRIB, PAGIBIG_CONTRIB, PHILHEALTH_CONTRIB FROM (SELECT a.emp_id, CONCAT(LNAME,', ',FNAME) AS ename, BIRTHDATE, DATE_FORMAT(BIRTHDATE,'%m/%d/%Y') AS BDAY,DATE_FORMAT(D_HIRED,'%m/%d/%Y') AS D_HIRED, b.SHIFT, b.BASIC_RATE, B.DESG, B.ALLOWANCE, SUM(TOT_HRS) AS TWORK, SUM(TOT_OT) AS OT, SUM(TOT_LATE) AS LATE, SUM(TOT_UT) AS UT, SSS_CONTRIB, PAGIBIG_CONTRIB, PHILHEALTH_CONTRIB FROM payroll_dtrfinal a LEFT JOIN payroll_empdetails b ON a.emp_id=b.emp_id WHERE `date` BETWEEN '$dtf' AND '$dt2' $x1 GROUP BY a.emp_id ORDER BY b.LNAME) a WHERE ename IS NOT NULL AND TWORK > 0;;");
	function dbquery($con1, $query){

    return mysqli_query($con1,$query);
}


function getarray($con1, $query){
    return mysqli_fetch_array(mysqli_query($con1,$query));
}



  //  $mpdf=new mPDF('win-1252','Legal','','',15,15,2,2,10,10);
  $mpdf=new mPDF('win-1252','Legal','','',18,15,2,10,16,10);
    $mpdf->keepColumns - true;
    $mpdf->keep_table_proportions = true;
$mpdf->use_embeddedfonts_1252 = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetAuthor("Roche80 Solutions");
$mpdf->SetDisplayMode(40);
$mpdf->Setcolumns(2);
//$roche1="select * from userinfo_copy where title='1' limit 5;";
//$result
//$result1   = mysqli_query($con1,$roche1);
$tala='2';
$det='5';



//$result1 = dbquery($con1,("select * from userinfo_copy where title='$tala' limit 2;"));

//$result1 = dbquery($con1,("select * from userinfo_copy where title='$tala' and Deptcode=$det;"));
$result1 = dbquery($con1,("select * from userinfo_copy where title='$tala';"));
//$result1 = dbquery($con1,("select * from userinfo_copy where title='$tala' and ID=5;"));
$ret="select count(*) from userinfo_copy where ID=5";
$fet=mysql_num_rows($ret);
echo "$ret";
if($fet>1){
$ret="2";
}
else
{
   $ret="1"; 
}
    //$mpdf->Setcolumns($ret);
 

while($row1  = mysqli_fetch_array($result1)){
    $use = $row1[ID];

   // $roche = "SELECT dtr, Date1, Date2, DATE_FORMAT(Date1, '%M'), DATE_FORMAT(Date1, '%e'), DATE_FORMAT(Date2, '%e'), DATE_FORMAT(Date2, '%Y') FROM dtrme ORDER BY id DESC LIMIT 1;";
//$result   = mysqli_query($con1,$roche);
list($use1, $date1, $Date2, $mo, $d8, $d8f, $yr)=getarray($con1, ("SELECT dtr, Date1, 
Date2, DATE_FORMAT(Date1, '%M'), DATE_FORMAT(Date1, '%e'), DATE_FORMAT(Date2, '%e'), DATE_FORMAT(Date2, '%Y') FROM dtrme ORDER BY id DESC LIMIT 1;"));
$date=$mo;
$me=$d8;
$me1=$d8f;
$me2=$yr;

//$n1="select name from userinfo_copy where id='$use'";
$n2="select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), date_format('$_POST[Date2]','%d'), year('$_POST[Date1]')";
$n3="select date_format('$_POST[Date2]','%d')";

//"select name, Head1, Head2 FROM userinfo_copy a LEFT JOIN dep_head b ON  a.Deptcode=b.ID where a.id"
$ff="17";
list($name,$head, $head1, $ee, $ff, $fs, $spc0)=getarray($con1, ("select name, Head1, Head2, spc, SSN, fs, spc0 FROM userinfo_copy a LEFT JOIN dep_head b ON  a.Deptcode=b.ID where a.id='$use';"));
//list($name)=mysqli_fetch_array(mysqli_query($con1,$n1));
list($mo, $d8, $d8ff, $yr)=getarray($con1, ("select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), date_format('$_POST[Date2]','%d'), year('$_POST[Date1]')"));
//list($mo, $d8, $d8ff, $yr)=mysqli_fetch_array(mysqli_query($con1,$n2));

list($d8f)=getarray($con1, ("select date_format('$_POST[Date2]','%d');"));
//list($d8f)=mysqli_fetch_array(mysqli_query($con1,$n3));


$amini ="04:00:00";
$aminf="09:00:00";
$ckami="I";
//list($amini)=getarray($con, ("select checkamini from checktype where ID=1;"));
//list($aminf)=getarray($con1, ("select checkaminf from checktype where ID=1;"));
//list($ckami, $ckamo, $ckpmi, $ckpmo)=getarray($con1, ("select ckami, ckamo, ckpmi, ckpmo from checktype where ID=1;"));
$amouti="11:00:00";
$amoutf="13:28:00";
$ckamo="O";
//list($amouti)=getarray($con, ("select checkamouti from checktype where ID=1;"));
//list($amoutf)=getarray($con, ("select checkamouti from checktype where ID=1;"));
//$ckamo="O";
$pmini="12:00:00";
$pminf="13:28:00";
$ckpmi="I";
$pmouti="14:39:00";
$pmoutf="18:28:00";
$ckpmo="O";


//$fs="14";

$result = dbquery($con1,("SELECT  * from userinfo_copy;"));
  //$result   = mysqli_query($con1,$sql);

  
  $html= $html .'<HTML>
  <body>

  <CAPTION><EM>   
  <table width="50%"> 
 <tr><td width="50%">
 <p style="text-align:left: 140; font-family:arial; font-size: 10px;">Civil Service Form No. 48</p>
 <br>
 <p style="padding-left: 120px; font-family:arial; font-weight:bold; font-size: 16px">'.str_repeat("&nbsp;",13).'DAILY TIME RECORD </p>
 <br>
 <p style="padding-left: 120px; font-family:arial; font-size=19px">'.str_repeat("&nbsp;",23).'-----o0o-----</p>
<br>
 <p style="padding-left: 140px;  font-family:arial; font-size: 18px;">'.str_repeat("&nbsp;",$ff).''.$name.'<u>
 </u><br style="font-size=3px">'.str_repeat("&nbsp;",20).'(Name)</p>
 <br>
 <br>
 <p style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of '.str_repeat("_",6).'<u><b>'.$date.' '.$me.' - '.$me1.', '.$me2.'</b></u>_____<br> 	
 Official hours for arrival<b>'.str_repeat("&nbsp;", 14).'</b> {Regular days'.str_repeat("_",10).'<br>
 '.str_repeat("&nbsp;",8).' and departure '.str_repeat("&nbsp;", 23).' {Saturdays'.str_repeat("_",10).'
	</td>
	</tr>
	</table>
	</EM></CAPTION>

	<table style="border-collapse: collapse;" border="1" width="10%">
        <thead>
        <tr>
        <th rowspan="2"><b>Day</b><th colspan="2"><br><b>A.M.</b>
        <th colspan="2"><br><b>P.M.</b><th colspan="2"><b>Under-<br>time</b>
        <TR><th><b>Arrival</b><th><b>Depar-<br>ture</b> 
        <th><b>Arrival</b>
        <th><b>Depar-<br>ture</b> 
        <th><b><br>Hours</b><th><b>Min-<br>utes</b>
                </thead>
            
			<tbody>';
			//$result     = mysqli_query($con1,$sql);
		
    $html = $html .'</table>';
    $ii="1";
	$html = $html .'</table>
	<p style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("&nbsp;", 14).'<b>TOTAL</b>'.str_repeat("_",20).'</p>
	<p style="text-align:justify; font-family:arial; font-size: 13px;">'.str_repeat("&nbsp;",5).'I CERTIFY <i>on my honor that the above is a true<br> and correct report
	  of the hours of work performed,<br> record of which was made daily at
	  the time  of arrival <br> and departure from office.</i> </p>
	  <p style="padding-top: -12px; text-align:left; font-family:arial; font-size: 10px"> '. str_repeat("&nbsp;", 36).''.str_repeat("_",36).'</p>
	  <p style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.</p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"> '.str_repeat("-",69).'</p>';
if(tala==1){
    $html.='<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">
    '.str_repeat("&nbsp;",30).''.str_repeat("_",20).'</p>';
    }
$html .='<br><br><p style="text-align:left; padding-top:-10px; font-family:arial; font-size: '.$fs.'px">' .str_repeat("&nbsp;",$spc0). '<u>' .$head. '</u><br>'.str_repeat("&nbsp;",$ee). '<b>'.$head1 .'</b></p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"></p>
<p style="text-align:left; padding-left:25px; font-family:arial; font:size:10px"><b><i></b></p>
<columnbreak/>';

}
$html =$html .'</body></html>';    
$mpdf->WriteHTML($html);
$mpdf->Output(); exit;

exit;
