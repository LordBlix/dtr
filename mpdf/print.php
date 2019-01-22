<?php 
include("MPDF57/mpdf.php");
include("../lgu/data/conn.php");
$name='roche';
$d8='April';
$d='8';
$d8f="";
$yr="2018";

$query = "SELECT * FROM (

    SELECT b.DATE, e.clock1  Clock1, b.clock2, b.clock3, b.clock4 FROM (
    SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, '' clock1, '' clock2, '' clock3, '' clock4
    FROM
    (
        SELECT
        DATE_FORMAT('$_POST[Date1]','%Y-%m-01') +
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
    WHERE MONTH(DATE) = MONTH('$_POST[Date1]')  ) b 
    LEFT JOIN
    
    ( SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(DATE AS DATE),'%d')) DATE, clock1 FROM (SELECT DATE, CASE WHEN WEEKDAY(DATE)='5'   
     
      THEN 'Saturday' WHEN WEEKDAY(DATE)='6' THEN 'Sunday' ELSE '' END  clock1
    FROM
    (
        SELECT
             '$_POST[Date1]' +
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
    WHERE MONTH(DATE) = MONTH('$_POST[Date1]') AND DATE BETWEEN '$_POST[Date1]' AND '$_POST[Date2]' AND DATE NOT IN (SELECT DISTINCT 
    CAST(checktime AS DATE) DATE FROM checkinout WHERE userid=$_POST[userid]
     AND CAST(checktime AS DATE) BETWEEN '$_POST[Date1]' AND '$_POST[Date2]')) c) e ON b.DATE=e.DATE WHERE
      B.DATE NOT IN (SELECT TRIM(LEADING 0 FROM DATE_FORMAT(CAST(checktime AS DATE),'%d')) DATE FROM checkinout g
        
    WHERE CAST(g.checktime AS DATE) BETWEEN '$_POST[Date1]' AND '$_POST[Date2]' AND userid='$_POST[userid]' 
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
       WHERE CAST(g.checktime AS DATE) BETWEEN '$_POST[Date1]' AND '$_POST[Date2]' AND userid='$_POST[userid]' 
       GROUP BY  g.userid, CAST(g.checktime AS DATE) ORDER BY DATE, DATE) m GROUP BY DATE ORDER BY DATE +0 ASC
  
  
  ";
  
  $result = mysql_query($query);









$html='<html>



<body><CAPTION><EM>
<p style="text-align:left; font-family:arial; font-size: 10px;">Civil Service Form No. 48</p>
<p style="padding-left: 140px; font-family:arial; font-weight:bold;font-size: 16px;">DAILY TIME RECORD </p>
<p style="padding-left: 180px; font-family:arial; font-size: 12px;">-----o0o-----</p>
<p style="padding-left: 95px;  font-family:arial; font-size: 18px;"><u>' . $name . '<u></p>
<p style="padding-left: 130px; font-family:arial; font-size: 12px;"> (Name)</p>
<p style="padding-left: 10px; font-family:arial; font-size: 12px;"> For the month of ______<u><b>'. $d8 .'  '. $d .'  '. $yr .'</u><br> 	
   Official hours for arrival {Regular days__________<br> and departure {Saturdays____________	</p>
     
<br><br>
        
<TABLE style="border-collapse: collapse; text-align:center; font-family:arial; font-size: 15px;" border="1">
<tr>
<th rowspan="2"><b>Day</b><th colspan="2"><br><b>A.M.</b>
<th colspan="2"><br><b>P.M.</b><th colspan="2"><b>Under-<br>time</b>
<TR><th><b>Arrival</b><th><b>Depar-<br>ture</b> 
<th><b>Arrival</b>
<th><b>Depar-<br>ture</b> 
<th><b><br>Hours</b><th><b>Min-<br>utes</b>
</table>
</EM></CAPTION></body></html>';
while($row=mysql_fetch_array($result))

{

echo "ssss";




  
}


?>