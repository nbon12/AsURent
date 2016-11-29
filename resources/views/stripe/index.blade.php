@extends('../layouts.app')

@section('content')
@if($stripe)
<div class="row top_tiles" style="margin: 10px 0;">
              <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span>Available Balance</span>
                <h2>$ {{number_format($available, 2, '.', '')}}</h2>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span>Pending Balance</span>
                <h2>$ {{number_format($pending, 2, '.', '')}}</h2>
              </div>
            </div>
@else
<h1>It Looks like you haven't connected with stripe yet.</h1>
<a href="https://connect.stripe.com/oauth/authorize?response_type=code&amp;client_id={{env('STRIPE_CLIENT_ID')}}&amp;scope=read_write" class="btn btn-info btn-lg">Connect Now</a>
@endif
@stop