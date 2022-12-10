<?php
use Source\DotEnv;
spl_autoload_register(function ($class){

    require_once '../'.str_replace('\\' , '/',$class).'.php';
    //or
    spl_autoload($class);
    //or
    set_include_path(str_replace('\\','/',__DIR__).'/'.str_replace('\\' , '/',$class).'.php');
    require_once get_include_path();
//    echo "<h1>".get_include_path()."</h1>";

//    loadClass($class, "classes3/", $classSuffix=".class.php");

//    echo '<h2>'.$class.'</h2><br>';
});
(new DotEnv(__DIR__.'/.env'))->load();
require_once __DIR__.'../app/help/helpers.php';
