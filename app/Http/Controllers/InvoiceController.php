<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Contract;
use App\User;
use App\Http\Requests;
use App\Item;

//
//

use App\Http\Controllers\Controller;
use App\Repositories\InvoiceRepository;
//
//

class InvoiceController extends Controller
{
    //
    protected $invoices;
    /**
     * Create a new controller instance.
     */
    public function __construct(InvoiceRepository $invoices)
    {
        $this->middleware('auth');
        //TODO: auth for invoices
        $this->invoices = $invoices;
        
    }
    /**
     * Display a list of all the user's invoices.
     * 
     * @param Request $request
     * @return Response
     */
     public function index(Request $request, Contract $contract)
     {
         $inv = $contract->invoices()->get();
         return view('invoices.index', [
             'invoices' => $inv,
             'contract' => $contract
             ]);
             
     }
     
     public function individual(Request $request, Contract $contract, Invoice $invoice)
     {
         $items = $invoice->items()->get();
         $total = 0;
         foreach($items as $item)
         {
             $total = $total + $item->value;
         }
         
         return view('invoices.individual',[
             'invoice' => $invoice,
             'tenant' => User::findOrFail($contract->tenant_id),
             'landlord' => User::findOrFail($contract->landlord_id),
             'items' => $items,
             'total' => $total
             ]);
     }
     
     public function store(Request $request, Contract $contract)
     {

        $inv = new Invoice;
        $inv -> contract_id = $contract -> id;
        $inv -> due_date = date('Y-m-d H:i:s');
        $inv -> enabled = 1;
        $inv -> paid = 0;
        $inv -> save();
        
        $item = new Item;
        $item -> description = 'Base Rate';
        $item -> invoice_id = $inv -> id;
        $item -> value = $contract -> base_rate;
        $item -> save();
        
        return redirect('/invoices/'.$contract->id);
     }
     /**
      * Destroy the given Invoice.
      * 
      * @param Request $request
      * @param Invoice $invoice
      * @return Response
      */ 
     public function destroy(Request $request, Contract $contract, Invoice $invoice)
     {
        /**$this->authorize('destroy', $invoice); 
        
        //Delete the Invoice..
        $invoice->delete();
        return redirect('/invoices');
        */
        
        //TODO: authorization for Invoice manipulation
        //$this->authorize('destroy', $invoice); 
        $invoice->delete();
        
        return redirect('/invoices/' . $contract->id);
     }
}
