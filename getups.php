<!DOCTYPE html>
<html lang="en">
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"/>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<title>AGP test page</title>
<link rel="shortcut icon" href="images/icon.ico" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

    
    <script src="automate.js?vs=<?php echo time(); ?>" >    </script>
    <script src="./gtranslator.js?vs=<?php echo time(); ?>"></script>
    <script src="./tagger.js?vs=<?php echo time(); ?>"></script>
    <script src="./AutomateImager/imager.js?vs=<?php echo time(); ?>"></script>
    <script src="./nicEdit/nicEdit.js" type="text/javascript"></script>
</head>
<body>
    <header>

        <h1>Let's automatically fetch updates!</h1>

    </header>

    
    
    <main>

        
<!--CONTENT BEGINS HERE-->

        
<?php
        set_time_limit(900);
        error_reporting(E_ERROR);
        
        

    $today = date('ymd', time()-14400);   
    $datei = fopen("derp/date.txt","r");
    $ldate = fread($datei,99999);
    fclose($datei); 
    $dates = explode(';', $ldate);
        
        
    if($dates[0] < $today){
        $dwrite = $today.';'.$dates[0].';'.$dates[1];
                                                        //THIS INDICATES WHETHER WE'VE CHECKED THE SITE FOR UPDATES RECENTLY
        $checkfile = fopen("derp/date.txt","w");
        $success = fwrite($checkfile, $dwrite);
        fclose($checkfile);
        $dates = explode(';', $dwrite);
    }

        
    
$tdate = $dates[0];
$ydate = $dates[1];
//$pdate = $dates[2];

                
    echo "Updates since: ".$ydate."<br/>";    
    echo "Today is: ".$tdate."<br/>"; 
    ?>
        <div id="remaining"></div><br />
        <div id="countdown"></div><br />

        
        <!-- The modaluniquea -->
<div id="mymodaluniquea" class="modaluniquea">

  <!-- modaluniquea content -->
  <div class="modaluniquea-content">
    <div class="modaluniquea-header">
      <span class="closemodalunqa">×</span>
      <h2>Modify and submit</h2>
    </div>
    <div class="modaluniquea-body">
        <form  action="/results.php" id="modify" name="modify" method="post" style="list-style-position: inside;">
            <ul id="step2">
               <li>LOADING... this may take a few minutes longer than usual. Bear with me. -Vlad</li>

            </ul>
        </form>
    </div>
    <div class="modaluniquea-footer">
      <h3><div id="status">All articles still need review </div><div id="submit2" class="button green" onclick="javascript:subConfirm1()">Submit</div><div id="cancel2" class="button red" onclick="document.getElementById('mymodaluniquea').style.display = 'none';">Cancel</div><div id="addart2" class="button yellow" onclick="javascript:addArticle()">Add Article</div></h3>
    </div>
  </div>

</div>
        
      <? 
     
    $datei = fopen("derp/psites.txt","r");                                                                                              
    $freelist = fread($datei,99999);
    fclose($datei);
    include_once("derp/crypto.php");
    $freelist = decrypt($freelist,$_COOKIE['PrivatePageLogin']);
    $conflist = explode("\n", str_replace("\r", '', $freelist));
    $reps = array();
        foreach ($conflist as $i => $value){ 
        $conf =  explode(';', $value);
        $urls[$i] = parse_url($conf[0], PHP_URL_HOST);
        $tiers[$i] = $conf[8];
    /*  $selects[$i] = $conf[1];
        $titls[$i] = $conf[2];
        $curls[$i] = $conf[3];
        $usrs[$i] = $conf[4];
        $pws[$i] = $conf[5];
        $xmls[$i] = $conf[6];   //*/
    }
    $cflstlen = count($conflist); 
    $countdownestimate = $cflstlen * 1.5;
    if (file_exists("derp/perflog.txt")) {
        $logfile = fopen("derp/perflog.txt","r");
        $allLoadTimes = fread($logfile,99999);
        fclose($logfile);
        $loadTimes = explode(';',$allLoadTimes);
        array_pop($loadTimes);
        $countdownestimate = array_sum($loadTimes)/count($loadTimes);
    }
         echo "<script type='text/javascript'>var articleCount = ".$cflstlen."; var articleCnt = ".$cflstlen."; var cdwn = Math.round(".$countdownestimate."); </script>";
    foreach ($urls as $i => $value){
        if (($i ) < $cflstlen){

            if(in_array($value, $urls)){
                //echo "Found multiple entries of: ".$value." - ".$i."<br />";
                $keys = array_keys($urls, $value);
                $reps[$value] = $keys;
                foreach ($keys as $j => $val){
                    //echo "config file lines: ".$val."<br />";
                }
            }
        }
    }
    //var_dump($reps);    
        
   foreach($reps as $key => $domain){
        echo "<div id='dDiv".$domain[0]."'><br/><img id=loading src=loading.gif />&nbsp; ".$urls[$domain[0]]."</div>";
       $i = $domain[0]; 
       $doms = "";

        foreach($domain as $j =>$i){
            $doms = $doms.$i.";";
        }

              echo"<script type='text/javascript'>  
                    $(document).ready(function(){
                 $('#dDiv".$domain[0]."').load('checkups.php', 'nbs=".$doms."');});";
       echo "</script>";
   }
        
        
        
?>
      
         <div id="plscopy">
            <div id="Backend"><p class="hcentre"></p></div>
            <div id="Frontend"><p class="hcentre"></p></div>
            <div id="Free"><p class="hcentre"></p></div>    
        </div>
        <div id="NU" ><p class="hcentre">Not Updated</p></div>       
        <div id="sneakydatadiv"></div>
        <div id="hiddendiv"></div>
    </main>
<!--FOOTER BEGINS HERE-->
			
    <footer id="page-footer">
<hr/>
Vladimir Kuznetsov, Agora Global Projects &copy; 2016  |  All Rights Reserved 

    </footer> 
</body>
</html>