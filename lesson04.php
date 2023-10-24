<?php
    //ワンペア・・・同じ数字2枚（ペア）が１組
    //ツーペア・・・同じ数字2枚（ペア）が２組
    //スリーカード・・・同じ数字が3枚
    //ストレート・・・同じ連番が5枚（１３と１は繋がらない）
    //フラッシュ・・・同じマークが５枚
    //フルハウス・・・同じ数字が3枚が1組＋同じ数字が２枚（ペア）が1組
    //フォーカード・・・同じ数字が4枚
    //ストレートフラッシュ・・・同じ連番が5枚＋同じマークが5枚
    //ロイヤルストレートフラッシュ・・・１、１０、１１、１２、１３、で同じマーク

// 手札
$cards = [
    ['suit'=>'culb', 'number'=>1],
    ['suit'=>'culb', 'number'=>10],
    ['suit'=>'culb', 'number'=>11],
    ['suit'=>'culb', 'number'=>12],
    ['suit'=>'culb', 'number'=>13],
];

function judge($cards) {
    // この関数内に処理を記述

    function InvalidCards($cards) {
        $uniqueCards = [];
    
        foreach ($cards as $card) {// カード番号が1から13の範囲外の場合、不正なカードと判定します
            if ($card['number'] < 1 || $card['number'] > 13) {
                return true;
            }
            // カードを一意な文字列として変換します
            $cardString = $card['suit'] . $card['number'];
            if (isset($uniqueCards[$cardString])) {// そのカードが既に存在するかどうかをチェックします
                return true;  // 重複したカードが見つかりました
            }
            $uniqueCards[$cardString] = true;// このカードを追跡するために$uniqueCards配列に追加します
        }
        return false;
    }
    // カードの並び替え
    echo "手札は\n";
    foreach ($cards as $card) {
        echo $card['suit'] . $card['number'] . " ";
    }echo "\n";

    // 役判定
    function isOnePair($cards) {//ワンペア
        $numbers = [];
        // 各カードの数値の出現回数を数える
        foreach ($cards as $card) {
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
        $pairs = 0;
        foreach ($numbers as $count) {
            if ($count == 2) {  // 同じ数字が2回出現した場合
                $pairs++;
            }
        }
        return $pairs == 1;  // ペアが1つだけ存在するかを確認
    }

    function isTwoPair($cards) {//ツーペア
        $numbers = [];
        // 各カードの数値の出現回数を数える
        foreach ($cards as $card) {
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
        
        $pairs = 0;
        foreach ($numbers as $count) {
            if ($count == 2) {  // 同じ数字が2回出現した場合
                $pairs++;
            }
        }
        return $pairs == 2;  // ペアが2つ存在するかを確認
    }
    
    function isthreecards($cards) {//スリーカード
        $numbers = [];
        foreach ($cards as $card) {
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
        $threes = 0;
        foreach ($numbers as $count) {
            if ($count == 3) {
                $threes++;
            }
        }
        return $threes == 1;
    }

    function isStraight($cards) {//ストレート
        // カードの番号のみの配列を作成
        $numbers = [];
        foreach ($cards as $card) {
            $numbers[] = $card['number'];
        }
        
        // カードの番号を昇順にソート
        sort($numbers);
    
        // 連続しているかをチェック
        for ($i = 1; $i < 5; $i++) {
            if ($numbers[0] == 1 && $numbers[1] == 10 && $numbers[2] == 11 && $numbers[3] == 12 && $numbers[4] == 13) {
                return true;
            }
    
            // 通常のストレートのチェック
            if ($numbers[$i] - $numbers[$i-1] != 1) {
                return false;
            }
        }
    
        return true;
    }
    
    function isFlush($cards) {//フラッシュ
        $suit = $cards[0]['suit'];
    
        foreach ($cards as $card) {
            if ($card['suit'] !== $suit) {
                return false;
            }
        }
    
        return true;
    }

    function isFullHouse($cards) {//フルハウス
        $numbers = [];
    
        // 各カードの数値の出現回数を数える
        foreach ($cards as $card) {
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
            }
            if ($count == 2) {  // 同じ数字が2回出現した場合
                $pair = true;
            }
        }
        // スリーカードとペアが存在する場合、フルハウスと判断
        return $threeOfAKind && $pair;
    }
    
    function isFourOfAKind($cards) {//フォーカード
        $numbers = [];
        
        // 各カードの数字の出現回数を数える
        foreach ($cards as $card) {
            if (!isset($numbers[$card['number']])) {
                $numbers[$card['number']] = 0;
            }
            $numbers[$card['number']]++;
        }
        // 4回出現する数字があるかをチェック
        foreach ($numbers as $count) {
            if ($count == 4) {
                return true; // 4回出現する数字があればtrueを返して終了
            }
        }
        return false; // 4回出現する数字がなければfalseを返す
    }
    
    function isStraightFlushc($cards) {//ストレートフラッシュ
        return isStraight($cards) && isFlush($cards);
    }
    
    function isRoyalStraightFlush($cards) {//ロイヤルストレートフラッシュ
        $requiredNumbers = [1, 10, 11, 12, 13];//必要なリスト
        $numbers = [];
    
        // 全てのカードが同じマークであることを確認
        $suit = $cards[0]['suit'];
        foreach ($cards as $card) {
            if ($card['suit'] !== $suit) {
                return false;
            }
            $numbers[] = $card['number'];
        }
    
        // カードの数字がロイヤルストレートのものであるか確認
        sort($numbers);
        foreach ($requiredNumbers as $index => $requiredNumber) {
            if ($numbers[$index] !== $requiredNumber) {
                return false;
            }
        }
        return true;
    }
    
    // 結果を返す
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

//結果：手札は
//spade1 heart1 heart10 heart11 heart12
//役はなしです。

//手札は
//diamond2 heart2 culb4 heart5 heart5 
//手札は不正です

//手札は
//diamond2 heart2 culb4 heart5 heart11 
//役はワンペアです

//手札は
//diamond2 heart2 culb4 heart4 heart11 
//役はツーペアです。

//手札は
//heart1 heart2 heart3 heart4 heart5
//役はストレートです。

//手札は
//diamond8 diamond1 diamond10 diamond4 diamond2 
//役はフラッシュです。

//手札は
//diamond8 heart8 culb8 spade1 diamond1 
//役はワンペアです。

//手札は
//diamond8 heart8 culb8 spade1 diamond1 
//役はフルハウスです。

//手札は
//diamond8 heart8 culb8 spade8 diamond1 
//役はフォーカードです。

//手札は
//culb3 culb4 culb5 culb6 culb7 
//役はストレートフラッシュです

//手札は
//culb1 culb10 culb11 culb12 culb13 
//役はロイヤルストレートフラッシュです。
?>
