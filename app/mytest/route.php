<?php

use App\Mytest\arraytest;
use Source\Request;


arraytest::GET('/user/{user}/name', 'auth/authcontroller@user')->name('mamad.auth');

arraytest::get('/user/{id}/{name}', function(Request $request , $name , $id){
    echo '<h1 style="color: #ff002a"><h1>id ====>>>> '.$id.'</h1></h1>';
    echo '<h1 style="color: #ff002a"><h1>name ====>>>> '.$name.'</h1></h1>';

//        return redirect()->to('/ali')->with(['name' => $request->name]);
})->name('mamad.auth');

arraytest::get('/foreach', function(Request $request ){
    $arr1=['a1','a2','a3','a4','a5','a6'];
    $arr2=['b1','b2','b3','b4','b5','b6'];
    $arr3=['c1','c2','c3','c4','c5','c6'];
    foreachloop($arr1,$arr2,$arr3);
})->name('foreach.loop');


arraytest::DELETE('/user/oopp/hh', 'auth/authcontroller@form1')->name('mamad.auth');
arraytest::post('/user/oopp/{name}', 'auth/authcontroller@form1')->name('mamad.auth');
arraytest::UPDATE('/user/oopp/{id}', 'auth/authcontroller@form1')->name('mamad.auth');
arraytest::GET('/user/{kill}/us', 'auth/authcontroller@form1')->name('mamad.auth');


arraytest::ANY('/ali' , function (){
    return view('home.welcome')->with(['name'=>'ali1' , 'famili'=>'malek2'])->with(['name'=>'ali2']);
});

arraytest::any('/' , function (){
    return view('home.welcome')->with(['name'=>'ali1' , 'famili'=>'malek2'])->with(['name'=>'ali2']);
});

arraytest::any('/ali2', 'auth/authcontroller@user_model')->name('mamad.auth');




arraytest::add('/form2', 'auth/authcontroller@form2')->name('mamad.auth');
arraytest::GET('/form3', 'auth/authcontroller@form3')->name('mamad.auth');
arraytest::get('/form4', 'auth/authcontroller@form4')->name('mamad.auth');
arraytest::get('/form5', 'auth/authcontroller@form5get')->name('form5.post');
arraytest::Post('/form5', 'auth/authcontroller@form5post')->name('form5.get');






arraytest::names('auth.')->prefix('/auth')->group(function (){

    arraytest::add('/home2', 'auth/authcontroller@home2')->name('home2');
    arraytest::add('/home3', 'auth/authcontroller@home3')->name('home3');
    arraytest::add('/home4', 'auth/authcontroller@home4')->name('home4');

    arraytest::prefix('/oopp')->group(function (){

        arraytest::post('/php', 'controller@home');
        arraytest::add('/api', 'controller@home');
        arraytest::add('/ppp', 'controller@home');

    });

    arraytest::prefix('/name')->group(function (){

        arraytest::add('/ali', 'controller@home');
        arraytest::add('/mohammad', 'controller@home');

    });
    arraytest::add('/api', 'controller@home');

});




arraytest::prefix('/g1')->names('g1.')->group(function (){
    arraytest::add('/ch1', 'controller@home')->name('add1');


    arraytest::group(function (){//g1.1
        arraytest::prefix('/g2')->group(function (){//g1.1.1

            arraytest::names('g3.')->group(function (){//g1.1.1.1
                arraytest::add('/ch1', 'controller@home')->name('ch1');

                arraytest::names('g4.')->prefix('/g4')->group(function (){//g1.1.1.1.1
                    arraytest::add('/ch1', 'controller@home')->name('ch1');
                    arraytest::add('/ch2', 'controller@home');
                });
                arraytest::add('/ch1', 'controller@home');
            });
            arraytest::add('/ch13', 'controller@home')->name('ch1');

        });

        arraytest::add('/ch14', 'controller@home');

    });

    arraytest::group(function (){
        arraytest::add('/ch12', 'controller@home');
        arraytest::add('/ch2', 'controller@home');
        arraytest::add('/ch3', 'controller@home');
    });

});
