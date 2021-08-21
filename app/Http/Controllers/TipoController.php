<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tipos;
use App\Http\Resources\Tipos as TiposResource;
use lluminate\Http\Response;

class TipoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {  
      try{
        $tipos = Tipos::paginate(5);
        return TiposResource::collection($tipos);
      }catch(\Exception $e){
        return response()->json('Ocorreu um erro no servidor',500);
      }

       
    }

    public function show($id)
    { 
      try{
        $tipos = Tipos::findOrFail( $id );
        return new TiposResource( $tipos );
      }catch(\Exception $e){
        return response()->json('Ocorreu um erro no servidor',500);
      }
    }
    
      public function store(Request $request)
      { 
        try{
          $tipos = new Tipos;
          $tipos->descricao = $request->input('descricao');
        
          if( $tipos->save() ){
          return new TiposResource( $tipos );
          }
        }catch(\Exception $e){
          return response()->json('Ocorreu um erro no servidor',500);
        }
      }
    
      public function update(Request $request)
      {
        try{
          $tipos = Tipos::findOrFail( $request->id );
          $tipos->descricao = $request->input('descricao');
      
          if( $tipos->save() ){
            return new TiposResource( $tipos );
          }
        }catch(\Exception $e){
          return response()->json('Ocorreu um erro no servidor',500);
        }

      } 
    
      public function destroy($id)
      {
        try{
          $tipos = Tipos::findOrFail( $id );
          if( $tipos->delete() ){
            return new TiposResource( $tipos );
          }
        }catch(\Exception $e){
          return response()->json('Ocorreu um erro no servidor',500);
        }

    /*public function liste(){
        $beers=['Skol','brahma'];

        return response()->json($beers, 200);
    } */
      }
    
}
