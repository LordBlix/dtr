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

    include("mpdf/MPDF57/mpdf.php");
    $mpdf = new mPDF(); 

    //$html = '<h1>Welcome</h1>';
    $html = '<div class="table-responsive">
        <table class="table table-hover tablesorter pdf_border">
            <thead>
                <tr class="pdf_border">
                    <th class="header pdf_border">Model No.</th>
                    <th class="header pdf_border">Mobile Name</th> 
                    <th class="header pdf_border">Price</th>
                    <th class="header pdf_border">Company</th>                      
                    <th class="header pdf_border">Category</th>
                </tr>
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
        </tr>';
        } 

      $html .= '</tbody></table>';
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
  <!DOCTYPE html>
  <html lang="en">  
  <head>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  </head>
  <title>How to generate pdf and send mail with attachment</title>
  <body>
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
    
</div> 
</form>

</body>
</html>