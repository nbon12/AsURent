<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Http\Requests;
use App\User;
//
//

use App\Http\Controllers\Controller;
use App\Repositories\ContractRepository;
//
//

class ContractController extends Controller
{
    //
    protected $contracts;
    /**
     * Create a new controller instance.
     */
    public function __construct(ContractRepository $contracts)
    {
        $this->middleware('auth');
        //TODO: auth for contracts
        $this->contracts = $contracts;
        
    }
    /**
     * Display a list of all the user's contracts.
     * 
     * @param Request $request
     * @return Response
     */
     public function index(Request $request)
     {
         $contr = $request->user()->contracts()->get();
         return view('contracts.index', [
             'contracts' => $contr
             ]);
             
     }
     public function store(Request $request)
     {
        //return redirect('/contracts');
        $this->validate($request, [
             'name' => 'required|max:255',
        ]);
        
        /*$request->contracts()->create([
            'name' => $request->name,
            'description' => $request->description,
            ]);*/
        $cont = new Contract;
        $cont -> name = $request -> name;
        $cont -> description = $request -> description;
        $cont -> base_rate = $request -> base_rate;
        $cont -> landlord_id = $request -> user() -> id;
        $cont -> tenant_id = $cont->setTenant($request -> tenant);

        $cont -> save();
        //Begin Stripe subscription signup...
        
        \Stripe\Stripe::setApiKey(env('ASURENT_STRIPE_SECRET'));
        
        //
        //$customer = \Stripe\Customer::create(array(
        //  "description" => "Customer for AsURent",
        //  "source" => null // will be replaced with btok...
        //));
        //dd($customer->id);
        $user = User::where('id', $cont->tenant_id)->first();
        
        $user->newSubscription('main', 'monthly')->create($creditCardToken);
        //dd($customer);
        return redirect('/contracts');
     }
     public function editForm(Request $request, Contract $contract)
     {
         return view('contracts.edit', [
            'contract' => $contract 
            ]);
     }
     public function edit(Request $request, Contract $contract)
     {
         $contract -> name = $request -> name;
         $contract -> description = $request -> description;
         $contract -> base_rate = $request -> base_rate;
         
         $contract -> save();
         
         return redirect('/contracts');
     }
     /**
      * Destroy the given contract.
      * 
      * @param Request $request
      * @param contract $contract
      * @return Response
      */ 
     public function destroy(Request $request, Contract $contract)
     {
        /**$this->authorize('destroy', $contract); 
        
        //Delete the contract..
        $contract->delete();
        return redirect('/contracts');
        */
        
        //TODO: authorization for contract manipulation
        $this->authorize('destroy', $contract); 
        $contract->delete();
        
        return redirect('/contracts');
     }
}
