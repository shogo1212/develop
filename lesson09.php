<?php

$arr = [99, 3, 12, 45, 60, 100, 31, 7, 28];

$n = count($arr);

for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($arr[$j] > $arr[$j + 1]) {
            // 2つの値を交換
            $temp = $arr[$j];
            $arr[$j] = $arr[$j + 1];
            $arr[$j + 1] = $temp;
        }
    }
    // 途中経過の表示
    echo implode(", ", $arr) . "\n". "↓\n";
}

echo implode(", ", $arr) . "\n";
// ここで並び替え処理
?>
