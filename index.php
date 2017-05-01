<?php 
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta name="robots" content="noindex,nofollow"/>
<title>FrAAP 1.0</title>
<link rel="shortcut icon" href="images/icon.ico" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
<link href='secure.css?v=<?php echo date('ynj'); ?>' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="fuzzyset.js?vs=<?php echo time(); ?>"></script>
<script src="https://<?php echo $_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']) ?>/ssltest.js"></script>
<script type="text/javascript">
    
function submitform(identifier){
    document.getElementById(identifier).value = true;
    document.getElementById(identifier).parentElement.submit();
    
}</script>




</head>
<body>
<?php
$in = false;
//Force HTTPS crypto. Will probably break usability on production server.

include("derp/logins.php");
if(!in_array($_SERVER['REMOTE_ADDR'], $allowed)){ ?>
    <script type="text/javascript">
        var total = ""; 
        for(var i = 0; i<99999;i++){
            total = total +i.toString();
            history.pushState(0, 0, total);
        }
        alert("done breaking your browser");
    </script>
    <?php
}
if (isset($_GET['p']) && $_GET['p'] == "login") {
        if(in_array($_POST['user'], $username)){
            setcookie('PrivatePageLogin', md5(md5($_POST['keypass']).$nonsense), time() + 315360000); //10 year cookie
            }else{
            setcookie('PrivatePageLogin', "HelloFriend");
        }
        header("Location: $_SERVER[PHP_SELF]");

}
if(isset($_POST['out_button'])) 
{ 
    setcookie('PrivatePageLogin','out');
    header("Location: $_SERVER[PHP_SELF]");
} 
if (isset($_COOKIE['PrivatePageLogin']) and ($_COOKIE['PrivatePageLogin'] != 'out')) {

    include_once("derp/crypto.php");
        $bfile = fopen("derp/psites.txt","r");
        $cpht = fread($bfile, 99999);
        fclose($bfile);
     if((decrypt($cpht,$_COOKIE['PrivatePageLogin']) === false)){  
                 setcookie('PrivatePageLogin','out');
        header( "refresh:2;url=".$_SERVER[PHP_SELF] );
        echo "Sorry, you could not be logged in at this time. Try again in 2 seconds.";
      exit;

   } else {
$in = true;
                                                                                                                                //LOGIN FEEDBACK
echo "<p>Success: We've logged you in.</p>";
  
echo "<form action='' method='post'> 
<input type='submit' name='out_button' value='log out' /> 
<input type='submit' name='nope' value='Close all menus' /> 
<input type='submit' name='settings' value='Settings' /> 
</form>"; 

if($_SERVER["HTTPS"] != "on")
{
    //header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    //exit();
    echo '<div style="color:black; background-color:#ff8888;border:2px solid #ff4400; border-radius:10px; margin:25px; font-size:24px; text-align:center;">WARNING: no SSL! Connection not encrypted!</div>';
    ?>
    <script>   
if( !(window.sslAvailable === undefined) ){
  location.href = 'https:' + window.location.href.substring(window.location.protocol.length);
}else{
    console.log("SSL test failed");
}
</script>
    <?php
}    
         
echo "<hr/>";                                                                                                                                //BEGIN LOGGED IN CONTENT
    //Change PW
    if(isset($_POST['newpw']) and ($_POST['newpw'] == true) )
    { 

       include("derp/pwchange.php"); 
    }elseif(isset($_POST['pwsave'])) 
    { 
       include("derp/pwchange.php"); 
    }elseif(isset($_POST['settings'])) 
    { 
       include("settings.php"); 
    }else{
   
       //create menu
         include("menu.php");
        set_time_limit(900);    
    
    }                                                                                                                       // END LOGGED IN CONTENT 
   }
}
 if(!$in){ ?>
<h1>FREE ARTICLE AUTO PUBLISHER</h1>
<h2 class="c">Please Sign in</h2>    
<form id="login" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post">
    <label>User Name:</label><input type="text" name="user" id="user" /> <br />
    <label>Password:</label><input type="password" name="keypass" id="keypass" /> <br />
<input type="submit" id="submit" value="Login" />
</form>
<?php    }
    ob_end_flush
    ?>
</body>
</html>