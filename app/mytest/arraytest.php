<?php
namespace App\Mytest;

use App\Controller\controller;
use Source\Model;
use Source\Request;

class arraytest{
    public static $array_routes=[];
    public static $last=[];
    public static $lastnames=[];
    public static $lastname=false;
    public static $lastPrefix=false;
    public static $url='';
    public static $route_queue=[];
    public static $id=0;
    public function __construct($val=['add'=>false , 'url'=>''])
    {

        if ($val['add']) {
            self::$url = $val['url'];
        }


//        }else {
//            if (isset($val['url'])) {
//
//               array_push( self::$last , $val['url']);
//            } else {
//                self::$last=self::$last;
//            }
//        }
    }

    public static function __callStatic($name, $arguments)
    {
        if (!method_exists( new static , $name)){
            switch (strtolower($name)){
                case 'get':
                    return static::add($arguments[0] , $arguments[1] , 'get');
                    break;
                case 'post':
                    return static::add($arguments[0] , $arguments[1] , 'post');
                    break;
                case 'delete':
                    return static::add($arguments[0] , $arguments[1] , 'delete');
                    break;
                case 'update':
                    return static::add($arguments[0] , $arguments[1] , 'update');
                    break;
                case 'any':
                    return static::add($arguments[0] , $arguments[1] , 'any');
                    break;

            }
        }
        // TODO: Implement __call() method.
    }

    public static function add($url,$action , $method='any'){
        $exploadUrl=explode('/',trim(implode(self::$last).$url,'/'));
        $countUrl = count($exploadUrl);


        $exploadVarOfRouteUrl =str_between_all($url , '{' , '}' );




        static::$array_routes[implode(self::$last).$url]=[
            'action'=>$action ,
            'name'=>null ,
            'urlNum'=>$countUrl,
            'urlParts'=>$exploadUrl,
            'url'=>implode(self::$last).$url ,
            'urlVarsNum'=>count($exploadVarOfRouteUrl),
            'urlVars'=>$exploadVarOfRouteUrl,
            'method'=>$method
        ];

        return new static(['add'=>true , 'url'=>implode(self::$last).$url]);

    }

    public static function name($name){
        static::$array_routes[static::$url]['name']=implode(self::$lastnames).$name;
        return new static(['add'=>true , 'url'=>static::$url]);
    }



    public static function names($name){
        static::$lastname = true;
        array_push(static::$lastnames,$name);
        return new static;
    }

    public static function prefix($val){
        static::$lastPrefix=true;
        array_push(static::$last,$val);
        return new static(['add'=>false, 'url'=>$val]);
    }


    public static function group($func){
        array_push(static::$route_queue,['prefix'=>static::$lastPrefix , 'name'=>self::$lastname]);
        static::$lastPrefix=false;
        self::$lastname=false;
        $func();
        $last_queue = end(static::$route_queue);
        if ($last_queue['prefix']){
        array_pop(self::$last);
        }
        if ($last_queue['name']){
        array_pop(self::$lastnames);
        }
            array_pop(self::$route_queue);

    }

    /**
     * @return array
     */
    public function getArray()
    {
        return static::$array_routes;
    }

    public function foundRoute($routes , $url){

            return $this->filterRoutesByMethod($routes , $url);

    }
    public function filterRoutesByMethod($routes , $url){
        $result=[];
        $urlMethod  = strtolower($_SERVER['REQUEST_METHOD']);
        foreach ($routes as $key=>$route){
            if ($route['method']==$urlMethod || $route['method']=='any'){
                $result[$key]=$route;
            }
        }

        return count($result)>0? $this->filterRoutesByUrlNum($result , $url) : NULL ;
    }


    public function filterRoutesByUrlNum($routes , $url) {
        $result=[];
        $urlNum = count(explode('/',trim($url,'/')));
        foreach ($routes as $key=>$route){
            if ($route['urlNum']==$urlNum){
                $result[$key]=$route;
//                echo '<br>'.$route['url'];
            }
        }
//        echo '<br>__________________________________';

        return count($result)>0? $this->filterRoutesByUrlVars($result , $url) : NULL ;
    }

    public function filterRoutesByUrlVars($routes , $url) {
        $result=[];
        $urlParts = explode('/',trim($url,'/'));
//        echo '<br><br>';print_r($url);
        foreach ($routes as $key=>$route){
            $diffRoutes =array_diff_assoc($route['urlParts'] , $urlParts);
            $diffUrls =array_diff_assoc($urlParts , $route['urlParts']);

            if (count($diffRoutes)==$route['urlVarsNum']  && count(array_diff_key($diffRoutes , $diffUrls))==0 && $this->is_vars($diffRoutes)){
                $result[$key]['routes'] = $route; $result[$key]['diffNum'] = count($diffRoutes);
//                echo $this->is_vars($diffRoutes)? '<br><span style="color: darkmagenta;">'.$route['url'].'</span>':'<br><span style="color: #ff002a;">'.$route['url'].'</span>';
            }elseif (count($diffRoutes)==0){
                $result[$key]['routes'] = $route; $result[$key]['diffNum'] = count($diffRoutes);
//                echo $this->is_vars($diffRoutes)? '<br><span style="color: darkmagenta;">'.$route['url'].'</span>':'<br><span style="color: #ff002a;">'.$route['url'].'</span>';

            }
//            echo '<br>';print_r($diffRoutes);
//            echo '===>>>';print_r($diffUrls);
        }
//        echo '<br>__________________________________';
        return count($result)>0? $this->filterRoutesByMinimumDiffs($result) : FALSE ;
    }


    public function filterRoutesByMinimumDiffs($result){
        $results=[];
        $min = 1000000;
        foreach ($result as $key=>$item){
            if($item['diffNum']<$min){
                $min = $item['diffNum'];
            }
        }
        foreach ($result as $key=>$item){
            if($item['diffNum']==$min){
                $results[] = $item['routes'];
//                echo '<br><span style="color: #00802d;">'.$item['routes']['url'].'</span>';
            }
        }
        return $results;

    }

    public function is_vars($arr) {
        if ($arr){
        foreach ($arr as $key=>$item) {
            if (strpos($item, '{') !== FALSE && strpos($item, '}') !== FALSE) {
                $flag = TRUE;
            } else {
                $flag = FALSE;
            }
        }
        }else{
            return FALSE;
        }
            return $flag;
    }



















    public function action(){
        $url = !empty($_GET['url'])||isset($_GET['url'])? '/'.$_GET['url'] :'/' ;
        $routes=self::$array_routes;
        if ($this->foundRoute($routes , $url)){
            $routes = $this->foundRoute($routes , $url);
            $action = end($routes);
            echo '<h1 style="color: #ff002a"><h1>'.$action['url'].'</h1></h1>';

        }else{
            echo '<h1 style="color: #ff002a"><h1>این آدرس را پیدا نکردیم. لطفا آنرا در میان روتهایتان تعریف کنید</h1></h1>';
            return false;
        }


        if (isset($action) || !empty($action) || $action!=null) {
            $this->runRouteFunction($action, $url);
        }else{
            echo '<h1 style="color: #ff002a"><h1>قسمت مربوط به عملیات این آدرس خالی است</h1></h1>';
        }
    }
















    public function runRouteFunction($route , $url){
        $vars =$this->getVariablesFromUrlToRoute($route['url'] , $url);
        if ($route['action'] instanceof \Closure || is_callable($route['action'])){
            $this->runFunction($route , $vars);
        }elseif (is_string($route['action'])){

            $this->runClassAndFunction($route , $vars );
        }else{
            echo '<h1 style="color: #ff002a"><h1>اشتباه تایپی در قسمت وارد کردن کنترولر و تابعها</h1></h1>';
        }



    }
    public function runFunction($route , $vars ){
        $ref = new \ReflectionFunction($route['action']);
        $params = $this->getFunctionParamsVal($route , $vars , $ref);
        if ($params!==false){
            $route['action'](...$params);
        }else{
            echo '<h1 style="color: #ff002a"><h1>33ورودیهای تابع با این آدرس یکی نیست</h1></h1>';
        }
    }

    public function runClassAndFunction($route , $vars){
    $result =$this->exploadClassAndFunction($route['action']);
    $controller=$result['controller'];
    $function = $result['function'];
        $ref =$result!==false? new \ReflectionMethod($result['controller'],$result['function']):false;

        $params =$ref!==false? $this->getFunctionParamsVal($route , $vars , $ref):false;
        if ($result!==false && $params!==false){
            $controller = new $controller();

            $controller->$function(...$params);
        }else{
            echo '<h1 style="color: #ff002a"><h1> df ورودیهای تابع با این آدرس یکی نیست</h1></h1>';
        }

    }

    public function exploadClassAndFunction($string){
        $arr=explode('@' , $string);
        $controller ='App\Controller\\'.str_replace('/','\\',$arr[0]);
        $function = $arr[1];
        if (class_exists($controller) && method_exists($controller,$function)) {
            return ['controller'=>$controller , 'function'=>$function];
        }else{
            return false;
        }
    }

    public function getFunctionParamsVal($route , $vars , $ref){
        $params = [];
        $i = 0;
        $j = $ref->getNumberOfParameters();
        if ($j==0){return [];}

        foreach ($ref->getParameters() as $key=>$parameter){//اسم وورودیهای یک تابع را میکیرد
//            echo '<br>'.$parameter->getPosition().':$'.$parameter->getName().' _or_ $'.$parameter->name.'=>getType='.$parameter->getType();//نا و مقدار پیشفرض و موقعیت این وورودی از تابع
            if (in_array(strval($parameter->getName()) , $route['urlVars'])){
                $i++;
                $params[$key] = $vars[strval($parameter->getName())];
//                            echo trim($value[strval($parameter->getName())],'{}');
            }
            if (class_exists($parameter->getType())){

                $p1=strval($parameter->getType());
//----------------------------------------------------------------------------------------------------------------------
                $parentClass = get_parent_class($p1);
                echo $p1.'-----'.$parentClass.'--------'.$parameter->getName().'---------'.$key.'-------------/<br>';

                    $rc = new \ReflectionClass($p1);

                if ($parentClass === Model::class){
                    $r=explode('\\',$p1);
                    $r = $r[count($r)-1];

                    echo '\\\\\\\\'.$rc->getShortName().'_MODEL::<br>in namespace:'.$rc->getNamespaceName().'<br>in file:'.$rc->getFileName().'<br> has parent:'.$rc->getParentClass()->getName().
                        '</br>end line:'.$rc->getEndLine().'////<br>';
                }
                if ($p1 === Request::class){

                    echo '\\\\\\\\'.$rc->getShortName().'_MODEL::<br>in namespace:'.$rc->getNamespaceName().'<br>in file:'.$rc->getFileName().'<br> has parent:'.$rc->getParentClass().
                        '</br>end line:'.$rc->getEndLine().'////<br>';
                }
//----------------------------------------------------------------------------------------------------------------------

                $params[$key] = new $p1();

                if (!in_array(strval($parameter->getName()) , $route['urlVars'])){
                    $j--;
                }

            }

        }

        return $i==count($route['urlVars']) && $j==$i?$params:false;
    }




    public function getVariablesFromUrlToRoute($route , $url)
    {
        $urlParts = array_map(function ($val){
            return trim($val , '{}');
        } , explode('/' , trim($route , '/')) );

        $diffRoutes =array_diff_assoc($urlParts , explode('/' , trim($url , '/')));
        $diffUrls =array_diff_assoc(explode('/' , trim($url , '/')) , $urlParts);
        $value = array_combine($diffRoutes, $diffUrls);
        return isset($value) ? $value : null ;

    }


}