@extends('../layouts.app')

@section('content')
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Individual Invoice</h2>
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

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                              <i class="fa fa-globe"></i> Invoice.
                              <small class="pull-right">Date: {{ $invoice->created_at->format('Y-m-d') }}</small>
                          </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From:
                          <br>
                          <strong>{{$landlord->name}}</strong>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          Billed To:
                          <br>
                          <strong>{{$tenant->name}}</strong><br>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice #{{$invoice->id}}</b>
                          <br>
                          <br>
                          <b>Payment Due:</b> {{$invoice->due_date}}
                          <br>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th style="width: 85%">Item</th>
                                <th>Subtotal</th>
                                <th style="width: 2%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $item)
                              <tr>
                                <td>1</td>
                                <td>{{$item->description}}</td>
                                <td>${{$item->value}}</td>
                                <td>
                                  <form class="form-inline" style="margin-bottom: 0em;" action="{{ url('invoice/'.$contract->id.'/'.$invoice->id.'/'.$item->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            
                                  </form>
                                </td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">

                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead">Amount Due</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>${{$total}}</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>${{$total}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-2">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
                        <div class="col-xs-offset-9 col-xs-1">
                          <form class="form-inline" action="{{ url('individualcheckout/'.$invoice->id) }}" method="POST">
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{$contract->pk}}"
                                data-name="AsURent"
                                data-description="Monthly Subscription"
                                data-amount="{{$contract->base_rate * 100}}"
                                data-label="Pay">
                            </script>
                          </form>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
@endsection