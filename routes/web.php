<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Role;
use App\User;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/create', function () {
    $user = User::findOrFail(2);

    $role = new Role(['name'=>'Author']);

    $user->roles()->save($role);
});

Route::get('/read', function () {
    $user = User::findOrFail(2);

    $roles = $user->roles;
    foreach ($roles as $role){
        echo $role->name.'<br>';
    }
});

Route::get('/update', function () {
    $user = User::findOrFail(1);

    if ($user->has('roles')){
        $roles = $user->roles;
        foreach ($roles as $role){
            if ($role->name == 'Administrator'){
                $role->name = strtolower($role->name);
                $role->save();
            }
        }
    }
});




Route::get('/delete', function () {
    $user = User::findOrFail(2);

//    $role = $user->roles();
//    $role->delete();

    foreach ($user->roles as $role){
        $role->whereId(3)->delete();
    }
});


Route::get('/attach', function () {
    $user = User::findOrFail(2);

    $user->roles()->attach(1);
});


Route::get('/detach', function () {
    $user = User::findOrFail(2);

    //detach one

    $user->roles()->detach(1);

    //detach all
    //$user->roles()->detach();


});



Route::get('/sync', function () {
    $user = User::findOrFail(2);

    $user->roles()->sync([1,2]);
});