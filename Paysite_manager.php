<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<title>AGP test page</title>
<link rel="shortcut icon" href="images/icon.ico" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache"/>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
<link href='secure.css' rel='stylesheet' type='text/css'>
  




</head>
<body>
    <header>

        <h1>Website configuration manager</h1>
<hr />
    </header>

    
    
    <main>

        
<!--CONTENT BEGINS HERE-->        
<?php
    set_time_limit(0);
    $success = false;
    //uncomment below to emergency reset pw    
    /*include_once("derp/logins.php");
    setcookie('PrivatePageLogin', md5(md5("eekt").$nonsense));
    include_once("derp/crypto.php"); //*/   
    $datei = fopen("derp/psites.txt","r");
    $freelist = fread($datei,99999);
    fclose($datei);
    $paylist = decrypt($freelist, $_COOKIE['PrivatePageLogin']); //$freelist;//
    $conflist = explode("\n", str_replace("\r", '', $paylist));
    foreach ($conflist as $i => $value){ 
        $conf =  explode(';', $value);
        $urls[$i] = $conf[0];
        $selects[$i] = $conf[1];
        $titls[$i] = $conf[2];
    }
            if(isset($_POST['psave'])) 
    { 
            $paylist = $_POST['comment'];
            $postlist = $_POST;
            /*    
            echo "<strong>DATA BE HERE --></strong>";
                var_dump($postlist);
            echo"<strong><-- DATA END HERE</strong>";   
            //*/    
            if(!($paylist =="")){
                $freelist = encrypt($paylist, $_COOKIE['PrivatePageLogin']);
                $checkfile = fopen("derp/psites.txt","w");
                $success = fwrite($checkfile, $freelist);
                fclose($checkfile);
            }
            if($success){
                echo '<script language="javascript">alert("File updated")</script>';
                if($_POST['gfcsave']){
                    echo '<form action="" id="gsites" method="post"><input type="hidden" value="true" name="stmg" />';
                    echo "<input type='hidden' value=".$_POST['newentry']." name='bottom' />";
                    echo '</form>';
                    echo '<script language="javascript">document.getElementById("gsites").submit();</script>';
                }
            }else{
                echo '<script language="javascript">alert("An error has occured, please try again")</script>'; }     
        }

/*        
echo "<h2>Sites:</h2><ol>";        
   foreach ($urls as $num => $ul){
        echo "<li>";
        echo '<h3>'.$titls[$num].'</h3>';
        echo '<p>Source URL: <a href='.$ul.'>.'.$ul.'</a></p>';
        echo '<p>Target selector: '.$selects[$num].'</p><br/>';
        echo "</li>";
   }
echo "</ol>";
*/
        echo '<form action="" id="sites" method="post">
        <textarea name="comment" form="sites" id="config">'.$paylist.'</textarea>
        <input type="submit" name="psave">
        <input type="submit" name="stmg" value="Simplified Settings">
        </form>';


?>
        
        

    </main>
<!--FOOTER BEGINS HERE-->
			
    <footer id="page-footer">
<hr/>
Vladimir Kuznetsov, Agora Global Projects &copy; 2016  |  All Rights Reserved 

    </footer> 
</body>
</html>