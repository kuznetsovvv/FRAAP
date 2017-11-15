<?php ob_start();
if(empty($_SERVER['CONTENT_TYPE']))
{ 
 $_SERVER['CONTENT_TYPE'] = "application/x-www-form-urlencoded"; 
}

	if(isset($_POST["tags"])){
		$getUrl = "https://agoraeconomics.com/aeimg2/?key=ArbitraryStringOfTextForAKey&posid=".$_GET['posid'];
        //echo "<pre>";
        //var_dump($_POST["tags"]);
        //echo "</pre><hr>";
	}else{
        ?>
        <script>alert("get4ai.php failed");</script>
        <?php
    }
    ?>
    <h2><?php echo $getID ?></h2>
    <p>The target url was: <?php echo "<a href='$getUrl'>$getUrl</a>" ?></p>
    <?php
	$ch = curlSettings($getUrl, $_POST["tags"]);
    $result = curlRequest($ch);
	$header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($result, 0, $header_len);
	$body = substr($result, $header_len);
    echo $body;// json_encode($body);
    ?>
    <?php
    exit();

function curlSettings($url, $tags){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Connection:	keep-alive","Cache-Control:	no-store, no-cache, private","Upgrade-Insecure-Requests:	1","If-Modified-Since: ".gmdate('D, d M Y H:i:s \G\M\T'),'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8','Accept-Encoding: none','Accept-Language: en-US,en;q=0.8'));                      
    curl_setopt($curl, CURLOPT_HEADER, true);                                         //curl for login/auth
    curl_setopt($curl, CURLOPT_NOBODY, false);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,30); 
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); 
    curl_setopt($curl, CURLOPT_POST, 1);
    $fields_string ="";
    $fields = array(
        'goodtags' => $tags
    );
    //url-ify the data for the POST
    $fields_string = http_build_query($fields);
    //foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    //rtrim($fields_string, '&');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file_path);
    //set the cookie the site has for certain features, this is optional
    //curl_setopt($curl, CURLOPT_COOKIE, "cookiename=".$num);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    //curl_setopt($curl, CURLOPT_REFERER, parse_url($url, PHP_URL_SCHEME)."://".parse_url($url, PHP_URL_HOST));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_URL, $url);                                    
      //parse_url($url, PHP_URL_SCHEME)."://".parse_url($url, PHP_URL_HOST));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return $curl;
}
function curlRequest($handle){
    $curlResult = curl_exec($handle);
    return $curlResult;
}