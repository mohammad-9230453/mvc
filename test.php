<?php
$str = "i am string";
$str = str_replace("am", "are", $str);echo "$str\n";
$len = strlen($str);echo "$len\n";
$pos = strpos("are" , "ooooo are ooo");echo "$pos\n";



unset($str);
echo isset($str)? "the str = $str"."\n" : "no isset str"."\n";
echo !empty($str)? "the str = $str"."\n" : "empty str"."\n";
