<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\Moto;
use App\Models\Image;
use App\Models\User;

use Carbon\Carbon;



class AdminController extends Controller
{
    public function index()
    {
        $motos = Moto::paginate(12);

        $firstImages = [];
        $countdowns = [];
        $pujasMotos = [];

        foreach ($motos as $moto) {
            $firstImages[$moto->id] = $moto->images->first();

            // Calcular el tiempo restante para la moto actual
            $fecha_finalizacion = Carbon::parse($moto->ending_date);
            $now = Carbon::now();
            $diff = $fecha_finalizacion->diff($now);

            $countdowns[$moto->id] = [
                'days' => $diff->d,
                'hours' => $diff->h,
                'minutes' => $diff->i,
                'seconds' => $diff->s
            ];

            $maxBid = $moto->bids()->max('amount');
            $bid = $moto->bids()->where('amount', $maxBid)->first();

            if ($bid) {
                $user = User::find($bid->user_id);
                $pujasMotos[$moto->id] = [
                    'user_id' => $user->id,
                    'user_name'=>$user->name,
                    'moto_id'=>$moto->id,
                    'amount' => $bid->amount,
                ];
            }
        }

        return view('admin.dashboard', compact('motos', 'firstImages', 'countdowns', 'pujasMotos'));
    }


    


    public function create()
    {
        return view('admin.upload');
    }


    public function uploadData(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'starting_price' => 'required',
            'category'=>'required',
            'ending_date'=>'required|date|after_or_equal:today', // Agregamos validación para fecha
            'imagen.*' => 'required|image'
        ]);

        $moto = Moto::create([
            'name' => $request->name,
            'description' => $request->description,
            'starting_price' => $request->starting_price,
            'category'=>$request->category,
            'highest_bid' => $request->starting_price,
            'ending_date'=>$request->ending_date
        ]);
        
        foreach ($request->file('imagen') as $imagen) {
            $url = Storage::url($imagen->store('public/imagenes'));

            Image::create([
                'moto_id' => $moto->id,
                'url_image' => $url
            ]);
        }


        return redirect()->to('admin');
    }



    public function showAdmin(Moto $moto, Image $foto)
    {
        return view('moto', compact('moto'), compact('foto'));
    }

    public function delete($id)
    {
        Moto::destroy($id);
        return back();
    }

    public function edit(Moto $moto)
    {
        return view('admin.edit', compact('moto'));
    }

    public function update(Request $request, Moto $moto)
    {
        $moto->update([
            'name' => $request->name,
            'description'=>$request->description,
            'starting_price' =>$request->starting_price

        ]);

        if ($request->hasFile('imagen')) {
            foreach ($request->file('imagen') as $imagen) {
                $url = Storage::url($imagen->store('public/imagenes'));
                Image::create([
                    'moto_id' => $moto->id,
                    'url_image' => $url
                ]);
            }
        }
    
        // obtener las imágenes actualizadas
        $moto->load('images');
    
        //De esta forma no tengo que volver a escribir el código del método index aquí, hay que poner redirect()->route() para que no muestre la ruta 
        //sino para que nos redirija
        return redirect()->route('admin.index');


    }


}
    

