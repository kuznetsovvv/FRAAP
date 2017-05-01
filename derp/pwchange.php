<?php
include("derp/logins.php");
    

    if(isset($_POST['pwsave'])) 
    { 
        $hshd = md5(md5($_POST['oldpw']).$nonsense);
             if(!(decrypt($cpht, $hshd)) === false){  

                        if($_POST['npw']!=$_POST['npw2']){
                            echo $_POST['npw']." = ".$_POST['npw2']."?<br/>";
                            echo "<h4>New Passwords do not match. Password not changed</h4>";
                        }else{

                        $cfile = fopen("derp/psites.txt","r");
                        $npln = fread($cfile, 99999);
                        fclose($cfile);
                        $oldhash =$_COOKIE['PrivatePageLogin'];
                        $pln = decrypt($npln, $oldhash);
                        $newhash = md5(md5($_POST['npw']).$nonsense);
                        $enctxt = encrypt($pln, $newhash);
                        $cfile = fopen("derp/psites.txt","w");    
                        setcookie('PrivatePageLogin', $newhash);    
                        $success = fwrite($cfile, $enctxt);    
                        fclose($cfile);
                        echo "<h4>Password updated Successfully!</h4>
                        <p>Don't lose your password, it's your encryption key. Without it, the paid site list is just gibberish.</p>";
                             
}
            }else{
                echo "Incorrent Old password";

            }

    }
if(isset($_POST['newpw'])) 
    { 
    echo '<br/><form action="" id="sites" method="post">
    <label>Old Password:</label><input type="password" name="oldpw" id="user" /> <br />
    <label>New Password:</label><input type="password" name="npw" id="keypass" /> <br />
    <label>New Password:</label><input type="password" name="npw2" id="keypass" /> <br />
    <input type="submit" id="submit" name="pwsave" value="Change Password" />     
    </form>';
        }


?>