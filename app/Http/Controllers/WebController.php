<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Categoria;
use App\Models\Configuracion;
use \Mailjet\Resources;
use Illuminate\Support\Facades\Config;

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

        $html = '<table style="width:100%; border-collapse: collapse; border: 1px solid gainsboro">
        <tbody>
              <tr style="border: 1px solid gainsboro">
            <td><b>Nombre</b></td>
            <td>'.$name.'</td>
                 <td><b>Correo</b></td>
            <td>'.$email.'</td>
          </tr>
          <tr style="border: 1px solid gainsboro">
            <td><b>Asunto</b></td>
            <td colspan="3">'.$subject.'</td>
          </tr>
          <tr>
            <td><b>Mensaje</b></td>
            <td colspan="3">'.$message.'</td>
          </tr>
        </tbody>
      </table>';
        
        $mj = new \Mailjet\Client('4bd11c44dbf66e28eeef58f0fd39a4be','b93698430ac0713a4ff1976bf2d33f5c',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
            [
                'From' => [
                'Email' => 'no-reply@jesusmoris.cl',
                'Name' => 'Contacto Jesus Moris'
                ],
                'To' => [
                [
                    'Email' => "jesus@soluciontotal.cl",
                    'Name' => "Jesus Moris"
                ]
                ],
                'Subject' => 'Solicitud de contacto desde la web',
                'HTMLPart' => $html,
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
        $populars = null;
        $config = Configuracion::first();
        if(isset($request->category)){
            $categoria = Categoria::find($request->category);
            if(isset($request->search)){
                $entry = Entrada::where('status', true)->where('title', 'like', '%'.$request->search.'%')->orderBy('created_at', 'desc')->whereHas('categorias', function($q) use($categoria){
                    return $q->where('categorias.id', $categoria->id);
                })->paginate($config->nro_entradas);
            }else{
                $entry = Entrada::where('status', true)->orderBy('created_at', 'desc')->whereHas('categorias', function($q) use($categoria){
                    return $q->where('categorias.id', $categoria->id);
                })->paginate($config->nro_entradas);
            }
        }else{
            if(isset($request->search)){
                $entry = Entrada::where('status', true)->where('title', 'like', '%'.$request->search.'%')->orderBy('created_at', 'desc')->paginate($config->nro_entradas);
            }else{
                $entry = Entrada::where('status', true)->orderBy('created_at', 'desc')->paginate($config->nro_entradas);
            }
        }
        $categories = Categoria::all();
        $filtro = $config->filtro_populares;
        if($filtro == 0){
            $populars = Entrada::orderBy('views', 'desc')->where('status', true)->limit(4)->get();
        }else{
            $populars = Entrada::where('status', true)->addSelect(\DB::raw('*, (CASE WHEN votes=0 THEN 0 WHEN votes>0 THEN votescore/votes END) as rating'))->orderByRaw('rating desc')->limit(4)->get();
        }
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
            $entrada->votescore = round($entrada->votescore + $request->rating);
            $entrada->save();

            return response()->json([
                "rating" => $entrada->votescore / $entrada->votes
            ]);
        }
    }
}
