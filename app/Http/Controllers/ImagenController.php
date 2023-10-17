<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');//obtenes el request de la imagen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();//le damos un nombre unico
        $imagenServidor= Image::make($imagen);//Es la que se va almacenar en el servidor
        $imagenServidor->fit(1000, 1000);//fit es un efecto de intervention image
        $imagenPath = public_path('uploads') . '/' . $nombreImagen; //El path seria el id unico
        $imagenServidor->save($imagenPath);
        return response()->json(['imagen' => $nombreImagen]);
    }
}
