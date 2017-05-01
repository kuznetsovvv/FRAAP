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
<link href='secure.css?v=<?php echo time(); ?>' rel='stylesheet' type='text/css'>
  
 <script type="text/javascript">
    function showhide(num){
        but = document.getElementById("more"+num);
        if(but.className == "less"){
            but.src = "automate/more.png"
            but.className = "more";
            document.getElementById("ul"+num).className="hiddenclass";
        }
        else{
            but.className = "less";
            but.src = "automate/less.png";
            document.getElementById("ul"+num).className="nothidden";
        }
    }
     
    function NewEntry(){

        document.getElementById("config").value=document.getElementById("config").value+'\n;;;;;;;;;;;;;';
        document.getElementById("newentry").value=true;
        document.getElementById("gsites").submit();
    };
    function DoSubmit(varline){
        //alert("Entry number: "+varline);
        
        var xa=document.getElementById("surl"+varline).value;
        var xb=document.getElementById("sels"+varline).value;
        var xc=document.getElementById("titl"+varline).value;
        var xd=document.getElementById("lurl"+varline).value;
        var xe=document.getElementById("cred"+varline).value;
        var xf=document.getElementById("xpost"+varline).value;
        var xg=document.getElementById("feed"+varline).value;
        var xh=document.getElementById("lang"+varline).value;
        var xi=document.getElementById("tier"+varline).value;
        var xj=document.getElementById("prom"+varline).value;                
        var xk=document.getElementById("contents"+varline).value;
        var xl=document.getElementById("auth"+varline).value;
        var xm=document.getElementById("code"+varline).value;
        var xs=document.getElementById("stop"+varline).value;
        
/*
        for(var i = 0; i < x.length; i++) {
            var str=x[i].value; 
            x[i].value=str.replace("&","%26");
        }
  //*/
    var targ=document.getElementById("config");
    var lines = targ.value.split("\n");

    // calculate start/end
    var startPos = 0, endPos = targ.value.length;
    for(var x = 0; x < lines.length; x++) {
        if(x == varline) {
            break;
        }
        startPos += (lines[x].length+1);
    }

    var endPos = lines[varline].length+startPos;
    //alert(targ.value.substring(startPos, endPos));
    //alert(xa+";"+xb+";"+xc+";"+xd+";"+xe+";"+xf+";"+xg);
    var str = targ.value;  
    var n=str.replace(str.substring(startPos, endPos),(xa+";"+xb+";"+xc+";"+xd+";"+xe+";"+xf+";"+xg+";"+xh+";"+xi+";"+xj+";"+xk+";"+xl+";"+xm+";"+xs))
    targ.innerHTML = n;
    document.getElementById("gsites").submit();
    return true;
    }

     function DoSubmitAll(varlen){
        //alert("Entry number: "+varline);
        
        var targ=document.getElementById("config");
            for (var varline = 0; varline < varlen; varline++){
                //alert(varline);
                var xa=document.getElementById("surl"+varline).value;
                var xb=document.getElementById("sels"+varline).value;
                var xc=document.getElementById("titl"+varline).value;
                var xd=document.getElementById("lurl"+varline).value;
                var xe=document.getElementById("cred"+varline).value;
                var xf=document.getElementById("xpost"+varline).value;
                var xg=document.getElementById("feed"+varline).value;
                var xh=document.getElementById("lang"+varline).value;
                var xi=document.getElementById("tier"+varline).value;
                var xj=document.getElementById("prom"+varline).value;
                var xk=document.getElementById("contents"+varline).value;
                var xl=document.getElementById("auth"+varline).value;
                var xm=document.getElementById("code"+varline).value;
                var xs=document.getElementById("stop"+varline).value;
                
        /*
                for(var i = 0; i < x.length; i++) {
                    var str=x[i].value; 
                    x[i].value=str.replace("&","%26");
                }
          //*/
                
            var lines = targ.value.split("\n");

            // calculate start/end
            var startPos = 0, endPos = targ.value.length;
            for(var x = 0; x < lines.length; x++) {
                if(x == varline) {
                    break;
                }
                startPos += (lines[x].length+1);
            }

            var endPos = lines[varline].length+startPos;
            //alert(targ.value.substring(startPos, endPos));
            //alert(xa+";"+xb+";"+xc+";"+xd+";"+xe+";"+xf+";"+xg);
            var str = targ.value;
            var n=str.replace(str.substring(startPos, endPos),(xa+";"+xb+";"+xc+";"+xd+";"+xe+";"+xf+";"+xg+";"+xh+";"+xi+";"+xj+";"+xk+";"+xl+";"+xm+";"+xs));
            if(!(xc)){
                n=str.replace(str.substring(startPos - 1, endPos),(""));
            }
            targ.innerHTML = n;
            
            }
         
    document.getElementById("gsites").submit();
    return true;
    }
     
    </script>



</head>
<body>
    <header>

        <h1>Website configuration manager</h1>
<hr />
    </header>

    
    
    <main>

        
<!--CONTENT BEGINS HERE-->        
<?php        
        
    $datei = fopen("derp/psites.txt","r");
    $freelist = fread($datei,99999);
    fclose($datei);
    $paylist = decrypt($freelist, $_COOKIE['PrivatePageLogin']);
    $conflist = explode("\n", trim(str_replace("\r", '', $paylist)));
    foreach ($conflist as $i => $value){ 
        $conf =  explode(';', $value);
        $urls[$i] = $conf[0];
        $selects[$i] = $conf[1];
        $titls[$i] = $conf[2];        
        $logurls[$i] = $conf[3];
        $creds[$i] = $conf[4];
        $xtrapost[$i] = $conf[5];
        $feeds[$i] = $conf[6];
        $langs[$i] = $conf[7];
        $tiers[$i] = $conf[8];
        $proms[$i] = $conf[9];
        $contents[$i] = $conf[10];
        $auths[$i] = $conf[11];
        $codes[$i] = $conf[12];
        $stops[$i] = $conf[13];
    }


     echo '<p><input type="button" onclick="javascript:DoSubmitAll('.count($urls).');" value="Save All Changes!!" /> this also will delete any entries without <span style="font-style:italic;"> titles.</span></p><p><input type="button" onclick="javascript:NewEntry();" value="Add new Entry" /> and auto-scroll to it!</p>';
               
echo '<h2>Sites:</h2><form action="" id="holder" method="post"><ol>';        
   foreach ($urls as $num => $ul){
        echo '<li>';
        echo '<input type="text" class="titl wide" name="titl'.$num.'" id="titl'.$num.'" value="'.$titls[$num].'"/><img id="more'.$num.'" src="automate/more.png" class="more" onclick="showhide('.$num.')" /> ';
        echo '<ul id="ul'.$num.'" class="hiddenclass"><li>Author: <input type="text" class="wide" name="auth'.$num.'" id="auth'.$num.'" value="'.$auths[$num].'"/> </li>';//'<ul><li>Source URL: <a href="'.$ul.'">.'.$ul.'</a>';
        echo '<li>Publication Code: <input type="text" class="wide" name="code'.$num.'" id="code'.$num.'" value="'.$codes[$num].'"/> </li>';
        echo '<li>Source URL: <input type="text" class="wide" name="surl'.$num.'" id="surl'.$num.'" value="'.$ul.'"/> </li>';//'<ul><li>Source URL: <a href="'.$ul.'">.'.$ul.'</a>';
        echo '<li>Login Form URL (Leave blank for free sources): <input type="text" class="wide" name="lurl'.$num.'" id="lurl'.$num.'" value="'.$logurls[$num].'"/> </li>';
        echo '<li>Promo URL (Leave blank for free sources): <input type="text" class="wide" name="prom'.$num.'" id="prom'.$num.'" value="'.$proms[$num].'"/> </li>';
        echo '<li>Login Credentials (Leave blank for free sources): <input type="text" class="wide" name="cred'.$num.'" id="cred'.$num.'" value="'.urldecode($creds[$num]).'"/> </li>';//urldecode($creds[$num]).'</li>';
        echo' <li>Additional POST data to log in (Leave blank for free sources): <input type="text" class="wide" name="xpost'.$num.'" id="xpost'.$num.'" value="'.urldecode($xtrapost[$num]).'"/>';
        echo '</li><li>Target xPath selector:  <input type="text" class="wide" name="sels'.$num.'" id="sels'.$num.'" value="'.htmlspecialchars($selects[$num]).'"/>';//.$selects[$num];
        echo '</li><li>Content xPath selector:  <input type="text" class="wide" name="contents'.$num.'" id="contents'.$num.'" value="'.htmlspecialchars($contents[$num]).'"/>';
        echo '</li><li>Content end xPath selector:  <input type="text" class="wide" name="stop'.$num.'" id="stop'.$num.'" value="'.htmlspecialchars($stops[$num]).'"/>';//.$selects[$num];
        echo '</li><li>Feed URL (Leave blank for no feed): <input type="text" class="wide" name="feed'.$num.'" id="feed'.$num.'" value="'.htmlspecialchars($feeds[$num]).'"/></li>';
        echo '<li>Language: <input type="text" class="wide" name="lang'.$num.'" id="lang'.$num.'" value="'.$langs[$num].'"/></li>';
        echo '<li>Price Tier: <select class="wide" name="tier'.$num.'" id="tier'.$num.'" />';
        echo '<option value="Free"';
        if ($tiers[$num] == "Free"){echo ' selected="selected"';}
        echo '>Free</option>';
        echo '<option value="Frontend"';
        if ($tiers[$num] == "Frontend"){echo ' selected="selected"';}
        echo '>Frontend</option>';
        echo '<option value="Backend"';
        if ($tiers[$num] == "Backend"){echo ' selected="selected"';}
        echo '>Backend</option>';
        echo '</select></li>';
        echo '</ul><input type="button" onclick="javascript:DoSubmit('.$num.');" value="Save Changes to THIS Entry" /></li>';
   }
        echo '</ol></form><form action="" id="gsites" method="post"><textarea style="display:none;" name="comment" form="gsites" id="config">'.$paylist.'</textarea><input type="hidden" value="true" name="psave" /><input type="hidden" value="false" id="newentry" name="newentry" /><input type="hidden" value="true" name="gfcsave" /></form>'; // style="display:none;"
        

if($_POST['bottom'] === "true"){
    echo '<script type="text/javascript">';
    echo "$('html,body').animate({'scrollTop':$('#titl".(count($urls)-1)."').position().top}, 500);";
    echo '</script>';
}
        
            echo '<p><input type="button" onclick="javascript:DoSubmitAll('.count($urls).');" value="Save All Changes!!" /> this also will delete any entries without <span style="font-style:italic;"> titles.</span></p><p><input type="button" onclick="javascript:NewEntry();" value="Add new Entry" /> and auto-scroll to it!</p>';
               
 //*/       
        

/*
$url="http://moneyweek.com/";        
        
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$content= curl_exec($ch);
curl_close($ch);
            

        
        //$content = file_get_contents('http://moneyweek.com/');
$content = preg_replace('/(href|src)=([\'"])\//',"$1=$2".$url,$content);
//echo $content;    
             echo "<h3>This module coming soon</h3>"   //*/
?>
        <!--
        <div style="position: fixed; bottom: 0; right: 0;" id="jsout" />
       <script>
setInterval(function(){
    
    var element = $(':hover');
    if(element.length)
    {
        var domElement = element[element.length - 1];
        var tagName = domElement.tagName;
        var id = domElement.id ? ' id="' + domElement.id + '"' : "";
        var clss = domElement.className ? ' class="' + domElement.className + '"' : "";
        document.getElementById('jsout').innerHTML =
        "hover: &lt;" + tagName.toLowerCase() + id + clss + "&gt;";
    }
}, 100);
        </script> 
-->

    </main>
<!--FOOTER BEGINS HERE-->
			
    <footer id="page-footer">
<hr/>
Vladimir Kuznetsov, Agora Global Projects &copy; 2016  |  All Rights Reserved 

    </footer> 
</body>
</html>