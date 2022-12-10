<?php
namespace Source\Artisan;



use App\Mytest\arraytest;

class CmdOperation{
    protected $cmd;

    protected $parts=[
        'make:model' => [
            'Description'=>'Create a new Eloquent model class' ,
            'Usage'=>"make:model [options] [--] \<name\>" ,
            'Arguments' =>[
                'name'=> 'The name of the class'
            ] ,
            'Options' =>[
                '-h  ,  --help' => 'Display this help message',
                '-a  ,  --all' => 'Generate a migration, seeder, factory, and resource controller for the model',
            ]
        ],
        'make:controller' => [
            'Description'=>'Create a new Eloquent Controller class' ,
            'Usage'=>"make:controller [options] [--] \<name\>" ,
            'Arguments' =>[
                'name'=> 'The name of the class'
            ] ,
            'Options' =>[
                '-h  ,  --help' => 'Display this help message',
            ]
        ],
        'route:list' => [
            'Description'=>'show all routes list' ,
            'Usage'=>"route:list [options] [--]" ,
            'Options' =>[
                '-h  ,  --help' => 'Display this help message',
            ]
        ],
    ];

    public function __construct()
    {
        $argv=$_SERVER["argv"];
        if ($argv[0] == 'artisan'){
            array_shift($argv);
//            echo "\e[32mi am CmdOperation class\e[0m\n";

        }
        $this->cmd = $argv;
        if (isset($argv[0])){
            $this->runCmd();
        }else{
//            echo "\e[31mi am not set\e[0m\n";
            $this->printHelps();

        }


    }


    public function make($option , $part){
        switch ($option){
            case 'make':
                $this->runmake($part);
                break;
            case 'route':
                $this->runRoute($part);
                break;


        }

    }







    public function runmake($part){
        switch ($part){
            case 'controller':
                $this->create('controller' , 'app/controller/');
                break;
            case 'model':
                $this->create('model' , 'app/models/');
                break;
        }

    }


    public function runRoute($part){
        switch ($part){
            case 'list':
                $this->printRoutes();
                break;
        }

    }

    public function printRoutes(){
        $routes = new arraytest();
        echo "\e[31murl\e[32m name \e[36mmethod \e[34maction             \n";
        foreach ($routes->getArray() as $route){
            $action = ($route['action'] instanceof \Closure)?'function':$route['action'];
            echo "\e[32;2m[_".$route['url']."_]\e[30m(".$route['name'].")\e[36m{".$route['method']."}\e[34m<".$action.">             \n";
            echo "\e[0m";
        }
    }







    public function create($part , $newPath){



        $name=$this->cmd[1];
        $path=$newPath.trim($name , '/\ ').'.php';
//        echo $path;
        if (strpos(trim($name), '/')){
            $names=explode('/' , $name);
            $name = $names[count($names)-1];
            array_pop($names);
            $namespace = trim(join("\\" , $names) , '/\ ');
//create folders if not exist
            $dir = $newPath.trim(join("/" , $names) , '/\ ');
            if (!file_exists($dir)){
                mkdir($dir , 0777 , true);
            }

        }

        if (!file_exists($path)){
            $f= fopen($path , 'w+',1);
            $lines = file('source/artisan/store/'.$part.'.php', FILE_IGNORE_NEW_LINES);//for copy the source
            foreach ($lines as $line) {
                $l=explode(' ',trim($line));

                if ($l[0]=='class'){
                    $l[1]=$name;
                    $line = join( ' ',$l)."\n";
                }

                if ($l[0]=='namespace' && isset($namespace)){
                    $l[1]=trim($l[1] , ';').'\\'.$namespace;
                    $line = join( ' ',$l).";\n";
                }

//    echo trim($line)."     \e[31m\$l[0]\e[34m=\e[32m$l[0]\e[0m\n";

                fwrite($f,$line."\n");
            }
            fclose($f);
            echo trim($line)."\n     \e[32mcreate $part $namespace\\$name successfully\e[0m\n";
        }else{
            echo "\n     \e[31mclass $part $namespace\\$name is alredy exist\e[0m\n";
        }

    }









    public function makeHelp($part){
        if (strpos(':',$part) !== 0  && strpos(':',$part) !== strlen($part)-1 && array_key_exists($part,$this->parts)){
            echo "\e[36m Description: \e[0m\n          ";
                echo $this->parts[$part]['Description'];
            echo "\n\e[36m Usage: \e[0m\n          ";
                echo $this->parts[$part]['Usage'];
            echo "\n\e[36m Arguments: \e[0m\n          ";
                if (isset($this->parts[$part]['Arguments'])){
                    foreach ($this->parts[$part]['Arguments'] as $key => $value){
                        echo "\e[32m $key   \e[0m  $value";
                    }
                }else{
                    echo "\e[31m this option dosnt have any Arguments \e[0m";
                }
            echo "\n\e[36m Options: \e[0m\n          ";
                foreach ($this->parts[$part]['Options'] as $key => $value){
                    echo "\e[32m $key   \e[0m  $value\n          ";
                }

        }else{
            echo "\e[31m this cmd dosnt exist \e[0m";
        }
    }




    public function runCmd(){
        if (count($this->cmd)>1 && (in_array('-h' , $this->cmd) || in_array('--help' , $this->cmd) )){
            $this->makeHelp($this->cmd[0]);
            exit();
        }
        if (strpos(':',$this->cmd[0]) !== 0  && strpos(':',$this->cmd[0]) !== strlen($this->cmd[0])-1 && array_key_exists($this->cmd[0],$this->parts)) {
            $option = explode(':' , $this->cmd[0] );
            $this->make($option[0],$option[1]);
        }

        }





    public function printHelps(){
        echo "
  \e[96;5m make :
        \e[31m make:model                \e[30m create a new model 
        \e[31m make:controller           \e[30m create a new controller 
  \e[96m route :
        \e[31m route:list                \e[30m print a routers list       
        \e[0m
        ";
    }


    
}

