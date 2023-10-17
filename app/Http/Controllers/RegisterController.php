<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);-> DD es igual a debuguear. Por medio de Request accedo a lo enviado en form
        //Modificar el request con add para evitar registros duplicados (aclarado en migracion)
        //slug convierte a minusculas, acentos y espacios
        $request->request->add(['username'=>Str::slug($request->username)]);
        //Validar: toma el request (lo que se envió y las validaciones)
        $this->validate($request, [
            'name'=> 'required|max:30',
            'username'=> 'required|unique:users|min:3|max:20',
            'email'=> 'required|unique:users|email|max:60',
            'password'=> 'required|confirmed|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'username'=> $request->username,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);
        //Autenticar
        auth()->attempt([//es similar a session_start
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        //Redireccion
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
