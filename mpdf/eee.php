<?php 
include("/MPDF57/mpdf.php");
$mpdf = new \Mpdf();

//$stylesheet = file_get_contents('style.css');
//$mpdf->WriteHTML($stylesheet, 1);

$mpdf->WriteHTML('Hello World', 2);

$mpdf->Output();




?>