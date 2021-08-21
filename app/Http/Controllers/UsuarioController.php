<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuarios ;
use App\Models\Tipos;
use App\Http\Resources\Usuarios as UsuariosResource;
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
      try{ 
        $usuarios = Usuarios::paginate(5);
        return UsuariosResource::collection($usuarios);
      }catch(\Exception $e){
        return response()->json('Ocorreu um erro no servidor',500);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
      try{
        $validator = $this->validarUsuario($request);
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
        
        $tipo = $request->input('tipo_id');
        if(!Tipos::find($tipo)){
          return response()->json(['message'=>'Erro','Tipo a ser relacionado não existe !'],404);
        }
        
        if( $usuarios->save() ){
          return new UsuariosResource( $usuarios );
        }
      }catch(\Exception $e){
        return response()->json('Ocorreu um erro no servidor',500);
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
      try{
        $usuarios = Usuarios::findOrFail($id);
        return new UsuariosResource( $usuarios );
      }catch(\Exception $e){
        return response()->json('Ocorreu um erro no servidor',500);
      }
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
      try{
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
      }catch(\Exception $e){
        return response()->json('Ocorreu um erro no servidor',500);
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
      try{
        $usuarios = Usuarios::findOrFail( $id );
        if( $usuarios->delete() ){
          //return new UsuariosResource( $usuarios );
          return response()->json('Registro apagado com sucesso !',200);
        }
      }catch(\Exception $e){
        return response()->json('Ocorreu um erro no servidor',500);
      }
    }
}
