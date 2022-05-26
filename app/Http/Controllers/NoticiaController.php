<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia; 

class NoticiaController extends Controller
{
    //Obtiene todas las noticias ordenadas por fecha de creación
    public function index()
    {
        return Noticia::orderBy('created_at', 'desc')->get();
    }

    //Obtiene la noticia con un id determinado
    public function show($id)
    {
        return Noticia::find($id);
    }

    //Obtiene las noticias en páginas de 10 noticias
    public function showPaginate($page)
    {
        return Noticia::paginate(10, ['*'], 'page', $page);
    }

    //Crea una noticia
    public function store(Request $request)
    {
        Noticia::create($request->all());
        return response()->json('news created succesfully'); 
    }

    //Actualiza los datos de una noticia
    public function update(Request $request, $id)
    {
        Noticia::findOrFail($id)->update($request->all());
        return response()->json('news updated succesfully'); 
    }

    //Elimina una noticia
    public function destroy($id)
    {
        Noticia::findOrFail($id)->delete();
        return response()->json('news deleted succesfully');
    }
}
