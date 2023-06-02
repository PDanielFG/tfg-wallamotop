<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {

        $this->validate(request(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);

        $user=User::create(request(['name', 'email', 'password'])); //Almacenamos en $user, lo que obtenemos del formulario de los campos con nombre name, email, password

        auth()->login($user);		//Cuando nos registremos nos inicie sesion
        return redirect()->to('/login');	//Redireccionamos a la pagina raíz
    }

    public function google($user)
    {
        dd($user);
    }

}
