<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<title>Loading... Automate</title>
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
    <header style="text-align:center;">

        <h1>Your submission is being processed, please be patient.</h1>
        <h2> Wordpress is faster than PDF writing.</h2>
<hr />
    </header>

    
    
    <main>

        
<!--CONTENT BEGINS HERE-->  
        <div style="width:50%; float:left; margin:0; padding:0;">
        <h2>Saving as WordPress Posts:</h2>
        <div style="text-align:center"><img id="loadingspinnerwp" src="helicopterLoad.gif" style="width:8%; height:auto;" /></div>
<?php  

        
        
        //sleep($_POST['waittime']);
        //set things up for remote sign in to draft generate form        
        $curl= "https://agoraeconomics.com/wp-login.php?action=postpass&wpe-login=agoraeconomics";

        $selector = '//div[contains(@id, "content")]';
        $path = "derp/ctemp";
        //build a unique path with every request to store 
        //the info per user with custom func. 

        $postinfo = "post_password=jCZ4hut8t6qGbKqvpQ9k";

        $cookie_file_path = $path."/cookie.txt";
            //open connection
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
        //foo
        //sleep(1);
//set POST variables
    $url="https://agoraeconomics.com/automatepostintegration/";
    $fields = $_POST;
    //var_dump($fields);
    //url-ify the data for the POST
    foreach($fields as $key=>$value) { 
        $fields_string .= $key.'='.$value.'&'; 
    }
    rtrim($fields_string,'&');
        
        $fields_string = html_entity_decode($fields_string);
        //var_dump($fields_string);
    require_once('vendor/autoload.php');
    require_once('vendor/spipu/html2pdf/html2pdf.class.php');
    $outstring = '<p>ERROR GENERATING PDF</p>';

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //execute post
    //die();    
    $result = curl_exec($ch);
    /*
    echo "<h1>SUBMISSION DATA</h1>";
    //var_dump($fields_string);/*
    foreach ($_POST as $key => $value){
        echo "<br/><strong>['".$key."']</strong> => ".$value;
    }                       
    echo "<hr/>";
    echo "<h1>RESULT</h1>";//*/
    //var_dump($result);
    $last_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); 
    if(strpos($result, "view it please enter your password below") !== false){
        echo '<script type="text/javascript">alert("error logging in submitter page")</script>';
    }
        ?>
            <a href="https://agoraeconomics.com/wp-admin/edit.php?post_status=draft&post_type=post"><h3>Go to the WordPress Drafts page</h3></a>
            <iframe src="https://agoraeconomics.com/wp-admin/edit.php?post_status=draft&post_type=post" style="border:0px #bbbbbb none;" name="Drafts" scrolling="yes" frameborder="1" marginheight="0px" marginwidth="0px" height="500px" width="100%" allowfullscreen></iframe>
            <script type="text/javascript">
            document.getElementById("loadingspinnerwp").style.display = 'none';
                </script>
        </div><div style="width:50%; float:left; margin:0; padding:0;">
        <h2>Saving as PDF documents:</h2>
        <a href="<?php echo '//'.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']).'/saved/'; ?>" target="_blank"><h3>Saved Files Directory</h3></a>
        <div style="text-align:center"><img id="loadingspinnerpdf" src="helicopterLoad.gif" style="width:8%; height:auto;" /></div>
        <ul>
            <?php
    for($inc = 0; $inc < $fields['bulkpubnumber']; $inc++) {
        $targName = date('ymd', time()-14400).".".$fields['user-submitted-pubcode'.$inc];
        $targName = $targName.".".str_replace(", ",".",$fields['user-submitted-tags'.$inc]);
        $outstring = "<h1>".$fields['user-submitted-title'.$inc]."</h1><br /><h2>Retrieved ".date('l jS \of F Y h:i:s A')."</h2><br />".html_entity_decode($fields['user-submitted-content'.$inc]); 
        $outstring = str_ireplace("<center",'<span style="text-align:center;" ',$outstring);
        $outstring = str_ireplace("</center>",'</span>',$outstring);
        $outstring = str_ireplace('="//','="http://',$outstring);
        //$outstring = str_ireplace("</T>",'</div>',$outstring);
        $outstring = preg_replace("</?(script|style|html|body|head|center|section).*?>is","",$outstring); //*/
        $allowed = "<a><abbr><acronym><address><applet><area><article><aside><audio><b><base><basefont><bdi><bdo><big><blockquote><body><br><button><canvas><caption><cite><code><col><colgroup><datalist><dd><del><details><dfn><dialog><dir><div><dl><dt><em><embed><fieldset><figcaption><figure><font><footer><form><frame><frameset><h1><h6><head><header><hr><html><i><iframe><img><input><ins><kbd><keygen><label><legend><li><link><main><map><mark><menu><menuitem><meta><meter><nav><noframes><noscript><object><ol><optgroup><option><output><p><param><picture><pre><progress><q><rp><rt><ruby><s><samp><script><select><small><source><span><strike><strong><style><sub><summary><sup><table><tbody><td><textarea><tfoot><th><thead><time><title><tr><track><tt><u><ul><var><video><wbr>";
        $outstring = strip_tags($outstring, $allowed);
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($outstring);
        $html2pdf->Output(dirname(__FILE__).'/saved/'.$targName.'.pdf', 'F');    
        echo ('<li>'.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']).'/saved/'.$targName.'.pdf</li>');
    }   
        ?>
        </ul>
        <script type="text/javascript">
            document.getElementById("loadingspinnerpdf").style.display = 'none';
        </script>
        </div>
        <?php 
        
    //close connection
    curl_close($ch);

        
    //redirect back 
    ?>
        
        <script type="text/javascript">
            document.title = "Done! Automate"
        </script>  <?php                                                      //OR USE THIS TO CLOSE THE TAB '
    //header( "Location:https://agoraeconomics.com/wp-admin/edit.php?post_status=draft&post_type=post" );                                                             //REDIR BACK, DON'T FORGET TO UNCOMMENT
        
        /* 
       
       
       echo       "<form id='itemreport_new' type='post' action='./?".parse_url($last_url, PHP_URL_QUERY)."'>
          <input id='submit2' name='drafted' type='submit' value='show'  target=_blank   />
</form>
<script>
    $(document).ready(function () {


        $('#submit2').click(function() {
                 $('#itemreport_new').attr('target','_blank');
        });
    });  
</script>";//*/
        

        

    
        ?>

     <div style="clear:both;">&nbsp;</div>   
    </main>
<!--FOOTER BEGINS HERE-->
			
    <footer id="page-footer">
<hr/>
Vladimir Kuznetsov, Agora Global Projects &copy; 2016  |  All Rights Reserved 

    </footer> 
</body>
</html>