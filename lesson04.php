﻿<?php
// 外側のループ: 各行ごと
for ($i = 1; $i <= 4; $i++) {
    
    // アスタリスクの出力
    for ($j = 4; $j > $i; $j--) {
        echo "*";
    }

    // 増加する数字の出力
    for ($k = 1; $k <= $i; $k++) {
        echo $k;
    }

    // 減少する数字の出力
    for ($l = $i - 1; $l >= 1; $l--) {
        echo $l;
    }
    
    echo "\n";
}
?>