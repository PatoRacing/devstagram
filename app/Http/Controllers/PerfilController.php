<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index ()
    {
        return view('perfil.index');
    }

    public function store (Request $request)
    {
        $request->request->add(['username'=>Str::slug($request->username)]);

        $this->validate($request, [
            'username'=> ['required','unique:users', 'min:3', 'max:20', 'not_in:twitter,editar-perfil']
        ]);

        if($request->imagen) {
            $imagen = $request->file('imagen');//obtenes el request de la imagen
            $nombreImagen = Str::uuid() . "." . $imagen->extension();//le damos un nombre unico
            $imagenServidor= Image::make($imagen);//Es la que se va almacenar en el servidor
            $imagenServidor->fit(1000, 1000);//fit es un efecto de intervention image
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen; //El path seria el id unico
            $imagenServidor->save($imagenPath);
        } 
        //Guardar los cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
