<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intervencion; 

class IntervencionController extends Controller
{
    //Obtiene todas las intervenciones
    public function index()
    {
        return Intervencion::all();
    }

    //Obtiene la intervención con un id determinado
    public function show($id)
    {
        return Intervencion::find($id);
    }

    //Obtiene todas las intervenciones realizadas sobre una solicitud determinada
    public function search($idSolicitud)
    {
        return Intervencion::where('id_solicitud', $idSolicitud)->orderBy('created_at', 'desc')->get();
    }

    //Crea una intervención
    public function store(Request $request)
    {
        Intervencion::create($request->all());
        return response()->json('intervention created succesfully'); 
    }

    //Actualiza los datos de una intervención
    public function update(Request $request, $id)
    {
        Intervencion::findOrFail($id)->update($request->all());
        return response()->json('intervention updated succesfully'); 
    }

    //Elimina una intervención
    public function destroy($id)
    {
        Intervencion::findOrFail($id)->delete();
        return response()->json('intervention deleted succesfully');
    }
}
