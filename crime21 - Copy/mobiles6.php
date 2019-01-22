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
 // $mpdf=new mPDF('win-1252','L',-1,-1,-1,'','','',-1,-1);
  $mpdf=new mPDF('win-1252', array(215,330),-1,-1,-1,-1,-1,-1,-1,-1);
    $mpdf->keepColumns = true;
    $mpdf->keep_table_proportions = true;
$mpdf->use_embeddedfonts_1252 = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetAuthor("Roche80 Solutions");
$mpdf->SetDisplayMode(40);
//$mpdf->SetWatermarkImage('./watermark.png');
$mpdf->showWatermarkImage = true;
//$mpdf->Setcolumns(1);
$ID=$_GET['id'];

//values($permitNo, $taxPayer, $businessName, $address, $ctcNo )")or die(mysql_error());;"));

list($col)=getarray($con1,("select count(*) from userinfo_copy where Deptcode=$ID;"));
list($man, $desc, $cen, $spa)=getarray($con1, ("SELECT mun, desig, post, spa FROM mun ORDER BY ID DESC LIMIT 1;"));
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

    <tr><td colspan="10" style="color:#000000;" width=15%><img src="./headerlogo.png" height=200 /></td></tr>
    <tr><td colspan=8><p align="justify" style=" font-family:arial; font-size: 20px">&nbsp;</p></td></tr>
    <tr><td colspan="10" align="center"><p align="center" style=" font-family:Times New Roman;  font-weight:bold; font-size: 25px">OFFICE OF THE MUNICIPAL MAYOR </p></td></tr>
    <tr><td align="center" colspan="10"><p align="justify" style=" font-family:arial; font-size: 20px">_____________________________________________________________</p></td></tr>
    <tr><td colspan=8><p align="justify" style=" font-family:arial; font-size: 20px">&nbsp;</p></td></tr>
    <tr><td colspan="10" align="center"><p align="center" style=" font-family:Times New Roman; font-size: 30px">CLEARANCE </p></td></tr>
    <tr><td colspan=8><p align="justify" style=" font-family:arial; font-size: 20px">&nbsp;</p></td></tr>
    <tr><td></td><td colspan="7"><p align="center" style="font-weight:bold; font-family:arial; font-size: 20px">TO WHOM IT MAY CONCERN:</p></td></tr>
<tr><td colspan=8><p align="justify" style=" font-family:arial; font-size: 20px">&nbsp;</p></td></tr>
    <tr>
    <td width="9%">1</td>
    <td width="8%">2</td>
    <td width="3%">3</td>
    <td width="11%">4</td>
    <td width="3%">5</td>
    <td width="21%">6</td>
    <td width="7%">7</td>
    <td width="10%">8</td>
    <td width="19%">9</td> 
    <td width="9%">10</td> 
    </tr>

<tr>
<td></td>
<td colspan="8" align="justify">
<p align="justify" style=" font-family:arial; font-size: 20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>BUSINESS CLEARANCE</b> is hereby granted to <b><u>'.strtoupper($row1[client]).' </u></b>owned/represented by <u><b>'.strtoupper($row1[tradeName]).' </b></u>
located at <u><b>'.ucwords($row1[baraddress]).'</b></u>, operating and recognized in the Municipality of Sison, Province of Surigao Del Norte,
cleared from the barangay per barangay clearance attached, and no financial obligations from the Municipal Treasurers Office.
</td></tr>
<tr>
<td colspan=8><p align="justify" style=" font-family:arial; font-size: 20px">&nbsp;</p></td>
</tr>
<tr>
<td colspan=""></td>
<td colspan="8"><p align="justify" style=" font-family:arial; font-size: 19px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
THIS CLEARANCE IS BEING ISSUED upon request of the above-mentioned business operator for business purposes only.</td></tr>
<tr>

<td colspan=""></td>
<td colspan="8"><p align="right" style=" font-family:arial; font-size: 20px">

</td></tr>
<tr>
<td colspan=8><p align="justify" style=" font-family:arial; font-size: 20px">&nbsp;</p></td>
</tr>

<tr>
<td colspan="">
<td colspan="8" align="justify"><p align="justify" style=" font-family:arial; font-size: 20px">
<b>&nbsp;&nbsp;&nbsp;&nbsp;Issued this '.date("j",strtotime(now)).'th day of '.date("F",strtotime(now)).' '.date("Y",strtotime(now)).'</b> at Sison, Surigao Del Norte, Philippines.
</p></td>
</tr>
<tr>
<td colspan="">
<td colspan="8" align="justify"><p align="justify" style=" font-family:arial; font-size: 20px">

</p></td>
</tr>
<tr>
<td>&nbsp;
</td>
</tr>
<tr>
<td colspan="6"><p align="justify" style=" font-family:arial; font-weight:bold; font-size: 95px">&nbsp;</td>
</tr>
<tr>
<td colspan="5"></td>
<td colspan="4" align='.$cen.'><p align="center" style=" font-family:arial; font-weight:bold; font-size: 20px">'.$man.'</p>
</tr>
<tr>
<td colspan='.$spa.'>
<td colspan="5" align="right"><p align="justify" style=" font-weight:bold; font-family:arial; font-size: 20px">'.$desc.'</p>
</tr>
<tr>
<td colspan="6"><p align="justify" style=" font-family:arial; font-weight:bold; font-size: 105px">&nbsp;</td>
</tr>
<tr><td colspan="1"><td colspan="6" align="left"><p align="justify" style=" font-weight:bold; font-family:arial; font-size: 20px"><u><b>'.strtoupper($row1[client]).' </b></u></p></tr>
<tr><td colspan="1"><td colspan="8" align="left"><p align="justify" style=" font-family:arial; font-size: 20px">(Signature of Requesting Party)</p></tr>
<tr>
<td colspan="6"><p align="justify" style=" font-family:arial; font-weight:bold; font-size: 35px">&nbsp;</td>
</tr>
<tr>
<td></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 15px">Paid Under</p></td>
<td colspan="3"><p align="justify" style=" font-family:arial; font-size: 15px">: Php. 100.00</p></td>
</tr>
<tr>
<td></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 15px">O.R. No.</p></td>
<td><p align="justify" style=" font-family:arial; font-size: 15px">: '.$row1[orNo].'-Z</p></td>
</tr>
<tr>
<td></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 15px">Issued on</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 15px">: '.date("F j, Y",strtotime(now)).'</p></td>
</tr>
<tr>
<td></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 15px">Issued at</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 15px">: Sison, Surigao Del Norte</p></td>
</tr>
<tr>
<td colspan="6"><p align="justify" style=" font-family:arial; font-weight:bold; font-size: 35px">&nbsp;</td>
</tr>
<tr>
<td></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 15px">CTC No.</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 15px">: '.$row1[ctcNo].'</p></td>
</tr>
<tr>
<td></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 15px">Issued on</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 15px">: '.date("F j, Y",strtotime($row1[date2])).'</p></td>
</tr>
<tr>
<td></td>
<td colspan="2" align="justify"><p align="justify" style=" font-family:arial; font-size: 15px">Issued at</p></td>
<td colspan="6"><p align="justify" style=" font-family:arial; font-size: 15px">: Sison, Surigao Del Norte</p></td>
</tr>
</table>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<table width="100%">
	<tr>
		<td style="color:#000000;" width=15%><img src="./footerlogo.png" height=100 /></td>

	</tr>
	<tr>
	<td></td>
</table>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />';
$html2=$html2 .'<tr>
<td></td>
<tr>';
$html2 = $html2 .'';
$html3 = $html2 .'<p align="center" style=" font-family:arial; font-weight:bold; font-size: 16px">'.str_repeat("&nbsp;",16).'Province of Surigao Del Norte</p>';
$html3 = $html2 .'<p align="center" style=" font-family:arial; font-weight:bold; font-size: 16px">'.str_repeat("&nbsp;",16).'Municipality of Sison</p>';
$html3 = $html2.'<p style="padding-left: 100px; font-family:arial; font-size=19px">'.str_repeat("&nbsp;",15).'-----o0o-----</p>';
$html3 = $html2.' <p style="padding-left: 20px;  font-family:arial; font-size: 18px;">'.str_repeat("&nbsp;",$ff).'<u>'.$name.'</u>';
$html3 = $html2.'<p style="">'.str_repeat("&nbsp;",35).'(Name)</p>';
$html3 = $html2.'<p style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of '.str_repeat("&nbsp;",6).'<b><u>'.$date.' '.$me.' - '.$me1.', '.$me2.'</u></b><br>';	
$html3 = $html2.'Official hours for arrival<b>'.str_repeat("&nbsp;", 22).'</b> {Regular days'.str_repeat("_",7).'<br>
 '.str_repeat("&nbsp;",8).' and departure '.str_repeat("&nbsp;", 32).' {Saturdays'.str_repeat("_",8).'
	
    </tr>';
    
	$html3=$html2.'</table>
	</EM></CAPTION>
         
	<table style="border-collapse: collapse;"  width="10px">
        <thead>
        <tr>
        <th rowspan="2" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Day</b>
        <th colspan="2" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><br><b>A.M.</b>
        <th colspan="2" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><br><b>P.M.</b>
        <th colspan="3" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Under-<br>time</b>
       <TR>
        <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Arrival</b>
        
        
        <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
        
        
        <b>Depar-<br>ture</b> 



        <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
        
        
        <b>Arrival</b>


        <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
        
        <b>Depar-<br>ture</b> 

        <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
       
        <b><br>Hours</b>
        
     
        <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
        
        <b>Min-<br>utes</b>


        <th><b><br>    </b><th><b><i> <i><br><i>'.str_repeat("&nbsp;", 5).'<i></b>
     
                </thead>
            
			<tbody>';
			//$result     = mysqli_query($con1,$sql);
			while($row  = mysqli_fetch_array($result))
			{                    
			$html2 = $html2.'<tr font-family: sans-serif; font-size: 8pt;>
            <td font-family: sans-serif; font-size: 8pt; style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
            
            </td>  

            <td style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
            
        </td>

            <td style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
            
          </td>
            <td style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
            
     </td>                    
            <td style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
            
           </td>
            <td style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
            
            &nbsp;</td>
            <td style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
            
            </td>
			</tr>';

			}
    $html2 = $html2 .'</table>';
    $ii="1";
	$html3 = $html2 .'</table>
	<p style="text-align:left; font-family:arial font-size: 8px;">'.str_repeat("&nbsp;", 14).'<b>TOTAL</b>'.str_repeat("_",20).'</p>
    <p style="text-align:justify; font-family:arial; font-size: 12px;">'.str_repeat("&nbsp;",3).'';
    
    $html3=$html2 .'I  CERTIFY on my honor that  the  above  is  a  true  and correct';
    $html3= $html2 .'<br>report <i> of <i> the <i> hours <i> of <i> work <i> performed, <i> record <i> of <i>which';
    $html3= $html2 .'<br> was made daily at the  time of arrival and';
    $html3=$html2.' departure from';
    $html3=$html2. '<br>office.</i> </p>';
	$html3=$html2.' <p style="padding-top: -12px; text-align:left; font-family:arial; font-size: 10px"> '. str_repeat("&nbsp;", 36).''.str_repeat("_",36).'</p>
	  <p style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.</p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"> '.str_repeat("-",65).'</p>
';

//if( $row1[date2]>now() ){
   dbquery($con1,("UPDATE ignore maclearance SET date1=NOW() WHERE id=173"));
   


$html3 =$html2.'<br><p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">' .str_repeat("&nbsp;",$spc0). '<u><b>' .$head. '<b></u><br>'.str_repeat("&nbsp;",$ee). ''.$head1 .'</p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"></p>
<p style="text-align:left; padding-left:25px; font-family:arial; font:size:10px"><b><i></b><br><br><br><br><br><br><br></p>
<columnbreak/>';

}
$html3 =$html2 .'</body></html>';   

$mpdf->WriteHTML($html2);
$mpdf->Output(); exit;

exit;
