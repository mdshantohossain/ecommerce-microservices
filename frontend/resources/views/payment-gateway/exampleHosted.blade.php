<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Example - Hosted Checkout | SSLCommerz</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="py-5 text-center">
        <h2>Hosted Payment - SSLCommerz</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. We have provided this sample form for understanding Hosted Checkout Payment with SSLCommerz.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">

                @if($payment_method == 0)

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Your need to pay your delivery charge is {{ $delivery_charge. 'Tk' }}</h6>
                    </div>
                </li>

                @else
                    @foreach(Cart::content() as $cartItem)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $cartItem->name }}</h6>
                            <small class="text-muted">{{ $cartItem->qty }}</small>
                        </div>
                        <span class="text-muted">{{ $cartItem->price. 'Tk' }}</span>
                    </li>
                    @endforeach
                @endif

                @if(session('payment_method') != 0)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong>{{ Cart::subTotal() + $delivery_charge }} TK</strong>
                    </li>
                @endif

            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName">Full name</label>
                        <input type="text" name="customer_name"  class="form-control" id="customer_name" placeholder=""
                               value="{{ auth()->user()->name }}" required />
                        <div class="invalid-feedback">
                            Valid customer name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile">Mobile</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+88</span>
                        </div>
                        <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile"
                               value="{{ auth()->user()?->phone }}" />
                        <div class="invalid-feedback" style="width: 100%;">
                            Your Mobile number is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="customer_email" class="form-control" id="email"
                           placeholder="you@example.com" value="{{ auth()->user()->email }}" />
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="delivery_address" placeholder="123 Main St">{{ session('delivery_address') }}</textarea>

                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout (Hosted)</button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</html>
