<?php
include('conn.php');


$head='';
$head1='';
$sql5="select Head, Designate from department;";
$result5= mysqli_query($con1,$sql5);
//list($head, $head1)=mysqli_fetch_array($result5);


//$head='KARISSA R. FETALVERO-PARONIA';
//$head1='Municipal Mayor';




$roche1="select * from userinfo_copy where title='1' limit 3;";
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


//$mo='May';
//$d8='1';
//$d8f='15';
//$yr='2018';
  //include('header.php');
  
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
if(isset($_REQUEST['submit']))
{  $sql1 = "UPDATE  dtrme SET STATUS=1 ORDER BY ID DESC LIMIT 1;";
  $result   = mysqli_query($con1,$sql1);
  
  /*-------------------- for genearte pdf start -----------------*/

    include("../mpdf/MPDF57/mpdf.php");
    $mpdf=new mPDF('win-1252','A4','','',15,15,2,2,10,10);
//$html = '<h1>Welcome</h1>'; ?>
    <?php

$n1="select name from userinfo_copy where id='$use'";
$n2="select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), date_format('$_POST[Date2]','%d'), year('$_POST[Date1]')";
$n3="select date_format('$_POST[Date2]','%d')";



list($name)=mysqli_fetch_array(mysqli_query($con1,$n1));
list($mo, $d8, $d8ff, $yr)=mysqli_fetch_array(mysqli_query($con1,$n2));
list($d8f)=mysqli_fetch_array(mysqli_query($con1,$n3));
    $reg=str_repeat("&nbsp;", 20);
  
    $html = '<html>
    
    
    
    <body>
    <CAPTION><EM>
    <p style="text-align:left: 140; font-family:arial; font-size: 10px;">Civil Service Form No. 48</p>
    <p style="padding-left: 90px; font-family:arial; font-weight:bold; font-size: 16px">DAILY TIME RECORD </p>
    <p style="padding-left: 120px; font-family:arial; font-size=19px">-----o0o-----</p>
    <p style="padding-left: 100px;  font-family:arial; font-size: 18px;">'.$name.'<u>
    </u><br style="font-size=3px">'.str_repeat("&nbsp;",9).'(Name)</p>
    <p style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of ______<u><b>'.$date.' '.$me.' - '.$me1.', '.$me2.'</b></u>_____<br> 	
    Official hours for arrival<b>'.str_repeat("&nbsp;", 14).'</b> {Regular days__________<br>
    '.str_repeat("&nbsp;",8).' and departure '.str_repeat("&nbsp;", 23).' {Saturdays__________
</EM></CAPTION>
    <div class="table-responsive">
    <table border="1">
        <thead>
        <tr>
        <th rowspan="2"><b>Day</b><th colspan="2"><br><b>A.M.</b>
        <th colspan="2"><br><b>P.M.</b><th colspan="2"><b>Under-<br>time</b>
        <TR><th><b>Arrival</b><th><b>Depar-<br>ture</b> 
        <th><b>Arrival</b>
        <th><b>Depar-<br>ture</b> 
        <th><b><br>Hours</b><th><b>Min-<br>utes</b>
                </thead>
            
            <tbody>'; ?>
</div> 
</form>

</body>
    <?php
     
           
   

      $result     = mysqli_query($con1,$sql);
      while($row  = mysqli_fetch_array($result))
      {                    
        $html .= '<tr class="pdf_border">
        <td class="pdf_border">'.$row['model_no'].'</td>   
        <td class="pdf_border">'.$row['mobile_name'].'</td> 
        <td class="pdf_border">'.$row['price'].'</td>
        <td class="pdf_border">'.$row['company'].'</td>                    
        <td class="pdf_border">'.$row['mobile_category'].'</td>
        <td class="pdf_border"></td>
        <td class="pdf_border"></td>
        </tr>';
        } 

      $html .= '</tbody></body></table>
      <p style="text-align:left; font-family:arial font-size: 10px;">'.str_repeat("&nbsp;", 14).'<b>TOTAL</b>____________________</p>
      <p style="text-align:justify; font-family:arial; font-size: 13px;">'.str_repeat("&nbsp;",5).'I CERTIFY <i>on my honor that the above is a true<br> and correct report
        of the hours of work performed,<br> record of which was made daily at
        the time  of arrival <br> and departure from office.</i> </p>
        <p style="padding-top: -12px; text-align:left; font-family:arial; font-size: 10px"> '. str_repeat("&nbsp;", 36).'___________________________________</p>
        <p style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.</p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"> '.str_repeat("-",69).'</p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"> '.str_repeat("&nbsp;",30).''.str_repeat("_",20).'</p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">' .str_repeat("&nbsp;",22). '<u>' .$head. '</u><br>' .str_repeat("&nbsp;",12). '<b>'.$head1 .'</b></p>
<p style="text-align:left; padding-left:25px; font-family:arial; font:size:10px">(See instructions on back)'.str_repeat("&nbsp;",9).'<b><i>In Charge</i></b></p>
      
      
      <html>';
       //echo $html; die;  
       $mpdf->WriteHTML($html);
$mpdf->Output(); exit;
     

    /*-------------------- for genearte pdf close -----------------*/

    
  $result   = mysqli_query($con1,$sql);


  


}
?>
<?php
$n1="select name from userinfo_copy where id='$use'";
//$n2="select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), date_format('$_POST[Date2]','%d'), year('$_POST[Date1]')";
//$n3="select date_format('$_POST[Date2]','%d')";


list($name)=mysqli_fetch_array(mysqli_query($con1,$n1));
//list($mo, $d8, $d8ff, $yr)=mysqli_fetch_array(mysqli_query($con1,$n2));
//list($d8f)=mysqli_fetch_array(mysqli_query($con1,$n3));

//$name='roche';

?>



  <!DOCTYPE html>
  <html lang="en">  
  <head>
  <body>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  
  <title>Daily Time Record</title>
    <CAPTION><EM>
<p style="text-align:left: 140; font-family:arial; font-size: 10px;">Civil Service Form No. 48</p>
<p style="padding-left: 90px; font-family:arial; font-weight:bold; font-size: 16px">DAILY TIME RECORD </p>
<p style="padding-left: 120px; font-family:arial; font-size=19px">-----o0o-----</p>
<p style="padding-left: 80px;  font-family:arial; font-size: 12px;"><u><?php echo $name ?></u>
<br style="font-size=12px"><?php echo str_repeat("&nbsp;",14)?> (Name)</p>
<p style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of ______<u><b><?php echo $mo ?>&nbsp<?php echo $d8?>-<?php echo $d8f ?>&nbsp<?php echo $yr ?></b></u>_____<br> 	 			
Official hours for arrival <?php echo str_repeat("&nbsp;", 3); ?> {Regular days__________<br>
<?php echo str_repeat("&nbsp;", 8); ?>and departure 
<?php echo str_repeat("&nbsp;", 14); ?>{Saturdays____________	</p>
</EM></CAPTION>
  </head>
  <form action="" method="POST">
  <div class="table-responsive">



    <table border="1">
        <thead>
<tr>
<th rowspan="2"><b>Day</b><th colspan="2"><br><b>A.M.</b>
<th colspan="2"><br><b>P.M.</b><th colspan="2"><b>Under-<br>time</b>
<TR><th><b>Arrival</b><th><b>Depar-<br>ture</b> 
<th><b>Arrival</b>
<th><b>Depar-<br>ture</b> 
<th><b><br>Hours</b><th><b>Min-<br>utes</b>
        </thead>
        <br>
        <input type="submit" name="submit" class="pull-right btn btn-warning btn-large" style="margin-right:40px" value="Genarte PDF">
        <br>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0 ) {
                while($row = mysqli_fetch_array($result)){
                    ?>
<tr class="pdf_border">
<td class="pdf_border"><?php echo $row['model_no']; ?></td>   
<td class="pdf_border"><?php echo $row['mobile_name']; ?></td> 
<td class="pdf_border"><?php echo $row['price']; ?></td>
<td class="pdf_border"><?php echo $row['company']; ?></td>                   
 <td class="pdf_border"><?php echo $row['mobile_category']; ?></td>
 <td class="pdf_border"></td>
 <td class="pdf_border"></td>
</tr><?php
                }
               }
             else {
                ?>
                <tr>
                    <td colspan="5" class="alert alert-danger">No Records founds</td>    
                </tr>
            <?php } 
            ?>

        </tbody>
    </table>
<p style="text-align:left; font-family:arial font-size: 10px;"><?php echo str_repeat("&nbsp;", 14); ?><b>TOTAL</b>____________________</p>
<p style="text-align:justify; font-family:arial; font-size: 13px;"><?php echo str_repeat("&nbsp;",5);?>I CERTIFY <i>on my honor that the above is a true<br> and correct report
of the hours of work performed,<br> record of which was made daily at
the time  of arrival <br> and departure from office.</i> </p>
<table><p style="padding-top:-210px; text-align:left; font-family:arial; font-size: 10px"><?php echo str_repeat("&nbsp;", 32)?>___________________________________</p></table>
<p style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.</p>

<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"><?php echo str_repeat("&nbsp;",17)?> <u><?php echo $head; ?></u><br><?php echo str_repeat("&nbsp",10) ?><b><?php echo $head1; ?></b></p>
<p style="text-align:right: 80px; padding-top:-10px; font-family:arial; font-size:-1px"><?php echo str_repeat("&nbsp;",30) ?><?php echo str_repeat("_",20)?>
<p style="text-align:left; padding-left:25px; font-family:arial; font:size:10px">(See instructions on back)<?php echo str_repeat("&nbsp;",3)?><b><i>In Charge</i></b></p>
<?php } ?>
</html>