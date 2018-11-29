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
  
  .btn{border-radius:0px;}
</style>
</head>
<body class="container">
<div class="col-md-12">
        <a class="btn btn-info float-left zamana" href="{{ URL::previous() }}">Go Back</a>
 
    <div >
        <h4 align="center">LANKA PLYWOOD MANUFACTURERS (PVT) LTD.</h4>
          <p align="center">Industrial Estate,Pallekale,Kandy</p>
          <p align="center">Tel -081 4953318 Mobile - 0777410288 Fax-0814545657</p>
      <p align="center"> Email - info@lankaplywood.lk </p>
    </div>
    
    

    <div class="col-md-6">
        @foreach (array_slice($items->toArray(), 0, 1) as $item)
            <h5>Customer Name :{{$item->c_name}}</h5> 
            <h5>Order ID      :{{$item->o_id}}</h5> 
            <h5>Order PO      :{{$item->o_po}}</h5> 
            <h5>Order Date      :{{$item->created_at}}</h5>
            <h5>Delivery Date      :{{$item->o_d_date}}</h5> 
        @endforeach
    </div>
    <div class="col-md-6">
            <p align="right">www.lankaplywood.lk</p>
            <h5 align="right">OREDR</h5>
        </div>
    <div class="col-md-12">
            <table class="table table-bordered">
                    <thead>
                        <tr class="text-center text-uppercase">
                            <th>Product Name</th>
                            <th>LENGTH(MM)</th>
                            <th>WIDTH(MM)</th>
                            <th>THICKNESS(MM)</th>
                            <th>DOORTYPE</th>
                            <th>DOOR SKIN</th>
                            <th>QUANTITY</th>
                            <TH>NOTE</TH>
                        </tr>
                    </thead>
                    @foreach($items as $item)
                    <tr>
                        <td>
                           {{$item->o_p_type}}
                            </td>
                            <td>{{$item->o_p_length}}</td>
                            <td>{{$item->o_p_width}}</td>
                            <td>{{$item->o_p_thikness}}</td>
                            <td>{{$item->o_p_type}}</td>
                            <td>{{$item->o_p_doorskin}}</td>
                            <td>{{$item->o_p_qty}}</td>
                            <td>{{$item->o_p_note}}</td>
                        
                    </tr>
                    @endforeach
                        
                    
                </table>
    </div>
  
    
<div class="row">
	<div style="width:100%; height:700px, padding-top:50px; padding-bottom:100px;" class="zam col-md-12">
		<button onclick="window.print();" class="only_sc btn btn-info float-right zam btn-link">Customer Print</button>  
	<div>
</div>
    
<script>
$(document).ready(function(){
    $(".zam").hover(function(){
        $(".zamana").hide();
		//$(".zam").css({"color":"white","background-color":"white","border-color":"white"});
    });
	
	
    $(".zam").mouseout(function(){
        $(".zamana").show();
		//$(".zam").css({"color":"black","background-color":"white","border-color":"black"});
    });
	
});
</script>
	
	
</body>
</html>