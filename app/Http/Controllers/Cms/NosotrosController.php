<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Nosotro;

use Storage; 
use Str;

class NosotrosController extends Controller
{
    public function index()
    {
    	$banners = Nosotro::all();

    	return view('cms.nosotros.index', compact('banners'));
    }

    public function crearNosotros()
    {
    	return view('cms.nosotros.crear_nosotros');
    }

    public function guardarNosotros(Request $request)
    {
    	$path = $request->file('image')->store('public');
    	$file = Str::replaceFirst('public/', '',$path);


    	$seccion = new Nosotro;
    	$seccion->create([
    		'title' => $request->title,
    		'description' => $request->description,
    		'status' => $request->status,
    		'image' => $file,
    	]);

    	return back()->with('message', 'Sección creada con éxito');

    }

    public function editarNosotros($id)
    {
    	$banner = Nosotro::find($id);

    	return view('cms.nosotros.editar_nosotros', compact('banner'));
    }

    public function actualizarNosotros(Request $request, $id)
    {
    	$banner = Nosotro::find($id);

    	if($request->file('image'))
    	{
    	    $deleted = Storage::disk('public')->delete($banner->image);

    	    if(isset($deleted) || $banner->image == null)
    	    {
    	        $path = $request->file('image')->store('public');

    	        $file = Str::replaceFirst('public/', '',$path);

    	        $banner->update([
    	            'title' => $request->title,
    	            'description' =>$request->description,
    	            'status' => $request->status,
    	            'image' => $file,
    	        ]);
    	        
    	        return back()->with('message', 'Sección actualizada con éxito');
    	    } else {
    	        return back()->with('message', 'No se pudo actualizar la sección');
    	    }
    	} else {
    	    $banner->update([
    	        'title' => $request->title,
    	        'status' => $request->status,
    	        'description' =>$request->description,
    	    ]);

    	    return back()->with('message', 'Sección actualizado con éxito');
    	}
    }


    public function eliminarSeccion($id)
    {
    	$banner = Nosotro::find($id);
    	$deleted = Storage::disk('public')->delete($banner->image);
    	
    	if(isset($deleted) || $banner->image == null)
    	{
    	    $banner->delete();
    	    return back()->with('error', 'Sección eliminada con éxito');
    	} else {
    	    return back()->with('error', 'No se pudo eliminar el Banner');
    	}
    }
}
