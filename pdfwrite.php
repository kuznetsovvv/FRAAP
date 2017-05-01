<?php ob_start(); if(false){ ?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<title>AGP Automate 1.1</title>
<link rel="shortcut icon" href="images/icon.ico" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
<link href='secure.css?v=<?php echo date('ynj'); ?>' rel='stylesheet' type='text/css'>
</head>
<body>
<?php }
require_once('vendor/autoload.php');
require_once('vendor/spipu/html2pdf/html2pdf.class.php');
$outstring = '<p>This is the fallback HTML</p>';
if(isset($_POST['dataToPdf'])){
$outstring = $_POST['dataToPdf'];
}
$html2pdf = new HTML2PDF('P', 'A4', 'en');
$html2pdf->writeHTML($outstring);
$html2pdf->Output(dirname(__FILE__).'/first_PDF_file.pdf', 'F');
?>
</body>