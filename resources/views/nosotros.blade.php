@extends('layouts.app')

@section('content')
<style type="text/css">
  .banner_principal{
    height: 60vh;
    background-size: cover;
    background-repeat: no-repeat;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }    
</style>

<section class="banner_principal" style="background: url({{asset('storage/'. $principal->image)}})">
    <h1>{{$principal->title}}</h1>
    <p>{{$principal->description}}</p>
</section>

<section class="container ">
    <div class="row banners_content py-5">
        <div class="banner_img col-6 img-fluid">
            <img src="https://picsum.photos/700/400" class="w-100">
        </div>
        <div class="banner_body col-6">
            <h2>Titulo</h2>
            <p>Contenido</p>
        </div>
    </div>
    <div class="row banners_content py-5">
        <div class="banner_body col-6">
            <h2>Titulo</h2>
            <p>Contenido</p>
        </div>
        <div class="banner_img col-6 img-fluid">
            <img src="https://picsum.photos/700/400" class="w-100">
        </div>
    </div>
    <div class="row banners_content py-5">
        <div class="banner_img col-6 img-fluid">
            <img src="https://picsum.photos/700/400" class="w-100">
        </div>
        <div class="banner_body col-6">
            <h2>Titulo</h2>
            <p>Contenido</p>
        </div>
    </div>
</section>
@endsection
