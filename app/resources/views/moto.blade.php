@extends('layouts.app')

@section('title', 'Detalles del producto')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    
    <link rel="stylesheet" href="{{asset('/css/moto.css')}}">
@endsection

@section('content')
        

    <div class="container">
        <div class="col-lg-8 border p-5 main-section bg-white">
            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">

                    @php
                        $primeraImagen = true;
                    @endphp

                    @foreach ($moto->images as $foto)
                        @if ($primeraImagen)
                            <a href="{{ asset($foto->url_image) }}" data-lightbox="product-images">
                                <img class="w-full object-cover h-48 rounded-md shadow-md" src="{{ asset($foto->url_image) }}" alt="{{$moto->name}}">
                            </a>
                            @php
                                $primeraImagen = false;
                            @endphp
                        @endif
                    @endforeach

                    <span class="sub-img">
                        @foreach ($moto->images as $foto)
                            <a href="{{ asset($foto->url_image) }}" data-lightbox="product-images">
                                <img class="w-full object-cover h-48 rounded-md shadow-md" src="{{ asset($foto->url_image) }}"
                                    alt="{{ $moto->name }}">
                            </a>
                        @endforeach
                    </span>
                </div>
                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="m-0 p-0">{{$moto->name}}</p>
                            </div>
                            <div class="col-lg-12">
                                <p class="m-0 p-0 price-pro">{{$moto->highest_bid}}€</p>
                                <hr class="p-0 m-0">
                            </div>
                            <div class="col-lg-12 pt-2">
                                <h5>Product Detail</h5>
                                <span>{{$moto->description}}</span>
                                <hr class="m-0 pt-2 mt-2">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <p class="tag-section"><strong>Precio inicial: </strong><span class="ml-2">{{$moto->starting_price}}</span></p>
                                <p class="tag-section"><strong>Puja actual: </strong><span class="ml-2">{{$moto->highest_bid}}</span></p>
                                <p class="tag-section"><strong>Fecha de finalización:</strong> <span class="ml-2">{{$moto->ending_date}}</span></p>
                                <p class="tag-section"><strong>Quedan: </strong><span class="ml-2" id="cuenta-{{ $moto->id }}"></span></p>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6 pb-2">
                                        {{-- <a href="#" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Pujar</a> --}}
                                        <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#exampleModalCenter">Pujar </button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="#" class="btn btn-success w-100">Añadir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container mt-5">
                <h1>Formulario de Precio</h1>
                <form action="{{ route('moto.madebid', $moto) }}" method="POST" id="puja">
                    <input type="hidden" name="inputHidden" value={{$moto->id}}>

                    @csrf
                    {{-- @method('PUT') --}}
                  <div class="form-group">
                    <label for="precio">Nuevo Precio:</label>
                    <input type="number" class="form-control" id="highest_bid" name="highest_bid" placeholder="Ingrese el nuevo precio">
                </div>
                  {{-- <div class="form-group">
                    <label for="rangoPrecio">Precio (Rango):</label>
                    <input type="range" class="form-control-range" id="rangoPrecio" name="rangoPrecio" min="0" max="100" step="1">
                  </div> --}}
                  <button type="submit" name="submit" class="btn btn-primary">Guardar</button>


               
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>




    
@endsection

@section('js')
<script>

    var countDownDate{{ $moto->id }} = new Date("{{ $moto->ending_date }}").getTime();
    var ended{{ $moto->id }} = false;
    
    var x{{ $moto->id }} = setInterval(function() {
        // Verificamos si la subasta ha terminado
        if (ended{{ $moto->id }}) {
            return;
        }
        
        var now{{ $moto->id }} = new Date().getTime();
        
        var distance{{ $moto->id }} = countDownDate{{ $moto->id }} - now{{ $moto->id }};
        
        var days{{ $moto->id }} = Math.floor(distance{{ $moto->id }} / (1000 * 60 * 60 * 24));
        var hours{{ $moto->id }} = Math.floor((distance{{ $moto->id }} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes{{ $moto->id }} = Math.floor((distance{{ $moto->id }} % (1000 * 60 * 60)) / (1000 * 60));
        var seconds{{ $moto->id }} = Math.floor((distance{{ $moto->id }} % (1000 * 60)) / 1000);
        
        var countdown{{ $moto->id }} = '';
        
        if (days{{ $moto->id }} > 0) {
            countdown{{ $moto->id }} += days{{ $moto->id }} + "d ";
        }
        
        countdown{{ $moto->id }} += hours{{ $moto->id }} + "h ";
        countdown{{ $moto->id }} += minutes{{ $moto->id }} + "m ";
        countdown{{ $moto->id }} += seconds{{ $moto->id }} + "s";
        
        // Actualizamos el elemento HTML correspondiente
        document.getElementById("cuenta-{{ $moto->id }}").innerHTML = countdown{{ $moto->id }};
        
        // Si el contador llega a cero, lo detenemos y actualizamos la vista
        if (distance{{ $moto->id }} < 0) {
            clearInterval(x{{ $moto->id }});
            document.getElementById("cuenta-{{ $moto->id }}").innerHTML = "Subasta cerrada";
            document.getElementById("info-{{ $moto->id }}").style.display = "block"; // Mostrar información adicional
            ended{{ $moto->id }} = true;
        }
    }, 1000);
    

    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>



@endsection