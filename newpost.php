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
<link href='secure.css' rel='stylesheet' type='text/css'>
  

    <script type="text/javascript">
    function DoSubmit(){
        //alert("I tried to run");
        var x=document.getElementsByTagName("input"); // plural

        for(var i = 0; i < x.length; i++) {
            var str=x[i].value; 
            x[i].value=str.split("&").join("%26");
        }
         document.getElementById("richTextArea").value=document.getElementsByClassName("nicEdit-main")[0].innerHTML;
         console.log(document.getElementById("richTextArea").value);
        var x=document.getElementsByTagName("textarea"); // plural

        for(var i = 0; i < x.length; i++) {
            var str=x[i].value; 
            x[i].value=str.split("&").join("%26");
            str=x[i].value; 
            x[i].value=str.split("; font-family: Roboto, sans-serif;").join(";"); 
            str=x[i].value; 
            x[i].value=str.split(";font-size: 12px").join(";");
        }
      
    setTimeout(function(){
        document.getElementById("usp_form").submit();
        return true;
           }, 1000)
    }

    
    </script>

    <script src="./nicEdit/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor({fullPanel : true, iconsPath : './nicEdit/nicEditorIcons.gif'}).panelInstance('richTextArea');
    });
    </script>
</head>
<body>
    <header>

        <h1>A wordpress submission form</h1>

    </header>

    
    
    <main>

        
<!--CONTENT BEGINS HERE-->        
<?php

//set things up for remote sign in to draft generate form        
$curl= "https://agoraeconomics.com/wp-login.php?action=postpass&wpe-login=agoraeconomics";
$url= "https://agoraeconomics.com/automatepostintegration/";
$selector = '//div[contains(@id, "content")]';
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
    "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
curl_exec($ch);
            
if (curl_error($ch)) {
    echo curl_error($ch);
}
            
//page with the content I want to grab
curl_setopt($ch, CURLOPT_URL, $url);
//do stuff with the info with DomDocument() etc
$content = curl_exec($ch);
curl_close($ch);
//$content = preg_replace('/(href|src)=([\'"])\//',"$1=$2".$url,$content);            
                   
            
            
            
        $checkText = "";
        
        //$content = file_get_contents($url);
        $d = new DOMDocument;
        libxml_use_internal_errors(true);
        $d->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();


        $x = new DOMXPath($d);
            $checkText = $d->saveHTML();
            if (($div = $x->query($selector))) {
                $checkText = ($d->saveHTML($div->item(0)));
                $checkText = str_replace('<form id="usp_form" method="post" enctype="multipart/form-data" action="">', '<form id="usp_form" method="post" enctype="multipart/form-data" action="sendp.php">',$checkText); 

                /*if (trim(strip_tags($checkText)) == ""){
                    $checkText = $checkText.($d->saveHTML($div->item(1)));
                }
            */
                echo $checkText;
        }

        
?>
        
        

    </main>
<!--FOOTER BEGINS HERE-->
			
    <footer id="page-footer">
<hr/>
Vladimir Kuznetsov, Agora Global Projects &copy; 2016  |  All Rights Reserved 

    </footer> 
</body>
</html>