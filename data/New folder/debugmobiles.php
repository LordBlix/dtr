<?php
  //include('header.php');
  include('conn.php');
  $sql      = "SELECT DATE id, DATE model_no, clock1 mobile_name, clock2 price, clock3 company, clock4 mobile_category, clock4 price FROM (

    SELECT b.DATE, e.clock1  Clock1, b.clock2, b.clock3, b.clock4 FROM (
    SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, '' clock1, '' clock2, '' clock3, '' clock4
    FROM
    (
        SELECT
        DATE_FORMAT('2018-04-01','%Y-%m-01') +
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
    WHERE MONTH(DATE) = MONTH('2018-04-01')  ) b 
    LEFT JOIN
    
    ( SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, clock1 FROM (SELECT DATE, CASE WHEN WEEKDAY(DATE)='5'   
     
      THEN 'Saturday' WHEN WEEKDAY(DATE)='6' THEN 'Sunday' ELSE '' END  clock1
    FROM
    (
        SELECT
             '2018-04-01' +
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
    WHERE MONTH(DATE) = MONTH('2018-04-01') AND DATE BETWEEN '2018-04-01' AND '2018-04-30' AND DATE NOT IN (SELECT DISTINCT 
    CAST(checktime AS DATE) DATE FROM checkinout WHERE userid='53'
     AND CAST(checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30')) c) e ON b.DATE=e.DATE WHERE
      B.DATE NOT IN (SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(checktime AS DATE),'%d')) DATE FROM checkinout g
        
    WHERE CAST(g.checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30' AND userid='53' 
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
       WHERE CAST(g.checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30' AND userid='53' 
       GROUP BY  g.userid, CAST(g.checktime AS DATE) ORDER BY DATE, DATE) m GROUP BY DATE ORDER BY DATE +0 ASC";
  $result   = mysqli_query($con1,$sql);
if(isset($_REQUEST['submit']))
{
  /*-------------------- for genearte pdf start -----------------*/

    include("../mpdf/MPDF57/mpdf.php");
    $mpdf=new mPDF('win-1252','LETTER','','',15,15,2,2,10,10);
//$html = '<h1>Welcome</h1>'; ?>
    <?php
   // $name='roche';

//list($Mo, $da, $yr)=mysql_fetch_array(mysql_db_query("select * from checkinout where checkdate like"));

//list($name)=mysql_fetch_array(mysql_query("select name from userinfo_copy where id='$_POST[userid]'"));
//list($name)=mysql_fetch_array(mysql_query("select name from userinfo_copy where id='$_POST[userid]'"));
    $mo='April';
    $d8='1';
    $d8f='30';
    $yr='2018';
    $reg=str_repeat("&nbsp;", 20);
  
    $html = '<html>
    
    
    
    <body>
    <CAPTION><EM>
    <p style="text-align:left: 140; font-family:arial; font-size: 10px;">Civil Service Form No. 48</p>
    <p style="padding-left: 90px; font-family:arial; font-weight:bold; font-size: 16px">DAILY TIME RECORD </p>
    <p style="padding-left: 120px; font-family:arial; font-size=19px">-----o0o-----</p>
    <p style="padding-left: 140px;  font-family:arial; font-size: 18px;">'.$name.'<u>
    </u><br style="font-size=3px">(Name)</p>
    <p style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of ______<u><b>'.$mo.' '.$d8.'-'.$d8f.' '.$yr.'</b></u>_____<br> 	
    Official hours for arrival<b>'.str_repeat("&nbsp;", 14).'</b> {Regular days__________<br>
    '.str_repeat("&nbsp;",8).' and departure 
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
    <?php
      $sql        = "SELECT DATE id, DATE model_no, clock1 mobile_name, clock2 price, clock3 company, clock4 mobile_category, clock4 price FROM (

        SELECT b.DATE, e.clock1  Clock1, b.clock2, b.clock3, b.clock4 FROM (
        SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, '' clock1, '' clock2, '' clock3, '' clock4
        FROM
        (
            SELECT
            DATE_FORMAT('2018-04-01','%Y-%m-01') +
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
        WHERE MONTH(DATE) = MONTH('2018-04-01')  ) b 
        LEFT JOIN
        
        ( SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, clock1 FROM (SELECT DATE, CASE WHEN WEEKDAY(DATE)='5'   
         
          THEN 'Saturday' WHEN WEEKDAY(DATE)='6' THEN 'Sunday' ELSE '' END  clock1
        FROM
        (
            SELECT
                 '2018-04-01' +
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
        WHERE MONTH(DATE) = MONTH('2018-04-01') AND DATE BETWEEN '2018-04-01' AND '2018-04-30' AND DATE NOT IN (SELECT DISTINCT 
        CAST(checktime AS DATE) DATE FROM checkinout WHERE userid='53'
         AND CAST(checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30')) c) e ON b.DATE=e.DATE WHERE
          B.DATE NOT IN (SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(checktime AS DATE),'%d')) DATE FROM checkinout g
            
        WHERE CAST(g.checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30' AND userid='53' 
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
           WHERE CAST(g.checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30' AND userid='53' 
           GROUP BY  g.userid, CAST(g.checktime AS DATE) ORDER BY DATE, DATE) m GROUP BY DATE ORDER BY DATE +0 ASC
           
           
           
           
    ";

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
        <p style="padding-top: -12px; text-align:left; font-family:arial; font-size: 10px"> '. str_repeat("&nbsp;", 32).'___________________________________</p>
        <p style="text-align:left; padding-left:20px; font-family:arial; font:size:10px">Verified as to the prescribed office hours.</p>
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px">'.str_repeat("-",69).'</p>
<p style="text-align:left; font-family:arial; font-size:10px">'.str_repeat("-",50).'</p>
<p style="text-align:left; padding-left:25px; font-family:arial; font:size:10px">(See instructions on back)'.str_repeat("&nbsp;",9).'<b><i>In Charge</i></b></p>
      
      
      <html>';
       //echo $html; die;  
      $path       = 'upload/';
      $file_name ="webpreparations-".time().".pdf";
      $stylesheet = '<style>'.file_get_contents('assets/css/bootstrap.min.css').'</style>';  // Read the css file
      $mpdf->WriteHTML($stylesheet,1);  //             
      $mpdf->WriteHTML($html,2); 
      $mpdf->Output($path.$file_name, "F");

    /*-------------------- for genearte pdf close -----------------*/

    $sql      = "SELECT DATE id, DATE model_no, clock1 mobile_name, clock2 price, clock3 company, clock4 mobile_category, clock4 price FROM (

        SELECT b.DATE, e.clock1  Clock1, b.clock2, b.clock3, b.clock4 FROM (
        SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, '' clock1, '' clock2, '' clock3, '' clock4
        FROM
        (
            SELECT
            DATE_FORMAT('2018-04-01','%Y-%m-01') +
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
        WHERE MONTH(DATE) = MONTH('2018-04-01')  ) b 
        LEFT JOIN
        
        ( SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, clock1 FROM (SELECT DATE, CASE WHEN WEEKDAY(DATE)='5'   
         
          THEN 'Saturday' WHEN WEEKDAY(DATE)='6' THEN 'Sunday' ELSE '' END  clock1
        FROM
        (
            SELECT
                 '2018-04-01' +
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
        WHERE MONTH(DATE) = MONTH('2018-04-01') AND DATE BETWEEN '2018-04-01' AND '2018-04-30' AND DATE NOT IN (SELECT DISTINCT 
        CAST(checktime AS DATE) DATE FROM checkinout WHERE userid='53'
         AND CAST(checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30')) c) e ON b.DATE=e.DATE WHERE
          B.DATE NOT IN (SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(checktime AS DATE),'%d')) DATE FROM checkinout g
            
        WHERE CAST(g.checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30' AND userid='53' 
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
           WHERE CAST(g.checktime AS DATE) BETWEEN '2018-04-01' AND '2018-04-30' AND userid='53' 
           GROUP BY  g.userid, CAST(g.checktime AS DATE) ORDER BY DATE, DATE) m GROUP BY DATE ORDER BY DATE +0 ASC
           
           
           
           
    ";
  $result   = mysqli_query($con1,$sql);

  


}
?>
<?php
$n1="select name from userinfo_copy where id='53'";
$n2="select date_format('$_POST[Date1]','%M'), date_format('$_POST[Date1]','%d'), year('$_POST[Date1]')";


list($name)=mysqli_fetch_array(mysqli_query($con1,$n1));
list($mo, $d8, $yr)=mysqli_fetch_array(mysqli_query($con1,$n2));

//$name='roche';
//$mo='April';
//$d8='5';
//$d8f='9';
//$yr='2018';
?>



  <!DOCTYPE html>
  <html lang="en">  
  <head>
  <body>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  
  <title>How to generate pdf and send mail with attachment</title>
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
<p style="text-align:left; padding-top:-10px; font-family:arial; font-size:-1px"><?php echo str_repeat("-",69)?>
<p style="text-align:left; padding-left:25px; font-family:arial; font:size:10px">(See instructions on back)<?php echo str_repeat("&nbsp;",9)?><b><i>In Charge</i></b></p>
</div> 
</form>

</body>
</html>