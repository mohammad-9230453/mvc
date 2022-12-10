<?php
namespace Source;

class RedirectOperation{
    private static $url=null;

    public function __construct($to='')
    {
        if (isset($to) || !empty($to)){
            static::$url=$to;
        }
    }


    public static function back(){
            if(isset($_SERVER['HTTP_REFERER'])) {
                static::$url = $_SERVER['HTTP_REFERER'];
            }else{
                static::$url=null;
            }
            return new static(static::$url);
    }


    public static function to($to){
        return new static($to);
    }


    public function with($parameters = []){
        $_SESSION['parameters'] = $parameters;
//        setcookie('parameters', '114pp', time() + (86400 * 30));
        return $this;
    }


    public function __destruct()
    {
        static::done();


        // TODO: Implement __destruct() method.
    }













    private static function done(){
        if (static::$url!=null || isset(static::$url)){//برو به این صفحه
            if (headers_sent()){
//        echo("<script> location.href='$url';</script>");
//        echo("<script> window.location='$url';</script>");
//        echo("<script> document.location.href = '$url';</script>");
                //بالاییا کلا به صفحه ای با این آدرس میرن ولی پایینیا فقط آدرس آدرسبارو تغییر میدنو محتویات صفحه رو حفظ میکنن
//        echo("<script> history.pushState({},'','$url');</script>");
//        echo("<script> history.replaceState({},'','$url');</script>");
                die("<script> window.location='".static::$url."';</script>");
            }else{
                ob_start();
//             header('Status: 301 Moved Permanently', false, 301);

                header('Location:'.static::$url);
                ob_end_flush();
                die();
            }
        }else{//برگرد به صفحه قبلیت
            //        echo("<script>window.history.go(-1);</script>");   به 1 یا چند صفحه قبل میره
            echo("<script>window.history.back();</script>");

        }
    }


}