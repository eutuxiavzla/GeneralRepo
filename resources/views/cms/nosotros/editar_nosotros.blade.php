@extends('cms.layout.main')
@section('title')
	Editar Seccion
@endsection

@section('content')

@if(session('message'))
    <div class="alert alert-success my-4" role="alert">
      {{session('message')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger my-4" role="alert">
      {{session('error')}}
    </div>
@endif

<div class="d-flex justify-content-between my-3">
	<h1>
		Editar Sección
	</h1>
	<div>
		<a href="{{route('nosotros.home')}}" class="btn btn-outline-success">Volver</a>
	</div>
</div>
<section class="col-6 my-4">
	<form action="{{route('nosotros.update', $banner->id)}}" method="POST" enctype="multipart/form-data">
		@csrf
		<div  class="form-group">
			<h5>Titulo <small>(191)</small></h5>
			<input class="form-control" id="input_text" type="text" value="{{$banner->title}}" maxlength="191" name="title">
		</div>
		<div  class="form-group">
			<h5>Descripción</h5>
			<textarea class="form-control" name="description">{{$banner->description}}</textarea>
		</div>
		<div  class="form-group">
			<h5>Sección</h5>
			<select class="form-control" name="status">
				<option value="principal"<?php if($banner->status == 'principal') echo 'selected' ?> >Banner principal</option>
				<option value="nosotros" <?php if($banner->status == 'nosotros') echo 'selected' ?> >Quienes Somos</option>
				<option value="vision" <?php if($banner->status == 'vision') echo 'selected' ?>>Visión</option>
			</select>
		</div>
		<div  class="form-group">
			<h5>Imagen</h5>
			<input type="file" name="image">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Actualizar Sección">
		</div>
	</form>
</section>


<script type="text/javascript">
	let input_text = document.getElementById('input_text');

	document.addEventListener('DOMContentLoaded', () => {
		let contador = input_text.parentNode.children[0].children[0];

		contador.textContent = `(${191 - input_text.textLength})`
	})

	input_text.addEventListener('keyup', (e) => {
		let contador = e.target.parentNode.children[0].children[0];
		
		contador.textContent = `(${191 - input_text.textLength})`
	});
</script>
@endsection