<div class="row py-1 d-flex align-items-center">
	<div class="col-2 d-flex justify-content-center">
		<img class="reporte-imagen" src="{{ asset('storage/img/logo.png') }}" alt="Logo Municipal Liberia">
	</div>
	<div class="col-8 text-center">
		<h4>Asociacion Deportiva Municipal Liberia</h4>
		<small class="lead text-muted print">Institución deportiva dedicada a crear espacios dentro de una sana convivencia con el fin de deleitar a nuestros socios de un espectaculo deportivo de primer nivel.</small>	
	</div>
</div>
	<div class="d-flex justify-content-center py-4">
		<h5>Sistema de Control de Membresias</h5>
	</div>
	
<div class="row d-flex justify-content-center pb-3">
	<div class="col-4 d-flex flex-column pl-5">
		<label><b><h6>Reporte de:</h6></b></label>
		<label><b><h6>Fecha:</h6></b></label>
		<label><b><h6>Generado por:</h6></b></label>
	</div>
	<div class="col-4 d-flex flex-column text-right pr-5">
		<label><b>{{ $tipoReporte }}</b></label>
		<label><b>{{ date('d-m-Y', strtotime($hora)) }}</b></label>
		<label><b>{{ Auth::user()->nombre_usuario }}</b></label>
	</div>
</div>