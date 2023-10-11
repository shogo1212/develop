<?php
$data = [
    ['name'=>'田中', 'age'=>'25', 'gender'=>'男'],
    ['name'=>'鈴木', 'age'=>'20', 'gender'=>'男'],
    ['name'=>'佐藤', 'age'=>'23', 'gender'=>'女'],
    ];

    foreach ($data as $person) {
   
        echo trim($person['name']) . trim($person['age']) . trim($person['gender']) . "\n";
    }
    foreach ($data as $person) {
        if (trim($person['age']) == '20') {
            echo $person['age']. "\n";
        }
    }
?>