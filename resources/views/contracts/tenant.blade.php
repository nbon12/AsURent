@extends('../layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
<section>
        <!-- page content -->
        <div class="" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Contracts <small>Leasing Agreements List</small></h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Contracts</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <p>Table with contracts where a landlord has added you</p>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 20%">Address</th>
                          <th style="width: 60%">Description</th>
                          <th>Amount</th>
                          <th>Status</th>
                          <th style="width: 15%">Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($contracts as $contract) 
                        <tr>
                          <td>
                            <a>{{ $contract->name }}</a>
                            <br />
                            <small>Created {{$contract -> created_at}}</small>
                          </td>
                          <td>
                            {{ $contract->description }}
                          </td>
                          <td>
                            $ {{ $contract -> base_rate }}
                          </td>
                          <td>
                            <button type="button" class="btn btn-muted btn-xs">Status</button>
                          </td>
                          <td>
                                        <form class="form-inline" action="{{ url('checkout/'.$contract->id) }}" method="POST">
                                          <a href="{{ url('invoices/'.$contract->id) }}" class="btn btn-xs btn-info" role="button"><i class="fa fa-folder"></i>
                                            &nbspInvoices
                                          </a>
                                          
                                          <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="{{$contract->pk}}"
                                            data-name="AsURent"
                                            data-description="Monthly Subscription"
                                            data-amount="{{$contract->base_rate * 100}}"
                                            data-label="Pay">
                                          </script>
                                        </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
</section>
@endsection