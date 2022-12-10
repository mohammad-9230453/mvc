<?php
namespace App\Mytest;

trait exists{


    // TODO:    __call($name, $arguments)
public function __call($name, $arguments)
{
    //این تابع فقط زمانی اجرا میگردد که شما توابع را به صورت استاتیک صدا نزده باشید
    //در جایی خارج از این کلاس:
    //$t=exists::class;
    //$t->myfun($v1,$v2)
    // =>   $name = 'myfun'   ,    $arguments=[$v1,$v2]

    // TODO: Implement __call() method.
}
public static function __callStatic($name, $arguments)
{
    //این تابع فقط زمانی اجرا میگردد که شما توابع را به صورت استاتیک صدا زده باشید
    //در جایی خارج از این کلاس:
    //exists::myfun($v1,$v2)
    // =>   $name = 'myfun'   ,    $arguments=[$v1,$v2]
    //return => وقتی میخاهید مقداری را برگردانید

    // TODO: Implement __call() method.
}

    public function methodExist(){


//    $class = new \ReflectionClass('controller');
//    echo $class;
//    spl_autoload_call('controller');


        //اجرای یک تابع از یک کلاس با این ورودی ها
        call_user_func_array(['App\Controller\controller' , 'call_tester'],['ali ' , 'mohammad']);

        //برسی وجود یک تابع درون یک کلاس
        $exist = method_exists('App\Controller\controller' , 'call_tester') ? '<span style="color: blue">true</span><br>' : '<span style="color: red">false</span><br>';
        echo 'method_exists::'.$exist;

        //برسی وجود یک متغیر درون یک کلاس
        $exist = property_exists('App\Controller\controller' , 'property1') ? '<span style="color: blue">true</span><br>' : '<span style="color: red">false</span><br>';
        echo 'property_exists::'.$exist;

        $exist = 'name';
        echo 'exist::'.$t=isset($this->{$exist})? '<span style="color: blue">true</span><br>' : '<span style="color: red">false</span><br>'; // FALSE
        echo 'exist::'.$t=property_exists($this, $exist)? '<span style="color: blue">true</span><br>' : '<span style="color: red">false</span><br>'; // FALSE
        echo 'exist::'.$t=array_key_exists($exist, get_object_vars($this))? '<span style="color: blue">true</span><br>' : '<span style="color: red">false</span><br>'; // FALSE


//    unset($this->$property);
//
//    isset($this->$property); // FALSE
//    property_exists($this, $property); // TRUE
//    array_key_exists($property, get_object_vars($this)); // FALSE
//
//    $this->$property = 'baz';
//
//    isset($this->$property); // TRUE
//    property_exists($this, $property); // TRUE
//    array_key_exists($property, get_object_vars($this));  // TRUE


        //چک کردن تابع بودن یا نبودن یک کتغیر
        $exist=function (...$params){
            echo '<h1>function output::';print_r($params);echo'</h1>';//راهی برای گرفتن وورودی یک تابعی با تعداد وورودی نامشخص
            foreach (func_get_args() as $par){echo '<h2>'.$par.'</h2>';}//راه دوم
        };
        $exist('ali',2);//روشی برای اجرای یک تابعی که ورودی بوده
        echo 'isFunction::'.$t=is_callable($exist)? '<span style="color: blue">true</span><br>' : '<span style="color: red">false</span><br>'; // FALSE
        //fvsd

    }






}