<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Categoria;

class WebController extends Controller
{
    public function index(){
        return view('web_principal.home');
    }

    public function contacto(){
        return view('web_principal.contacto');
    }

    public function blog(Request $request){
        $entry = null;
        if(isset($request->category)){
            $categoria = Categoria::find($request->category);
            $entry = Entrada::where('status', true)->orderBy('created_at', 'desc')->whereHas('categorias', function($q) use($categoria){
                return $q->where('categorias.id', $categoria->id);
            })->paginate(3);
        }else{
            $entry = Entrada::where('status', true)->orderBy('created_at', 'desc')->paginate(3);
        }
        $categories = Categoria::all();
        $populars = Entrada::orderBy('views', 'desc')->where('status', true)->limit(4)->get();
        return view('web_principal.blog', ['entradas' => $entry, 'categorias' => $categories, 'populares' => $populars]);
    }

    public function blogDetail($id){
        $categories = Categoria::all();
        $entrada = Entrada::find($id);
        $entrada->views = $entrada->views + 1;
        $entrada->save();

        $previous = Entrada::where('id', '<', $entrada->id)->where('status', true)->max('id');
        $next = Entrada::where('id', '>', $entrada->id)->where('status', true)->min('id');
        $next = Entrada::find($next);
        $previous = Entrada::find($previous);
        $populars = Entrada::orderBy('views', 'desc')->where('status', true)->limit(4)->get();
        return view('web_principal.blog_detail', ['entrada' => $entrada, 'categorias' => $categories, 'anterior' => $previous, 'siguiente' => $next, 'populares' => $populars]);
    }
}
