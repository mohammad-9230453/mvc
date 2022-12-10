<?php
namespace Source;

class Model{
    protected $table_name;
    protected $class_name;
    protected static $keys=['id'];
    protected static $id=0;

    public function __construct()
    {
        $this->runModel();

    }


    public function addtKey($keys=[]){
        if (!is_array($keys)){
            $keys=[$keys];
        }
        if (!in_array('id' , static::$keys) && isset(static::$keys)) {
            array_push(static::$keys, 'id');
        }
        foreach ($keys as $key){
            if (!in_array($key , static::$keys) && isset(static::$keys)){
                array_push(static::$keys , $key);
                foreach ($this->{$this->table_name} as $model){
                    $model[$key] = null;
                }
            }
        }
        return $this;
    }

    public function create($array=[]){
        static::$id++;
        if (func_get_args()){
            $array['id']=static::$id;
            foreach (static::$keys as $key){
                if (array_key_exists($key , $array)){
                    $this->{$this->table_name}[static::$id][$key]  = $array[$key];
                }else{
                    $this->{$this->table_name}[static::$id][$key]  = null;
                }
            }
        }else{
            $this->{$this->table_name}[static::$id]['id'] = static::$id;
            foreach (static::$keys as $key){
               if ( isset($this->$key) || !empty($this->$key)){
                    $this->{$this->table_name}[static::$id][$key]  = $this->$key;
                }else{
                    $this->{$this->table_name}[static::$id][$key]  = null;
                }
            }
        }
        return $this;
    }

    public function get($id=null){
        if (isset($id)){
            if (array_key_exists($id , $this->{$this->table_name})){
                return $this->{$this->table_name}[$id];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function get_all(){
                return $this->{$this->table_name};
    }

    public function get_keys(){
                return static::$keys;
    }



    private function runModel(){
        $this->SetTableName();
        $this->SetModelTable();
        $this->SetClassName();
    }


    private function SetTableName(){
        if (!isset($this->table_name)){

            $class=get_class($this);
            $array=explode('\\' , $class);
            $this->table_name = strtolower(end($array)).'s';
        }
    }

    private function SetClassName(){
        if (!isset($this->class_name)){

            $this->class_name =get_class($this);
        }
    }

    private function SetModelTable(){
        if (!isset($this->{$this->table_name})) {

            $this->{$this->table_name} = [];
        }
    }



    public function __get($name)
    {
        return ['name'=>'myName' , 'id'=>1];
        // TODO: Implement __get() method.
    }
    public function __isset($name)
    {
        return true;
        // TODO: Implement __isset() method.
    }


}