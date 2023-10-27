<?php
    function numberLoop() {
        $output = "";
    
        // 上半分のパターンを出力
        for ($i = 1; $i <= 5; $i++) {
            // アスタリスクを出力
            for ($j = 5; $j > $i; $j--) {
                $output .= "*";
            }
    
            // 増加する数字を出力
            for ($k = 1; $k <= $i; $k++) {
                $output .= ($k % 2 == 0) ? "<strong>$k</strong>" : $k;
            }
    
            // 減少する数字を出力
            for ($l = $i - 1; $l >= 1; $l--) {
                $output .= ($l % 2 == 0) ? "<strong>$l</strong>" : $l;
            }
    
            $output .= "<br>"; // HTMLの改行
        }
    
        for ($i = 4; $i >= 1; $i--) {
            // アスタリスクを出力
            for ($j = 5; $j > $i; $j--) {
                $output .= "*";
            }
    
            // 増加する数字を出力
            for ($k = 1; $k <= $i; $k++) {
                $output .= ($k % 2 == 0) ? "<strong>$k</strong>" : $k;
            }
    
            // 減少する数字を出力
            for ($l = $i - 1; $l >= 1; $l--) {
                $output .= ($l % 2 == 0) ? "<strong>$l</strong>" : $l;
            }
    
            $output .= "<br>"; // HTMLの改行
        }
    
        return $output;
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ループ表示</title>
</head>
<body>
    <!-- ここに表示例の通り表示 -->
  <?php
     echo numberLoop(); 
    ?>
</body>
</html>