
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
// Rutas del objeto usuario

Route::get('personas/mostrar/{user}','PersonasController@show');
Route::get('personas/editar/{user}','PersonasController@show_update');
Route::post('personas/editar/{user}','PersonasController@update');

Route::get('usuarios/home','UsuariosController@index');
Route::get('usuarios/socios/{user}','UsuariosController@show');


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

// Rutas del objeto socio.

Route::get('/socios/home', 'SociosController@home');
Route::post('/socios/create', 'SociosController@create');
Route::get('/socios/index', 'SociosController@index');
Route::get('/socios/show/{socio}','SociosController@show');

Route::get('/socios/listarPorEstado/{id}', 'SociosController@listarPorEstado');
Route::get('/socios/find','SociosController@buscarSocio');
Route::get('/socios/estado/{id}','SociosController@cambiarEstado');
Route::get('/socios/show/edit/{socio}','SociosController@edit');
Route::post('/socios/update/{socio}','SociosController@update');


// Rutas del objeto factura
Route::get('/facturas/create/{id}', 'FacturaController@create');
Route::get('/facturas/generar', 'FacturaController@GenerarFacturas');
Route::post('/facturas/{id}', 'FacturaController@store');

Route::get('/facturas/list/{id}', 'FacturaController@ListarPorEstado');
Route::get('/facturas/socio/{id}','FacturaController@ListarPorSocio');
Route::get('/facturas/{socio}/{id}','FacturaController@ListarPorSocioEstado');

Route::get('/facturas/list', 'FacturaController@list');



Route::get('/facturas/list/{id}', 'FacturaController@ObtenerFacturasPorEstado');
Route::get('/facturas/socio/{id}','FacturaController@ObtenerFacturasPorSocio');


//Rutas para correo 

Route::get('auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\AuthController@confirmRegister');


//Rutas para el objeto roles 
Route::get('/roles/index', 'RolesController@index');
Route::post('/roles/create', 'RolesController@create');

Route::get('/role/show/{role}', 'RolesController@show');
Route::post('/role/update/{role}', 'RolesController@update');


//Rutas para configuracion.
Route::get('/conf/index', 'ConfiguracionController@index');
