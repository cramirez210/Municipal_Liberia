
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

Route::get('/personas/listar','PersonasController@home');
Route::get('personas/mostrar/{user}','PersonasController@show');
Route::get('personas/editar/{user}','PersonasController@show_update');
Route::post('personas/editar/{user}','PersonasController@update');


// Rutas del objeto catalogo
Route::get('/categoria/home', 'CategoriaController@home');
Route::post('/categoria/create', 'CategoriaController@create');
Route::get('/categoria/{categoria}', 'CategoriaController@show');
Route::post('/categoria/update/{categoria}', 'CategoriaController@update');

// Rutas del objeto estado
Route::get('/estados/home', 'EstadoController@home');
Route::post('/estados/create', 'EstadoController@create');
Route::get('/estados/{estado}', 'EstadoController@show');
Route::post('/estados/update/{estado}', 'EstadoController@update');


//Rutas del objeto Roles

Route::get('/roles/home','RolesController@index');

// Rutas del objeto socio.

Route::get('/socios/home', 'SociosController@home');
Route::post('/socios/create', 'SociosController@create');
Route::get('/socios/index', 'SociosController@index');

// Rutas del objeto factura
Route::get('/factura/create', 'FacturaController@create');
Route::get('/factura/list', 'FacturaController@list');
