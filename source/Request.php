<?php
namespace Source;

class Request
{
    public function __construct()
    {
        echo '<h1><h1><h1>ppp</h1></h1></h1>';

        if (isset($_POST) && !empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $this->$key = $value;
            }

        }
        if (isset($_GET) && !empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $this->$key = $value;
            }

        }
         if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
             $this->last_url=$_SERVER['HTTP_REFERER'];
         }


    }


}