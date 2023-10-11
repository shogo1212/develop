<?php
// 現在の日時
$now = new DateTime();
echo $now->format('Y年m月d日H時i分s秒') . "\n";

// 現在日時から3日後
$threeDaysLater = (clone $now)->modify('+3 days');
echo $threeDaysLater->format('Y年m月d日H時i分s秒') . "\n";

// 現在から12時間前
$twelveHoursBefore = (clone $now)->modify('-12 hours');
echo $twelveHoursBefore->format('Y年m月d日H時i分s秒') . "\n";

// 2022年元旦から現在までの経過日数
$newYear = new DateTime('2020-01-01');
$interval = $newYear->diff($now);
echo $interval->days . "日\n";

?>