<?php

// ランダムな数値を含む配列を生成
$randomArray = [];
for ($i = 0; $i < 10; $i++) {
    $randomArray[] = rand(0, 99); // 0〜99の間でランダムな数値を生成し配列に追加
}

// 配列の内容を表示
var_dump($randomArray);

?>