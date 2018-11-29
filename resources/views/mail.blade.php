<html lang="en">
<head>
	<title>LANKA PLYWOOD OMS</title>
</head>
<body>
<div class="col-md-12">
        <div style="width:100%; height:200px;"><!--header section-->
                        <!--company details section-->
                        <div style="float:left; width:75%; height:100%; background:#e2e2e2;">
                            <h1>&nbsp;Lanka Plywood Manufacturers (Pvt) Ltd.</h1>
                                <h4>&nbsp;&nbsp;Industrial Estate, Pallekele, Kandy, Sri lanka.</h4>
                                <h4>&nbsp;&nbsp;TEL - 0814953318, 0777663920
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FAX
                        - 0814545657</h4>
                                <h4>&nbsp;&nbsp;EMAIL - info@lankaplywood.lk
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WEB
                        - lankaplywood.lk</h4>
                            </div>
                            <!--invoice section-->
                            <div style="float:right; width:25%; height:100%;
                        background:#232323;text-align:center; verticle-align:center;
                        color:white;">
                             <h1>INVOICE</h1>
                             @foreach (array_slice($items->toArray(), 0, 1) as $item)
                                 <h5>Customer Name :{{$item->c_name}}</h5> 
                                 <h5>Order ID      :{{$item->o_id}}</h5> 
                                  <h5>Delivery Date      :{{$item->o_d_date}}</h5> 
                             @endforeach
                            </div>
            </div>
   
   
    <div class="col-md-12">
            <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Product Name</th>
                            <th>LENGTH(MM)</th>
                            <th>WIDTH(MM)</th>
                            <th>THICKNESS(MM)</th>
                            <th>DOORTYPE</th>
                            <th>DOOR SKIN</th>
                            <th>QUANTITY</th>
                        </tr>
                    </thead>
                    @foreach($items as $item)
                    <tr>
                            <td>{{$item->o_po_num}}</td>
                            <td>{{$item->o_p_length}}</td>
                            <td>{{$item->o_p_width}}</td>
                            <td>{{$item->o_p_thikness}}</td>
                            <td>{{$item->o_p_type}}</td>
                            <td>{{$item->o_p_doorskin}}</td>
                            <td>{{$item->o_p_qty}}</td>
                        
                    </tr>
                    @endforeach
                        
                    
                </table>
    </div>
  
    
</div>
 

</body>
</html>