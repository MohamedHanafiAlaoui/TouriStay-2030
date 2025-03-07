<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Paiement</h1>
            <p class="text-gray-600 mb-4">Total à payer : <strong>{{ $totalPrice }} MAD</strong></p>

            <!-- Formulaire de paiement avec Stripe -->
            <form id="payment-form" action="/touriste/payment/process" method="POST">
                @csrf

                <input type="hidden" name="startDate" value="{{ $startDate }}">
            <input type="hidden" name="endDate" value="{{ $endDate }}">
            <input type="hidden" name="annonce_id" value="{{ $annonceId }}">


                <input type="hidden" name="amount" value="{{ $totalPrice }}">

                <div id="card-element" class="border p-3 rounded-lg bg-gray-50"></div>

                <div id="card-errors" class="text-red-500 mt-2"></div>

                <button id="pay-button" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mt-4 w-full">
                    Payer maintenant
                </button>
            </form>
        </div>
    </div>

    <script>
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        var elements = stripe.elements();
        var card = elements.create("card");
        card.mount("#card-element");

        var form = document.getElementById("payment-form");
        var payButton = document.getElementById("pay-button");
        var cardErrors = document.getElementById("card-errors");

        form.addEventListener("submit", function(event) {
            event.preventDefault();
            payButton.disabled = true;
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    cardErrors.textContent = result.error.message;
                    payButton.disabled = false;
                } else {
                    var hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "stripeToken");
                    hiddenInput.setAttribute("value", result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
