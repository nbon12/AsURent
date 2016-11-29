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

                    <p>Table with contracts you created, listings with progress and editing options</p>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 20%">Address</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Status</th>
                          <th style="width: 20%">Options</th>
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
                            $ {{ $contract->base_rate }}
                          </td>
                          <td>
                            <button type="button" class="btn btn-muted btn-xs">Status</button>
                          </td>
                          <td>
                            <form action="{{ url('contract/'.$contract->id) }}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <a href="{{ url('invoices/'.$contract->id) }}" class="btn btn-xs btn-info" role="button"><i class="fa fa-folder"></i>
                                            &nbspInvoices
                                        </a>
                                        <a href="{{ url('contract/'.$contract->id) }}" class="btn btn-xs btn-warning" role="button"><i class="fa fa-pencil-square-o"></i>&nbspEdit</a>
                                        <button type="submit" id="delete-task-{{ $contract->id }}" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash-o"></i>&nbspDelete 
                                        </button>
                                        
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
        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>New Leasing Agreement</h2>
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
                    <br />
                    <form action="{{ url('/contracts/landlord') }}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Address" name="name">
                        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" id="inputSuccess3" placeholder="Description" name="description">
                        <span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="email" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Tenant Email" name="tenant">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="number" min="0" step="0.01" class="form-control" id="inputSuccess5" placeholder="Monthly Rent" name="base_rate">
                        <span class="fa fa-usd form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tenant Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="email" class="form-control" placeholder="Additional Tenant">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tenant Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="email" class="form-control" placeholder="Additional Tenant">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tenant Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="email" class="form-control" placeholder="Additional Tenant">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tenant Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="email" class="form-control" placeholder="Additional Tenant">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
        <!-- /page content -->
</section>
@endsection