<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tailwindcss-colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/payement.css') }}">
    <title>Payment for {{ $event->title }}</title>
</head>
<body>
    
    <!-- Start: Payment -->
    <section class="payment-section">
        <div class="container">
            <div class="payment-wrapper">
                <div class="payment-left">
                    <div class="payment-header">
                        <div class="payment-header-icon"><i class="ri-flashlight-fill"></i></div>
                        <div class="payment-header-title">{{ $event->title }}</div> 
                    </div>
                    <div class="payment-content">
                        <div class="payment-body">
                            <div class="payment-plan">
                                <div class="payment-plan-type">Pro</div>
                                <div class="payment-plan-info">
                                    <div class="payment-plan-info-name">{{ $event->title }} Plan</div>
                                    <div class="payment-plan-info-price">{{ number_format($event->price, 2) }} Dh per ticket</div>
                                </div>
                                <!-- Here you might want to link to a change plan page or similar functionality -->
                                <!-- <a href="#" class="payment-plan-change">Change</a> -->
                            </div>
                            <div class="payment-summary">
                                <div class="payment-summary-divider"></div>
                                <div class="payment-summary-item payment-summary-total">
                                    <div class="payment-summary-name">Total</div>
                                    <div class="payment-summary-price">{{ number_format($event->price, 2) }} Dh</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <form action="{{ route('components.payment.process', ['eventId' => $event->id]) }}" method="POST" class="payment-form">
                        @csrf
                        <h1 class="payment-title">Payment Details</h1>
                        <div class="payment-method">
                            <!-- Payment Method Options -->
                            <input type="radio" name="payment-method" id="method-1" value="visa" checked>
                            <label for="method-1" class="payment-method-item">
                                <img src="{{ asset('images/visa.png') }}" alt="Visa">
                            </label>
                            <input type="radio" name="payment-method" id="method-2" value="mastercard">
                            <label for="method-2" class="payment-method-item">
                                <img src="{{ asset('images/mastercard.png') }}" alt="Mastercard">
                            </label>
                            <input type="radio" name="payment-method" id="method-3" value="paypal">
                            <label for="method-3" class="payment-method-item">
                                <img src="{{ asset('images/paypal.png') }}" alt="PayPal">
                            </label>
                        </div>
                        <div class="payment-form-group">
                            <input type="email" placeholder=" " class="payment-form-control" id="email" required name="email">
                            <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                        </div>
                        <div class="payment-form-group">
                            <input type="text" placeholder=" " class="payment-form-control" id="card-number" required name="card_number">
                            <label for="card-number" class="payment-form-label payment-form-label-required">Card Number</label>
                        </div>
                        <div class="payment-form-group-flex">
                            <div class="payment-form-group">
                                <input type="date" placeholder=" " class="payment-form-control" id="expiry-date" required name="expiry_date">
                                <label for="expiry-date" class="payment-form-label payment-form-label-required">Expiry Date</label>
                            </div>
                            <div class="payment-form-group">
                                <input type="text" placeholder=" " class="payment-form-control" id="cvv" required name="cvv">
                                <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                            </div>
                        </div>
                        <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    

</body>
</html>
