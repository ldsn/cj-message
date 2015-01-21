<?
function judgeEqual($key1,$key2){
    if(array_diff($key1,$key2) || array_diff($key2,$key1)){
        return true;
    }else{
        return false;
    }

}

echo judgeEqual('asdf','asdf');
echo judgeEqual('','');
