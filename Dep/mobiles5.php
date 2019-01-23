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
  $mpdf=new mPDF('utf-8', array(480,320),'','',2,2,2,2,2,2);
//$mpdf=new mPDF('utf-8', array(360,335),'','',2,2,2,2,2,2);
 // $mpdf=new mPDF('win-1252','A4','','',2,2,2,2,2,2);
    $mpdf->keepColumns = true;
    $mpdf->keep_table_proportions = true;
$mpdf->use_embeddedfonts_1252 = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetAuthor("Roche80 Solutions");
$mpdf->SetDisplayMode(40);
//$mpdf->Setcolumns(1);
$ID=$_GET['id'];

list($col)=getarray($con1,("SELECT COUNT(*) DATE FROM lgu.checkinout WHERE USERID in  AND CAST(CHECKTIME AS DATE) BETWEEN '2018-12-01' AND '2018-12-15';"));
//$mpdf->Setcolumns(2);
$mpdf->Setcolumns(4);
//if($col>2){
 //   $mpdf->Setcolumns(1);
  // }
   // else
   // {
    //    $mpdf->Setcolumns(2);
    //}
//$roche1="select * from userinfo_copy where title='1' limit 5;";
//$result
//$result1   = mysqli_query($con1,$roche1);
$tala='1';
$det='5';


$ID=$_GET['id'];
//$result1 = dbquery($con1,("select * from userinfo_copy where title='$tala' limit 2;"));

//$result1 = dbquery($con1,("select * from userinfo_copy where title='$tala' and Deptcode=$det;"));
//$result1 = dbquery($con1,("select * from userinfo_copy where title='$tala' limit 2;"));
//$result1 = dbquery($con1,("SELECT * FROM userinfo_copy a LEFT JOIN dep_head b ON a.Deptcode=b.ID WHERE b.ID=6;"));
$result1 = dbquery($con1,("SELECT * FROM userinfo_copy WHERE Deptcode=$ID;"));

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

   // $roche = "SELECT dtr, Date1, Date2, DATE_FORMAT(Date1, '%M'), DATE_FORMAT(Date1, '%e'), DATE_FORMAT(Date2, '%e'), DATE_FORMAT(Date2, '%Y') FROM dtrme ORDER BY id DESC LIMIT 1;";
//$result   = mysqli_query($con1,$roche);

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
//list($amini)=getarray($con, ("select checkamini from checktype where ID=1;"));
//list($aminf)=getarray($con1, ("select checkaminf from checktype where ID=1;"));
//list($ckami, $ckamo, $ckpmi, $ckpmo)=getarray($con1, ("select ckami, ckamo, ckpmi, ckpmo from checktype where ID=1;"));
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





$result = dbquery($con1,("SELECT DATE id, DATE model_no, clock1 mobile_name, clock2 price, clock3 company, clock4 mobile_category, clock4 1price FROM (

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
    MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '$amini' AND '$aminf' AND checktype='$ckami'   
    THEN TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i') ELSE '' END ) AS Clock1, 
    MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '$amouti' AND '$amoutf' AND checktype='$ckamo'   
    THEN TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i') ELSE '' END ) AS Clock2,
    MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '$pmini' AND '$pminf' AND checktype='$ckpmi'     
    THEN TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i') ELSE '' END ) AS Clock3,
      MAX( CASE WHEN CAST(g.checktime AS TIME) BETWEEN '$pmouti' AND '$pmoutf' AND checktype='$ckpmo'  
      THEN IF(11='$use','05:00',TIME_FORMAT(CAST(g.checktime AS TIME), '%h:%i')) ELSE '' END ) AS Clock4 FROM checkinout g
       WHERE CAST(g.checktime AS DATE) BETWEEN '$date1' AND '$Date2' AND userid='$use' 
       GROUP BY  g.userid, CAST(g.checktime AS DATE) ORDER BY DATE, DATE) m GROUP BY DATE ORDER BY DATE +0 ASC;"));
  //$result   = mysqli_query($con1,$sql);

  


  $html2=$html2.'
  </EM></CAPTION>
       
  <table style="border-collapse: collapse;"  width="10px">
      <thead>
      <tr>
      <td align="" colspan="4" style=" font-family:arial; font-size:10px; ">Civil Service Form No. 48
      <tr>
      <td align="center" style="font-family:arial; font-weight:bold; font-size:16px;" colspan="8"><b>DAILY TIME RECORD<b>
      <tr>
      <td align="" colspan="" style="font-size:17px; ">'.str_repeat("&nbsp;",6).'
      <tr>
      <td align="center" colspan="8" style="font-size:17px; ">'.str_repeat("-",5).'o0o'.str_repeat("-",5).'
      <tr>
      <td align="" colspan="3" style="font-size:17px; ">'.str_repeat("&nbsp;",6).'
      <tr>
      <td align="" colspan="3" style="font-size:12px; ">
      <tr>
      <td align="center" colspan="8" style="font-size:18px; "><u>'.$name.'</u>
      <tr>
      <td align="center" colspan="8" style="font-size:17px; ">(Name)
      <tr>
      <td align="">'.str_repeat("&nbsp;",6).'
      <tr>
      <td align="" colspan="5" style="font-size:12px; ">For the month of '.str_repeat("&nbsp;",6).'<b><u>'.$date.' '.$me.' - '.$me1.', '.$me2.'</u></b>
      <tr>
      <td align="" colspan="3" style="font-size:12px; ">Official hours for arrival
      <td align="" colspan="1">
      <td align="" colspan="3" style="font-size:12px; ">{Regular days'.str_repeat("_",7).'
      <tr>       
      <td align="" colspan="3" style="font-size:12px; ">and departure
      <td align="" colspan="1">
      <td align="" colspan="3" style="font-size:12px; ">{Saturdays'.str_repeat("_",8).'
      <tr>
      
      <th align="" rowspan="2" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Day</b>
      <th align="" colspan="2" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><br><b>A.M.</b>
      <th align="" colspan="2" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><br><b>P.M.</b>
      <th align="" colspan="3" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Under-<br>time</b>
     <tr>
      <th align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Arrival</b>
      <th align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Depar-<br>ture</b> 
      <th align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"><b>Arrival</b>
      <th align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
      
      <b>Depar-<br>ture</b> 

      <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
     
      <b><br>Hours</b>
      
   
      <th style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">
      
      <b>Min-<br>utes</b>


      <th><b><br>    </b><th><b><i> <i><br><i>'.str_repeat("&nbsp;", 5).'<i></b>
   
         
          
<tbody>';
                          //$result     = mysqli_query($con1,$sql);
                          while($row  = mysqli_fetch_array($result))
                          {                    
                          $html2 = $html2.'<tr font-family: sans-serif; font-size: 8pt;>
                          <td font-family: sans-serif; font-size: 8pt; style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">'.$row['model_no'].'</td>  
                          <td align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">'.$row['mobile_name'].'</td>
                          <td align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">'.$row['price'].'</td>
                          <td align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">'.$row['company'].'</td>
                          <td align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">'.$row['mobile_category'].'</td>
                          <td align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;">&nbsp;</td>
                          <td align="" style="border-top: 0.1mm solid black; border-bottom: 0.1mm solid black; border-left: 0.1mm solid black;border-right: 0.1mm solid black;"></td>
                          ';
          
                          }
  
                          $html2 = $html2 .'</tbody>   
                          
                          <tr>
                          <td align="" colspan="2" style="font-size:15px; ">'.str_repeat("&nbsp;",6).'
                          <td align="" colspan="4" style="font-size:15px; "><b>TOTAL</b>'.str_repeat("_",20).'
                          <tr>
                          <td align = "justify" colspan="7" style="font-size:13px; ">I  CERTIFY on my honor that  the  above  is  a  true  and correct report of the hours of work performed, record of which was made daily at the  time of arrival and departure from office.
                          <tr>
                          <td align="" colspan="2" style="font-size:10px; ">'.str_repeat("&nbsp;",1).'
                          <tr>
                          <td align="" colspan="7" style="font-size:15px; ">Verified as to the prescribed office hours.
                          <tr>
                          <td align="" colspan="2" style="font-size:10px; ">'.str_repeat("&nbsp;",1).'
                          <tr>
                          <td align="center" colspan="8" style="font-size:12px; ">'.str_repeat("_",36).'
                          <tr>
                         
                          <td align="" colspan="1" style="font-size:10px; ">'.str_repeat("&nbsp;",1).'
                          <tr>
                          <td align="" colspan="7" style="font-size:20px; ">'.str_repeat("-",65).'
                          <tr>
                          <td align="" colspan="2" style="font-size:10px; ">'.str_repeat("&nbsp;",1).'
                          <tr>
                          <td align="center" colspan="8" style="font-size:14px; "><u><b>' .$head. '<b></u>
                          <tr>
                          <td align="center" colspan="8" style="font-size:15px; ">'.$head1 .'
                          <tr>
                          </thead></table>';
                          $html1=$html1.'
                          <tr>
                          <td align="" colspan="" style="font-size:17px; ">'.str_repeat("&nbsp;",6).'
                          <tr>
                          <td align="" colspan="1" style="font-size:17px; ">I  CERTIFY on my honor that  the  above  is  a  true  and correct
                       
                          ';
                          $html=$html.'<p style="text-align:left; font-family:arial font-size: 8px;">'.str_repeat("&nbsp;", 14).'<b>TOTAL</b>'.str_repeat("_",20).'</p>
                          <p style="text-align:justify; font-family:arial; font-size: 12px;">'.str_repeat("&nbsp;",3).'';
                          
                          $html1=$html1 .'<p>I  CERTIFY on my honor that  the  above  is  a  true  and correct';
                          $html1= $html1 .'<br>report <i> of <i> the <i> hours <i> of <i> work <i> performed, <i> record <i> of <i>which';
                          $html1= $html1 .'<br> was made daily at the  time of arrival and';
                          $html1=$html1.' departure from';
                          $html1=$html1. '<br>office.</i> </p>';
                          $html1=$html1.' <p style="padding-top: -12px; text-align:left; font-family:arial; font-size: 10px"> '. str_repeat("&nbsp;", 36).''.str_repeat("_",36).'</p>';
                          $html1=$html1.'<p style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.</p>';
                          $html1=$html1.'<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"> '.str_repeat("-",65).'</p>';
                      
                      if(tala==1){
                          $html.='<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">
                          '.str_repeat("&nbsp;",30).''.str_repeat("_",20).
                          
                      '';
                          }
                      $html1 =$html1.'<br><p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">' .str_repeat("&nbsp;",$spc0). '<u>';
                      $html1=$html1='<b>' .$head. '<b></u><br>'.str_repeat("&nbsp;",$ee). ''.$head1 .'</p>';
                      $html1=$thml1='<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"></p>';
                      $html1=$html1='<p style="text-align:left; padding-left:25px; font-family:arial; font:size:10px"><b><i></b><br><br><br><br><br><br><br><br><br><br></p>';
                      $html1=$html1='<columnbreak/>';

                      }
$html2 =$html2 .'</html>';   

$mpdf->WriteHTML($html2);
$mpdf->Output(); exit;

exit;
