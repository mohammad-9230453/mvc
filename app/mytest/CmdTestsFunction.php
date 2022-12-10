<?php
namespace App\Mytest;


use MongoDB\Driver\Command;
use MongoDB\Driver\Exception\CommandException;

class CmdTestsFunction{
    protected $argv;
    protected $argc;
    public function __construct()
    {
        $this->define();

//        $this->done();
        $this->getopt1();
    }

    public function done(){
        $input=$this->fread('name');
        $this->fwrite($input,GREEN);
        $input=$this->readline('famili');
        $this->fwrite($input,GREEN);
//        $this->fgets();
    }



private function getopt1(){

        $opts = getopt('f:d::rtp',["zarory:","delkhahi::","readable","top","help","pop"],$opts4 );
        echo RED."_________________________________________________________________________________________________\n".ENDCOLOR;
        echo BROWN."***********".GREEN."\nopts:".ENDCOLOR;
        var_dump($opts);
    echo BROWN."***********".GREEN."\nposition:".ENDCOLOR;
        var_dump($opts4);
    echo BROWN."***********".GREEN."\nargv:".ENDCOLOR;
        var_dump($this->argv);
    echo BROWN."***********".GREEN."\nargv_slice:".ENDCOLOR;
        var_dump(array_slice($this->argv , $opts4));
    echo BROWN."***********".RED."\n_________________________________________________________________________________________________\n".ENDCOLOR;

}

    private function fread($message="?"){
        echo $message." = ";
        $name = fread(STDIN , 80);
        return $name;
    }

    private function readline($message="?"){
        $name = readline("$message =");
        return $name;
    }
    private function fwrite($str = 'Hello world from stdout',$color){
        fwrite(STDOUT, $color.$str. ENDCOLOR . PHP_EOL);
    }
    private function fgets(){
        while ($line = fgets(STDIN)) {
            $line = strtolower(trim($line));
            switch ($line) {
                case "bad":
                    fprintf(STDERR, "%s is bad" . PHP_EOL, $line);
                    break;
                case "quit":
                    exit;
                default:
                    fprintf(STDOUT, "%s is good" . PHP_EOL, $line);
                    break;
            }
        }
    }








    private function define(){

        $this->argv=$_SERVER['argv'];
        $this->argc=$_SERVER['argc'];
        if (!defined("STDIN")){
            define("STDIN", fopen('php://stdin','r'));
        }

        if (!defined("STDOUT")){
            define("STDOUT", fopen('php://stdout','w'));
        }

        if (!defined("STDERR")){
            define("STDERR", fopen('php://stderr','w'));
        }
        define("RED", "\e[31m");
        define("GREEN", "\e[32m");
        define("BROWN", "\e[33m");
        define("ENDCOLOR", "\e[0m");

    }

}