<?php
include('pdf/pdf.php');
$a = new PDF2Text();
$a->setFilename('https://www.equitymaster.com/the-vivek-kaul-letter/detail.asp?story=5&date=02/03/2017'); //grab the test file at http://www.newyorklivearts.org/Videographer_RFP.pdf
$a->decodePDF();
echo $a->output(); 
?>