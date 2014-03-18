<?php

/**
 * Stat view file
 * This is view that call the controlor get_stat.php
 * 
 * @package Dogs
 * @name csv_stat.php
 * @author Riadh Hamdi
 * 
 */

// Get stat from the controller
include 'get_stat.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>csv stat</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body background='http://www.amicale-chien-loup-tchecoslovaque.com/space2.jpg' BGCOLOR='#00000' TEXT='#FFFFFF' LINK='#FFFFFF' VLINK='#FFFFFF' ALINK='#FFFFFF'>
        <!-- Render the html result -->
        <?php echo $htmlToRender;?>
    </body>
</html>
