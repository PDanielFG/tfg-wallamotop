<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\TestMail;
use Mail;
use Illuminate\Support\Facades\URL;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }




    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $confirmationCode = Str::random(25);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'confirmation_code' => $confirmationCode
        ]);

        $confirmationLink = URL::signedRoute('confirmation', ['code' => $confirmationCode]);

        Mail::send('testmail', ['user' => $user, 'confirmationLink' => $confirmationLink], function($message) use ($user) {
            $message->to($user->email, $user->name)->subject('Por favor confirma tu correo');
        });

        auth()->login($user);
        return redirect()->to('/login');
    }

    
    public function confirmEmail($code)
    {
        $user = User::where('confirmation_code', $code)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->confirmation_code = null;
            $user->save();

            // Puedes realizar otras acciones aquí, como redirigir a una página de éxito o mostrar un mensaje al usuario

            return redirect()->to('/');
        } else {
            // El código de confirmación no es válido, puedes mostrar un mensaje de error o redirigir a una página de error
            return redirect()->to('/invalid-confirmation');
        }
    }



    public function google(Request $request)
    {
        dd($user);
    }

}
