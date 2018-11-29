@extends('layouts.app')
@section('content')

<style type="text/css">
  .btn,.btn-success{border-radius:0px;}
</style>

<div class="container">
    <h2>CURRENT ORDERS</h2>
    <br>

	<div class="row">
	
		<div class="col-md-6">
			<form class="form-horizontal" method="POST" action="Pro">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input class="text-center" style="border-color:red; padding:5px;" type="text" placeholder="ENTER ORDER ID" id="orderID" name="oid">              
				<input type="submit" id="btnAddProduct" value="SEARCH" class="btn btn-link" >               
			</form>
		</div>
	
		<div class="col-md-6">
			@if(!empty($items))
			@foreach (array_slice($items->toArray(), 0, 1) as $item)         
			<input class="col-md-6 text-center" style="background-color:brown; color:white; border:none; padding:5px;" readonly type="text" value=" PO NUMBER - {{$item->o_po}}" id="orderPO" name="Pono">
			<input class="col-md-6 text-center" style=" background-color:yellow; border:none; padding:5px;" readonly type="text" value="ORDER NUMBER - {{$item->o_id}}">
			@endforeach
			@endif
		</div>

	</div>	 
         @if(!empty($items))           

				<hr><!-- line separator -->
				
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link" data-toggle="tab" href="#home">IN PRODUCTION</a>       
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu1">IN STOCK</a>
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
                                        <thead>
                                                <tr>
												   <th>CUSTOMER NAME</th>
												   <th>ORDER DATE</th>
												   <th>DELIVERY DATE</th>
												   <th>PRODUCT NAME</th>
												   <th>ORDER  QUANTITY</th>
												   <th>TO STOCK</th>                                                     
                                                </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @foreach($items as $item)
                                        <tr>
                                        <td>{{$item->c_name}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->o_d_date}}</td>
                                                
                                        <td>{{$item->o_po_num}}</td>
                                        <td>{{$item->o_p_qty}}</td>
                                        <td>
                                        <form method="POST" action="Production">
                                                <input type="hidden" name="itemid" value="{{$item->o_id}}">
                                                <input type="hidden" name="ID" value="{{$item->id}}">
                                                 {{ csrf_field() }}
                                               
                                        <input class="col-md-6" style="padding:5px;" type="number" placeholder="Enter Value" name="upQty">
                                        
                                        <button type="submit" class="btn btn-primary col-md-4 btn-sm" style=" margin-left:15px;">Update</button>
                                       
										</form> 
                                        </td>
                                          
                                        
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
                                                <tr>
                                                       <th>CUSTOMER NAME</th>
                                                       <th>ORDER DATE</th>
                                                       <th>DELIVERY DATE</th>
                                                        <th>PRODUCT NAME</th>
                                                        <th>ORDER STOCK QUANTITY</th>
                                                        <th>TO DELIVERY</th>
                                                       
                                                </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @foreach($items as $item)
                                        <tr>
                                                        <td>{{$item->c_name}}</td>
                                                        <td>{{$item->created_at}}</td>
                                                        <td>{{$item->o_d_date}}</td>

                                        <td>{{$item->o_po_num}}</td>
                                        <td>{{$item->o_stock_qty}}</td>
                                        <td> 
                                        <form method="POST" action="stock">
										<input type="hidden" name="itemid" value="{{$item->o_id}}">
										{{ csrf_field() }}
										<input type="hidden" name="ID" value="{{$item->id}}">										
                                        <input class="col-md-6" style="padding:5px;" type="number" placeholder="Enter Value" name="upQty">                                      
                                        <button type="submit" class="btn btn-primary col-md-4 btn-sm" style="margin-left:15px;">Update</button>                        
									    </td>
										</form> 
                                               

                                        
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
                                                <tr>
                                                        <th>CUSTOMER NAME</th>
                                                        <th>ORDER DATE</th>
                                                        <th>DELIVERY DATE</th>
                                                        <th>PRODUCT NAME</th>
                                                        <th>ORDER DELIVERED QUANTITY</th>
                                                       
                                                       
                                                </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @foreach($items as $item)
                                        <tr>
                                                        <td>{{$item->c_name}}</td>
                                                        <td>{{$item->created_at}}</td>
                                                        <td>{{$item->o_d_date}}</td>
                                        <td>{{ $item->o_po_num}}</td>
                                        <td>{{$item->o_dilivery_qty}}</td>
                                        
                                        
                                        </tr>
                                        
                                        
                                        @endforeach  
                                       
                                            
                                        </tbody>  
                                    
									
								</table>
							</div>	
                            </div>
                            {{-- END DELIVERED --}}
                            </div>
                                   
                        

                        @foreach (array_slice($items->toArray(), 0, 1) as $item)
                        <a href="{{ url('Current/'.$item->o_id) }}" class="btn btn-link">Export to Excel Document</a>
                       
                        
                    @endforeach
           @endif   
        @if(!empty($records))
        
	<div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" data-sorting="true">
                        <thead>
							<tr class="text-uppercase">                            
								<th>Date</th>
								<th>PRODUCT NAME</th>
								<th>Order Number</th>
								<th>Action</th>
								<th>Qty</th>       
							</tr>
                        </thead>
                        <tbody id="myTable">
							@foreach($records as $record)
							<tr>
							<td>{{$record->created_at}}</td>
							<td>{{ $record->Product}}</td>
							<td>{{$record->orderID}}</td>
							<td>{{$record->Action}}</td>
							
							<td>{{$record->qty}}</td>
							
							
							</tr>
							
							@endforeach  

						</tbody>  
        </table>
		
	</div>	
        @endif  
		
</div>		
		
		
		
		
		
		
		
		
		
<script>
  function getOrder()
  {
    var orderID=document.getElementById("orderID").value;
    

    window.open("Pro/"+orderID,"_self");

    
  }endsection
</script>

