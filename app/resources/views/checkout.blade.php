<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{ asset('/css/checkout.css') }}">


    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 30%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .form-row {
            margin-bottom: 10px;
        }

        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: larger;
        }

        #card-errors {
            color: red;
            margin-top: 10px;
        }

        .submit-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

</head>
<body>
    
    <div class="form-container">
        <form id="payment-form">
            <div class="form-row">
                <label for="card-element" style="font-size: larger; margin-bottom: 10px;">
                    Credit or debit card
                </label>
                <div id="card-element" style="height: 50px"></div>
                <div id="card-errors" role="alert"></div>
            </div>
            <!-- Campo oculto para el precio de la moto -->
            <input type="hidden" id="precio-moto" value="{{ $motoObjeto->highest_bid }}">
            
            <button class="submit-btn" type="submit" style="margin-top: 10px;">Pay Now</button>
        </form>
        <div id="payment-result"></div>
    </div>

<script>
    // Configura tu clave pública de Stripe
    var stripe = Stripe('pk_test_51N8jrbF4e8NouFrl8uNgmc9Pxx0FMBpo0ylH1TqDqvYxmqQuGY55iN3ncLG8grTpC9D937lVIUkqJYUUB0WDxx9L00EPyUj3AO');

    // Crea una instancia de elementos de Stripe
    var elements = stripe.elements();

    // Establece los estilos de los elementos de entrada de tarjeta
    var style = {
      base: {
        fontSize: '16px',
        color: '#32325d',
        
      }
    };

    // Crea el elemento de entrada de tarjeta y monta en el DOM
    var cardElement = elements.create('card', { style: style });
    cardElement.mount('#card-element');

    // Maneja el evento de envío del formulario
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      // Deshabilita el botón de pago para evitar múltiples clics
      form.querySelector('button').disabled = true;

      // Crea un token de tarjeta y realiza la solicitud de pago
      stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
          // Muestra un mensaje de error si la tarjeta es inválida
          var errorElement = document.getElementById('payment-result');
          errorElement.textContent = result.error.message;
        } else {
          // Envía el token a tu servidor para realizar el pago
          stripeTokenHandler(result.token);
        }
      });
    });

    // Función para enviar el token de pago a tu servidor
    function stripeTokenHandler(token) {
      // Obtén el precio de la moto del campo oculto
      var precioMoto = document.getElementById('precio-moto').value;

      // Envía el token y el precio de la moto a tu servidor
      fetch('/procesar-pago', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ token: token.id, precioMoto: precioMoto })
      })
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        // Maneja la respuesta de tu servidor
        var resultElement = document.getElementById('payment-result');
        resultElement.textContent = data.message;
      });
    }
</script>
</body>
</html>
