
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

Route::get('/', function () { return view('layouts/master'); });


Route::get('/usuarios/showCreate','UsuariosController@showCreate');
Route::post('/usuarios/create','UsuariosController@create');
Route::get('/correo/enviar','CorreoController@notificar');

Route::get('/usuarios/get/links/{id}', function ($id) {

    $usuario = App\User::find($id); 
	return view('usuarios.links', compact('usuario')); 
});

Route::get('/socios/get/links/{id}', function ($id) {

    $socio = App\Socio::find($id); 
	return view('socios.links', compact('socio')); 
});


Route::group(['middleware' => ['auth','SoloAdministrador']], function() {

	Route::get('/personas/editar/{user}','PersonasController@show_update');
	Route::post('/personas/editar/{user}','PersonasController@update');
	Route::get('/usuarios/cobros/{id}','UsuariosController@ReporteDeCobros');
	Route::get('/usuario/estado/{user}','UsuariosController@cambiarEstado');

	Route::get('/conf/index', 'ConfiguracionController@index');
	Route::get('/roles/index', 'RolesController@index');
	Route::post('/roles/create', 'RolesController@create');
	Route::get('/role/show/{role}', 'RolesController@show');
	Route::post('/role/update/{role}', 'RolesController@update');

	//Descuentos
	Route::get('/descuentos/create', 'DescuentoController@create');
	Route::post('/descuentos/store', 'DescuentoController@store');
	Route::get('/descuentos/show/{id}', 'DescuentoController@show');
	Route::post('/descuentos/update/{id}', 'DescuentoController@update');

	// Cobros
	Route::get('/cobros/recuento', 'CobroController@BuscarRecuento');
	Route::post('/cobros/recuento','CobroController@recuento');
	Route::get('/cobros/mostrar/recuento/{desde}/{hasta}', 'CobroController@MostrarRecuento');
	Route::get('/cobros/recuento/{desde}/{hasta}', 'CobroController@ListarPorFecha');
	Route::get('/cobros/recuento/{desde}/{hasta}/{estado}', 'CobroController@ListarPorFechaEstado');
	Route::get('/facturas/recuento', 'FacturaController@BuscarRecuento');
	Route::post('/facturas/recuento','FacturaController@recuento');
	Route::get('/facturas/mostrar/recuento/{desde}/{hasta}', 'FacturaController@MostrarRecuento');
	Route::get('/facturas/recuento/{desde}/{hasta}', 'FacturaController@ListarPorFecha');
	Route::get('/facturas/recuento/{desde}/{hasta}/{estado}', 'FacturaController@ListarPorFechaEstado');
	Route::get('/facturas/reporte/morosos', 'FacturaController@ReporteSociosMorosos');

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
	Route::get('/socios/filtrar', 'SociosController@RequestFiltrar');
	Route::get('/socios/filtrar/{criterio}/{valor}/{estado}', 'SociosController@filtrar');
	Route::get('/socio/facturas/filtrar', 'FacturaController@RequestFiltrarSocio');
	Route::get('/socio/facturas/filtrar/{id}/{criterio}/{valor}/{estado}', 'FacturaController@filtrar_socio');

	// Rutas del objeto factura
	Route::get('/facturas/index', 'FacturaController@index');
	Route::get('/facturas/create', 'FacturaController@create');
	Route::post('/facturas/confirmar/{id}', 'FacturaController@ConfirmarPago');
	Route::post('/facturas/liquidar/{id}', 'FacturaController@liquidar');
	//Route::get('/facturas/pagar/buscar', 'FacturaController@buscar_socio');
	Route::get('/facturas/pagar/{id}', 'FacturaController@pagar');

	Route::get('/facturas/generar', 'FacturaController@GenerarFacturas');

	Route::get('/facturas/list/{id}', 'FacturaController@ListarPorEstado');
	Route::get('/facturas/socio/{id}','FacturaController@ListarPorSocio');
	Route::get('/facturas/{socio}/{id}','FacturaController@ListarPorSocioEstado');
	Route::get('/facturas/pendientes/{socio}/{id}','FacturaController@ListarPendientesSocio');
	//Route::get('/facturas/buscar','FacturaController@BuscarPorSocio');
	Route::post('/facturas/buscar','FacturaController@BuscarSocio');
	Route::get('/facturas/list', 'FacturaController@list');
	Route::get('/facturas/morosos', 'FacturaController@ListarSociosMorosos');
	//Route::get('/facturas/socios/morosos/consultar', 'FacturaController@ConsultarMorosidad');
	Route::get('/facturas/socios/morosos/consultar/{criterio}/{valor}', 'FacturaController@BuscarMoroso');
	Route::get('/facturas/socios/morosos/{id}', 'FacturaController@MostrarMorosidadSocio');
	Route::get('/facturas/filtrar', 'FacturaController@RequestFiltrar');
	Route::get('/facturas/filtrar/{criterio}/{valor}/{estado}', 'FacturaController@filtrar');

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
	Route::get('/cobros/liquidar/{id}', 'CobroController@liquidarPorEstado');
	Route::get('/cobros/liquidar/{user}/{id}', 'CobroController@liquidarPorUsuarioEstado');
	Route::post('/cobros/confirmar', 'CobroController@confirmar');
	Route::post('/cobros/liquidar', 'CobroController@liquidar');
	//Route::get('/cobros/buscar','CobroController@BuscarPorUsuario');
	Route::post('/cobros/buscar/user','CobroController@BuscarUsuario');
	Route::get('/cobros/reporte/user/{id}','CobroController@ReporteCobrosDeEjecutivo');
	//Route::get('/cobros/buscar/liquidar','CobroController@BuscarParaliquidar');
	Route::post('/cobros/buscar/liquidar','CobroController@Buscarliquidar');
	Route::get('/cobros/morosos', 'CobroController@ListarUsuariosMorosos');
	//Route::get('/cobros/usuarios/morosos/consultar', 'CobroController@ConsultarMorosidad');
	Route::post('/cobros/usuarios/morosos/consultar', 'CobroController@BuscarMoroso');
	Route::get('/cobros/usuarios/morosos/{id}', 'CobroController@MostrarMorosidadUsuario');
	Route::get('/cobros/filtrar', 'CobroController@RequestFiltrar');
	Route::get('/cobros/filtrar/{criterio}/{valor}/{estado}', 'CobroController@filtrar');
	Route::get('/cobros/user/{id}/filtrar/{criterio}/{valor}/{estado}', 'CobroController@filtrar_user');

});


	Route::group(['middleware' => ['auth','MostrarDatos']], function() {

	//Usuarios

	Route::get('/usuarios/home','UsuariosController@index');
	Route::get('/personas/mostrar/{username}','PersonasController@show');
	Route::get('/usuarios/socios/{user}','UsuariosController@show');
	Route::get('/usuarios/find','UsuariosController@buscarUsuario');
	Route::get('/usuarios/listarPorEstado/{id}','UsuariosController@listarPorEstado');
	Route::get('/usuarios/listarPorRole/{id}','UsuariosController@listarPorRole');
	Route::get('/usuarios/listarTodos','UsuariosController@listarTodosLosUsuarios');
	Route::get('/usuarios/filtrar', 'UsuariosController@RequestFiltrar');
	Route::get('/usuarios/filtrar/{criterio}/{valor}/{estado}/{rol}', 'UsuariosController@filtrar');
	Route::get('/cobros/usuario/filtrar', 'CobroController@RequestFiltrarUser');
	Route::get('/cobros/usuario/filtrar/{id}/{criterio}/{valor}/{estado}', 'CobroController@filtrar_user');

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




