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
  //$mpdf=new mPDF('win-1252','Legal-L',-1,-1,-1,'','','',-1,-1);
  $mpdf=new mPDF('win-1252', array(380,230),-1,-1,-1,-1,-1,-1,-1,-1);
    $mpdf->keepColumns = true;
    $mpdf->keep_table_proportions = true;
$mpdf->use_embeddedfonts_1252 = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetAuthor("Roche80 Solutions");
//$mpdf->showImageErrors = true;
$mpdf->Image('./watermark.jpg', 0, 0, 10, 29, 'jpg', '', true, true);
//$mpdf->SetDisplayMode(40);
$mpdf->SetWatermarkImage('./watermark.png');
$mpdf->showWatermarkImage = true;
//$mpdf->Setcolumns(1);
$ID=$_GET['id'];
list($col)=getarray($con1,("select count(*) from userinfo_copy where Deptcode=$ID;"));
list($man, $desc, $cen)=getarray($con1, ("SELECT mun, desig, post FROM mun ORDER BY ID DESC LIMIT 1;"));
dbquery($con1,("UPDATE maclearance SET  release1=1 WHERE ID=$ID;"));
$mpdf->Setcolumns(1);
if($col>2){
    $mpdf->Setcolumns(1);
    }
    else
    {
        $mpdf->Setcolumns(1);
    }

$result1 = dbquery($con1,("SELECT * FROM maclearance where ID=$ID;"));
//$ret="select count(*) from userinfo_copy where ID=5";
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



list($stat)=getarray($con1,("select title from userinfo_copy where ID='$use';"));
list($use1, $date1, $Date2, $mo, $d8, $d8f, $yr)=getarray($con1, ("SELECT dtr, Date1, 
Date2, DATE_FORMAT(Date1, '%M'), DATE_FORMAT(Date1, '%e'), DATE_FORMAT(Date2, '%e'), DATE_FORMAT(Date2, '%Y') FROM dtrme
where Status='$stat' ORDER BY id DESC LIMIT 1;"));
$date=$mo;
$me=$d8;
$me1=$d8f;
$me2=$yr;

//$n1="select name from userinfo_copy where id='$use'";
$n2="select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), date_format('$_POST[Date2]','%d'), year('$_POST[Date1]')";
$n3="select date_format('$_POST[Date2]','%d')";

//"select name, Head1, Head2 FROM userinfo_copy a LEFT JOIN dep_head b ON  a.Deptcode=b.ID where a.id"
$ff="17";
//list($name,$head, $head1, $ee, $ff)=getarray($con1, ("select name, Head1, Head2, spc, SSN FROM userinfo_copy a LEFT JOIN dep_head b ON  a.Deptcode=b.ID where a.id='$use';"));
list($name,$head, $head1, $ee, $ff, $fs, $spc0)=getarray($con1, ("SELECT NAME, b.Head1, b.Head2, b.spc, SSN, b.fs, b.spc0 FROM 
userinfo_copy a LEFT JOIN dep_head b ON  a.Deptcode=b.ID WHERE a.id='$use';"));
//list($name)=mysqli_fetch_array(mysqli_query($con1,$n1));
list($mo, $d8, $d8ff, $yr)=getarray($con1, ("select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), date_format('$_POST[Date2]','%d'), year('$_POST[Date1]')"));
//list($mo, $d8, $d8ff, $yr)=mysqli_fetch_array(mysqli_query($con1,$n2));

list($d8f)=getarray($con1, ("select date_format('$_POST[Date2]','%d');"));
//list($d8f)=mysqli_fetch_array(mysqli_query($con1,$n3));



$amini ="04:00:00";
$aminf="11:00:00";
$ckami="I";

$amouti="08:00:00";
$amoutf="13:28:00";
$ckamo="O";
//list($amouti)=getarray($con, ("select checkamouti from checktype where ID=1;"));
//list($amoutf)=getarray($con, ("select checkamouti from checktype where ID=1;"));
//$ckamo="O";
$pmini="12:00:00";
$pminf="18:28:00";
$ckpmi="I";
$pmouti="13:00:00";
$pmoutf="18:28:00";
$ckpmo="O";

$html = $html .'<HTML>
  <body>


  <CAPTION><EM>   
  
 <tr>';

$html2 = $html2 .'
<htmlpageheader name="myheader">
<table width="100%">
    <tr><td colspan="10" style="color:#000000;" ><img src="./headerlogo1.png" height=200 /></td></tr>
    
    <tr>
    <td><img src="./12.png" width="60px" height="20"><td colspan="8" align="center"><p align="center" style=" font-family:arial;  font-size: 18px">OFFICE OF THE MUNICIPAL MAYOR </p>
    </td>
    <td><img src="./13.png" width="60px" height="22"></td>
    </tr>
    


    <tr><td><img src="./12.png" width="60px" height="20"><td colspan=8><p align="justify" style=" font-family:arial; font-size: 10px">&nbsp;</p></td>
    <td><img src="./13.png" width="60px" height="22"></td>
    </tr>
<tr>
<td colspan="7"><img src="./12.png" width="60px" height="20"></td>
   <td colspan="2"><p align="center" style=" font-family:arial; font-weight:bold; font-size: 18px">Permit No. <u>'.str_pad($row1[permitNo],3,'0',STR_PAD_LEFT).'-2019</u></p></td>
   <td><img src="./13.png" width="60px" height="22"></td>
   </tr>

    <tr>
    <td><img src="./12.png" width="60px" height="20"></td>
    <td colspan="8"><p align="center" style=" font-family:arial; font-size: 18px">TO WHOM IT MAY CONCERN:</p></td>
    <td><img src="./13.png" width="60px" height="22"></td>
    <tr>
    <td><img src="./12.png" width="60px" height="20"><td>
<td colspan="7"><p align="justify" style=" font-family:arial; font-size: 18px">&nbsp;</p></td>
<td><img src="./13.png" width="60px" height="22"></td>
</tr>

    <tr>
    <td width="6%"><img src="./12.png" width="60px" height="20"></td>
    <td width="4%">2</td>
    <td width="3%">3</td>
    <td width="12%">4</td>
    <td width="5%">5</td>
    <td width="13%">6</td>
    <td width="15%">7</td>
    <td width="10%">8</td>
    <td width="27%">9</td> 
    <td width="3%"><img src="./13.png" width="60px" height="22"></td> 
    </tr>
    
<tr>
<td><img src="./15.png" width="60px" height="60"></td>
<td colspan="8" align="justify"><p align="justify" style=" font-family:arial; font-size: 18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <span align="justify" style="  font-family:arial; font-weight:bold; font-size: 30px"><u>'.strtoupper($row1[client]).'</u></span> of '.ucwords($row1[peraddress]).' after having complied with existing rules and regulations and paid the corresponding fees as required by laws and ordinance is hereby granted this</p></td>
<td><img src="./16.png" width="60px" height="62"></td>
</tr>
<tr>
<td><img src="./12.png" width="60px" height="20"></td>
<td colspan=8><p align="justify" style=" font-family:arial; font-size: 10px">&nbsp;</p></td>
<td><img src="./13.png" width="60px" height="22"></td>
</tr>
<tr>
<td><img src="./15.png" width="60px" height="60"></td>
<td colspan="8" align="center"><p align="justify" style=" font-family:arial; font-weight:bold; font-size: 30px">BUSINESS PERMIT</p></td>
<td><img src="./16.png" width="60px" height="62"></td>
</tr>

<tr>
<td><img src="./15.png" width="60px" height="60"></td>
<td align="justify" colspan="8"><p align="justify" style=" font-family:arial; font-size: 18px">authorizing him/her to operate a <span align="justify" style="  font-family:arial; font-weight:bold; font-size: 30px"><u>'.strtoupper($row1[busOperate]).'</u></span> for the '.strtoupper($row1[yea]).' indicated in the receipt as attested by the
Municipal Treasurer of his/her authorized representative unless sooner revoked or cancelled for cause which thereby subject the fees paid therefore to be forfeited.
</p></td>
<td><img src="./16.png" width="60px" height="62"></td>
<tr>

<td><img src="./15.png" width="60px" height="60"></td>
<td colspan="8" align="justify"><p align="justify" style=" font-family:arial; font-size: 18px">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Issued this '.date("j",strtotime(Now)).'th day of '.date("F",strtotime(Now)).' '.date("Y",strtotime(Now)).' at Sison, Surigao Del Norte Philippines.
</p></td>
<td><img src="./16.png" width="60px" height="62"></td>
</tr>
<tr>
<td><img src="./15.png" width="60px" height="40"></td>
<td colspan="5"></td>
<td colspan="3" align='.$cen.'><p align="justify" style=" font-family:arial; font-weight:bold; font-size: 25px">'.$man.'</p>
<td><img src="./16.png" width="60px" height="42"></td>
</tr>

<tr>
<td colspan="6"><img src="./15.png" width="60px" height="40"></td>
<td colspan="3" align='.$cen.'><p align="justify" style=" font-family:arial; font-size: 25px">'.$desc.'</p></td>
<td><img src="./16.png" width="60px" height="42"></td>
</tr>
<tr>
<td><img src="./14.png" width="60px" height="10"></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 10px">Paid Under</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 10px">: Php. 325.00</p></td>
<td><img src="./17.png" width="60px" height="10px"></td>
</tr>
<tr>
<td><img src="./14.png" width="60px" height="10"></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 10px">O.R. No.</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 10px">: '.$row1[orNo].'-Z</p></td>
<td><img src="./17.png" width="60px" height="10px"></td>
</tr>
<tr>
<td><img src="./14.png" width="60px" height="10"></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 10px">Issued on</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 10px">: '.date("F j, Y",strtotime($row1[date2])).'</p></td>
<td><img src="./17.png" width="60px" height="10px"></td>
</tr>
<tr>
<td><img src="./14.png" width="60px" height="10"></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 10px">Issued at</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 10px">: Sison, Surigao Del Norte</p></td>
<td><td>
</tr>
<tr>
<td colspan="9"><img src="./15.png" width="60px" height="60"></td>
<td><img src="./16.png" width="60px" height="62"></td>
</tr>
</table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<table width="100%">
	<tr>
		<td style="color:#000000;" width=15%><img src="./footerlogo1.png" height=100 /></td>

	</tr>
	<tr>
	<td></td>
</table>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />';




}
$path       = "upload/";
list($man1, $man2, $man3)=getarray($con1, ("SELECT permitNo, client, tradeName from maclearance where ID=$ID;"));
$file_name="BUSINESS PERMIT NO. ".str_pad($man1,3,'0',STR_PAD_LEFT)."-2019 - ".strtoupper($man2)."-".strtoupper($man3).".pdf";
$html6.='BUSINESS PERMIT NO '.str_pad($row1[permitNo],3,'0',STR_PAD_LEFT).'-2019.pdf';
$mpdf->WriteHTML($html2,2);
$mpdf->Output($file_name, "I");
 exit;

exit;
