<?php

function fizzbuzz() {
    // この関数内に処理を記述
    for ($i = 1; $i <= 100; $i++){
        if ($i % 3 == 0 && $i % 5 == 0) {
            echo $i. " FizzBuzz\n";
        } elseif ($i % 3 == 0) {
            echo $i. " Fizz\n";
        } elseif ($i % 5 == 0) {
            echo $i. " Buzz\n";
        } else {
            echo $i. "\n";
        }
    }
}
fizzbuzz()
?>
