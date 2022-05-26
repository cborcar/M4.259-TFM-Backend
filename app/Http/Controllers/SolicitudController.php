<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud; 

class SolicitudController extends Controller
{
    //Obtiene todas las solicitudes ordenadas por fecha de creación
    public function index()
    {
        return Solicitud::orderBy('created_at', 'desc')->get();
    }

    //Obtiene la solicitud con un id determinado
    public function show($id)
    {
        return Solicitud::find($id);
    }

    //Obtiene todas las solicitudes que coincidan con un estado determinado
    public function search($estado)
    {
        if ($estado == "Pendientes") {
            return Solicitud::where('estado', 'Abierta')->orWhere('estado', 'Retrasada')->orderBy('created_at', 'desc')->get();
        }
        if ($estado == "Todas") {
            return Solicitud::orderBy('created_at', 'desc')->get();
        }
        return Solicitud::where('estado', $estado)->orderBy('created_at', 'desc')->get();
    }

    //Crea una solicitud
    public function store(Request $request)
    {
        Solicitud::create($request->all());
        return response()->json('request created succesfully'); 
    }

    //Actualiza los datos una solicitud
    public function update(Request $request, $id)
    {
        Solicitud::findOrFail($id)->update($request->all());
        return response()->json('request updated succesfully'); 
    }

    //Actualiza el estado de una solicitud
    public function updateStatus($id, $estado)
    {
        Solicitud::where('id', $id)->update(array('estado' => $estado));
        return response()->json('status updated succesfully'); 
    }

    //Elimina una solicitud
    public function destroy($id)
    {
        Solicitud::findOrFail($id)->delete();
        return response()->json('request deleted succesfully');
    }
}
