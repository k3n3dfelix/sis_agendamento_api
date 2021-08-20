<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuarios as Usuarios;
use App\Http\Resources\usuarios as UsuariosResource;
use lluminate\Http\Response;
use Validator;

class UsuarioController extends Controller

{
    protected function validarUsuario($request){
      $validator = Validator::make($request->all(),[
        'tipo_id' => 'required|numeric',
        'nome' =>'required',
        'sobrenome' =>'required',
        'login' =>'required',
        'senha' =>'required|min:3',
      ]);
      return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuarios::paginate(5);
        return UsuariosResource::collection($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = $this->validarusuario($request);
        if($validator->fails()){
          return response()->json(['message'=>'Erro','errors'=> $validator->errors()],400);
        }
        $usuarios = new Usuarios;
        $usuarios->tipo_id = $request->input('tipo_id');
        $usuarios->nome = $request->input('nome');
        $usuarios->sobrenome = $request->input('sobrenome');
        $usuarios->login = $request->input('login');
        $senha= bcrypt($request->input('senha'));
        $usuarios->senha = $senha;
        
    
        if( $usuarios->save() ){
          return new UsuariosResource( $usuarios );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuarios = Usuarios::findOrFail($id);
        return new UsuariosResource( $usuarios );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuarios = Usuarios::findOrFail( $request->id );
        $usuarios->tipo_id = $request->input('tipo_id');
        $usuarios->nome = $request->input('nome');
        $usuarios->sobrenome = $request->input('sobrenome');
        $usuarios->login = $request->input('login');
        $senha= bcrypt($request->input('senha'));
        $usuarios->senha = $senha;
    
        if( $usuarios->save() ){
          return new UsuariosResource( $usuarios );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Usuarios::findOrFail( $id );
        if( $usuarios->delete() ){
          return new UsuariosResource( $usuarios );
        }
    }
}
