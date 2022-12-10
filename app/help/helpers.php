<?php
use Source\ViewOperation;
use Source\RedirectOperation;
if (! function_exists('view')) {


    function view($view = null, $val = [])
    {

        $view = new ViewOperation($view, $val);
        return $view;
    }
}
if (! function_exists('env')) {


    function env($name , $default = null)
    {

        if (!empty($default) || isset($default) || $default!=null){
            return $default;
        }
        if (isset($_ENV[$name])){
            return $_ENV[$name];
        }
        return null;
    }
}


   function redirect($to=null){
        return new RedirectOperation($to);

   }





     function printTable($head , $body , $name='head'){
        echo '<table style="font-size: 16px"><thead><tr>' ;
         echo '<th colspan="'.count($head).'" style="border: #ffbe00 solid 1px; color: forestgreen; font-size:x-large">'.$name.'</th>';
         echo '</tr><tr>';
        foreach ($head as $key){
            echo '<th style="border: seagreen solid 1px; color: seagreen">'.$key.'</th>';
        }
        echo '</tr></thead><tbody>';
        foreach ($body as $user){
            echo '<tr>';
            foreach ($user as $item){
//                if (isset($item) && $item!=null && !$item instanceof Closure ){
                    echo '<td style="border: darkmagenta solid 1px; color: darkmagenta">';print_r($item);echo '</td>';
//                }else{
//                    if (is_callable($item)){
//                        if (is_array($item)){
//                            echo '<td style="border: firebrick solid 1px; color: firebrick">Array()</td>';
//                        }else{
//                    echo '<td style="border: firebrick solid 1px; color: firebrick">Function()</td>';
//                        }
//                    }else{
//                        echo '<td style="border: red solid 1px; color: red">null</td>';
//                    }
//               }
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }



function str_between(string $string, string $start, string $end, bool $includeDelimiters = false, int &$offset = 0): ?string
{
    //$includeDelimiters: برگرداندن قطعه برش خورده به همراه ابتدا و انتهاییا
    if ($string === '' || $start === '' || $end === '') return null;

    $startLength = strlen($start);
    $endLength = strlen($end);

    $startPos = strpos($string, $start, $offset);//offset: از این کاراکتر به بعد سرچ کن
    if ($startPos === false) return null;

    $endPos = strpos($string, $end, $startPos + $startLength);
    if ($endPos === false) return null;

    $length = $endPos - $startPos + ($includeDelimiters ? $endLength : -$startLength);
    if (!$length) return '';

    $offset = $startPos + ($includeDelimiters ? 0 : $startLength);

    $result = substr($string, $offset, $length);

    return ($result !== false ? $result : null);
}



function str_between_all(string $string, string $start, string $end, bool $includeDelimiters = false, int &$offset = 0): ?array
{
    $strings = [];
//    $length = strlen($string);
//    while ($offset < $length)
//    {
//        $found = str_between($string, $start, $end, $includeDelimiters, $offset);
//        if ($found === null) break;
//        $strings[] = $found;
//        $offset += strlen($includeDelimiters ? $found : $start . $found . $end); // move offset to the end of the newfound string
//    }
    $string = substr($string , $offset);

    foreach (explode($start, $string) as $key => $value) {
        if(strpos($value, $end) !== FALSE){
            $strings[] = $includeDelimiters ? $start.substr($value, 0, strpos($value, $end)).$end : substr($value, 0, strpos($value, $end));
        }
    }

    return $strings;
}

function foreachloop(...$arays ){
//    print_r($arays);echo "_-_-_-<br>";
    if (count($arays)>1 &&  is_array($arays[0])){
        $arr=$arays;
        unset($arr[0]);
        foreach ($arays[0] as $item){
            echo "$item . ".foreachloop(...$arr);
        }








    }else{
      foreach ($arays[0] as $item){
          return "$item/";
      }
    }

}







