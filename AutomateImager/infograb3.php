<?php

//set things up for remote sign in to draft generate form        
$curl= "https://agoraeconomics.com/wp-login.php?action=postpass&wpe-login=agoraeconomics";
$url= "https://agoraeconomics.com/automatepostintegration/";
$aselector = '//select[contains(@id, "user-submitted-name")]';
$cselector = '//select[contains(@name, "user-submitted-category")]';
$tselector = '//div[contains(@id, "tagdump")]'; 
$nselector = '//input[contains(@id, "usp-nonce")]';
$path = "derp/ctemp";
//build a unique path with every request to store 
//the info per user with custom func. 

$postinfo = "post_password=jCZ4hut8t6qGbKqvpQ9k";

$cookie_file_path = $path."/cookie.txt";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_URL, $curl);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
//set the cookie the site has for certain features, this is optional
curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
curl_setopt($ch, CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
curl_exec($ch);
echo '<div style="background:red;">';            
if (curl_error($ch)) {
    echo curl_error($ch);
}
            
//page with the content I want to grab
curl_setopt($ch, CURLOPT_URL, $url);
//do stuff with the info with DomDocument() etc
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$content = curl_exec($ch);

curl_close($ch);
//$content = preg_replace('/(href|src)=([\'"])\//',"$1=$2".$url,$content);            
                   
            
            
        $catList = "";    
        $authList = "";
        $alltags = "";
        
        
        //$content = file_get_contents($url);
        $d = new DOMDocument;
        libxml_use_internal_errors(true);
        $d->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();


        $x = new DOMXPath($d);
            $checkText = $d->saveHTML();
            if (($div = $x->query($aselector))) {
                $authList = ($d->saveHTML($div->item(0)));
                $dom = new DOMDocument;
                $authList = str_replace("'"," ",$authList);
                if(!$dom->loadHTML($authList)){echo "error loading ".gettype($authList)." authlist: ".$authList;}                                                           //debug statement
                //echo ".".$dom->saveHTML();                                                                                                                                      //debug statement
                //var_dump($dom);
                $aList = array();
                $options = $dom->getElementsByTagName('option');
                foreach ($options as $option) {
                    $aList[$option->getAttribute('value')]= $option->nodeValue;
                    
                }
                echo "<script type='text/javascript'> window['authList'] = '".json_encode($aList)."'".'</script>';
                //echo json_encode($aList);                                                                                                                                    //debug statement
        }

        $x = new DOMXPath($d);
            $checkText = $d->saveHTML();
            if (($div = $x->query($cselector))) {
                $catList = ($d->saveHTML($div->item(0)));
                $dom = new DOMDocument;
                if(!$dom->loadHTML($catList)){echo "error loading ".gettype($catList)." catlist: ".$catList;}                                                           //debug statement
                //echo ".".$dom->saveHTML();                                                                                                                                      //debug statement
                //var_dump($dom);
                $cList = array();
                $options = $dom->getElementsByTagName('option');
                foreach ($options as $option) {
                    $cList[$option->getAttribute('value')]= $option->nodeValue;
                    
                }
                echo "<script type='text/javascript'> window['catList'] = '".json_encode($cList)."'".'</script>';
        }

        $x = new DOMXPath($d);
            $checkText = $d->saveHTML();
            if (($div = $x->query($tselector))) {
                $alltags = ($d->saveHTML($div->item(0)));
                
                $alltags = str_replace("'"," ",$alltags);

                echo "<script type='text/javascript'> window['alltags'] = '".substr($alltags, 40, -6)."'".'</script>';
        }
                
        
        
           //Find the nonce 
        $x = new DOMXPath($d);
        $checkText = $d->saveHTML();
        if (($div = $x->query($nselector))) {
            $uspnonce = ($d->saveHTML($div->item(0)));
            $uspnonce = substr($uspnonce, (strpos($uspnonce, "value=") + 7), 10 );

            echo "<script type='text/javascript'> window['uspnonce'] = '".$uspnonce."'".'</script>';
        }   

echo '</div>';
?>