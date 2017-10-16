<html>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="./imager.js?vs=<?php echo time(); ?>" >    </script>
    <?php require_once("infograb3.php");?>
    <div style="background:blue; border: 1px solid black; color:white; padding:12px; border-radius: 8px; display:inline-block;" onclick="queryImg(jQuery('textarea').val());">submit</div>
    <br>
    <textarea style="font-size: 18px;"></textarea>
    <br>
    <div id="outarea"></div>
    <div id="hiddenoutarea" style="display:none;"></div>
    <!--<script type="text/javascript">requestTags();</script>-->
</html>