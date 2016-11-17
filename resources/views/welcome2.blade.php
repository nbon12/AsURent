@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('checkout/'.$contract) }}" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="{{$pk}}"
    data-name="AsURent"
    data-description="Monthly Subscription"
    data-amount="{{$rate}}"
    data-label="Pay">
  </script>
</form>
</div>

@endsection
