<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

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
            'password' => bcrypt(request('password')),
            'confirmation_code' => $confirmationCode
        ]);
    
        Mail::send('confirmation_code', ['confirmation_code' => $confirmationCode], function($message) use ($user) {
            $message->to($user->email, $user->name)->subject('Por favor confirma tu correo');
        });
    
        auth()->login($user);
        return redirect()->to('/login');
    }
    
    public function verify($code)
    {
        $user = User::where('confirmation_code', $code)->first();

        if(! $user)
        {
            return redirect('/');
        }

        $user->confirmed=true;
        $user->confirmation_code=null;
        $user->save();

        return redirect('/');
    }


    public function google(Request $request)
    {
        dd($user);
    }

}
