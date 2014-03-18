<?php

require 'includes/config.inc.php';
require 'includes/classi/CDatabase.php';
require 'includes/classi/CDogs.php';

//$db = new Database($host,$user,$password,$name);
//$db->connetti();
$obj_dog = new Dogs();
$males = $obj_dog->get_males();
$females = $obj_dog->get_females();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dogs</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="csv_stat.php" method="get">
            <p>
            <label for="dog1">Choose the male:</label><br>
            <select name="dog1" id="dog1">
                <option value="">Choose</option>
                <?php if(isset($males)):?>
                    <?php foreach ($males as $key => $value):?>
                    <option value="<?php echo $value['id']?>"><?php echo $value['nome']?> - <?php echo $value['registro']?></option>
                    <?php endforeach;?>
                <?php endif;?>
            </select>
            </p>
            <p>           
            <label for="dog2">Choose the female:</label><br>
            <select name="dog2" id="dog2">
                <option value="">Choose</option>
                <?php if(isset($females)):?>
                    <?php foreach ($females as $key => $value):?>
                    <option value="<?php echo $value['id']?>"><?php echo $value['nome']?> - <?php echo $value['registro']?></option>
                    <?php endforeach;?>
                <?php endif;?>
            </select>
            </p>
            <p>
            <label for="depth">statistic for:&nbsp;
                5 <input type="radio" name="depth" value="5" checked /> or
                10 <input type="radio" name="depth" value="10" />
            &nbsp;generations
            </label>
                </p>           
            <input type="submit" value="Coefficient of inbreeding [Sum (1/2)^n1+n2+1 * (1+Fa)]">
        </form>
    </body>
</html>