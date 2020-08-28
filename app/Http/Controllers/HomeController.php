<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo_Banner;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lading()
    {
        $sliders = Logo_Banner::where('tipo', 'banner')->where('status', 1)->get();
        return view('landing', compact('sliders'));
    }
}
