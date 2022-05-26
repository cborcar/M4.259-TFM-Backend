<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; 
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //Obtiene todos los usuarios ordenados por apellidos
    public function index() {
        return Usuario::orderBy('apellidos', 'asc')->get();
    }

    //Obtiene el usuario logueado
    public function user(Request $request){
        return $request->user();
    }

    //Obtiene el usuario con un id determinado
    public function show($id)
    {
        return Usuario::find($id);
    }

    //Crea un usuario con contraseña cifrada
    public function register(UserRegisterRequest $request)
    {
        Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => 'blank.png',
            'perfil' => $request->perfil,
        ]);
        return response()->json('user created succesfully');
    }

    //Actualiza los datos de un usuario
    public function update(Request $request, $id)
    {
        //Si el usuario no introdujo contraseña, no la tiene en cuenta.
        if ($request->password == '') {
            Usuario::findOrFail($id)->update([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'perfil' => $request->perfil,
            ]);
        }
        else {
            Usuario::findOrFail($id)->update([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'perfil' => $request->perfil,
            ]);
        }
        return response()->json('user updated succesfully'); 
    }

    //Sube y actualiza la imagen de perfil de un usuario
    public function updateUserImage(Request $request, $id) 
    {
        if ($request->hasFile('foto')) {
            $completeFileName = $request->file('foto')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $completeName = str_replace(' ', '_', $fileNameOnly).'-'.rand() . '_'.time(). '.'.$extension;
            $path = $request->file('foto')->storeAs('public/userImages', $completeName);
            $request->foto = $completeName;
            Usuario::findOrFail($id)->update([
                'foto' => $request->foto,
            ]);
            return response()->json($completeName);
        }
    }   

    //Elimina un usuario
    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();
        return response()->json('usuario deleted succesfully');
    }
}
