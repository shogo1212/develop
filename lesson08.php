<?php
$country = [
    "日本" => "東京",
    "アメリカ" => "ワシントン",
    "イギリス" => "ロンドン",
    "フランス" => "パリ",
];
foreach ($country as $key => $value) {
    echo $key, "の首都は", $value, "です。\n";
}

?>