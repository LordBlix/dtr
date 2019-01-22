<?php
  //include('header.php');
  include('conn.php');
  $sql      = "SELECT * FROM mobiles";
  $result   = mysqli_query($con,$sql);
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
      $sql        = "SELECT * FROM mobiles";
      $result     = mysqli_query($con,$sql);
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

    $sql      = "SELECT * FROM mobiles";
  $result   = mysqli_query($con,$sql);
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
<td class="pdf_border"><?php echo $row['company']; ?></td>                    <td class="pdf_border"><?php echo $row['mobile_category']; ?></td>
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