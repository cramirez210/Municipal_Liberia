
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



// Rutas del objeto catalogo
Route::get('/categoria/home', 'CategoriaController@home');
Route::post('/categoria/create', 'CategoriaController@create');
<<<<<<< HEAD

=======
>>>>>>> 9465bd4a576632c8ce1d27e9d14a7ec2452ec163
Route::get('/categoria/{categoria}', 'CategoriaController@show');
Route::post('/categoria/update/{categoria}', 'CategoriaController@update');

// Rutas del objeto estado
Route::get('/estados/home', 'EstadoController@home');
Route::post('/estados/create', 'EstadoController@create');
Route::get('/estados/{estado}', 'EstadoController@show');
Route::post('/estados/update/{estado}', 'EstadoController@update');