<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use GuzzleHttp\Middleware;


//En kernel.php definimos los aliases de los middleware
// 'auth' => \App\Http\Middleware\Authenticate::class,
// 'auth.admin' => \App\Http\Middleware\AdminAuth::class, 


Route::get('/login', [SessionsController::class, 'create'])->name('login.index');   //llamamos al controlador, concretamente a la función create() y le damos nombre a la ruta
Route::get('/register', [RegisterController::class, 'create'])->name('register.index');


//creamos la ruta de store
//llamamos al controlador de registro, al metodo store y la renmobramos como register.store
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

//ruta para login
Route::post('/login', [SessionsController::class, 'store'])->name('login.store'); 

//Ruta para logout
Route::get('/logout', [SessionsController::class, 'destroy'])->name('login.destroy'); 
Route::post('/logout', [SessionsController::class, 'destroy'])->name('login.destroy');      //Esta ruta es para que funcione el botón de la plantilla de adminlte para salir de amdin


//                                          nombre del metodo al que redirijimos
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin.index');


Route::get('/admin/upload', [AdminController::class, 'create'])
    ->middleware('auth.admin')
    ->name('admin.upload');

Route::post('admin/upload', [AdminController::class, 'uploadData'])
    ->middleware('auth.admin')
    ->name('admin.uploadData');


//las mostraré en mi vista raíz
Route::get('/', [SessionsController::class, 'mostrarMotos'])
    ->middleware('auth')            //middleware authenticate
    ->name('user.mostrarMotos');


//ruta dinamica para crear la vista de cada moto individual
Route::get('/{moto:id}', [SessionsController::class, 'show'])
    ->middleware('auth')
    ->name('moto.show');

//Ruta para mostrar una moto en la vista del administrador 
Route::get('/{motos:id}', [AdminController::class, 'showAdmin'])
    ->middleware('auth')
    ->name('motoAdmin.show');


//Ruta para eliminar una moto
Route::delete('/motos/{moto:id}/delete', [AdminController::class, 'delete'])
    ->middleware('auth')
    ->name('motoAdmin.delete');


//Ruta para modificar los datos de una moto
Route::get('/motos/{moto}/edit', [AdminController::class, 'edit'])
    ->middleware('auth')
    ->name('motoAdmin.edit');


Route::put('/motos/{moto}', [AdminController::class, 'update'])
    ->middleware('auth')
    ->name('motoAdmin.update');
    

//Ruta para establecer puja
// Route::get('/moto/{moto}/bid', [SessionsController::class, 'bid'])
//     ->middleware('auth')
//     ->name('moto.bid');

Route::post('/moto/{moto}', [SessionsController::class, 'madebid'])
    ->middleware('auth')
    ->name('moto.madebid');



Route::get('/datos/{id}', 'RegisterController@google');





// Ruta para pagos
Route::post('/pago', [SessionsController::class, 'pago'])
    ->name('pago');


  