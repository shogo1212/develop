<?php
$yen = 10000;   // 購入金額
$product = 150; // 商品金額

echo "10000円札で購入した場合、\n";

function calc($yen, $product) {
    // この関数内に処理を記述
    
    $change = $yen - $product;
    $money = [10000,5000,1000,500,100,50,10,5,1];
    foreach ($money as $j) {
        $maisu = floor($change / $j);
        $change -= ($j * $maisu);
        $t = ($j > 500) ? "札" : "玉";
        echo $j . "円" . $t . "x" . $maisu . "枚、";
    }
    echo "\n";
    
    echo "100円玉で購入した場合、\n";
    $yen = 100;
    $product = 150;
    if ($yen < $product) {
        echo ($product - $yen) . '円足りません。'; 
    }
    echo "\n";
}
calc($yen, $product)
?>
