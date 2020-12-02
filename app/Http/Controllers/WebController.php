<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Categoria;
use \Mailjet\Resources;

class WebController extends Controller
{
    public function index(){
        return view('web_principal.home');
    }

    public function contacto(){
        return view('web_principal.contacto');
    }

    public function enviarContacto(Request $request){
        $name = $request->name;
	    $email = $request->email;
	    $subject = $request->subject;
	    $message = $request->message;

        $mj = new \Mailjet\Client('4bd11c44dbf66e28eeef58f0fd39a4be','b93698430ac0713a4ff1976bf2d33f5c',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
            [
                'From' => [
                'Email' => $email,
                'Name' => $name
                ],
                'To' => [
                [
                    'Email' => "jesus@soluciontotal.cl",
                    'Name' => "Jesus Moris"
                ]
                ],
                'Subject' => $subject,
                'HTMLPart' => $message,
            ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        
        if($response->success()){
            return response()->json([
                'status' => 'ok'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
        
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

    public function blogRating(Request $request, $id){
        if($id != null){
            $entrada = Entrada::find($id);
            $entrada->votes = $entrada->votes + 1;
            $entrada->voteScore = round($entrada->voteScore + $request->rating);
            $entrada->save();

            return response()->json([
                "rating" => $entrada->voteScore / $entrada->votes
            ]);
        }
    }
}
