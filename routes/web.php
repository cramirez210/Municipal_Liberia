
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

// Rutas del objeto usuario

Route::get('/personas/mostrar/{user}','PersonasController@show');
Route::get('/personas/editar/{user}','PersonasController@show_update');
Route::post('/personas/editar/{user}','PersonasController@update');

Route::get('/usuarios/home','UsuariosController@index')->middleware('auth');
Route::get('/usuarios/socios/{user}','UsuariosController@show')->middleware('auth');
Route::get('/usuarios/find','UsuariosController@buscarUsuario')->middleware('auth');
Route::get('/usuarios/showCreate','UsuariosController@showCreate');
Route::post('/usuarios/create','UsuariosController@create');
Route::get('/usuarios/listarPorEstado/{id}','UsuariosController@listarPorEstado')->middleware('auth');
Route::get('/usuario/estado/{user}','UsuariosController@cambiarEstado')->middleware('auth');
Route::get('/usuarios/listarTodos','UsuariosController@listarTodosLosUsuarios')->middleware('auth');


// Rutas del objeto catalogo
Route::get('/categoria/home', 'CategoriaController@home')->middleware('auth');;
Route::post('/categoria/create', 'CategoriaController@create')->middleware('auth');;
Route::get('/categoria/{categoria}', 'CategoriaController@show')->middleware('auth');;
Route::post('/categoria/update/{categoria}', 'CategoriaController@update')->middleware('auth');;

// Rutas del objeto estado
Route::get('/estados/home', 'EstadoController@home')->middleware('auth');;
Route::post('/estados/create', 'EstadoController@create')->middleware('auth');;
Route::get('/estados/{estado}', 'EstadoController@show')->middleware('auth');;
Route::post('/estados/update/{estado}', 'EstadoController@update')->middleware('auth');;

// Rutas del objeto socio.

Route::get('/socios/home', 'SociosController@home')->middleware('auth');;
Route::post('/socios/create', 'SociosController@create')->middleware('auth');;
Route::get('/socios/index', 'SociosController@index')->middleware('auth');;
Route::get('/socios/show/{socio}','SociosController@show')->middleware('auth');;

Route::get('/socios/listarPorEstado/{id}', 'SociosController@listarPorEstado')->middleware('auth');;
Route::get('/socios/find','SociosController@buscarSocio')->middleware('auth');;
Route::get('/socios/estado/{id}','SociosController@cambiarEstado')->middleware('auth');;
Route::get('/socios/show/edit/{socio}','SociosController@edit')->middleware('auth');;
Route::post('/socios/update/{socio}','SociosController@update')->middleware('auth');;
Route::get('/socios/listarTodos','SociosController@listarTodosLosSocios')->middleware('auth');

// Rutas del objeto factura
Route::get('/facturas/index', 'FacturaController@index')->middleware('auth');;
Route::post('/facturas/create', 'FacturaController@create')->middleware('auth');;
Route::post('/facturas/confirmar/{id}', 'FacturaController@ConfirmarPago')->middleware('auth');;
Route::post('/facturas/pagar/{id}', 'FacturaController@pagar')->middleware('auth');;
Route::get('/facturas/pagar/buscar', 'FacturaController@buscar_socio')->middleware('auth');;
Route::get('/facturas/edit/{id}', 'FacturaController@edit')->middleware('auth');;
Route::get('/facturas/generar', 'FacturaController@GenerarFacturas')->middleware('auth');;
Route::post('/facturas/update/{id}', 'FacturaController@update')->middleware('auth');;
Route::get('/facturas/list/{id}', 'FacturaController@ListarPorEstado')->middleware('auth');;
Route::get('/facturas/socio/{id}','FacturaController@ListarPorSocio')->middleware('auth');;
Route::get('/facturas/{socio}/{id}','FacturaController@ListarPorSocioEstado')->middleware('auth');;
Route::get('/facturas/buscar','FacturaController@BuscarPorSocio')->middleware('auth');;
Route::post('/facturas/buscar','FacturaController@BuscarSocio')->middleware('auth');;
Route::get('/facturas/list', 'FacturaController@list')->middleware('auth');;
Route::get('/facturas/recuento', 'FacturaController@BuscarRecuento')->middleware('auth');;
Route::post('/facturas/recuento','FacturaController@recuento')->middleware('auth');;
Route::get('/facturas/recuento/show/m', 'FacturaController@MostrarRecuento')->middleware('auth');;
Route::get('/facturas/recuento/{mes}/{anio}', 'FacturaController@ListarPorFecha')->middleware('auth');;
Route::get('/facturas/recuento/{mes}/{anio}/{estado}', 'FacturaController@ListarPorFechaEstado')->middleware('auth');;
Route::get('/facturas/show/id/{id}', 'FacturaController@show')->middleware('auth');;
Route::get('/facturas/imprimir', 'FacturaController@facturas_pendientes')->middleware('auth');;
Route::post('/facturas/imprimir','FacturaController@imprimir')->middleware('auth');;

//Rutas del objeto cobro
Route::get('/cobros/index', 'CobroController@index')->middleware('auth');;
Route::get('/cobros/list/{id}', 'CobroController@ListarPorEstado')->middleware('auth');;
Route::get('/cobros/user/{id}','CobroController@ListarPorUsuario')->middleware('auth');;
Route::get('/cobros/{user}/{id}','CobroController@ListarPorUsuarioEstado')->middleware('auth');;
Route::get('/cobros/list', 'CobroController@list')->middleware('auth');;
Route::get('/cobros/buscar','CobroController@BuscarPorUsuario')->middleware('auth');;
Route::post('/cobros/buscar/user','CobroController@BuscarUsuario')->middleware('auth');;
Route::get('/cobros/recuento', 'CobroController@BuscarRecuento')->middleware('auth');;
Route::post('/cobros/recuento/buscar','CobroController@recuento')->middleware('auth');;
Route::get('/cobros/recuento/{mes}/{anio}', 'CobroController@ListarPorFecha')->middleware('auth');;
Route::get('/cobros/recuento/{mes}/{anio}/{estado}', 'CobroController@ListarPorFechaEstado')->middleware('auth');;

//Rutas para correo 

Route::get('/auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\AuthController@confirmRegister');


//Rutas para el objeto roles 
Route::get('/roles/index', 'RolesController@index')->middleware('auth');;
Route::post('/roles/create', 'RolesController@create')->middleware('auth');;

Route::get('/role/show/{role}', 'RolesController@show')->middleware('auth');;
Route::post('/role/update/{role}', 'RolesController@update')->middleware('auth');;


//Rutas para configuracion.
Route::get('/conf/index', 'ConfiguracionController@index')->middleware('auth');;
