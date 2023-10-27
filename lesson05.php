<?php
$cards = [
    ['suit'=>'culb', 'number'=>1],
    ['suit'=>'culb', 'number'=>10],
    ['suit'=>'culb', 'number'=>11],
    ['suit'=>'culb', 'number'=>12],
    ['suit'=>'culb', 'number'=>13],
];
// 手札
function hand(){
    // この関数内に処理を記述
    if(isset($_POST['submit'])) {
        // カードの情報を取得
        $cards = [];
        for($i = 1; $i <= 5; $i++) {
            $suit = $_POST['suit' . $i];
            $number = $_POST['number' . $i];
            $cards[] = ['suit' => $suit, 'number' => $number];
        }

        // カードの判定処理
        foreach ($cards as $card) {
            echo $card['suit'] . $card['number'] . " ";
        }
    }
    
}

// 判定
function judge() {
    // この関数内に処理を記述
    if(isset($_POST['submit'])) {
        // カード情報を取得
        $cards = [];
        for($i = 1; $i <= 5; $i++) {
            $suit = $_POST['suit' . $i];
            $number = $_POST['number' . $i];
            $cards[] = ['suit' => $suit, 'number' => (int)$number];
        }

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
            // 以下、他の役の判定...
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
        }
        if (InvalidCards($cards)) {
            exit("不正です。");
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
            return "不正です";
        }
    
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" style="text/css" href="./css/style.css">
<title>ポーカー役判定</title>
</head>
<body>
    <form action="#" method="POST" name="formtype">
        <section>    
            <div class="flex">
                <?php for($i = 1; $i <= 5; $i++){ ?>
                <div class="card">
                    <p><?php echo $i . ":" ?> 
                    <select name="<?php echo "suit".$i ?>" class="suit">
                        <option value=""></option>
                        <option value="spade">spade</option>
                        <option value="diamond">diamond</option>
                        <option value="heart">heart</option>
                        <option value="club">club</option>
                    </select>
                    <select name="<?php echo "number".$i ?>">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                    </select>
                </div>
                <?php } ?>
                <button type="submit" class="button1" name="submit">判定</button>
            </div>
            <div>
                <!-- 「hand」関数を使用してセレクトボックスで入力した手札を戻り値で取得し、ブラウザー上で表示する。 -->
                <!-- 引数の仕様有無は各自の判断に任せるとする。-->
                <p>手札は<?php
                    echo hand();
                  ?></p>
            </div>
            <div>
                <!-- 「judge」関数を使用してセレクトボックスで入力した手札から役を戻り値で取得し、ブラウザー上で表示する。 -->
                <!-- 引数の仕様有無は各自の判断に任せるとする。-->
                <p>役は<?php
                    echo judge()
                    
                    //手札はspade1 spade1 spade1 spade1 spade1
                    //役は不正です。
                    
                    //手札はspade2 heart2 heart9 club12 club8
                    //役はワンペア
                
                    //手札はspade6 diamond6 heart6 heart1 spade1
                    //役はフルハウス

                    //手札はheart10 club13 club10 club13 spade1
                    //役はなし

                    //手札はheart1 diamond1 diamond2 spade2 club10
                    //役はツーペア

                    //手札はspade1 diamond1 heart1 heart9 club6
                    //役はスリーカード

                    //手札はspade1 diamond2 club3 diamond4 spade5
                    //役はストレート

                    //手札はspade1 spade2 spade10 spade9 spade3
                    //役はフラッシュ

                    //手札はdiamond8 heart8 culb8 spade8 diamond1 
                    //役はフォーカード

                    //手札はclub4 club5 club6 club7 club8
                    //役はストレートフラッシュ

                    //手札はdiamond1 diamond10 diamond11 diamond12 diamond13
                    //役はロイヤルストレートフラッシュ
                 ?></p>
            </div>
         </section>
    </form>
</body>
</html>