@extends('layouts.app')
@section('content')

<div class="container">
	
    <h2 class="text-uppercase">Search By Customer Name</h2>
    <br>
    <div class="row">
	
		<div class="col-md-6">
			<form method="POST" action="ReportResualt">
				{{ csrf_field() }}               
				<input type="text" class="col-md-10 text-uppercase text-center" style="border-color:red; padding:5px;" placeholder="CUSTOMER NAME" id="cus_name" name="cus_name" required>             
				<button type="submit" class="btn btn-link col-md-2 text-uppercase text-center">FIND</button> 
			</form>
		</div>

   
		<div class="col-md-6">
		@if(!empty($city1))
		
			<form method="POST" action="CusEx">
				{{csrf_field()}}	 
				<input type="text" readonly class="col-md-10 text-uppercase text-center" style="background-color:yellow; border-color:red; padding:5px;" value="{{$city1}}" id="fromDate" name="cusName">
				<button type="submit" class="btn btn-link text-uppercase col-md-2">Export</button> 
			</form>
		@endif
		</div>
	
	</div>

	<hr><!--divider-->
	
    <div class="row">
		@if(!empty($items))                       
					<!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                    <li class="nav-item active">
                            <a class="nav-link" data-toggle="tab" href="#home">IN PRODUCTION</a>                      
                    </li>
                    <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#menu1">IN STOCK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">DELIVERED</a>
                    </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

						{{-- Start IN Productuon --}}
						<div id="home" class="tab-pane active"><br>
							<div class="table-responsive">
						
								<table class="table table-bordered table-striped table-hover" data-sorting="true">
										<thead class="info">
											<tr class="text-uppercase info">
                                                <th>ORDER ID</th>
                                                <th>Order Date</th>
                                                <th>Delivery Date</th>
												<th>Width</th>
												<th>Thickness</th>
												<th>length</th>
												<th>ORDER PRODUCTION QUANTITY</th>
											</tr>
										</thead>
										<tbody id="myTable">
											@foreach($items as $item)
											<tr>
											
                                                    <td> {{$item->o_id}}</td>
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
						<div id="menu1" class="tab-pane fade"><br>
						
							<div class="table-responsive">
								
								<table class="table table-bordered table-striped table-hover" data-sorting="true">
										<thead class="">
											<tr class="text-uppercase warning">
												<th>ORDER ID</th>
                                                <th>Order Date</th>
                                                <th>Delivery Date</th>
												<th>Width</th>
												<th>Thickness</th>
												<th>length</th>
												<th>ORDER STOCK QUANTITY</th>
											</tr>
										</thead>
										<tbody id="myTable">
										@foreach($items as $item)
										<tr>
										<td> {{$item->o_id}}</td>
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
						<div id="menu2" class="tab-pane fade"><br>
						
							<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover" data-sorting="true">
									<thead class="danger">
										<tr class="text-uppercase danger">
                                                <th>ORDER ID</th>
                                            <th>Order Date</th>
                                            <th>Delivery Date</th>
											<th>ORDER DELIVERED QUANTITY</th>
											<th>Width</th>
											<th>Thickness</th>
											<th>length</th>
										</tr>
									</thead>
									<tbody id="myTable">
									@foreach($items as $item)
									<tr>
                                        <td> {{$item->o_id}}</td>
										<td>{{$item->o_p_width}}</td>
										<td>{{$item->o_p_thikness}}</td>
										<td>{{$item->o_p_length}}</td>
										<td>{{$item->o_dilivery_qty}}</td>
									</tr>
									
									
									@endforeach  
								
										
									</tbody>  
							</table>
							</div>
							
							
						{{-- END DELIVERED --}}
						</div>
                        
					</div>


    @endif   
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
 
  $( "#cus_name" ).autocomplete({
	source: 'http://oms.app.lankaplywood.lk/lpwV1/public/SearchCus'
  });
} );
</script>
	

@endsection


