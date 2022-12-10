<?php
namespace App;
use App\Controller\controller;
use http\Header\Parser;
use function MongoDB\BSON\toJSON;
use App\Mytest\exists;
use App\Mytest\arraytest;
use App\Mytest\functions;
use App\Models\User;


class app
{
    use exists , functions;


    public $name;
public function __construct()
{


    echo '<a href="/ali">ali</a>';

//    $this->methodExist();
//    echo 'تابع فاکتوریل با استفاده از توابع تو در تو::'.$this->factorielfunction(5);
//    $this->function_param();
//--------------------------------------------------------
//    $this->foo(new controller('mom'));
//--------------------------------------------------------
    $user = new User();

require_once __DIR__.'/../app/mytest/route.php';
    $array = new arraytest();
    $array->action();

//    echo '<br>$_REQUEST:: ';
//    print_r($_REQUEST);
//
//
//
//    echo '<br>$_SESSION:: ';
//    print_r($_SESSION);
//
//
//    echo '<br>$_COOKIE:: ';
//    print_r($_COOKIE);
//
//    echo '<br>$_GET:: ';
//    print_r($_GET);
//
//    echo '<br>$_SERVER:: <br>';
//
//    foreach ($_SERVER as $key=>$value){
//        echo '<span style="color:red">'.$key.'</span>'.' = <span style="color:rebeccapurple">'.$value.'</span><br>';
//    }

//
//    if (isset($_SERVER['HTTP_REFERER']) || !empty($_SERVER['HTTP_REFERER'])) {
//        echo '<br>parse_url:: <br>';
//
//        foreach (parse_url($_SERVER['HTTP_REFERER']) as $key => $value) {
//            echo '<span style="color:red">' . $key . '</span>' . ' = <span style="color:rebeccapurple">' . $value . '</span><br>';
//        }
//
//    }
//
//
//
//    echo '<br>$_ENV:: ';
//    print_r($_ENV);
//
//    echo '<br>$_POST:: ';
//    print_r($_POST);
//
//

    printTable(['action' , 'name' , 'urlNum','urlParts', 'url', 'urlVarsNum', 'urlVars','method'],$array->getArray(),'routs');


}

//--------------------------------------------------------
public function foo(Controller $controller){
    echo $controller->show_something();
}
//--------------------------------------------------------




}