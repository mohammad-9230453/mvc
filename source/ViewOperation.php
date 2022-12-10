<?php
namespace Source;

class ViewOperation{
    private  $view='/';
    private  $parameters=[];

   public function __construct($view , $parameters=[]){
       $this->view=$view;
       $this->parameters=$parameters;
       return $this;
}



public function with($parameters=[]){

    $this->parameters=array_merge($this->parameters,$parameters);
       return $this;
}





public function __destruct()
{
    // TODO: Implement __destruct() method.
    $session_parameters = !empty($_SESSION['parameters']) || isset($_SESSION['parameters'])? $_SESSION['parameters'] : [] ;
    $this->parameters = array_merge($this->parameters , $session_parameters);

    if (!empty($this->parameters) || $this->parameters!=[] || isset($this->parameters)){
        extract($this->parameters);
    }

    if (empty($this->view) || $this->view==null){
        $this->view = '../app/view/'.trim(str_replace('.' , '/' ,$this->view) , ' ').'.php';
        echo '<h1 style="color: red;">can not find this view:'.$this->view.'</h1>';
    }
    $this->view = '../app/view/'.trim(str_replace('.' , '/' ,$this->view) , ' ').'.php';

    if (file_exists($this->view)){
        require_once $this->view;

    }else{
        echo '<h1 style="color: red;">can not find this view:'.substr($this->view , 7).'</h1>';
    }

}

}