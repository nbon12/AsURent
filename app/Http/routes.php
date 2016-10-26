<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
Route::group(['middleware' => ['web']], function() {
    Route::get('/', function() {
        return view('welcome');
    });
    
    Route::auth();
    
    Route::get('/invoices/{contract}', 'InvoiceController@index')->name('invoiceindex');
    Route::post('/invoices/{contract}', 'InvoiceController@store')->name('invoicestore');
    Route::delete('/invoices/{contract}/{invoice}', 'InvoiceController@destroy')->name('invoicedestroy');
    Route::get('/invoice/{contract}/{invoice}', 'InvoiceController@individual');
    Route::post('/invoice/{contract}/{invoice}', 'InvoiceController@storeItem');
    
    
    Route::delete('/invoice/{contract}/{invoice}/{item}', 'InvoiceController@destroyItem');
    
    Route::get('/home', 'HomeController@index');
    Route::get('/tasks', 'TaskController@index')->name('lalatask');
    Route::post('/tasks', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');
       
    Route::get('/contracts', 'ContractController@index')->name('contractindex');
    Route::post('/contracts', 'ContractController@store')->name('contractstore');
    Route::delete('/contract/{contract}', 'ContractController@destroy')->name('contractdestroy');
    
    Route::get('/contract/{contract}', 'ContractController@editForm');
    Route::post('/contract/{contract}', 'ContractController@edit');
    Route::post('/payOnce', 'SubscriptionController@payOnce');
    Route::get('/stripeconnect', function(){
            $error = Input::get("error");
            $error_description = Input::get("error_description");
            $code = Input::get("code");
            if($error != null || $code == null)
            {   
                //for now, we dump the error to view, but in the future we can pass this along to the view.
                dd("The user was not authorized. " . $error . " " .  $error_description);
                //if($error_description != null){ //pass error and error description along to view here }
            }
            //We have the authorization code, good.
            //TODO: sanitize the Input? or does the input get method already sanitize it? 
            //dd(Input::get("code"));
            //TODO: store the input and set up with laravel Cashier.
            //TODO: set up laravel cashier
            dd($code);
            
    
    })->name('stripe_redirect_uri');
    Route::get('/testrequest', function(Request $request){
       //dd( $request); 
    });
    Route::post('/plaidlink', function(Request $request){
        //dd($request);
        $client_id = env('PLAID_ID');
        $secret = env('PLAID_SECRET');
        $public_token = $request->public_token;
        
        //Okay, now we have the public_token...
        $user = User::where('email', 'tenantA@tenant.com')->first();
        //we've got to send it in a CURL to the plaid servers, with the account_id,
        //in order to get a btok. Then we store the btok into the $customer->source. 
        
    })->name('plaidlink');
    Route::get('/chargetenantA', function(){
        $user = User::where('email', 'tenantA@tenant.com')->first();
        
    })->name('chargetenantA');
    
    Route::post('/plaidcurl', function(Request $request){
        //$temp_public_token = "50d9c0dab695a88ec8cc64faeae243235e62c4523951351366c1c395921d0592e4ed48930e724ec9ecac3968824fad7ae63fde04c372ccc6007fd4ffbb75a7c0";
        
        $public_token = $_POST['public_token1'];
        $account_id = $_POST['account_id1'];
        
        //dd($account_id . " --- " . $public_token);
        //return("HELLOOO??");
        //dd($public_token);
        //$public_token = $request->public_token; //from plaid_module
        //$account_id = $request->account_id; //from plaid module
        //dd($account_id . " ----" . $public_token);
        //dd($request->public_token);
        //dd($response->account_id);
        //send our id and secret key to plaid in order to get a btok (bank token) from them
        $url = 'https://tartan.plaid.com/exchange_token';
        //$data = array('client_id' => env('PLAID_ID_TEST'), 'secret' => env('PLAID_SECRET_TEST'), 'public_token' => $public_token, 'account_id' => $account_id);
        //$data = array('client_id' => env('PLAID_ID_TEST'), 'secret' => env('PLAID_SECRET_TEST'), 'public_token' => $public_token);
        $data = array('client_id' => 'test_id', 'secret' => 'test_secret', 'public_token' => $public_token, 'account_id' => $account_id);
        //dd($data);
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        //Okay now we have the access token(and hopefully btok, lets print it
        //dd($account_id . " --- " . $public_token. "-\n" . $result);
        dd($result);
        //var_dump($result);
        //$resp = curl_exec($curl);
        //dd($resp);
        
        
        
    })->name('plaidcurlgeneric');
    Route::get('/plaidcurl2', function(Request $request){
        $public_token = "50d9c0dab695a88ec8cc64faeae243235e62c4523951351366c1c395921d0592e4ed48930e724ec9ecac3968824fad7ae63fde04c372ccc6007fd4ffbb75a7c0";
        //$public_token = $request->public_token; //from plaid_module
        //$account_id = $request->account_id; //from plaid module
        $account_id = 1;
        //dd($request->public_token);
        //dd($response->account_id);
        $url = 'https://tartan.plaid.com/exchange_token';
        $data = array('client_id' => env('PLAID_ID_TEST'), 'secret' => env('PLAID_SECRET_TEST'), 'public_token' => $public_token, 'account_id' => $account_id);
        
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        //Okay now we have the access token, lets print it
        dd($result);
        //dd($result);
        //var_dump($result);
        //$resp = curl_exec($curl);
        //dd($resp);
        
        
        
    })->name('plaidcurlgeneric2');
    Route::get('/cashier_create', function(){
       
        $user = User::where('email', 'tenantA@tenant.com')->first();
        $user->customer_id = null;
        $user->newSubscription('main', 'monthly')->create($creditCardToken);
        dd($user);
        //dd($user);
        return "cashier_create route ended.";
    })->name('cashier_create');
    Route::get('/curltest', function(){
        $temp_public_token = "50d9c0dab695a88ec8cc64faeae243235e62c4523951351366c1c395921d0592e4ed48930e724ec9ecac3968824fad7ae63fde04c372ccc6007fd4ffbb75a7c0";
        //$account_id = $response->account_id;
        $url = 'https://tartan.plaid.com/exchange_token';
        $data = array('client_id' => env('PLAID_ID'), 'secret' => env('PLAID_SECRET'), 'public_token' => $temp_public_token, 'account_id' => $account_id);
        
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        //dd($result);
        //var_dump($result);
        var_dump($result);
        //dd($result);
        
    });
    /* Routes protected by authenication middleware */
    Route::group(['middleware' => ['auth']], function() {
        
        /* Route::get('/tasks', function() {
            return view('tasks', [
                'tasks' => Task::orderBy('created_at', 'asc')->get()
            ]);
        })->name('lalatask');
        */
       
        /*Route::post('/task', function(Request $request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                //'tenantname' => 'required'
            ]);
    
            if ($validator->fails()) {
                //return redirect('/')
                return redirect()->route('lalatask')
                    ->withInput()
                    ->withErrors($validator);
            }
            $task = new Task;
            $task->name = $request->name;
            $task->tenantname = $request->gabe;
            $task->save();
            //return redirect('/');
            return redirect()->route('lalatask');
        });
        
        
        */
        /**
         * Delete Task
         */
        /*Route::delete('/task/{id}', function($id) {
            Task::findOrFail($id)->delete();
            return redirect()->route('lalatask');
        });//delete task
        */
    }); //Route::group middleware auth


});//Route::group web




