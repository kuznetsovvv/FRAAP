<?php
echo "<form action='' method='post'> 
<input type='submit' name='upck' value='Update checker' /> 
<!--<input type='submit' name='upck2' value='Update checker 2' />-->
<input type='submit' name='adar' value='Add article manually' /> 
<input type='submit' name='awebr' value='AWeber' /> 
</form>"; 
       //menu actions

    if(isset($_POST['stmg']) and ($_POST['stmg'] == true) ) 
    { 
       include("sitemanager.php"); 
    }


//Manage Paysites
    if(isset($_POST['pstmg']) and ($_POST['pstmg'] == true) ) 
    { 
       include("Paysite_manager.php"); 
    }
    if(isset($_POST['psave'])) 
    { 
       include("Paysite_manager.php"); 
    }
    
    if(empty($_POST)||isset($_POST['upck']))
    {  
        set_time_limit(900);
        include("getups.php");
    }
        if(isset($_POST['upck2']))
    {  
        set_time_limit(900);
        include("getups2.php");
    } 
//*/
    if(isset($_POST['adar'])) 
    { 
       include("newpost.php"); 
    }
    if(isset($_POST['awebr'])) 
    { 
       include("derp/aweber.php"); 
    }
    



    ?>