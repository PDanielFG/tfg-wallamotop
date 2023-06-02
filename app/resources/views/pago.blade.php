@extends('layouts.app')

@section('title', 'Detalles del producto')


@section('content')
<h1>Realizar Pago</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('procesar-pago') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
    </div>
    <div id="card-element">
        <!-- Stripe.js generará el formulario de tarjeta de crédito aquí -->
    </div>
    <button type="submit">Pagar</button>
</form>

<script>
    // Configurar Stripe.js
    var stripe = Stripe('{{ config("services.stripe.key") }}');
    var elements = stripe.elements();

    var style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4"
            }
        }
    };

    var card = elements.create("card", { style: style });
    card.mount("#card-element");

    card.addEventListener("change", function (event) {
        var displayError = document.getElementById("card-errors");
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    });

    // Manejar el envío del formulario
    var form = document.getElementById("payment-form");
    form.addEventListener("submit", function (event) { 
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById("payment-form");
        var hiddenInput = document.createElement("input");
        hiddenInput.setAttribute("type", "hidden");
        hiddenInput.setAttribute("name", "stripeToken");
        hiddenInput.setAttribute("value", token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
</body>
@endsection