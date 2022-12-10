<?php
namespace App\Controller\Auth;

use App\Models\User;
use Source\Request;

class authController
{



    public function home2(){
        $name = 'ali';
        $famili = 'malek';
        return view('home.welcome',compact('name' , 'famili'));
    }

    public function home3(){
        $name = 'mohammad';
        $famili = 'malekshahi';
        return view('home.welcome',compact('name' , 'famili'));
    }


    public function home4(){
        return view('home.welcome');
    }




    public function form1(Request $request ,  $name){
        echo '<h1 style="color: #ff002a"><h1>id ====>>>> '.$name.'</h1></h1>';


        return redirect()->to('/ali')->with(['name' => $request->name , 'famili'=>$name]);
    }



    public function form2($name = 'ali'){
//        $url = '/ali85';
//        return redirect($url);
    }



    public function form3(){

        return redirect()->back();

    }



    public function form4(){
        return redirect()->to('/ali88');
    }


    public function form5post(Request $request){
        echo '<h2>form5post::</h2><br>';
        print_r($request);echo '<br>';
        print_r($request->id);echo '<br>';
        print_r($request->name);echo '<br>';
    }


    public function form5get(Request $request , $id , $name){
        echo '<h2>form5get::</h2><br>';
        print_r($request);echo '<br>';
        print_r($id);echo '<br>';
        print_r($name);echo '<br>';
    }







    public function user_model(){
        $users = new User();
        $users->addtKey(['name' , 'email']);
        $users->name = 'ali';
        $users->email = 'email1';
        $users->create();
        $users->create(['name'=>'mohammad' , 'email'=>'email11']);
        $users->create(['name'=>'mohammad1' , 'email'=>'email12']);
        $users->create(['name'=>'mohammad2' , 'email'=>'email13']);
        $users->create(['name'=>'mohammad3' , 'email'=>'email14']);

        printTable($users->get_keys(),$users->get_all() , 'users');



    }

    public function user(User $user , Request $request){
        echo '<h1 style="color: lightslategray">'.$user->rr.'</h1>';
        echo env('APP_NAME');
    }

}
