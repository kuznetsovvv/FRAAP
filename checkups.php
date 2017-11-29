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
<link href='secure.css?v=<?php echo date('ynj'); ?>' rel='stylesheet' type='text/css'>
  




</head>

        
<!--CONTENT BEGINS HERE-->        
<?php
    set_time_limit(9000);
    error_reporting(E_ERROR); //E_ALL);
        
    $today = date('ymd', time()-14400);   
    $datei = fopen("derp/date.txt","r");
    $ldate = fread($datei,99999);
    fclose($datei); 
    $dates = explode(';', $ldate);
        
    $tdate = $dates[0];
    $ydate = $dates[1];
    $pdate = $dates[2];
    $nums = $_GET['nbs'];
    //echo $nums."<br/>";
    $nms = explode(';', $nums);
    //var_dump($nms);
    $num = $nms[0];                 //$_GET['nobatch'];
    $datei = fopen("derp/psites.txt","r");                                                                                              
    $freelist = fread($datei,99999);
    fclose($datei);
    include_once("derp/crypto.php");
    $freelist = decrypt($freelist,$_COOKIE['PrivatePageLogin']);
    $conflist = explode("\n", str_replace("\r", '', $freelist));
    foreach ($conflist as $i => $value){ 
        $conf =  explode(';', $value);
        $urls[$i] = $conf[0];
        $selects[$i] = $conf[1];
        $titls[$i] = $conf[2];
        $curls[$i] = $conf[3];
        $usrs[$i] = $conf[4];
        $pws[$i] = $conf[5];
        $xmls[$i] = $conf[6];
        $langs[$i] = $conf[7];
        $tiers[$i] = $conf[8];
        $proms[$i] = $conf[9];
        $contents[$i] = $conf[10];
        $auths[$i] = $conf[11];
        $codes[$i] = $conf[12];
        $stops[$i] = $conf[13];
        $excludes[$i] = $conf[14];
        $reauths[$i] = $conf[15];
        $savepaths[$i] = $conf[16];
    }
    $fir = "1";
    $last = "0";
    $ch = curl_init();
    foreach ($nms as $nombre => $item){
        if($item == ""){break;}
        if(($nombre + 2) == count($nms)){ $last = "1";}else{$last = "0";}
        if($nombre==0){ $fir = "1"; }else{$fir = "0";}
        //echo $nombre ." vs ". count($nms);
        //echo "first: ".$fir."<br/>last: ".$last;
        $num = $item;
        checkups($selects[$num], $urls[$num], $curls[$num], $usrs[$num], $pws[$num], $num, $titls[$num],$tdate, $ydate, $pdate, $xmls[$num], $auths[$num], $contents[$num], $stops[$num], $tiers[$num],$fir,$last, $codes[$num], $proms[$num], 0, $langs[$num], $excludes[$num], $reauths[$num], $savepaths[$num]);                    
       flush(); ob_flush();
    }  

        
        
        
        function checkups($selector, $url, $curl, $usr, $pw, $num, $title, $tdate, $ydate, $pdate, $xrss, $auth, $csel, $stsel, $tier, $fir, $last, $code, $promo, $recursioncount = 0, $lang, $exclude, $reauth, $savepath){                         //Check Updates!
               
            
                global $ch;
                $NUM_OF_ATTEMPTS = 5;
                $attempts = 0;
                do {
                        $attempts++;
                        if(! empty($xrss)){
                        $rss = simplexml_load_file($xrss);

                        //echo '<h1>'. $rss->channel->title . '</h1>';
                        $rssArray = array();
                        foreach ($rss->channel->item as $item) {
                        $rssArray[] = '<a href="'. $item->link .'">' . $item->title . "</a>";//" </h2> <p> " . $item->pubDate . "</p>";//"<p>" . $item->description . "</p>";
                        }      
                            $content = $rssArray[0];
                    }else{

                        if(($fir || $reauth) and (!(empty($curl)))){
                            $path = "derp/ctemp";
                            $cookie_file_path = $path."/cookie.txt";
                            
                            curl_setopt($ch, CURLOPT_HEADER, true);                                         //curl for login/auth
                            curl_setopt($ch, CURLOPT_NOBODY, false);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,30); 
                            curl_setopt($ch, CURLOPT_TIMEOUT, 30); 

                            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
                            //set the cookie the site has for certain features, this is optional
                            curl_setopt($ch, CURLOPT_COOKIE, "cookiename=".$num);
                            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
                            //curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

                            $postinfo = $usr."&".$pw;
                            curl_setopt($ch, CURLOPT_URL, $curl);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
                            curl_setopt($ch, CURLOPT_FAILONERROR, false);
                             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_exec($ch);
                            if (curl_error($ch)) {
                                echo '<div style="background-color:#FFBBBA;">'.curl_error($ch).'</div>';
                            }
                        }

                        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 999999','Transfer-Encoding: chunked'));
                        //page with the content I want to grab
                        curl_setopt($ch, CURLOPT_URL, $url);                                            //curl for headers/updates
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        //do stuff with the info with DomDocument() etc
                        echo '<div style="background-color:#FFBBBB;">';
                        $content = curl_exec($ch);
                        echo '</div>';
                        //echo '<p>'.$num.' - '.curl_getinfo($ch, CURLINFO_HTTP_CODE).'</p>';
                        if (curl_error($ch)) {
                            echo '<div style="background-color:#FFBBBB;">'.curl_error($ch).'</div>';
                        }
                        /*if (strpos($code, "VKD") !== false) { 
                            echo "this is VKD! <br/>";
                            $content = file_get_contents($url); 
                        }//*/
                    }     

            
        $checkText = "";

        //$content = file_get_contents($url);
        //$content = preg_replace("#( href| src)=('|\")([^h/#.|^m])#",'$1=$2'.$url.'$3',$content);            
        $d = new DOMDocument;
        libxml_use_internal_errors(false);
        $d->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
           
        removeElementsByTagName('script', $d);
        removeElementsByTagName('style', $d);
        removeElementsByTagName('iframe', $d);
        removeElementsByTagName('button', $d);
        //libxml_clear_errors();

        foreach($d->getElementsByTagName('a') as $link) {
            $baseUrl = $url;
            if (substr($url, -1) !== '/') {
                $baseUrl = substr($url,'0',(strrpos($url,'/')));                                                                               
            }
   
            $href = $link->getAttribute('href');
            
            if(substr($href, 0, 1) == '/'){
                $baseUrl = 'http://'.parse_url($baseUrl, PHP_URL_HOST).'/';
            }
                         //   echo " &nbsp; - - - &gt;".$baseUrl."&lt; - - - &nbsp; ";              //debug garbage
            $href = preg_replace('#^/#', '', $href);                                                                    
            $href = preg_match('#^http#i', $href) ? $href : $baseUrl.$href;
            $link->setAttribute('href', $href);
        }     

     /*   if (strpos($title, 'Asianomics') !== false) {                                                                                        //Had to write a special function for Asianomics to work
            //error_reporting(E_ALL);
            $checkText = 'This debug code should only affect Asianomics. This function has to exist because they use JS to search JSON.';

            $scripts = $d->getElementsByTagName('script');
            foreach ($scripts as $book) {
                $chckText = $book->nodeValue;
                if(strpos($chckText, '[{') !== false){
                    $sLen = strpos($chckText, '}];') - strpos($chckText, '[{') + '2';
                    $JSON = substr($chckText,strpos($chckText, '[{'), $sLen);
                    $jsonarr = json_decode($JSON);
                    $jsnarr = $jsonarr[0];
                    foreach ($jsonarr as $obj){
                        $dstring = ($obj->analysts);
                        //echo "<br/>a: ".$dstring;
                        if(stripos($dstring,"im Walker")){
                            //echo " - HIT!";
                            $jsnarr = $obj;
                            break 1;
                        }
                    }

                    //echo "<br/>b: ".($jsnarr->analysts);
                    $checkText = "<a href='//www.asianomicsgroup.com/".$jsnarr->view_url."'>".$jsnarr->title."</a>";" - ".$jsnarr->analyst." - ".$jsnarr->date." <br/>".$jsnarr->detail;
                }
            }
                        
                    
            }else{ //*/
                $x = new DOMXPath($d);
                    //$checkText = $d->saveHTML();
                if (($div = $x->query($selector))) {
                    $checkText = $checkText.($d->saveHTML($div->item(0)));
                        if (trim(strip_tags($checkText)) == ""){
                            $checkText = $checkText.($d->saveHTML($div->item(1)));
                        //}
                        }
                }
            if((strlen($checkText)<1000) and (strlen($checkText)>0)){break;}else{$checkText=" - ERROR - could not retrieve content -";}
        }while($attempts < $NUM_OF_ATTEMPTS);
            
            $cachinfo=true;
            if (file_exists("derp/".$ydate."checkfileb".$code.".txt")) {
                $datei = fopen("derp/".$ydate."checkfileb".$code.".txt","r");
                $check = fread($datei,99999);
                fclose($datei);
            }else{
                $check = "#$%^&*()if somebody happened to set thier headline to this literal I guess it would break my program but come on, lol.-_-_-_-";
                 }
                         
                if((strcmp($checkText, $check) != 0)and(strcmp(trim($checkText), "") != 0)){

    //$checkText = preg_replace("#(<\s*a\s+[^>]*href\s*=\s*[\"'])(?!http)([^\"'>]+)([\"'>]+)#", '<a href='.$url, $checkText);        
            
            $domDoc = new DOMDocument;
            $domDoc->loadHTML(strip_tags($checkText, '<a>'));
            removeElementsByTagName('script', $domDoc);
            removeElementsByTagName('style', $domDoc);
            removeElementsByTagName('iframe', $domDoc);
            removeElementsByTagName('button', $domDoc);
            $anchor = $domDoc->getElementsByTagName('a');
           if($first = $anchor->item(0)){  
                $artcont = $first->getAttribute('href');                        //curl article page for contents
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, $artcont);
                $artcontent = curl_exec($ch);


                $domDoc->loadHTML(mb_convert_encoding($artcontent, 'HTML-ENTITIES', 'UTF-8'));//$artcontent);
                $full = mb_convert_encoding($artcontent, 'HTML-ENTITIES', 'UTF-8');
                removeElementsByTagName('script', $domDoc);
                removeElementsByTagName('style', $domDoc);
                removeElementsByTagName('iframe', $domDoc);
                removeElementsByTagName('button', $domDoc);
                removeElementsByTagName('form', $domDoc); 
                $contelem = $domDoc->getElementsByTagName('body');             //try to retrieve onle contents of Body tags, will get full page if body not found               
                $first = $contelem->item(0);
                $artcontent = $first->nodeValue;
                //$artcontent = strip_tags($artcontent);
            }else{
                $artcontent = $url;
                 }
                //echo"<small>";
                //echo $num." &nbsp ";            
                //echo"</small>";
            $x = new DOMXPath($domDoc);
            if ($csel == "pdf"){
              /*  
              Do something different for PDFs if a download link is found, that code should go HERE.
            //*/

            }
            elseif (($div = $x->query($csel))) {                                              //save content area based on xpath $csel and $stsel
                //$full = $domDoc->saveHTML();
                $artcontent = "";
                $artcontent = $artcontent.PHP_EOL.PHP_EOL.DOMinnerHTML($div->item(0));//($domDoc->saveHTML($div->item(0)));   //saves content area
                if (($divtwo = $x->query($stsel))) {                                            //if end selector exists
                    $startartcontent = $domDoc->saveHTML($div->item(0));                        
                    $endartcontent = $domDoc->saveHTML($divtwo->item(0));
                    $startartcontent = substr($startartcontent, 0 , 100);                       //start of article content - we chose 100 as an adequate length to avoid mishaps
                    $endartcontent = substr($endartcontent, 0 , 100);                           //end of article content
                    //strlen($artcontent);
                    $substringstart = stripos( $artcontent, $startartcontent);
                    $substringend = stripos( $artcontent, $endartcontent);
                    echo htmlspecialchars($endartcontent);                                      //the debug junk being dumped on the main page
                    echo "<br>";
                    echo htmlspecialchars(substr($artcontent, $substringend, 100));
                    echo "<hr>";
                    //echo htmlspecialchars($artcontent);
                    //echo $substringend = stripos( $full, $endartcontent);
                    $substringlength = $substringend - $substringstart;/*
                    $xp=$csel."[count(.| ".$stsel.")=count(".$stsel.")]";
                    $div = $x->query($xp);//*/
                    //$artcontent = PHP_EOL.PHP_EOL.($domDoc->saveHTML($div->item(0)));
                    $artcontent = substr($artcontent, $substringstart, $substringlength);                           //EXCLUDE CONTENT WILL GO SOMEWHERE AROUND HERE
                    $artcontent = removeAds($artcontent, $exclude);
                }
                $artcontent=trim($artcontent);//trim(strip_tags($artcontent));
                $acshort = $artcontent;
                if (strlen($artcontent) > 450){
                    $acshort = substr($artcontent, 0, 447) . '...';
                }
            }else{
                echo "didn't find content selector for number: ".$num;
            }
            if(($csel == "pdf")and($artcontent != "found a pdf")){
                $acshort = $artcontent = "Currently unable to retrieve contents of PDF files.";
            }
            if($csel == ""){
                $acshort = $artcontent = "Auto-content not available.";
            }
            //*/

                                                                        //not best practice, but I had to write exception code because of SOMEBODY'S site settings...
            if((strpos($checkText, "411 Length Required") !== false)or(strpos($artcontent, "411 Length Required") !== false)or(strpos($checkText, " - ERROR - could not retrieve content -") !== false) ){                                                             if($recursioncount < 5){
                    curl_close($ch);
                    $ch = curl_init();
                    $recursioncount = $recursioncount + 1;
                    //echo("bump -".$num);
                    checkups($selector, $url, $curl, $usr, $pw, $num, $title, $tdate, $ydate, $pdate, $xrss, $auth, $csel, $stsel, $tier, "true", $last, $code, $promo, $recursioncount, $lang, $exclude, $reauth, $savepath);
                    return;
                }else{
                $checktext =  "- ERROR - could not retrieve content -";
                }
            }
            
            /*
            $cachinfo=true;                                                                                     //MOVING UP
            if (file_exists("derp/".$ydate."checkfileb".$code.".txt")) {
                $datei = fopen("derp/".$ydate."checkfileb".$code.".txt","r");
                $check = fread($datei,99999);
                fclose($datei);
            }else{
                $check = "#$%^&*()if somebody happened to set thier headline to this literal I guess it would break my program but come on, lol.-_-_-_-";
                 }
                         
                if((strcmp($checkText, $check) != 0)and(strcmp(trim($checkText), "") != 0)){   //*/             //MOVING UP
                    echo '<div id="dataDiv'.$num.'" class="'.$tier.'">';
                    if($tier == "Free"){
                        $promourl = $artcont;
                    }else{
                        $promourl = $promo;
                    }
                    $acclean=$artcontent;                                                                                       //clean up article for excerpts and the like
                    if ((strpos($acclean, '</ul>') !== false) and (strpos(strip_tags($acclean, '<ul>'), '</ul>') < 300) ) {  
                        $acclean = substr($acclean, strpos($acclean, '</ul>'));
                    }
                    $artcontent = preg_replace("</?(script|style|html|body|head).*?>is","",$artcontent);          //THIS SHOULD BE DONE IN SENDP
                    $acclean = preg_replace("</?(script|style|html|body|head).*?>is","",$acclean);
                    $acclean = strip_tags($acclean);
                    $dArr = array($artcont, strip_tags($checkText), $auth, $title, $artcontent,  $promourl, $tier, $acclean, $lang, $code);       //THE ARRAY OUTPUTTED
                    echo '<script type="text/javascript"> window.dataArr'.$num.' = '.json_encode($dArr).'; </script>';
                 }else{ 
                        echo '<div id="dataDiv'.$num.'" class="NU">';
                        echo '<small>No updates from <a href="'.$url.'">'.$title.'</a>! Last update: '.strip_tags($checkText).'<br></small>';
                      }
                        /*
                        echo "<h2>".strip_tags($checkText, '<a>')."</h2>";
                        echo '<h3 id="norm'.$num.'">From '.$auth.' - <a href="'.$url.'">'.$title.'</a>- '.$acshort.'</h3>';
                        echo '<div id="ul'.$num.'" class="hiddenclass" ><div class="editarea" contenteditable="true">';
                        echo 'From '.$auth.' - '.$title.'- '.PHP_EOL;
                        echo $artcontent;
                        echo '</div>';
                        //echo 'Will pull content from: '.$artcont;
                        echo '</div>';
                        echo '<img id="more'.$num.'" src="automate/more.png" class="more" onclick="showhide('.$num.')" />';

                      //*/
            echo "</div>";
            if (file_exists("derp/".$pdate."checkfileb".$code.".txt")) {
                unlink("derp/".$pdate."checkfileb".$code.".txt");        
            }
            echo "<script type='text/javascript'>loaded(".$num.");</script>";
            $success = false;

            $checkfileb = fopen("derp/".$tdate."checkfileb".$code.".txt","w");
            $success = fwrite($checkfileb, $checkText);
            fclose($checkfileb);
    
            if($last){
                curl_close($ch);
            }
            //echo "<hr />";
        }
        function removeElementsByTagName($tagName, $document) {
            $nodeList = $document->getElementsByTagName($tagName);
            for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0; ) {
                $node = $nodeList->item($nodeIdx);
                $node->parentNode->removeChild($node);
            }
        }
        function removeAds($aContent, $adList){
            $allads = explode("|",$adList);
            if(count($allads)<1){
                return $aContent;
            }
            $thisad = array_pop($allads);
            $adList = implode("|",$allads);
            $dDoc = new DOMDocument;
            $dDoc->loadHTML(mb_convert_encoding($aContent, 'HTML-ENTITIES', 'UTF-8'));
            $path = new DOMXPath($dDoc);
            if ($div = $path->query($thisad)) { 
                foreach($div as $node){
                    $node->parentNode->removeChild($node);
                }
            }
            $aContent = $dDoc->saveHTML();
            if(count($allads)>0){
                $aContent = removeAds($aContent, $adList);
            }
            return $aContent;
        }
    
        function DOMinnerHTML(DOMNode $element){                            //Rethink how to shape this to not break tree structure. Definitely need first-level child nodes to come with their descendants
            $innerHTML = "";                                                //Probably don't want to iterate teh descendants individually
            $children  = $element->childNodes;

            foreach ($children as $child) 
            { 
                $innerHTML .= $element->ownerDocument->saveHTML($child);
            }

            return $innerHTML; 
        } 
        /* THIS IS DEMO CODE FOR THE ABOVE FUNCTION 
        $dom= new DOMDocument(); 
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput       = true;
        $dom->load($html_string); 
        
        $domTables = $dom->getElementsByTagName("table"); 

        // Iterate over DOMNodeList (Implements Traversable)
        foreach ($domTables as $table) 
        { 
            echo DOMinnerHTML($table); 
        } 
        */
?>
    <script type="text/javascript"> 
     //<!--   
     var base = $( 'base' ).attr( 'href' );
     if( base ) {
      // Fix a tags with relative href
      $( 'a[href]' ).filter( function() {
       return ! /^(\w+:|\/)/.test($(this).attr('href'));
      }).each( function() {
       $(this).attr( 'href' , base + $(this).attr( 'href' ) );
      });
     }
    //--></script>      
      

</html>