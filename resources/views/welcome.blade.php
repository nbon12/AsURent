@extends('layouts.app')

@section('content')

<section>
	<div class="row"></div>
	<div class="row">
	<div class="jumbotron">
          <h1>AsURent</h1>
          <p>The online rental collection web application that makes rent 
	collection, contract, and tenant management fast, easy, and trouble free!</p>
    </div>
    </div>
    
	<!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-4 col-sm-12 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">14</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-file-text-o"></i> Total Contracts</span>
              <div class="count">5</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-indent"></i> Total Invoices</span>
              <div class="count">45</div>
            </div>
          </div>
<!-- /top tiles -->
</section>

<section id="contentWrap">
	
	<div class=" container container2"> <!--container-->
		
			<div class="textCenter">
				<div class="smallBox row2">
					<h2 class="white">Manage Contracts</h1>
					<p>AsURent allows you to store all your contracts 
					electronically into one place, allowing easy access 
					to view, add, delete, or change any existing contract, 
					making it easier to stay organized and operate your 
					apartment complex efficiently and hassle free.</p>
				</div>
			<!-- new commentmmmm-->
				<div class="smallBox row2">
					<h2 class="white">Manage Tenants</h2>
					<p>View all your tenants in one place. Add or 
					remove tenants from a contract with a click of a button.</p>
				</div>
				
				<div class="smallBox row2">
					<h2 class="white">Automate Payments</h2>
					<p>The need for physical checks is over. With AsURent, 
					you can set up automated rent payments each month, allowing 
					you to easily view payments made, missed, or pending. Also, 
					AsURent allows you to keep track of all extra invoice items, 
					such as security deposits and pet fees. Hassle free, all in one place</p>
				</div>
			</div>	
	</div>
</section>



<div id="wPage">
    
    
</div>



@endsection
