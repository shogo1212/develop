<?php

$num1 = 1;  // 分子
$deno1 = 10; // 分母
$num2 = 5;  // 分子
$deno2 = 6; // 分母

function calcFraction($num1, $deno1, $num2, $deno2) {
    // この関数内に処理を記述
    $lcm = lcm($deno1, $deno2);
    $num = ($num1 * ($lcm / $deno1)) + ($num2 * ($lcm / $deno2));// 3 + 25
    $gcd = gcd($num, $lcm);
              //28,30
    return [$num / $gcd , $lcm / $gcd];
}        // 28 / (28,30), 30 /(28,30)

// 最大公約数 ２
function gcd($m, $n){
  if($n > $m) list($m, $n) = array($n, $m);

  while($n !== 0) {
    $tmp_n = $n;
    $n = $m % $n;
    $m = $tmp_n;
  }
  return $m;
}

// 最小公倍数　３０
function lcm($m, $n){
  return $m * $n / gcd($m, $n);
}
list($result_num, $result_deno) = calcFraction($num1, $deno1, $num2, $deno2);

echo $num1 . "/" . $deno1 . " + " . $num2 . "/" . $deno2 . " = " . $result_num . "/" . $result_deno . "\n";
?>
