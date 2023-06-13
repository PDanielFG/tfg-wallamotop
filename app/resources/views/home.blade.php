<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/products.css') }}">

</head>
<body>

    <section id="video-section">
        <video id="video-background" autoplay loop muted>
          <source src="videos/motorbike.mp4" type="video/mp4">
          <!-- Añadir más fuentes de video si es necesario para la compatibilidad con diferentes navegadores -->
        </video>
        <div id="slogan">
          <h1>Wallamotop</h1>
          <p>Interesados por el mundo de las dos ruedas, llegó vuestro sitio de pujas favorito</p>
        </div>
        <div class="verification-status">
            @if(auth()->check() && auth()->user()->email_verified_at)
                <p class="verified"> Estado de la cuenta: Verificada</p>
            @else
                <p class="not-verified">Estado de la cuenta: No Verificada</p>
            @endif
        </div>
      </section>


    <!--NAVBAR-->
    <div class="navbar">
        <a href="#video-section" class="fas fa-home" onclick="scrollOnClick(event, 'casa')"></a>
        <a href="#about" onclick="scrollOnClick(event, 'about')">About</a>
        <!-- <a href="#gallery">Gallery</a> -->
        <a href="#content" onclick="scrollOnClick(event, 'content')">Buy</a>
        <!-- <a href="#pages">Pages</a> -->
        <a href="#contact" onclick="scrollOnClick(event, 'contact')">Contact</a>
        <a href="{{ route('login.index') }}">Salir</a>
    </div>



    <div id="about" class="features">
        <div class="container">
        <!---728x90--->
    
            <div class="heading-setion-w3ls">
                <h1 class="title-w3layouts">What we Offer <i class="fa fa-bell-o" aria-hidden="true"></i><i class="fa fa-bell" aria-hidden="true"></i></h1>
            </div>
        <!---728x90--->
            <div class="col-md-4 servies-agileinfo">
            <p class="pink-w3ls">Motos al alcance de todos</p>
            <p class="para-w3agileits">Te ofrecemos la posibilidad de llevarte tu moto favorita al mejor precio gracias a nuestro sistema de pujas</p>
            </div>
            <div class="col-md-4 servies-agileinfo" id="segunda">
                <ul>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Motos de ocación</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Motos nuevas</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Motos revisadas</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Accesorios</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Piezas</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Atención al cliente</li>
                </ul>
            </div>
            <div class="col-md-4 servies-agileinfo">
                <ul>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Triciclos</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Quadriciclos</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Pujas</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Garantía del producto</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Devluciones</li>
                    <li><i class="fa fa-diamond" aria-hidden="true"></i>Satisfacción con el cliente</li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!---728x90--->
        </div>
    </div>




    

<section id="content">
  <div class="container">
    <div class="row w-100">
      @foreach ($motos as $moto)
        <div class="col-4 mb-5">
          <div class="card h-100 w-100 mt-5">
            @php
              $primeraImagen = true;
            @endphp

            @foreach ($moto->images as $foto)
              @if ($primeraImagen)
                <a href="{{ route('moto.show', $moto->id) }}">
                  <img class="card-img-top mb-3" width="100%" src="{{ asset($foto->url_image) }}" alt="{{ $moto->name }}">
                </a>
                @php
                  $primeraImagen = false;
                @endphp
              @endif
            @endforeach

            <div class="card-body">
              <div class="row">
                <div class="col">
                  <p class="text-muted mt-1">Precio inicial:</p>
                  <h6 class="mt-1">{{ $moto->starting_price }} €</h6>
                </div>
                <div class="col">
                  <p class="text-muted mt-1">Puja actual:</p>
                  <h6 class="mt-1">{{ $moto->highest_bid }} €</h6>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col">
                  <div class="d-flex flex-column">
                    <span class="text-muted">Fecha de finalización:</span>
                    <h5 class="mb-0">{{ $moto->ending_date }}</h5>
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <span class="text-muted">Quedan:</span>
                  <div id="cuenta-{{ $moto->id }}"></div>
                </div>
              </div>
              <hr>
              <div class="row p-3">
                <div class="col">
                  <p class="text-muted mb-1">Descripción</p>
                  <p>{{ $moto->description }}</p>
                </div>
              </div>
            </div>
            <div class="mb-3 mx-3">
              <a href="{{ route('moto.show', $moto->id) }}" class="btn btn-danger btn-block">
                <small>Ver</small>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>


<!-- Footer -->
<footer id="contact" class="page-footer font-small special-color-dark">

  <!-- Copyright -->
  <div class="footer-copyright text-center pt-2 pb-1">© 2023 Copyright:
    <a href="/"> wallamotop.com</a> <br>
    <i class="fas fa-envelope">  pedrodanielfg@gmail.com</i> <br>
    <i class="fas fa-envelope">  pfergue349@g.educaand.es</i> <br>
    <i class="fas fa-phone">  +34 727 71 02 81</i>
    <p>Pedro Daniel Fernández Guerrero</p>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->









        


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <script>


    function scrollOnClick(event, targetId) {
        event.preventDefault();

        const targetElement = document.querySelector(`#${targetId}`); // Obtén el elemento destino utilizando el ID
        
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop,
                behavior: 'smooth'
            });

            // Agrega la clase 'active' al enlace clicado para resaltarlo
            const links = document.querySelectorAll('.navbar a');
            links.forEach(function(link) {
                link.classList.remove('active');
            });
            targetElement.classList.add('active');
        }
    }




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
    
</body>
</html>



