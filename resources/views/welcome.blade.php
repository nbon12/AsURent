@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
                <!--PLAID LINK BUTTON-->
                <form id="some-id" method="POST" action="/plaidcurl"></form>

                    <!-- To use Link with longtail institutions on Connect, set the
                    data-longtail attribute to 'true'. See the Parameter Reference for
                    additional documentation. -->
                    <script
                      src="https://cdn.plaid.com/link/stable/link-initialize.js"
                      data-client-name="AsURent"
                      data-form-id="some-id"
                      data-key="a246cdb456f73cc16c8c6b9c813e4a"
                      data-product="auth"
                      data-env="tartan">
                    </script>
                <form id="weee" method="POST" action="/plaidcurl">
                    <button></button>
                </form>
                
                <!-- without plaid...-->
                
                <script>
                    //stripe response handler
                      Stripe.setPublishableKey('pk_test_89jOqsSrEjxCjEotST32cFc9');
                      var stripeResponseHandler = function(status, response) {
                          var $form = $('#payment-form');
                        
                          if (response.error) {
                            // Show the errors on the form
                            $form.find('.payment-errors').text(response.error.message);
                            $form.find('button').prop('disabled', false);
                          } else {
                            // token contains id, last4, and card type
                            var token = response.id;
                            // Insert the token into the form so it gets submitted to the server
                            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                            // and submit
                            $form.get(0).submit();
                      }
                    };
                    
                    
                    //stripe handle submit button
                    $(function() {
                      var $form = $('#payment-form');
                      $form.submit(function(event) {
                        // Disable the submit button to prevent repeated clicks:
                        $form.find('.submit').prop('disabled', true);
                    
                        // Request a token from Stripe:
                        Stripe.card.createToken($form, stripeResponseHandler);
                        console.log("HEllloOOO?");
                        // Prevent the form from being submitted:
                        return false;
                      });
                    });
                    
                </script>
             <!--   <script type="text/javascript">
                    Stripe.setPublishableKey('pk_test_89jOqsSrEjxCjEotST32cFc9');
                    Stripe.bankAccount.createToken({
                      country: $('.country').val(),
                      currency: $('.currency').val(),
                      routing_number: $('.routing-number').val(),
                      account_number: $('.account-number').val(),
                      account_holder_name: $('.name').val(),
                      account_holder_type: $('.account_holder_type').val()
                    }, stripeResponseHandler);
                </script>-->
                <form action="/payOnce" method="POST" id="payment-form">
                      {{csrf_field()}}
                      <span class="payment-errors"></span>
                      
                      <div class="form-row">
                        <label>
                          <span>Email</span>
                          <input type="text" name="email">
                        </label>
                      </div>
                      <div class="form-row">
                        <label>
                          <span>Card Number</span>
                          <input type="text" size="20" data-stripe="number" value="4242424242424242">
                        </label>
                      </div>
                    
                      <div class="form-row">
                        <label>
                          <span>Expiration (MM/YY)</span>
                          <input type="text" size="2" data-stripe="exp_month" value="1">
                        </label>
                        <span> / </span>
                        <input type="text" size="2" data-stripe="exp_year" value="19">
                      </div>
                    
                      <div class="form-row">
                        <label>
                          <span>CVC</span>
                          <input type="text" size="4" data-stripe="cvc", value="111">
                        </label>
                      </div>
                      <input type="submit" class="submit" value="Submit Payment">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
