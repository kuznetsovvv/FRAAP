<?php
$scanresult = [];
$noshow = [".","..",".htaccess"];
$scanresultpassone = scandir('./htnoaccess/');
foreach ($scanresultpassone as $key => $value){
    if(in_array($value, $noshow)){
        continue;
    }
    if (strpos($value, '.') === false){
        $scanresult[$value] = array_diff(scandir('./htnoaccess/'.$value),$noshow);
    }
}
echo json_encode($scanresult);

?>