<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuarios ;
use App\Models\Tipos;
use App\Models\Aulas;
use App\Models\Agendas;
use App\Http\Resources\Agendas as AgendasResource;
use lluminate\Http\Response;
use Validator;

class AgendaController extends Controller
{   
    protected function validarAgenda($request){
        $validator = Validator::make($request->all(),[
          'aula_id' => 'required|numeric',
          'usuario_id' => 'required|numeric',
          'status' =>'required|numeric|max:4',
          
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
            $agendas = Agendas::paginate(5);
            return AgendasResource::collection($agendas);
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
            $validator = $this->validarAgenda($request);
            if($validator->fails()){
              return response()->json(['message'=>'Erro','errors'=> $validator->errors()],400);
            }
            
            $agendas = new Agendas;
            $agendas->aula_id = $request->input('aula_id');
            $agendas->usuario_id = $request->input('usuario_id');
            $agendas->status = $request->input('status');
          
            $aula_id = $request->input('aula_id');
            if(!Aulas::find($aula_id)){
                return response()->json(['message'=>'Erro. Aula a ser relacionada não existe !'],404);
              }
            $usuario_id = $request->input('usuario_id');
            if(!Usuarios::find($usuario_id)){
              return response()->json(['message'=>'Erro','Usuario a ser relacionado não existe !'],404);
            }
            
            if( $agendas->save() ){
              return new AgendasResource( $agendas );
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
            $agendas = Agendas::findOrFail($id);
            return new AgendasResource( $agendas );
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
            $agendas = Agendas::findOrFail( $request->id );
            //$agendas->aula_id = $request->input('aula_id');
            //$agendas->usuario_id = $request->input('usuario_id');
            $agendas->status = $request->input('status');
    
            if( $agendas->save() ){
              return new AgendasResource( $agendas );
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
            $agendas = Agendas::findOrFail( $id );
            if( $agendas->delete() ){
              //return new AulasResource( $aulas );
              return response()->json('Registro apagado com sucesso !',200);
            }
          }catch(\Exception $e){
            return response()->json('Ocorreu um erro no servidor',500);
          }
    }
}
