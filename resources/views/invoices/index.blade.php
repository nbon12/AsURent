@extends('../layouts.app')

@section('content')
                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Invoice </th>
                            <th class="column-title">Invoice Date </th>
                            <th class="column-title">Type </th>
                            <th class="column-title">Bill to Name </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Amount </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($invoices as $invoice)
                          <tr class="even pointer">
                            <td class=" ">{{ $invoice->id }}</td>
                            <td class=" ">{{ $invoice->created_at->format('Y-m-d') }}</td>
                            <td class=" ">Recurring</td>
                            <td class=" ">{{$invoice -> tenant}}</td>
                            <td class=" ">
                                @if($invoice->paid)
                                Paid
                                @else
                                Unpaid
                                @endif
                            </td>
                            <td class="a-right a-right ">${{$invoice -> total}}</td>
                            <td class=" last"><a href="{{ url('invoice/'.$invoice->contract_id.'/'.$invoice->id) }}">View</a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
@endsection