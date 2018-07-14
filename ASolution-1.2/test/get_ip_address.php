<?php

exec("ifconfig -a", $config);
$temp_array = array();
foreach ( $config as $value ){
    if(preg_match("/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i",$value, $temp_array )){
        $mac_addr = $temp_array[0]; 
        break;
    }
} 
unset($temp_array);
echo $mac_addr;

?>