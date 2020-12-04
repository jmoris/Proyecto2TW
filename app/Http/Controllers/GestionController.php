<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class GestionController extends Controller
{
    public function index(){
        $users = User::count();
        $entrys = Entrada::count();
        $categorias = Categoria::count();
        $views = Entrada::sum('views');
        return view('gestion.home', [
            'usuarios' => $users,
            'entradas' => $entrys,
            'vistas' => $views,
            'categorias' => $categorias
        ]);
    }

    public function vistaUsuarios(){
        $usuarios = User::all();
        return view('gestion.usuarios', ['usuarios' => $usuarios]);
    }

    public function addUsuario(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'dob' => 'required',
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->save();

        switch($request->role){
            case 1:
                $user->assignRole('superadmin');
                break;
            case 2:
                $user->assignRole('admin');  
                break;
            case 3:
                $user->assignRole('escritor');
                break;
        }
        return response()->json([
            'status' => 'ok',
            'msg' => 'Usuario creado exitosamente.'
        ], 200);
    }

    public function updateUsuario(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => '',
            'dob' => 'required',
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->save();
        $user->roles()->detach();
        switch($request->role){
            case 1:
                $user->assignRole('superadmin');
                break;
            case 2:
                $user->assignRole('admin');  
                break;
            case 3:
                $user->assignRole('escritor');
                break;
        }
        return response()->json([
            'status' => 'ok',
            'msg' => 'Usuario modificado exitosamente.'
        ], 200);
    }

    public function getUsuario(Request $request, $id){
        $usuario = User::where('id', $id)->where('status', true)->first();
        return response()->json($usuario);
    }

    public function deleteUsuario(Request $request){
        if($request->id != null){
            $user = User::find($request->id);
            $user->status = !$user->status;
            $user->save();
            return response()->json([
                'status' => 'ok',
                'msg' => 'Usuario desactivado/activado exitosamente.'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
    }

    public function vistaPublicaciones(){
        $entradas = Entrada::all();
        $categorias = Categoria::all();
        $usuarios = User::where('status', true)->get();
        return view('gestion.publicaciones', ['entradas' => $entradas, 'categorias' => $categorias, 'usuarios' => $usuarios]);
    }

    public function addPublicacion(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'date' => 'required',
            'author' => 'required',
            'categorias' => ''
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
        $upldimg = $this->save_record_image($request->image, $request->image->getClientOriginalName());
        $entry = new Entrada();
        $entry->title = $request->title;
        $entry->content = $request->content;
        $entry->author_id = $request->author;
        $entry->created_at = date('Y-m-d', strtotime($request->date));
        $entry->image_path = $upldimg['data']['url'];
        $entry->save();
        if($request->categorias!=null||$request->categorias!=''){
            $cats = explode(',', $request->categorias);
            foreach($cats as $cat){
                $entry->categorias()->attach($cat);
            }
        }

        return response()->json([
            'status' => 'ok',
            'msg' => 'Publicacion creada exitosamente.'
        ], 200);
    }

    public function updatePublicacion(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => '',
            'date' => 'required',
            'author' => 'required',
            'categorias' => ''
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
        $upldimg = null;
        if(isset($request->image))
            $upldimg = $this->save_record_image($request->image, $request->image->getClientOriginalName());
        $entry = Entrada::find($id);
        $entry->title = $request->title;
        $entry->content = $request->content;
        $entry->author_id = $request->author;
        $entry->created_at = date('Y-m-d', strtotime($request->date));
        $entry->image_path = ($upldimg!=null)?$upldimg['data']['url']:$entry->image_path;
        $entry->save();

        $entry->categorias()->detach();
        if($request->categorias!=null||$request->categorias!=''){
            $cats = explode(',', $request->categorias);
            foreach($cats as $cat){
                $entry->categorias()->attach($cat);
            }
        }


        return response()->json([
            'status' => 'ok',
            'msg' => 'Publicacion modificada exitosamente.'
        ], 200);
    }

    public function deletePublicacion(Request $request, $id){
        if($id != null){
            $entry = Entrada::find($id);
            $entry->status = !$entry->status;
            $entry->save();
            return response()->json([
                'status' => 'ok',
                'msg' => 'Publicacion desactivada/activada exitosamente.'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
    }

    public function getPublicacion(Request $request, $id){
        $entrada = Entrada::where('id', $id)->where('status', true)->first()->toArray();
        $cats = Entrada::where('id', $id)->first()->categorias;
        $entrada['categorias'] = [];
        foreach($cats as $cat){
            array_push($entrada['categorias'], $cat->id);
        }
        return response()->json($entrada);
    }

    public function vistaConfiguraciones(){
        $categorias = Categoria::all();
        $config = Configuracion::first();

        return view('gestion.configuraciones', ['categorias' => $categorias, 'config' => $config]);
    }

    public function addCategoria(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
        $entry = new Categoria();
        $entry->name = $request->name;
        $entry->save();

        return response()->json([
            'status' => 'ok',
            'msg' => 'Categoria creada exitosamente.'
        ], 200);
    }

    public function deleteCategoria(Request $request, $id){
        if($id != null){
            $entry = Categoria::find($id);
            $entry->delete();
            return response()->json([
                'status' => 'ok',
                'msg' => 'Categoria eliminada exitosamente.'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'msg' => 'Todos los campos son requeridos.'
            ], 400);
        }
    }

    public function saveConfigBlog(Request $request){
        $config = Configuracion::first();
        $config->nro_entradas = $request->nro_entradas;
        $config->filtro_populares = $request->filtro_populares;
        $config->save();
        return response()->json([
            'status' => 'ok',
            'msg' => 'Configuración del blog cambiada exitosamente.',
            'nro' => $request->nro_entradas
        ], 200);
    }




    private function save_record_image($image,$name = null){
        $API_KEY = 'bf5ce7990d902d8460a27bed8687799b';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload?key='.$API_KEY);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $extension = pathinfo($image->getClientOriginalName(),PATHINFO_EXTENSION);
        $file_name = ($name)? $name.'.'.$extension : $image->getClientOriginalName() ;
        $data = array('image' => base64_encode(file_get_contents($image->getRealPath())), 'name' => $file_name);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }else{
            return json_decode($result, true);
        }
        curl_close($ch);
    }

}
