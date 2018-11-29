@extends('layouts.app')
@section('content')

<div class="container">
    <h2 class="text-uppercase">report By City</h2>
    <br>
    <div class="row">
                
          <form method="POST" action="ByCity">
                {{ csrf_field() }}
                <input class="col-md-3 text-uppercase text-center" style="border-color:red; padding:5px;" type="text" placeholder="Enter City" id="City1" name="City1">
                <input class="col-md-3 text-uppercase text-center" style="border-color:red; border-left:none; padding:5px;" type="text" placeholder="Enter City" id="City2" name="City2">
                <input class="col-md-3 text-uppercase text-center" style="border-color:red; border-left:none; padding:5px;" type="text" placeholder="Enter City" id="City3" name="City3">
                <div class="col-md-6">
                        <label for="order_date" class="" style="padding:6px; background-color:red; color:white; border-color:red;">FROM :</label>
                        <input type="date" class="" id="from_date" name="from_date" style="border-color:red; padding:5px;" required>
                        <label for="order_date" class="" style="padding:6px; background-color:red; color:white; border-color:red;">TO :</label>
                        <input type="date" class="" id="to_date" name="to_date" style="border-color:red; padding:5px;" required>
                        
                </div>
                <input class="col-md-3 btn btn-success text-uppercase text-center" type="submit" id="btnAddProduct" value="search">
          </form>
              
    </div>
        
        
	 {{-- //get Section --}}
	 <div class="row" style="margin-top:15px;">
			@if(!empty($city1))
		   
		   <form method="POST" action="CityEx">
			   {{ csrf_field() }}
			   <input class="col-md-2 text-uppercase text-center" style="background-color:brown; color:white; border:none; padding:5px;" type="text" readonly placeholder="" value="Searching on" id="City1" name="GetCity1">
			   <input class="col-md-3 text-uppercase text-center" style="background-color:yellow; border:none; padding:5px;" type="text" readonly placeholder="Enter City" value="{{$city1}}" id="City1" name="GetCity1">
			   <input class="col-md-3 text-uppercase text-center" style="background-color:yellow; border:none; padding:5px;" type="text" readonly placeholder="Enter City" value="{{$city2}}" id="City2" name="GetCity2">
               <input class="col-md-3 text-uppercase text-center" style="background-color:yellow; border:none; padding:5px;" type="text" readonly placeholder="Enter City" value="{{$city3}}" id="City3" name="GetCity3">
               
              	
						
			   <input class="col-md-1 btn btn-link text-uppercase" type="submit" id="btnAddProduct" value="Export">
		   </form>  
			@endif
	 </div>            
				 {{-- End Section --}}
		<hr><!-- line separator -->			 
				 
           <div class="row">
                
            @if(!empty($items))                       
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs">
                        <li class="nav-item active info">
                                <a class="nav-link" data-toggle="tab" href="#home">IN PRODUCTION</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#menu1">IN STOCK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">DELIVERED</a>
                        </li>
                        </ul>
    
                        <!-- Tab panes -->
                        <div class="tab-content">
    
                        {{-- Start IN Productuon --}}
                        <div id="home" class="tab-pane info active"><br>
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover " data-sorting="true">
										<thead>
											<tr class="text-uppercase info">
												<th>Order ID</th>
												<th>Customer Name</th>
												<th>City</th>
												<th>Width</th>
												<th>thickness</th>
												<th>length</th>
												<th>ORDER PRODUCTION QUANTITY</th>
											</tr>
										</thead>
										<tbody id="myTable">
										@foreach($items as $item)
										<tr>
										 <td> {{$item->o_id}}</td>
										 <td>{{$item->c_name}}</td>
										<td>{{$item->o_d_city}}</td>
										<td>{{$item->o_p_width}}</td>
										<td>{{$item->o_p_thikness}}</td>
										<td>{{$item->o_p_length}}</td>
										<td>{{$item->o_p_qty}}</td>
										
										
										</tr>
										
										@endforeach  
										
											
										</tbody>  
									</table>
								
								</div>
                        </div>
                        {{--END   IN Production --}}
    
                            {{-- Start  IN stoke --}}
                        <div id="menu1" class="tab-pane fade"><br>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" data-sorting="true">
                                    <thead>
										<tr class="text-uppercase danger">
											<th>Order ID</th>
											<th>Customer Name</th>
											<th>City</th>
											 <th>Width</th>
											<th>thickness</th>
											<th>length</th>
											<th>ORDER STOCK QUANTITY</th>
										</tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach($items as $item)
                                    <tr>
										<td> {{$item->o_id}}</td>
                                        <td>{{$item->c_name}}</td>
										<td>{{$item->o_d_city}}</td>
										<td>{{$item->o_p_width}}</td>
										<td>{{$item->o_p_thikness}}</td>
										<td>{{$item->o_p_length}}</td>
										<td>{{$item->o_stock_qty}}</td>
                                    </tr>
                                    
                                    @endforeach  
                                    
                                        
                                    </tbody>  
                            </table>
							</div>
                        </div>
                            {{-- END IN STOCK --}}
                        
                            {{-- Start DELIVERED --}}
                        <div id="menu2" class="tab-pane fade"><br>
							<div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" data-sorting="true">
                                    <thead>
                                            <tr class="text-uppercase warning">
                                                    <th>Order ID</th>
                                                    <th>Customer Name</th>
                                                    <th>City</th>
                                                    <th>Order Delivered Quantity</th>
                                                    <th>Width</th>
                                                    <th>thickness</th>
                                                    <th>length</th>
                                                
                                                
                                            </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach($items as $item)
                                    <tr>
                                            <td> {{$item->o_id}}</td>
                                            <td>{{$item->c_name}}</td>
                                            <td>{{$item->o_d_city}}</td>
                                            <td>{{$item->o_p_width}}</td>
                                            <td>{{$item->o_p_thikness}}</td>
                                            <td>{{$item->o_p_length}}</td>
                                            <td>{{$item->o_dilivery_qty}}</td>
                                    
                                    
                                    </tr>
                                    
                                    
                                    @endforeach  
                                
                                        
                                    </tbody>  
                            </table>
							</div>
                        </div>
                        {{-- END DELIVERED --}}
                        </div>
                            
                    </div>
    
     
                
            @endif
<script>
  function getOrder()
  {
    var orderID=document.getElementById("orderID").value;
    

    window.open("Pro/"+orderID,"_self");

    
  }endsection
</script>

