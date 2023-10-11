<?php
  $apple_val=100;
  $apple_qua=1;
  $grape_val=200;
  $grape_qua=3;
 
  
  echo $apple_val. "円のりんごを". $apple_qua. "個です。";
  echo "\n";
  echo $grape_val. "円のブドウを". $grape_qua. "個です。";
  $sum= $grape_val * $grape_qua + $apple_val * $apple_qua;
  echo "\n";
  echo "合計は". $sum. "円です。";
  echo "\n";
?>
