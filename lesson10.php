<?php
$numbers = [10,60,90,70,50];
foreach ($numbers as $number) {
    if ($number > 80) {
        echo  $number. "点は優です。"."\n";
    }
    if ($number > 60) {
        echo $number. "点は良です。". "\n";
    }
    if ($number > 40) {
        echo $number. "点は可です。". "\n";
    }
    if ($number < 40) {
        echo $number. "点は不可です。". "\n";
    }
    echo "\n";
}

?>
