<?php
	 include("../mpdf/MPDF57/mpdf.php");
	 include('conn.php');
	ini_set("memory_limit","1024M");
	ini_set("max_execution_time",0);
	
	//$cutoff = $_REQUEST['cutoff'];
	//if($_REQUEST['ee'] != "") { $x1 = " and a.emp_id='$_REQUEST[ee]' "; }
	//list($dtf,$dt2, $dtf1, $dt21, $code) = mysql_fetch_array(mysql_query("select dtf, dt2, date_format(dtf,'%m/%d/%Y'), date_format(dt2,'%m/%d/%Y'), date_format(dt2,'%m%d%Y') as code from payroll_cutoffs where cutoff = '$cutoff';"));
	//$q = mysql_query("SELECT emp_id, ename, BIRTHDATE, BDAY, D_HIRED, SHIFT, DESG, BASIC_RATE, ALLOWANCE, TWORK AS HRS, ROUND(TWORK/8,2) AS TWORK, ROUND(ROUND(TWORK/8,2) * BASIC_RATE,2) AS BASIC_PAY, ROUND(ROUND(BASIC_RATE/8,2) * OT,2) AS OT, SSS_CONTRIB, PAGIBIG_CONTRIB, PHILHEALTH_CONTRIB FROM (SELECT a.emp_id, CONCAT(LNAME,', ',FNAME) AS ename, BIRTHDATE, DATE_FORMAT(BIRTHDATE,'%m/%d/%Y') AS BDAY,DATE_FORMAT(D_HIRED,'%m/%d/%Y') AS D_HIRED, b.SHIFT, b.BASIC_RATE, B.DESG, B.ALLOWANCE, SUM(TOT_HRS) AS TWORK, SUM(TOT_OT) AS OT, SUM(TOT_LATE) AS LATE, SUM(TOT_UT) AS UT, SSS_CONTRIB, PAGIBIG_CONTRIB, PHILHEALTH_CONTRIB FROM payroll_dtrfinal a LEFT JOIN payroll_empdetails b ON a.emp_id=b.emp_id WHERE `date` BETWEEN '$dtf' AND '$dt2' $x1 GROUP BY a.emp_id ORDER BY b.LNAME) a WHERE ename IS NOT NULL AND TWORK > 0;;");
	

	
//$head='KARISSA R. FETALVERO-PARONIA';
//$head1='Municipal Mayor';
	
	$mpdf=new mPDF('win-1252','Legal','','',15,15,2,2,10,10);
$mpdf->use_embeddedfonts_1252 = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetAuthor("Roche80 Solutions");
$mpdf->SetDisplayMode(40);
$roche1="select * from userinfo_copy where title='1' limit 2;";
$result1   = mysqli_query($con1,$roche1);

while($row1  = mysqli_fetch_array($result1)){
    $use = $row1[ID];
    $roche = "SELECT dtr, Date1, Date2, DATE_FORMAT(Date1, '%M'), DATE_FORMAT(Date1, '%e'), DATE_FORMAT(Date2, '%e'), DATE_FORMAT(Date2, '%Y') FROM dtrme ORDER BY id DESC LIMIT 1;";
$result   = mysqli_query($con1,$roche);
list($use1, $date1, $Date2, $mo, $d8, $d8f, $yr)=mysqli_fetch_array($result);
$date=$mo;
$me=$d8;
$me1=$d8f;
$me2=$yr;

$n1="select name from userinfo_copy where id='$use'";
$n2="select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), date_format('$_POST[Date2]','%d'), year('$_POST[Date1]')";
$n3="select date_format('$_POST[Date2]','%d')";



list($name)=mysqli_fetch_array(mysqli_query($con1,$n1));
list($mo, $d8, $d8ff, $yr)=mysqli_fetch_array(mysqli_query($con1,$n2));
list($d8f)=mysqli_fetch_array(mysqli_query($con1,$n3));

$sql      = "SELECT DATE id, DATE model_no, clock1 mobile_name, clock2 price, clock3 company, clock4 mobile_category, clock4 1price FROM (

    SELECT b.DATE, e.clock1  Clock1, b.clock2, b.clock3, b.clock4 FROM (
    SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, '' clock1, '' clock2, '' clock3, '' clock4
    FROM
    (
        SELECT
        DATE_FORMAT('$date1','%Y-%m-01') +
            INTERVAL daynum DAY DATE
        FROM
        (
            SELECT t*10+u daynum
            FROM
                (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
                (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
                UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                UNION SELECT 8 UNION SELECT 9) B
            ORDER BY daynum
        ) AA
    ) AAA
    WHERE MONTH(DATE) = MONTH('$date1')  ) b 
    LEFT JOIN
    
    ( SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, clock1 FROM (SELECT DATE, CASE WHEN WEEKDAY(DATE)='5'   
     
      THEN 'Saturday' WHEN WEEKDAY(DATE)='6' THEN 'Sunday' WHEN occassion IS NOT NULL THEN occassion ELSE '' END  clock1
    FROM
    (
    SELECT a.date, occassion FROM   ( SELECT
             '$date1' +
            INTERVAL daynum DAY DATE
        FROM
        (
            SELECT t*10+u daynum
            FROM
                (SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
                (SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
                UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                UNION SELECT 8 UNION SELECT 9) B
            ORDER BY daynum
        ) AA) a LEFT JOIN  holidays b ON a.DATE=b.date
    ) AAA
    WHERE MONTH(DATE) = MONTH('$date1') AND DATE BETWEEN '$date1' AND '$Date2' AND DATE NOT IN (SELECT DISTINCT 
    CAST(checktime AS DATE) DATE FROM checkinout WHERE userid='$use'
     AND CAST(checktime AS DATE) BETWEEN '$date1' AND '$Date2')) c) e ON b.DATE=e.DATE WHERE
      B.DATE NOT IN (SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(checktime AS DATE),'%d')) DATE FROM checkinout g
        
    WHERE CAST(g.checktime AS DATE) BETWEEN '$date1' AND '$Date2' AND userid='$use' 
    GROUP BY  g.userid, CAST(g.checktime AS DATE) ORDER BY USERID, DATE_FORMAT(CAST(checktime AS DATE),'%d') )
    UNION ALL SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(checktime AS DATE),'%d')) DATE , 
    MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '04:00:00' AND '09:00:00' AND checktype='I'   
    THEN TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i') ELSE '' END ) AS Clock1, 
    MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '11:00:00' AND '13:28:00' AND checktype='O'   
    THEN TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i') ELSE '' END ) AS Clock2,
    MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '12:00:00' AND '13:28:00' AND checktype='I'     
    THEN TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i') ELSE '' END ) AS Clock3,
      MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '14:39:00' AND '18:28:00' AND checktype='O'  
       THEN TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i') ELSE '' END ) AS Clock4 FROM checkinout g
       WHERE CAST(g.checktime AS DATE) BETWEEN '$date1' AND '$Date2' AND userid='$use' 
       GROUP BY  g.userid, CAST(g.checktime AS DATE) ORDER BY DATE, DATE) m GROUP BY DATE ORDER BY DATE +0 ASC";
  $result   = mysqli_query($con1,$sql);
$html = $html. '<table width="100%">
<tr>
<td width="50%" style="text-align:left: 140; font-family:arial; font-size: 10px;">
Civil Service Form No. ' .str_repeat("<br>",5). '
<td width="50%" style="text-align:left: 140; font-family:arial; font-size: 10px;">
Civil Service Form No. 48' .str_repeat("<br>",5). '
<tr>
<td  style="padding-left: 80px; font-family:arial; font-weight:bold; font-size: 16px">DAILY TIME RECORD ' .str_repeat("<br>",1). '
<td  style="padding-left: 80px; font-family:arial; font-weight:bold; font-size: 16px">DAILY TIME RECORD ' .str_repeat("<br>",1). '
<tr height=10> 
<td style="padding-left: 120px; font-family:arial; font-size=19px">-----o0o----- ' .str_repeat("<br>",3). '
<td style="padding-left: 120px; font-family:arial; font-size=19px">-----o0o----- ' .str_repeat("<br>",3). '
<tr>
<td style="padding-left: 120px;  font-family:arial; font-size: 12px;">'.$name.'
<td style="padding-left: 120px;  font-family:arial; font-size: 12px;">'.$name.'
<tr>
<td width="50%" style="padding left: 120px; font-size=3px">'.str_repeat("&nbsp;",32).'(Name) ' .str_repeat("<br>",3). '
<td width="50%" style="padding left: 120px; font-size=3px">'.str_repeat("&nbsp;",32).'(Name) ' .str_repeat("<br>",3). '
<tr>
<td style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of ______<u><b>'.$date.' '.$me.' - '.$me1.', '.$me2.'</b></u>_____<br> 
<td style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of ______<u><b>'.$date.' '.$me.' - '.$me1.', '.$me2.'</b></u>_____<br>
<tr>
<td style="padding-left: 10px; font-family:arial; font-size: 12px;">Official hours for arrival<b>'.str_repeat("&nbsp;", 10).'</b> {Regular days__________<br>
<td style="padding-left: 10px; font-family:arial; font-size: 12px;">Official hours for arrival<b>'.str_repeat("&nbsp;", 10).'</b> {Regular days__________<br>
<tr>
<td style="padding-left: 10px; font-family:arial; font-size: 12px;">'.str_repeat("&nbsp;", 13).'and departure '.str_repeat("&nbsp;", 25).' {Saturdays__________
<td style="padding-left: 10px; font-family:arial; font-size: 12px;">'.str_repeat("&nbsp;", 13).'and departure '.str_repeat("&nbsp;", 25).' {Saturdays__________
</table>';

$html = $html .'
<thead>
<table style="border-collapse" width="100%">
<tr>
<td style="border-left: 0.1mm solid black; border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="5%" rowspan=2>Day
<td style="border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="10%" colspan=2>A.M.
<td style="border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="10%" colspan=2>P.M.
<td style="border-right: 0.1mm solid black; border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="8%" colspan=2>Under-<br>time
<td width="8%">
<td style="border-left: 0.1mm solid black; border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="5%" rowspan=2>Day
<td style="border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="15%" colspan=2>A.M.
<td style="border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="15%" colspan=2>P.M
<td style="border-right: 0.1mm solid black; border-top: 0.1mm solid black; border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="10%" colspan=2>Under-<br>time
<tr>
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="5%" >Arrival
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="10%" >Depar-<br>ture
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="5%" >Arrival
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="10%" >Depar-<br>ture
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-family:arial; font-size: 12px;" width="2%" >Hours
<td style="border-bottom: 0.1mm solid black;  border-right: 0.1mm solid black; border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-family:arial; font-size: 12px;" width="2%" >Min-<br>utes
<td width="4%">
<td style="border-bottom: 0.1mm solid black; border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="5%" >Arrival
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="10%" >Depar-<br>ture
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-size: 12px;" width="5%" >Arrival
<td style="border-bottom: 0.1mm solid black;  -left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-family:arial; font-size: 12px;" width="10%" >Depar-<br>ture
<td style="border-bottom: 0.1mm solid black;  border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-family:arial; font-size: 12px;" width="2%" >Hours
<td style="border-bottom: 0.1mm solid black;  border-right: 0.1mm solid black; border-left: 0.1mm solid black; border-top: 0.1mm solid black; font-family:arial; font-family:arial; font-size: 12px;" width="2%" >Min-<br>utes
</thead>';
$result     = mysqli_query($con1,$sql);
while($row  = mysqli_fetch_array($result))
{   
$html= $html .'<tbody >
<tr>
<td width="5%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['model_no'].'
<td width="5%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['mobile_name'].'
<td width="10%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['price'].'
<td width="5%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['company'].'
<td width="10%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['mobile_category'].'
<td width="10%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">
<td width="10%" style="border-left: 0.1mm solid black; border-right: 0.1mm solid black; border-bottom: 0.1mm solid black;">

<td width="4%";>
<td width="5%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['model_no'].'
<td width="5%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['mobile_name'].'
<td width="10%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['price'].'
<td width="5%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['company'].'
<td width="10%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">'.$row['mobile_category'].'
<td width="10%" style="border-left: 0.1mm solid black; border-bottom: 0.1mm solid black;">
<td width="10%" style="border-left: 0.1mm solid black; border-right: 0.1mm solid black; border-bottom: 0.1mm solid black;">

';






}
		
        $html = $html .'</tbody></table>';
        $html= $html .'<table width="100%">
        <tr>
        <td width="50%" style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("&nbsp;", 16).'<b>TOTAL</b>____________________'.str_repeat("<br>",5).'
        <td width="50%" style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("&nbsp;", 16).'<b>TOTAL</b>____________________'.str_repeat("<br>",5).'
        <tr>
        <td style="text-align:justify; font-family:arial; font-size: 13px;">'.str_repeat("&nbsp;",5).'I CERTIFY <i>on my honor that the above is a true<br> and correct report
        of the hours of work performed,<br> record of which was made daily at
        the time  of arrival <br> and departure from office.</i><br>'.str_repeat("<br>",5).'
        <td style="text-align:justify; font-family:arial; font-size: 13px;">'.str_repeat("&nbsp;",5).'I CERTIFY <i>on my honor that the above is a true<br> and correct report
        of the hours of work performed,<br> record of which was made daily at
        the time  of arrival <br> and departure from office.</i><br>'.str_repeat("<br>",5).'
        <tr>
        <td width="50%" style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("&nbsp;", 20).'<b>___________________________'.str_repeat("<br>",1).'
        <td width="50%" style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("&nbsp;", 20).'<b>___________________________'.str_repeat("<br>",1).'
        <tr>
        <td style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.'.str_repeat("<br>",5).'
        <td style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.'.str_repeat("<br>",5).'
        <tr>
        <td width="50%" style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("-",69).'
        <td width="50%" style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("-",69).'
        <tr>
        <td style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"> '.str_repeat("&nbsp;",30).''.str_repeat("_",20).'
        <td style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"> '.str_repeat("&nbsp;",30).''.str_repeat("_",20).'
        <tr>
        <td style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">' .str_repeat("&nbsp;",22). '' .$head. '<br>' .str_repeat("&nbsp;",12). '<b>'.$head1 .'</b>
        <td style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">' .str_repeat("&nbsp;",22). '' .$head. '<br>' .str_repeat("&nbsp;",12). '<b>'.$head1 .'</b>
        <tr>
        <td style="text-align:left; padding-left:25px; font-family:arial; font:size:10px">(See instructions on back)'.str_repeat("&nbsp;",9).'<b><i>In Charge</i></b>
        <td style="text-align:left; padding-left:25px; font-family:arial; font:size:10px">(See instructions on back)'.str_repeat("&nbsp;",9).'<b><i>In Charge</i></b>
        <tr>
        <td>' .str_repeat("<br>",8). '
        <td>' .str_repeat("<br>",8). '
        <td>
        </table>';
	}
$html =$html .'</body></html>';    
$mpdf->WriteHTML($html);
$mpdf->Output(); exit;

exit;
