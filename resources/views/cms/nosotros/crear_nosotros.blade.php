@extends('cms.layout.main')
@section('title')
	Crear Seccion
@endsection

@section('content')

@if(session('message'))
    <div class="alert alert-success my-4" role="alert">
      {{session('message')}}
    </div>
@endif

<div class="d-flex justify-content-between my-3">
	<h1>
		Crear Sección
	</h1>
	<div>
		<a href="{{route('nosotros.home')}}" class="btn btn-outline-success">Volver</a>
	</div>
</div>
<section class="col-6 my-4">
	<form action="{{route('nosotros.store')}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div  class="form-group">
			<h5>Titulo <small>(191)</small></h5>
			<input class="form-control" id="input_text" type="text" maxlength="191" name="title">
		</div>
		<div  class="form-group">
			<h5>Descripción</h5>
			<textarea class="form-control" name="description"></textarea>
		</div>
		<div  class="form-group">
			<h5>Sección</h5>
			<select class="form-control" name="status">
				<option value="0">Selecciona una sección</option>
				<option value="principal">Banner principal</option>
				<option value="nosotros">Quienes Somos</option>
				<option value="vision">Visión</option>
			</select>
		</div>
		<div  class="form-group">
			<h5>Imagen</h5>
			<input type="file" name="image">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Crear Sección">
		</div>
	</form>
</section>


<script type="text/javascript">
	let input_text = document.getElementById('input_text');

	input_text.addEventListener('keydown', (e) => {
		let contador = e.target.parentNode.children[0].children[0];
		
		contador.textContent = `(${191 - input_text.textLength})`
	});
</script>
@endsection