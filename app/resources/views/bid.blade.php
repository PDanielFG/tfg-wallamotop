    @extends('layouts.app')

    @section('title', 'Upload')


    @section('content')

        {{-- <div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200 rounded-lg shadow-lg">
            <h1 class="text-3xl text-center font-bold">Introduzca el nuevo precio de la puja</h1>

            <form class="mt-4" method="POST" action="{{ route('moto.madebid', $moto) }}" enctype="multipart/form-data"
                accept="image/*"> --}}

                {{-- cuiado con esto por dios --}}
                {{-- @csrf
                @method('PUT')

            
                <div class="mb-4">
                    <input type="number"
                        class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white"
                        placeholder="Puja" id="highest_bid" name="highest_bid">
                </div>

                @error('highest_bid')
                    <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
                @enderror


                <button type="submit"
                    class="rounded-md bg-green-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-green-600">Enviar</button>


            </form>



        </div> --}}

        <div class="container mt-5">
            <h1>Formulario de Precio</h1>
            <form>
              <div class="form-group">
                <label for="precio">Nuevo Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingrese el nuevo precio">
              </div>
              <div class="form-group">
                <label for="rangoPrecio">Precio (Rango):</label>
                <input type="range" class="form-control-range" id="rangoPrecio" name="rangoPrecio" min="0" max="100" step="1">
              </div>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        





    @endsection


