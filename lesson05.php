<?php

// 手札
$cards = [
    ['suit'=>'diamond', 'number'=>5],
    ['suit'=>'joker', 'number'=>0],
    ['suit'=>'diamond', 'number'=>7],
    ['suit'=>'diamond', 'number'=>9],
    ['suit'=>'diamond', 'number'=>8],
];

function judge($cards) {
    // この関数内に処理を記述
    function InvalidCards($cards) {//不正チェック
        $uniqueCards = [];
        $jokerCount = 0;
    
        foreach ($cards as $card) {
            if ($card['suit'] === 'joker' && $card['number'] == 0) {
                $jokerCount++;
                if ($jokerCount > 1) {  // ジョーカーが2枚以上あれば重複として扱う
                    return true;
                }
                continue;  // ジョーカーの場合、重複チェックのロジックをスキップ
            }
            // カード番号が1から13の範囲外の場合、不正なカードと判定します
            if ($card['number'] < 1 || $card['number'] > 13) {
                return true;
            }
            // カードを一意な文字列として変換します
            $cardString = $card['suit'] . $card['number'];
            if (isset($uniqueCards[$cardString])) {  // そのカードが既に存在するかどうかをチェックします
                return true;  // 重複したカードが見つかりました
            }
            $uniqueCards[$cardString] = true;  // このカードを追跡するために$uniqueCards配列に追加します
        }
        return false;
    }
    
    // カードの並び替え
    echo "手札は\n";
    foreach ($cards as $card) {
        echo $card['suit'] . $card['number'] . " ";
    }echo "\n";

    // 役判定
    function isOnePair($cards) {
        $numbers = [];
        $hasJoker = false;
        
        foreach ($cards as $card) {//ワンペア
            // ジョーカーをチェック
            if ($card['suit'] === 'joker' && $card['number'] == 0) {
                $hasJoker = true;
                continue;  // ジョーカーの場合、処理をスキップ
            }
            // カードの出現回数を数える
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
        $singleCounts = 0;
        $pairCounts = 0;

        foreach ($numbers as $count) {
            if ($count == 1) { 
                $singleCounts++;
            } elseif ($count == 2) {
                $pairCounts++;
            }
        }
        // ジョーカーが存在し、1つの数字が1回だけ出現する場合、または
        // 4つの数字がすべて異なる場合、ジョーカーを使ってワンペアにすることができる
        if ($hasJoker && ($singleCounts == 1 || $singleCounts == 4)) {
            return true;
        }
        return $pairCounts == 1;  // ペアが1つだけ存在するかを確認
    }    

    function isTwoPair($cards) {//ツーペア
        $numbers = [];
        $hasJoker = false;
    
        foreach ($cards as $card) {
            // ジョーカーをチェック
            if ($card['suit'] === 'joker' && $card['number'] == 0) {
                $hasJoker = true;
                continue;  // ジョーカーの場合、処理をスキップ
            }
            // カードの出現回数を数える
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
        
        $singleCounts = 0;
        $pairCounts = 0;
        foreach ($numbers as $count) {
            if ($count == 1) {
                $singleCounts++;
            } elseif ($count == 2) {
                $pairCounts++;
            }
        }
        // ジョーカーが存在し、既に1つのペアがあるか、または
        // 2つの数字が1回ずつ出現する場合、ジョーカーを使ってツーペアにすることができる
        if ($hasJoker && ($pairCounts == 1 || $singleCounts == 2)) {
            return true;
        }
        return $pairCounts == 2;  // ペアが2つ存在するかを確認
    }
    
    
    function isthreecards($cards) {//スリーカード
        $numbers = [];
        $hasJoker = false;

        foreach ($cards as $card) {
            // ジョーカーをチェック
            if ($card['suit'] === 'joker' && $card['number'] == 0) {
                $hasJoker = true;
                continue;  // ジョーカーの場合、処理をスキップ
            }
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
        $singleCounts = 0;
        $pairCounts = 0;
        foreach ($numbers as $count) {
            if ($count == 1) {
                $singleCounts++;
            } elseif ($count == 2) {
                $pairCounts++;
            }
        }
        // ジョーカーが存在し、既に1つのペアがあるか、または
        // 2つの数字が1回ずつ出現する場合、ジョーカーを使ってツーペアにすることができる
        if ($hasJoker && ($pairCounts == 1 || $singleCounts == 2)) {
            return true;
        }
        return $pairCounts == 1;
    }

    function isStraight($cards) {//ストレート
        // カードの番号のみの配列を作成
        $numbers = [];
        $jokerCount = 0; // ジョーカーの数をカウントする変数
    
        foreach ($cards as $card) {
            if ($card['suit'] == 'joker') {
                $jokerCount++;
            } else {
                $numbers[] = $card['number'];
            }
        }
        // カードの番号を昇順にソート
        sort($numbers);
        //・最小が１であることを確認・最後の要素が存在することを確認・最後の要素が１３であることを確認
        if ($numbers[0] == 1 && isset($numbers[4]) && $numbers[4] == 13) {
            return true;
        }
        // 連続しているかをチェック
        for ($i = 1; $i < count($numbers); $i++) {
            $diff = $numbers[$i] - $numbers[$i - 1];//現在のカードの数値と前のカードの数値の差を計算
            if ($diff == 1) {//2つのカードが連番になっているかどうかをチェック
                continue;//連番であれば、次のカードのチェックに進む
            } elseif ($diff <= 1 + $jokerCount) {
                // ジョーカーを使用して連番を完成させる
                $jokerCount -= ($diff - 1);//$diffが3の場合、2枚のジョーカーが必要
            } else {//必要なジョーカーの数を比較
                return false;
            }
        }
        return true;
    }
    
    function isFlush($cards) {//フラッシュ
        $suit = $cards[0]['suit'];
        $jokerCount = 0;
    
        foreach ($cards as $card) {
            // ジョーカーをカウント
            if ($card['suit'] == 'joker') {
                $jokerCount++;
                continue;
            }
            // 最初の非ジョーカーカードのマークを取得
            if ($suit == 'joker') {
                $suit = $card['suit'];
            }
            // マークが異なる場合、ジョーカーが存在するか確認
            if ($card['suit'] !== $suit) {
                if ($jokerCount > 0) {
                    $jokerCount--; // ジョーカーを使用
                } else {
                    return false;
                }
            }
        }
        return true;
    }
    
    function isFullHouse($cards) {//フルハウス
        $numbers = [];
        $jokerCount = 0;
    
        // 各カードの数値の出現回数を数える
        foreach ($cards as $card) {
            if ($card['suit'] == 'joker') {
                $jokerCount++;
                continue;
            }
    
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
    
        $threeOfAKind = false;
        $pair = false;
    
        foreach ($numbers as $count) {
            if ($count == 3) {  // 同じ数字が3回出現した場合
                $threeOfAKind = true;
            } elseif ($count == 2) {  // 同じ数字が2回出現した場合
                $pair = true;
            } elseif ($count == 1 && $jokerCount > 0) { // ジョーカーを使用してペアを形成
                $pair = true;
                $jokerCount--;
            }
        }
    
        // スリーカードが見つからない場合、ジョーカーで補完
        if (!$threeOfAKind && $jokerCount > 0) {
            $threeOfAKind = true;
            $jokerCount--;
        }
    
        // スリーカードとペアが存在する場合、フルハウスと判断
        return $threeOfAKind && $pair;
    }
    
    
    function isFourOfAKind($cards) {//フォーカード
        $numbers = [];
        $jokerCount = 0;
    
        // 各カードの数字の出現回数を数える
        foreach ($cards as $card) {
            if ($card['suit'] == 'joker') {
                $jokerCount++;
                continue;
            }
    
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
    
        // 4回出現する数字があるか、またはジョーカーを使用して4回出現させることができるかをチェック
        foreach ($numbers as $count) {
            if ($count == 4 || ($count == 3 && $jokerCount > 0)) {
                return true; // 4回出現する数字があればtrueを返して終了
            }
        }
        return false; // 4回出現する数字がなければfalseを返す
    }
    
    
    function isStraightFlushc($cards) {//ストレートフラッシュ
        return isStraight($cards) && isFlush($cards);
    }
    
    function isRoyalStraightFlush($cards) {//ロイヤルストレートフラッシュ
        $requiredNumbers = [1, 10, 11, 12, 13];
        $numbers = [];
        $hasJoker = false;
        // カードのスートと数字を調べる
        $suit = $cards[0]['suit'];
        foreach ($cards as $card) {
            if ($card['suit'] === 'joker') {
                $hasJoker = true;
                continue;
            }
            if ($suit !== $card['suit']) {
                return false;
            }
            $numbers[] = $card['number'];
        }
        if ($hasJoker) {
            if (count(array_diff($requiredNumbers, $numbers)) <= 1) {
                return true;
            }
        } else {
            sort($numbers);
            if ($numbers === $requiredNumbers) {
                return true;
            }
        }
        return false;
    }
    

    if (InvalidCards($cards)) {
        exit("手札は不正です。\n");
    }

    if (isRoyalStraightFlush($cards)) {
        return "ロイヤルストレートフラッシュ";
    } elseif (isStraightFlushc($cards)) {
        return "ストレートフラッシュ";
    } elseif (isFourOfAKind($cards)) {
        return "フォーカード";
    } elseif (isFullHouse($cards)) {
        return "フルハウス";
    } elseif(isFlush($cards)) {
        return "フラッシュ";
    } elseif (isStraight($cards)) {
        return "ストレート";
    } elseif (isthreecards($cards)) { // スリーカードの判定
        return "スリーカード";
    } elseif (isTwoPair($cards)) {
        return "ツーペア";
    } elseif (isOnePair($cards)) {
        return "ワンペア";
    } else {
        return "なし";
    }
}

// 関数「judge」を呼び出して結果を表示する
$str = judge($cards);
echo "役は". $str. "です。\n";

//手札は
//club1 joker0 spade1 spade2 heart15 
//手札は不正です。

//手札は
//spade11 joker0 spade1 spade2 spade13 
//役はワンペアです。

//手札は
//spade11 joker0 spade1 spade2 heart2 
//役はツーペアです。

//手札は
//club1 joker0 spade1 spade2 heart5 
//役はスリーカードです。

//手札は
//club1 joker0 spade4 spade2 heart5 
//役はストレートです。

//手札は
//club1 joker0 club4 club9 club5 
//役はフラッシュです

//手札は
//diamond1 joker0 heart1 club5 heart5 
//役はフルハウスです。

//手札は
//diamond5 joker0 heart1 club5 heart5 
//役はフォーカードです。

//手札は
//diamond5 joker0 diamond7 diamond9 diamond8 
//役はストレートフラッシュです。

//手札は
//spade11 joker0 spade1 spade12 spade13 
//役はロイヤルストレートフラッシュです。
?>
