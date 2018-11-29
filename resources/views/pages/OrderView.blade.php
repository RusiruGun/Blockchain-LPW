<html lang="en">
<head>
	<title>LANKA PLYWOOD OMS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/footable.bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/footable.min.js"></script>
<style type="text/css">
.hidden-print {
    display: none !important;
  }
</style>
</head>
<body>
        <div class="panel panel-primary">
                    <div class="panel-body">
                            <a class="btn btn-info float-left" href="{{ URL::previous() }}">Go Back</a>
                    </div>
        </div>
    
<div class="col-md-12">

    <div>
            
 
        <h4 align="center">LANKA PLYWOOD MANUFACTURERS (PVT) LTD.</h4>
          <p align="center">Industrial Estate,Pallekale,Kandy</p>
          <p align="center">Tel -081 4953318 ,0777663920 Fax-0814545657</p>
      <p align="center"> Email-tlpywoodltd@gmail.com </p>
    </div>
    
    
    @foreach (array_slice($items->toArray(), 0, 1) as $item)
    <div class="col-md-6">
      {{-- @foreach($items  as $item) --}}
      {{-- @foreach ($items->slice(0, 1) as $items) --}}
     
            <h5>Customer Name :{{$item->c_name}}</h5> 
            <h5>Order ID      :{{$item->o_id}}</h5> 
            <h5>PO Number      :{{$item->o_po}}</h5> 
   
    </div>
    <div align="right" class="col-md-6">
        <h4>Delivery Adress</h4>
        <ul>
                       <h5>{{$item->o_d_add1}}</h5>
                        <h5>{{$item->o_d_add2}}</h5>
                        <h5>{{$item->o_d_city}}</h5>
        </ul>
                    </div>
        @endforeach
    <div class="col-md-12">
            <table class="table table-bordered footable" id="#myTable">
                    <thead>
                        <tr class="text-center">
                            <th>Product Name</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>LENGTH(MM)</th>
                            <th>WIDTH(MM)</th>
                            <th>THICKNESS(MM)</th>
                            <th>DOORTYPE</th>
                            <th>DOOR SKIN</th>
                            <th>QUANTITY</th>
                            <td>NOTE</td>
                           
                           
                        </tr>
                    </thead>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$item->o_po_Name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->o_d_date}}</td>
                        <td>{{$item->o_p_length}}</td>
                        <td>{{$item->o_p_width}}</td>
                        <td>{{$item->o_p_thikness}}</td>
                        <td>{{$item->o_p_type}}</td>
                        <td>{{$item->o_p_doorskin}}</td>
                        <td>{{$item->o_p_qty}}</td>
                        <td>{{$item->o_p_note}}</td>
                        <td><a class="btn btn-success"href="{{ url('Order/'.$item->id.'/edit') }}" >Edit</a></td>
                      
                        
                    </tr>
                    @endforeach
                        
                    
                </table>
    </div>
  
    
    </div>
    {{-- <button onclick="window.print();" class="only_sc btn btn-info float-right">Print</button>   --}}

    <script type="text/javascript">
        $(document).ready(function(){
            $('.footable').footable();

            
        });

    </script>
</div>
    

</body>
</html>