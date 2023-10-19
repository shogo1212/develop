<?php
function isLeapYear($year) {
    return ($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0;
}

function displayLeapYearsInRange($start, $end) {
    for($year = $start; $year <= $end; $year++) {
        if (isLeapYear($year)) {
            echo $year . " はうるう年です。\n";
        } else {
            echo $year . "\n";
        }
    }
}

displayLeapYearsInRange(1980, 2080);
?>