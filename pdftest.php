<?php ob_start(); if(true){ ?>
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
    
    <form id="PDFform" name="PDFform" method="post" action="./pdfwrite.php"><input type="submit"></form>
    <textarea rows="42" cols="70" form="PDFform" name="dataToPdf" id="dataToPdf" autofocus>
        Place test html here.
    </textarea>
<?php }
// $_POST['dataToPdf'];

?>
</body>