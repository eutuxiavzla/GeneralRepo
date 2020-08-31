@extends('cms.layout.main')
@section('title')
	Nosotros
@endsection


@section('content')
	@if(session('error'))
	    <div class="alert alert-danger my-4" role="alert">
	      {{session('error')}}
	    </div>
	@endif

	@if(session('message'))
	    <div class="alert alert-success my-4" role="alert">
	      {{session('message')}}
	    </div>
	@endif


	<section class="row my-4">
		<div class="col-12	 d-flex justify-content-between">
			<h1>
				Secciones nosotros
			</h1>
			<div>
				<a href="{{route('nosotros.create')}}" class="btn btn-outline-success">Crear Sección</a>
			</div>
		</div>
	</section>

	<hr>

	<section>
		<div class="table-responsive">
		  <table class="table table-striped table-sm">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Imagen</th>
		        <th>Titulo</th>
		        <th>Descripción</th>
		        <th>Sección</th>
		        <th>Acciones</th>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach($banners as $banner)
		      <tr>
		        <td>{{$banner->id}}</td>
		        <td>
		        	<img src="{{asset('storage/'. $banner->image)}}" width="50">
		        </td>
		        <td>{{$banner->title}}</td>
		        <td>{{$banner->description}}</td>
		        <td>{{$banner->status}}</td>
		        <td class="d-flex">
		          <a href="{{route('nosotros.show', $banner->id)}}" class="btn btn-outline-success mr-2">editar</a>
		          <button type="button" id="{{$banner->id}}" class="btn btn-outline-danger eliminar" data-toggle="modal" data-target="#modalEliminar">Eliminar</button>
		        </td>
		      </tr>
		      @endforeach
		    </tbody>
		  </table>
		</div>
	</section>

	<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Eliminar Banner</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="" id="eliminar_form" method="POST">
	        	@csrf
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar Banner</button>
	      </div>
	    </div>
	  </div>
	</div>


	<script type="text/javascript">
		let eliminarButtons = document.querySelectorAll('.eliminar');
		let deleteSubmit = document.getElementById('eliminar_submit');



		//borrar banner
		deleteSubmit.addEventListener('click', (e) => {
			let form = document.getElementById('eliminar_form');

			form.submit();
		});




		//modal eliminar
		if(eliminarButtons)
		{
			eliminarButtons.forEach(buttons => {
				buttons.addEventListener('click', (e) => {
					let id = e.target.id
					modalEliminar(id)
				});
			});
		}


		function modalEliminar(id){
			let formEliminar = document.getElementById('eliminar_form');
			formEliminar.action = `/cms/nosotros/eliminar/${id}`;
		}
	</script>
@endsection
