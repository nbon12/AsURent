<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Http\Requests;
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
         
         return view('contracts.index', [
             'contracts' => $this->contracts->forUser($request->user()),
             ]);
             
     }
     public function store(Request $request)
     {
        //return redirect('/contracts');
        $this->validate($request, [
             'name' => 'required|max:255',
        ]);
        
        $request->user()->contracts()->create([
            'name' => $request->name,
            'description' => $request->description,
            ]);
            
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
        $this->authorize('destroy', $contract); 
        $contract->delete();
        
        return redirect('/contracts');
     }
}
