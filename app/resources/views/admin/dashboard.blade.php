    @extends('adminlte::page')

    @section('title', 'admin')

    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">

        <style>
            a:hover{
                text-decoration: none;
            }

            a:hover {
                color: inherit;
                text-decoration: none;
            }

            .slick-slider {
                width: 100%;
            }

            .slick-slider img {
                width: 100%;
            }

        </style>

    @endsection

    @section('content_header')
        <h1>Adminisración y gestión</h1>
    @endsection



    @section('content')
    <!-- Agregar el enlace a la librería de Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>

    <div class="container-fluid">
        <div class="row flex-wrap px-4">
            @foreach($motos as $moto)
                <div class="container mt-2 mb-5">
                    <div class="d-flex justify-content-center row">
                        <div class="col-md-10">
                            <div class="row p-2 bg-white border rounded">
                                <div class="col-md-3 mt-1"><img src="{{ asset($firstImages[$moto->id]->url_image) }}" alt="Imagen de la moto" class="w-100 d-none d-sm-block"></div>
                                <div class="col-md-6 mt-1">
                                    <h5 class="mt-2">{{$moto->name}}</h5>
                                    <div class="mt-3 mb-1 spec-1"><span>{{$moto->description}}</span></div>
                                    <div class="d-flex flex-column">
                                        <span class="text-muted">Quedan:</span>
                                        <div id="cuenta-{{ $moto->id }}"></div>
    
                                    </div>
                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left mt-2">
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1">Puja Inicial: </h4><span class="strike-text">{{$moto->starting_price}} €</span>
                                    </div>
                                    
                                    <div class="d-flex flex-row align-items-center">
                                        <h4 class="mr-1">Puja actual: </h4><span class="strike-text">{{$moto->highest_bid}} €</span>
                                    </div>
                                    

                                    <div class="d-flex flex-column mt-5">
                                        <button class="btn btn-primary btn-sm" type="button" onclick="window.location.href = '{{ route('motoAdmin.edit', $moto)}}'">Modificar</button>
                                        {{-- <button class="btn btn-outline-primary btn-sm mt-2" onclick="window.location.href = '{{ route('motoAdmin.delete', $moto->id)}}'" type="button">Eliminar</button> --}}
                                        
                                        <form action="{{ route('motoAdmin.delete', $moto->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-primary btn-sm mt-2 w-100" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>


            @endforeach
        </div>
    </div>

    {{ $motos->links() }}
    @endsection


    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Recorremos las motos y para cada una iniciamos un contador
            @foreach($motos as $moto)
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
            @endforeach
        });
    </script>

    @endsection


