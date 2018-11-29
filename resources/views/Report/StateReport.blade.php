@extends('layouts.app')
@section('content')

<div class="container">
    <h2 class="text-uppercase">Search By Date</h2>
    <br>
	<div class="row"><!--row 1 start-->
	
		<div class="col-md-6">
			<form method="POST" action="Dura">
				{{ csrf_field() }}
				<label for="order_date" class="" style="padding:6px; background-color:red; color:white; border-color:red;">FROM :</label>
				<input type="date" class="" id="from_date" name="from_date" style="border-color:red; padding:5px;" required>
				<label for="order_date" class="" style="padding:6px; background-color:red; color:white; border-color:red;">TO :</label>
				<input type="date" class="" id="to_date" name="to_date" style="border-color:red; padding:5px;" required>
				<button type="submit" class="btn btn-link text-uppercase">SEARCH</button> 		
			</form>
		</div>
    
		<div class="col-md-6">
		
			@if(!empty($city1))
    
			<form method="POST" action="DuraEx">
				{{ csrf_field() }}			
				<input type="text" class="col-md-4 text-uppercase text-center" value="{{$city1}}" id="fromDate" readonly name="fromDate" style="border:none; background-color:brown; color:white; padding:5px;">		
				<input type="text" class="col-md-4 text-uppercase text-center" value="{{$city2}}" id="to_date" readonly name="to_date" style="border:none; background-color:yellow; padding:5px;">
				<button type="submit" class="col-md-4 btn btn-link text-uppercase text-center">Export</button> 	
			</form>
			@endif
		
		</div>
    </div><!--row 1 end-->
	
	<hr><!--divider-->

    <div class="row">
            @if(!empty($items))                       
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                  <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#home">IN PRODUCTION(100)</a>
                      
                  </li>
                  <li class="nav-item">
                          <a class="nav-link " data-toggle="tab" href="#menu1">IN STOCK(35)</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#menu2">DELIVERED(50)</a>
                  </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">

                  {{-- Start IN Productuon --}}
                  <div id="home" class="container tab-pane active"><br>
							<div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" data-sorting="true">
                              <thead>
								  <tr class="text-uppercase info">
									  <th>Order ID</th>
                                      <th>Customer Name</th>
                                      <th>Order Date</th>
                                      <th>Delivery Date</th>
									  <th>Width</th>
									  <th>Thickness</th>
									  <th>length</th>
									  <th>Order Quantity</th>
								  </tr>
                              </thead>
                              <tbody id="myTable">
                              @foreach($items as $item)
                              <tr>
                              <td> {{$item->o_id}}</td>
                              <td>{{$item->c_name}}</td>
                              <td>{{$item->created_at}}</td>
                              <td>{{$item->o_d_date}}</td>
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
                  <div id="menu1" class="container tab-pane fade"><br>
                      
					  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover" data-sorting="true">
                              <thead>
								  <tr class="text-uppercase danger">
									<th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
									<th>Width</th>
									<th>Thickness</th>
									<th>length</th>
									<th>Order Stock Quantity</th>
								  </tr>
                              </thead>
                              <tbody id="myTable">
                              @foreach($items as $item)
                              <tr>
                              <td> {{$item->o_id}}</td>
                              <td>{{$item->c_name}}</td>
                              <td>{{$item->created_at}}</td>
                              <td>{{$item->o_d_date}}</td>
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
                  <div id="menu2" class="container tab-pane fade"><br>
				  
					<div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" data-sorting="true">
                                <thead>
                                    <tr class="text-uppercase warning">
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Width</th>
                                        <th>Thickness</th>
                                        <th>length</th>
                        
                                        <th>Order Delivered Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                @foreach($items as $item)
                                <tr>
                                    <td> {{$item->o_id}}</td>
                                    <td> {{$item->c_name}}</td>
                                    <td> {{$item->created_at}}</td>
                                    <td> {{$item->o_d_date}}</td>
                                    <td> {{$item->o_p_width}}</td>
                                    <td> {{$item->o_p_thikness}}</td>
                                    <td> {{$item->o_p_length}}</td>
                                    <td> {{$item->o_dilivery_qty}}</td>
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
</div>
</div>
<script>
  function getOrder()
  {
    var orderID=document.getElementById("orderID").value;
    window.open("Pro/"+orderID,"_self");

    
  }
</script>

@endsection