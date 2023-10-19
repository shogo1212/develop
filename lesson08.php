<?php

$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];
echo "_______________________", "\n";
echo " |_____|_c1 |_c2|_c3|横合計|", PHP_EOL;

$col_totals = [];
foreach ($arr as $row_key => $columns) {
    echo " |___", $row_key;
    $row_total = 0;
    foreach ($columns as $col_key => $value) {
        $row_total += $value;
        printf("|%4s", $value); // 4文字の幅で右揃え
        $col_totals[$col_key] = ($col_totals[$col_key] ?? 0) + $value; // 列の合計
    }
    printf("|%4s|", $row_total);
    echo "\n";
}

echo " |縦合計";
foreach ($col_totals as $value) {
    printf("|%4s", $value); // 4文字の幅で右揃え
}
printf("|%4s|", array_sum($col_totals));
echo PHP_EOL;

echo "_______________________", "\n";
?>