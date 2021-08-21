<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuarios ;
use App\Models\Tipos;
use App\Models\Aulas;
use App\Http\Resources\Aulas as AulasResource;
use lluminate\Http\Response;
use Validator;

class AulaController extends Controller
{
    protected function validarAula($request){
        $validator = Validator::make($request->all(),[
          'usuario_id' => 'required|numeric',
          'materia' =>'required',
          'data' =>'required',
          'hora' =>'required',
          
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
            $aulas = Aulas::paginate(5);
            return AulasResource::collection($aulas);
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
            $validator = $this->validarAula($request);
            if($validator->fails()){
              return response()->json(['message'=>'Erro','errors'=> $validator->errors()],400);
            }
            
            $aulas = new Aulas;
            $aulas->usuario_id = $request->input('usuario_id');
            $aulas->materia = $request->input('materia');
            $aulas->data = $request->input('data');
            $aulas->hora = $request->input('hora');
          
            $usuario_id = $request->input('usuario_id');
            if(!Usuarios::find($usuario_id)){
              return response()->json(['message'=>'Erro','Usuario a ser relacionado não existe !'],404);
            }
            
            if( $aulas->save() ){
              return new AulasResource( $aulas );
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
            $aulas = Aulas::findOrFail($id);
            return new AulasResource( $aulas );
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
            $aulas = Aulas::findOrFail( $request->id );
            $aulas->usuario_id = $request->input('usuario_id');
            $aulas->materia = $request->input('materia');
            $aulas->data = $request->input('data');
            $aulas->hora = $request->input('hora');
           
            if( $aulas->save() ){
              return new AulasResource( $aulas );
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
            $aulas = Aulas::findOrFail( $id );
            if( $aulas->delete() ){
              //return new AulasResource( $aulas );
              return response()->json('Registro apagado com sucesso !',200);
            }
          }catch(\Exception $e){
            return response()->json('Ocorreu um erro no servidor',500);
          }
    }
}
