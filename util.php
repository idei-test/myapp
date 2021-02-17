<?php
// このファイルから提供される関数はセキュリティに必要

// クロスサイトスクリプティング対策＝渡された引数をエスケープ
function myEscap($data,  String $charset ="utf-8"){
    // 配列なら各要素に対して、この関数を再帰して実行
    if(is_array($data)){
        return array_map(__METHOD__,$data);
    // 要素自体ならエスケープさせる 
    }else{
        return htmlspecialchars($data,ENT_QUOTES,$charset);
    }
}
//---------------------------------------------------------------------------
// 文字コードをチェック　boolで判定返す
function myCken(array $data){
    $result = true;
    // 各配列の要素内が配列なら連結する
    foreach($data as $key => $value){
        if(is_array($value)){
            $value = implode("",$value);
        }
        // 要素ごとにコードチェックする 
        if(!mb_check_encoding($value)){
            // 要素の一つでも文字コードが異なるならアウト
            $result = false;
        break;
        }
    }
    return $result;
}

?>