
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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () { return view('welcome'); });
Route::get('/auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\AuthController@confirmRegister');


Route::group(['middleware' => ['auth','SoloAdministrador']], function() {

	Route::get('/personas/editar/{user}','PersonasController@show_update');
	Route::post('/personas/editar/{user}','PersonasController@update');
	Route::get('/usuarios/showCreate','UsuariosController@showCreate');
	Route::post('/usuarios/create','UsuariosController@create');
	Route::get('/usuario/estado/{user}','UsuariosController@cambiarEstado');
	Route::get('/conf/index', 'ConfiguracionController@index');
	Route::get('/roles/index', 'RolesController@index');
	Route::post('/roles/create', 'RolesController@create');
	Route::get('/role/show/{role}', 'RolesController@show');
	Route::post('/role/update/{role}', 'RolesController@update');

	// Cobros
	Route::get('/cobros/recuento', 'CobroController@BuscarRecuento');
	Route::post('/cobros/recuento','CobroController@recuento');
	Route::get('/cobros/recuento/{mes}/{anio}', 'CobroController@ListarPorFecha');
	Route::get('/cobros/recuento/{mes}/{anio}/{estado}', 'CobroController@ListarPorFechaEstado');
	Route::get('/facturas/recuento', 'FacturaController@BuscarRecuento');
	Route::post('/facturas/recuento','FacturaController@recuento');
	Route::get('/facturas/recuento/show/m', 'FacturaController@MostrarRecuento');
	Route::get('/facturas/recuento/{mes}/{anio}', 'FacturaController@ListarPorFecha');
	Route::get('/facturas/recuento/{mes}/{anio}/{estado}', 'FacturaController@ListarPorFechaEstado');

	//Facturas

	Route::get('/facturas/edit/{id}', 'FacturaController@edit');
	Route::post('/facturas/update/{id}', 'FacturaController@update');

	// Rutas del objeto estado
	Route::get('/estados/home', 'EstadoController@home');
	Route::post('/estados/create', 'EstadoController@create');
	Route::get('/estados/{estado}', 'EstadoController@show');
	Route::post('/estados/update/{estado}', 'EstadoController@update');

	// Rutas del objeto catalogo
	Route::get('/categoria/home', 'CategoriaController@home');
	Route::post('/categoria/create', 'CategoriaController@create');
	Route::get('/categoria/{categoria}', 'CategoriaController@show');
	Route::post('/categoria/update/{categoria}', 'CategoriaController@update');


});

	Route::group(['middleware' => ['auth','EjecutivoyAdministrador']], function() {

	Route::get('/socios/asignarEjecutivo', 'SociosController@asignarEjecutivo');

	Route::post('/socios/create', 'SociosController@create');
	Route::get('/socios/show/edit/{socio}','SociosController@edit');
	Route::post('/socios/update/{socio}','SociosController@update');
	// Rutas del objeto factura
	Route::get('/facturas/index', 'FacturaController@index');
	Route::post('/facturas/create', 'FacturaController@create');
	Route::post('/facturas/confirmar/{id}', 'FacturaController@ConfirmarPago');
	Route::post('/facturas/pagar/{id}', 'FacturaController@pagar');
	Route::get('/facturas/pagar/buscar', 'FacturaController@buscar_socio');

	Route::get('/facturas/generar', 'FacturaController@GenerarFacturas');

	Route::get('/facturas/list/{id}', 'FacturaController@ListarPorEstado');
	Route::get('/facturas/socio/{id}','FacturaController@ListarPorSocio');
	Route::get('/facturas/{socio}/{id}','FacturaController@ListarPorSocioEstado');
	Route::get('/facturas/buscar','FacturaController@BuscarPorSocio');
	Route::post('/facturas/buscar','FacturaController@BuscarSocio');
	Route::get('/facturas/list', 'FacturaController@list');

	Route::get('/facturas/show/id/{id}', 'FacturaController@show');
	Route::get('/facturas/imprimir', 'FacturaController@facturas_pendientes');
	Route::get('/imprimir/{id}','FacturaController@imprimir');

//Rutas del objeto cobro
	Route::get('/cobros/index', 'CobroController@index');
	Route::get('/cobros/show/{id}','CobroController@show');
	Route::get('/cobros/list/{id}', 'CobroController@ListarPorEstado');
	Route::get('/cobros/user/{id}','CobroController@ListarPorUsuario');
	Route::get('/cobros/list/{user}/{id}','CobroController@ListarPorUsuarioEstado');
	Route::get('/cobros/list', 'CobroController@list');
	Route::get('/cobros/anular/{id}', 'CobroController@AnularPorEstado');
	Route::get('/cobros/anular/{user}/{id}', 'CobroController@AnularPorUsuarioEstado');
	Route::post('/cobros/confirmar', 'CobroController@confirmar');
	Route::post('/cobros/anular', 'CobroController@anular');
	Route::get('/cobros/buscar','CobroController@BuscarPorUsuario');
	Route::post('/cobros/buscar/user','CobroController@BuscarUsuario');
	Route::get('/cobros/buscar/anular','CobroController@BuscarParaAnular');
	Route::post('/cobros/buscar/anular','CobroController@BuscarAnular');

});


	Route::group(['middleware' => ['auth','MostrarDatos']], function() {

	//Usuarios

	Route::get('/usuarios/home','UsuariosController@index');
	Route::get('/personas/mostrar/{user}','PersonasController@show');
	Route::get('/usuarios/socios/{user}','UsuariosController@show');
	Route::get('/usuarios/find','UsuariosController@buscarUsuario');
	Route::get('/usuarios/listarPorEstado/{id}','UsuariosController@listarPorEstado');
	Route::get('/usuarios/listarTodos','UsuariosController@listarTodosLosUsuarios');

	// Rutas del objeto socio.
	Route::get('/socios/home', 'SociosController@home');
	Route::get('/socios/index', 'SociosController@index');
	Route::get('/socios/show/{socio}','SociosController@show');
	Route::get('/socios/listarPorEstado/{id}', 'SociosController@listarPorEstado');
	Route::get('/socios/find','SociosController@buscarSocio');
	Route::get('/socios/estado/{id}','SociosController@cambiarEstado');
	Route::get('/socios/listarTodos','SociosController@listarTodosLosSocios');
	Route::get('/socios/showImagen/{socio}','SociosController@showImagen');
	
});




