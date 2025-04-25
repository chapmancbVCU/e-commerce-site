<?php use Core\Lib\Utilities\Env; ?>
<?php $this->setSiteTitle("Checkout"); ?>

<!-- Body content between these two function calls. -->
<?php $this->start('body'); ?>
<script src="https://js.stripe.com/v3/"></script>
<form action="/charge" method="post" id="payment-form">
    <div class="form-row">
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element">

        </div>

        <div id="card-errors" role="alert">

        </div>

        <button>Submit Payment</button>
    </div>
</form>

<script>
    // Set your publishable key: remember to change this to your live publishable key in production
    // See your keys here: https://dashboard.stripe.com/apikeys
    const stripe = Stripe("<?=Env::get('STRIPE_PUBLIC')?>");
    const elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    const style = {
    base: {
        // Add your base input styles here. For example:
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        },
        color: '#32325d',
        fontFamily: '"Helvetica Nue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased'
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };

    // Create an instance of the card Element.
    const card = elements.create('card', {style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Create a token or display an error when the form is submitted.
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const {token, error} = await stripe.createToken(card);

    if (error) {
        // Inform the customer that there was an error.
        const errorElement = document.getElementById('card-errors');
        errorElement.textContent = error.message;
    } else {
        // Send the token to your server.
        stripeTokenHandler(token);
    }
    });

    const stripeTokenHandler = (token) => {
    // Insert the token ID into the form so it gets submitted to the server
    const form = document.getElementById('payment-form');
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
    }
</script>
<?php $this->end(); ?>
