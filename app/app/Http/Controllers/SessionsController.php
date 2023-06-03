<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

use Stripe\Stripe;
use Stripe\Charge;

use App\Models\User;
use App\Models\Bid;
use App\Models\Moto;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        //request son los datos que le pasamos por el formulario de login, tenemos que indicar el name de cada campo
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'email or password is incorrect. Please try again'
            ]);
        }
        //Si conseguimos iniciar sesión, si el role del usuario es admin nos redirige a la vista admin
        //de lo contrario a home
        else {
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->to('/');
            }
        }
    }

    //para cerrar sesión
    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/');     //Cierra sesíon y nos lleva a la pagina de inicio
    }


    //Mostrar motos para usuario / 
    public function mostrarMotos()
    {
        $motos = Moto::paginate(12);
        $firstImages = [];

        foreach ($motos as $moto) {
            $firstImages[$moto->id] = $moto->images->first();
        }

        return view('home', compact('motos', 'firstImages'));
    }
    //Así podré usar esa variable en la vista


    public function show(Moto $moto, Image $foto)
    {
        return view('moto', compact('moto'), compact('foto'));
    }


    public function bid(Moto $moto)
    {
        return view('bid', compact('moto'));
    }

    public function madebid(Request $request, Moto $moto)
    {

        $request->validate([
            'highest_bid' => 'required|numeric|min:' . ($moto->highest_bid + 1),
        ]);

        
        $moto->update([
            'highest_bid'=>$request->highest_bid,
            'highest_bid_user_id'=>auth()->id(),
        ]);

        $bid = Bid::create([
            'user_id' => auth()->id(), // ID del usuario que realiza la puja
            'moto_id' => $moto->id, // ID de la moto que se está subastando
            'amount' => $request->highest_bid, // Monto de la puja
        ]);
        
        // return redirect()->route('user.mostrarMotos');
        return back();
    }

    
    public function pago(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        
        $token = $request->input('stripeToken');
        $monto = 1000; // Aquí puedes establecer el monto del pago
        
        try {
            $charge = Charge::create([
                'amount' => $monto,
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Descripción del pago'
            ]);
            
            // Aquí puedes agregar la lógica adicional después de que el pago se haya procesado correctamente
            
            return redirect()->back()->with('success', 'Pago exitoso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}

