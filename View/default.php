<?php 
    include_once "header.php" ?>
<?php
    if(isset($page)) {
        if($page == 'home')
            require("home.php");
    else
        require($page.".php");
 }
 ?>
 <?php include_once "footer.php" ?>