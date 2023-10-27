<?php

function isLeapYear($year) {
    // この関数に判定処理を記述
        if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
            return true;
        }
        return false;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>うるう年判定</title>
</head>
<body>
    <!-- ここに表示例の通り表示 -->
    <?php
    function displayLeapYearsInRange($start, $end) {
        for($year = $start; $year <= $end; $year++) {
            if (isLeapYear($year)) {
                echo '<img src="img/torch.png" alt="Torch" />'. $year . " はうるう年です。"."<br>";
            } else {
                echo $year . "<br>";
            }
        }
    }
    
    displayLeapYearsInRange(1980, 2080);
    ?>
</body>
</html>
