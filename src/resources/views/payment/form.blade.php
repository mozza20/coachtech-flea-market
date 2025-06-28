<!DOCTYPE html>
<html>
<head>
    <title>Stripe支払い</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>購入手続き</h1>
    <form id="payment-form">
        <div id="card-element"><!-- Stripeのカード入力フォーム --></div>
        <button id="submit">支払う</button>
        <div id="error-message"></div>
    </form>

    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            // サーバーにintentを作らせる
            const res = await fetch("{{ route('payment.intent') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({})
            });

            const data = await res.json();

            const result = await stripe.confirmCardPayment(data.clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: 'テストユーザー'
                    }
                }
            });

            if (result.error) {
                document.getElementById('error-message').textContent = result.error.message;
            } else {
                if (result.paymentIntent.status === 'succeeded') {
                    window.location.href = "{{ route('payment.complete') }}";
                }
            }
        });
    </script>
</body>
</html>
