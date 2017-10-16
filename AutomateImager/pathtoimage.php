<?php
$path = $_GET["path"];
	$scanresult = [];
	$noshow = [".","..",".htaccess"];
	$scanres = scandir('./imager/'.$path);
	foreach ($scanres as $key => $value){
		if((in_array($value, $noshow))||(strpos($value, ".") === false)){
			continue;
		}
		$scanresult[] = $value;
	}
echo json_encode($scanresult);
?>