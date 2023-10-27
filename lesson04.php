<?php

$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>テーブル表示</title>
<style>
table {
    border:1px solid #000;
    border-collapse: collapse;
}
th, td {
    border:1px solid #000;
}
</style>        
</head>
<body>
    <!-- ここにテーブル表示 -->
    <table>
        <?php
  echo "_____________________________", "<br>";
  echo " |______|__c1|__c2|__c3|横合計|", "<br>";

  $col_totals = [];
  function formatValue($value, $maxDigits = 3) {
    $digits = strlen((string)$value);  // 数字の桁数を計算
    $underscores = $maxDigits - $digits;  // 必要なアンダースコアの数を計算
     // 数字が3桁の場合、アンダースコアを追加しない
 if ($digits == 3) {
    return $value;
}
    return str_repeat("_", $underscores) . $value;  // アンダースコアと数字を結合
}
  echo "|____r1";
  $row_total = array_sum($arr['r1']);
  foreach ($arr['r1'] as $col_key => $value) {
  echo "|_" . formatValue($value);
  $row_total += $value;
        // 列の合計を更新
        $col_totals[$col_key] = ($col_totals[$col_key] ?? 0) + $value;
}
  printf("|__%4s|", $row_total); // 横合計
  echo "<br>";

  echo "|____r2";
  $row_total = array_sum($arr['r2']);
  foreach ($arr['r2'] as $col_key => $value) {
      echo "|_" . formatValue($value);
      $row_total += $value;
        // 列の合計を更新
        $col_totals[$col_key] = ($col_totals[$col_key] ?? 0) + $value;
  }
  printf("|__%4s|", $row_total); // 横合計
  echo "<br>";

  echo "|____r3";
  $row_total = array_sum($arr['r3']);
  foreach ($arr['r3'] as $col_key => $value) {
  echo "| " . formatValue($value);
  $row_total += $value;
        // 列の合計を更新
        $col_totals[$col_key] = ($col_totals[$col_key] ?? 0) + $value;
}
  printf("|_%4s|", $row_total); // 横合計
  echo "<br>";

  echo " |縦合計";
  foreach ($col_totals as $value) {
      printf("|%4s", formatValue($value)); // 4文字の幅で右揃え
  }
  printf("|_%4s|", array_sum($col_totals));
  echo "<br>";
  echo "_____________________________", "<br>";
?>

    </table>
    
</body>
</html>