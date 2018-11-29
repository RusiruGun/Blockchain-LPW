@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<input class="form-control" type="text" id="myInput" placeholder="Search Here.." title="Type Something">
<br>


<div class="table-responsive">
  <table id="showcase-example-1 myTable" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        
        <th data-type="number" data-sort-initial="true">ORDER NO</th>
        <th>CUSTOMER NAME</th>
        <th>PRODUCT NAME</th>
        <th data-breakpoints="xs sm" data-type="date" data-format-string="YYYY MMMM Do">ORDER DATE</th>
        <th data-breakpoints="xs sm" data-type="date" data-format-string="YYYY MMMM Do">DELIVERY DATE</th>
        <th>CONTACT NO</th>
        <th>VIEW ORDER</th>
        <th>CUSTOMER PRINT</th>
        <th>PRODUCTION PRINT</th>
        <th>Order QTY</th>
        
        <th>PRODUCTION QTY</th>
        <th>STOCK QTY</th>
        <th>DELIVERED QTY</th>
        
      </tr>
    </thead>
    <tbody id="myTable">
      @foreach($items as $item)
      <tr class="header">
        <td>{{$item->o_id}}</td>
        <td>{{$item->c_name}}</td>
        <td>{{$item->o_po_Name}}</td>
        <td>{{$item->created_at}}</td>
        <td>{{$item->o_d_date}}</td>
        <td>{{$item->c_phone}}</td>
        
        
        <td><a href="{{ url('Order/'.$item->o_id) }}" class="btn btn-primary">VIEW</a></td>   
    
        <td><a href="{{ url('PrintCus/'.$item->o_id) }}" class="btn btn-primary">Customer</a></td>
        <td><a href="{{ url('PrintCom/'.$item->o_id) }}" class="btn btn-primary">Production Print</a></td>
        <td>{{$item->o_p_qty}}</td>
        
        <td>{{$item->o_production_qty}}</td>
        <td>{{$item->o_stock_qty}}</td>
        <td>{{$item->o_dilivery_qty}}</td>
       

      </tr>
      
      @endforeach  
     
		  
    </tbody>
  </table>
</div>  
  
  
<script>

jQuery(function($){

    $('[name=status]').on('change', function(){
	var filtering = FooTable.get('#showcase-example-1').use(FooTable.Filtering), // get the filtering component for the table
		filter = $(this).val(); // get the value to filter by
	if (filter === 'none'){ // if the value is "none" remove the filter
		filtering.removeFilter('status');
	} else { // otherwise add/update the filter.
		filtering.addFilter('status', filter, ['status']);
	}
	filtering.filter();
});
 
		$('.table').footable({
            
			"paging": {
				"enabled": true
			},
			"filtering": {
				"enabled": true
			},
			"sorting": {
				"enabled": true
			},		
            
		});
        
	});
	
	

 </script>
 
 
 <script><!--new filter for table-->
 $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
 
 </script>



@endsection
