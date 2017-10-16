<?php
$scanresult = [];
$noshow = [".","..",".htaccess"];
$scanresultpassone = scandir('./imager/');
foreach ($scanresultpassone as $key => $value){
    if(in_array($value, $noshow)){
        continue;
    }
	$scanresult[strtoupper($value)] = [];
    if (strpos($value, '.') === false){
		$scanptwo = scandir('./imager/'.$value);
		foreach($scanptwo as $keey => $innerfolder) {
			//echo strpos($innerfolder, '.')."<br>";
			 if (strpos($innerfolder, '.') === false){
				//echo $innerfolder;
				if(in_array($innerfolder, $noshow)){
					continue;
				}
        		array_push($scanresult[strtoupper($value)], strtoupper($innerfolder));
			 }
		}
    }
}
echo json_encode($scanresult);

?>