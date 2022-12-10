<?php
namespace App\Mytest;

use Source\Request;

trait functions{

    //   تابع تو در توی فاکتوریل____________________________________________
    public function factorielfunction($number){
        if($number !== 1 && $number >= 2){
          return  $this->factorielfunction($number-1)*$number;

        }else{
            return 1;
        }
    }

    public function function_param(string $p1=null ,integer $p2=null , $p3='ali'){
       $refm = new \ReflectionMethod($this , 'function_param');
       echo '<br>'.$refm->getNumberOfParameters();//تعداد ورودی های تعریف شده برای یک تابع را میدهد
       foreach ($refm->getParameters() as $p){//اسم وورودیهای یک تابع را میکیرد
          echo '<br>'.$p->getPosition().':$'.$p->getName().' _or_ $'.$p->name.'=>defaultValue='.$p->getDefaultValue();//نا و مقدار پیشفرض و موقعیت این وورودی از تابع
       echo $refm = new \ReflectionParameter([$this,'function_param'],'p1');
       }
    }

    public function var_type($var){


        $arr =[] ;
        switch (true){
            case is_iterable($var):
                array_push($arr , 'is_iterable');
                break;
            case is_countable($var):
                array_push($arr , 'is_countable');
                break;
            case is_callable($var):
                array_push($arr , 'is_callable');
                break;
            case is_object($var):
                array_push($arr , 'is_object');
                break;
            case isset($var):
                array_push($arr , 'isset');
                break;
            case is_array($var):
                array_push($arr , 'is_array');
                break;
            case is_string($var):
                array_push($arr , 'is_string');
                break;
            case is_bool($var):
                array_push($arr , 'is_bool');
                break;
            case is_dir($var):
                array_push($arr , 'is_dir');
                break;
            case is_double($var):
                array_push($arr , 'is_double');
                break;
            case is_executable($var):
                array_push($arr , 'is_executable');
                break;
            case is_file($var):
                array_push($arr , 'is_file');
                break;
            case is_finite($var):
                array_push($arr , 'is_finite');
                break;
            case is_float($var):
                array_push($arr , 'is_float');
                break;
            case is_infinite($var):
                array_push($arr , 'is_infinite');
                break;
            case is_int($var):
                array_push($arr , 'is_int');
                break;
            case is_integer($var):
                array_push($arr , 'is_integer');
                break;
            case is_link($var):
                array_push($arr , 'is_link');
                break;
            case is_long($var):
                array_push($arr , 'is_long');
                break;
            case is_nan($var):
                array_push($arr , 'is_nan');
                break;
            case is_null($var):
                array_push($arr , 'is_null');
                break;
            case is_numeric($var):
                array_push($arr , 'is_numeric');
                break;
            case is_readable($var):
                array_push($arr , 'is_readable');
                break;
            case is_real($var):
                array_push($arr , 'is_real');
                break;
            case is_resource($var):
                array_push($arr , 'is_resource');
                break;
            case is_scalar($var):
                array_push($arr , 'is_scalar');
                break;
            case is_soap_fault($var):
                array_push($arr , 'is_soap_fault');
                break;
            case is_subclass_of($var,'j'):
                array_push($arr , 'is_subclass_of');
                break;
            case is_uploaded_file($var):
                array_push($arr , 'is_uploaded_file');
                break;
            case is_writable($var):
                array_push($arr , 'is_writable');
                break;
            case is_writeable($var):
                array_push($arr , 'is_writeable');
                break;



        }
        return $arr;

    }





}