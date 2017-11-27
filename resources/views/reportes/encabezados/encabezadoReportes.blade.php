<div class="row py-5 d-flex align-items-center">
	<div class="col-4 d-flex justify-content-center">
		<img class="reporte-imagen" src="{{ asset('storage/img/logo.png') }}" alt="Logo Municipal Liberia">
	</div>
	<div class="col-8 text-center">
		<h3>Asociacion Deportiva Municipal Liberia</h3>
		<small class="lead text-muted">Institución deportiva dedicada a crear espacios dentro de una sana convivencia con el fin de deleitar a nuestros socios de un espectaculo deportivo de primer nivel.</small>	
	</div>
</div>
	<div class="d-flex justify-content-center pb-4">
		<h4>Sistema de Control de Membresias</h4>
	</div>
	
<div class="row pb-3">
	<div class="col-6 d-flex flex-column pl-5">
		<label><b><h5>Reporte de:</h5></b></label>
		<label><b><h5>Fecha:</h5></b></label>
		<label><b><h5>Generado por:</h5></b></label>
	</div>
	<div class="col-6 d-flex flex-column text-right pr-5">
		<label><b>{{ $tipoReporte }}</b></label>
		<label><b>{{ $hora }}</b></label>
		<label><b>{{ Auth::user()->nombre_usuario }}</b></label>
	</div>
</div>