<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tipos as Tipos;
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
        $tipos = Tipos::paginate(5);
        return TiposResource::collection($tipos);

       
    }

    public function show($id){
        $tipos = Tipos::findOrFail( $id );
        return new TiposResource( $tipos );
      }
    
      public function store(Request $request){
        $tipos = new Tipos;
        $tipos->descricao = $request->input('descricao');
        
    
        if( $tipos->save() ){
          return new TiposResource( $tipos );
        }
      }
    
       public function update(Request $request){
        $tipos = Tipos::findOrFail( $request->id );
        $tipos->descricao = $request->input('descricao');
    
        if( $tipos->save() ){
          return new TiposResource( $tipos );
        }
      } 
    
      public function destroy($id){
        $tipos = Tipos::findOrFail( $id );
        if( $tipos->delete() ){
          return new TiposResource( $tipos );
        }
    /*public function liste(){
        $beers=['Skol','brahma'];

        return response()->json($beers, 200);
    } */
      }
    
}
