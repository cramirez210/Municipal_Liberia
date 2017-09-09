
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/nueva/factura', function () {
    return view('registrar_factura');
});



// Rutas del objeto personas 
Route::get('/registro_personas', 'PersonasController@show_registrar');

Route::post('/registro_personas', 'PersonasController@create');


<<<<<<< HEAD
// Rutas del objeto catalogo
Route::get('/categoria/home', 'CategoriaController@home');
Route::post('/categoria/create', 'CategoriaController@create');
=======
>>>>>>> 816d176877a9d5955ee4a1ffcfce9cee1496a3ff
