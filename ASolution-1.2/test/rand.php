<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$min='A';
$max='Z';
//echo 'CR'.rand();
function make_seed(){
    list($usec,$sec)=  explode(' ', microtime());
    return(float)$sec+((float)$usec*100000);
}
echo make_seed().'<br/>.................<br/>';
//echo $randval=rand();

$array = array();
$numbers = array('test'=>'0.567', 0.002, 0.003, 0.004, 0.005, 0.006, 0.007, 0.008, 0.009);
foreach ($numbers as $number)
    $array[]= $number."->".number_format($number, 2, '.', ',')."<br>";

print_r($array);

echo '<br/>-----------------<br/>';
$pay = '3,000.00';
$payable_amount = floatval(preg_replace('/[^\d.]/', '',$pay));
echo gettype($payable_amount);
echo '<br/>-----------------<br/>';

echo htmlspecialchars('1,000.00').'<br/>';
echo htmlspecialchars("test';  & test sqlinjection ").'<br/>';
echo $usafe_data = "value'; drop table user; ".'<br/>';
echo mysql_real_escape_string($usafe_data).'<br/>';

$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
echo $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;
$a=1;
if($a=1){
    echo "your answer is".$a;
}
else{
    echo '0';
}


?>
