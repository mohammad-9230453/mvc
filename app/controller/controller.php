<?php
namespace App\Controller;

use App\Mytest\functions;

class controller
{
    use functions;


    public $property1;
    public function __construct($some=null)
    {
        $this->some=$some;
        echo 'controller<br>';
    }



    //---------------------------------used in app.php-------------------------------------
    public $some;
    public function show_something(){
        echo 'i am class::'.get_class($this).' and $some='.$this->some;
    }
    //----------------------------------------------------------------------
    public static function call_tester($x , $y){
        echo $x.$y;
    }

    public function home(){
        return view('email.welcome');
    }


}