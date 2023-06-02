<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">



    @yield('css')


    <style>

        body{
          background-color: #838383;
        }

        @media screen and (min-width:992px){
      .nav-item {
      line-height:80px;
      }
    }
    </style>
    
    


    <title>@yield('title') - Laravel App</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger" style="height: 80px;" id="headerNav">

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link mx-3 active" aria-current="page" href="#" style="font-size: larger;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-3" href="#" style="font-size: larger;">Products</a>
        </li>
        <li class="nav-item d-none d-lg-block" style="padding-top: 10px;">
          <a class="nav-link mx-3" href="#">
            <img src="{{ asset('images/locorojoCopia.png') }}" width="90px" height="90px" style="border-radius: 13%;">
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-3" href="#" style="font-size: larger; ">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link mx-3 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: larger;">
            Company
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Blog</a></li>
            <li><a class="dropdown-item" href="#">About Us</a></li>
            <li><a class="dropdown-item" href="#">Contact us</a></li>
          </ul>
        </li>
      </ul>
    </div>
  <!-- </div> -->
</nav>


    @yield('content')

    <script src="js/simplyCountdown.min.js"></script>
    <script src="js/countdown.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    @yield('js')

    </body>
    </html>