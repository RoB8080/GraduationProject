<?php
function string_to_bool_array ($str) {
    $res=[];
    $t=strlen($str);
    for($i=0;$i<$t;$i++)
        $res[$i]=substr($str,$i,1)==="1"?true:false;
    return $res;
}

function first_test_add($fStr,$nfStr,&$flag) {
    $str = ($flag?$fStr:$nfStr);
    $flag = false;
    return $str;
}