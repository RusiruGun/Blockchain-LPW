@extends('layouts.app')
@section('content')

<div class="container mt-3">
    <h2>CURRENT ORDERS</h2>
    <br>
    <div>
                <form class="form-horizontal" method="POST" action="Pro">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="text" placeholder="Enter Order ID" id="orderID" name="oid">
                
                <input type="submit" id="btnAddProduct" value="Find Products" class="btn btn-success" >
                
              </form>
         </div>

         @if(!empty($items))
         @foreach (array_slice($items->toArray(), 0, 1) as $item)
                 
        PO NUMBER:<input readonly type="text" value="{{$item->o_po}}" id="orderPO" name="Pono">
          @endforeach

         @endif 

         @if(!empty($items))                       
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                            <li class="nav-item">
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
                            <div id="home" class="container tab-pane active"><br>
                                
                            
                                    </table> 
                                        <table class="table table-bordered table-striped table-hover" data-sorting="true">
                                        <thead>
                                                <tr>
                                            
                                                        <th>PRODUCT NAME</th>
                                                        <th>ORDER PRODUCTION QUANTITY</th>
                                                       
                                                        <th>TO STOCK</th>
                                                       
                                                </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @foreach($items as $item)
                                        <tr>
                                        <td>{{$item->o_po_num}}</td>
                                        <td>{{$item->o_p_qty}}</td>
                                        <td>
                                         <form method="PUT" action="Production/{{$item->id}}">
                                                <input type="hidden" name="itemid" value="{{$item->o_id}}">
                                                 {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                        <input type="number" placeholder="Enter Value" name="upQty">
                                        
                                        <button type="submit" class="btn btn-primary" style="width: 46%; float: right;">Update</button>
                                       
                                      </form> 
                                        </td>
                                          
                                        
                                        </tr>
                                        
                                        @endforeach  
                                        
                                            
                                        </tbody>  
                                    </table>
                            </div>
                            {{--END   IN Production --}}

                                {{-- Start  IN stoke --}}
                            <div id="menu1" class="container tab-pane fade"><br>
                                
                               
                                <table class="table table-bordered table-striped table-hover" data-sorting="true">
                                        <thead>
                                                <tr>
                                            
                                                        <th>PRODUCT NAME</th>
                                                        <th>ORDER STOKE QUANTITY</th>
                                                        <th>TO DELIVERD</th>
                                                       
                                                </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @foreach($items as $item)
                                        <tr>
                                        <td> @if($item->o_po_num==0)
                                                        DOOR
                                                        @elseif($item->o_po_num==1)
                                                        SHEETS
                                                        @elseif($item->o_po_num==2)
                                                        VENEER BALES
                                                        @endif</td>
                                        <td>{{$item->o_stock_qty}}</td>
                                        <td> <form method="PUT" action="stock/{{$item->id}}">
                                                <input type="hidden" name="itemid" value="{{$item->o_id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                        <input type="number" placeholder="Enter Value" name="upQty">
                                        
                                        <button type="submit" class="btn btn-primary" style="width: 46%; float: right;">Update</button>
                                       
                                      </form> 
                                                </td>

                                        
                                        </tr>
                                        
                                        @endforeach  
                                        
                                            
                                        </tbody>  
                                    </table>    
                            </div>
                                {{-- END IN STOCK --}}
                            
                                {{-- Start DELIVERED --}}
                            <div id="menu2" class="container tab-pane fade"><br>
                            
                                <table class="table table-bordered table-striped table-hover" data-sorting="true">
                                        <thead>
                                                <tr>
                                            
                                                        <th>PRODUCT NAME</th>
                                                        <th>ORDER DELIVERED QUANTITY</th>
                                                       
                                                       
                                                </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @foreach($items as $item)
                                        <tr>
                                        <td> @if($item->o_po_num==0)
                                                        DOOR
                                                        @elseif($item->o_po_num==1)
                                                        SHEETS
                                                        @elseif($item->o_po_num==2)
                                                        VENEER BALES
                                                        @endif</td>
                                        <td>{{$item->o_dilivery_qty}}</td>
                                        
                                        
                                        </tr>
                                        
                                        
                                        @endforeach  
                                       
                                            
                                        </tbody>  
                                    </table>
                            </div>
                            {{-- END DELIVERED --}}
                            </div>
                                   
                        </div>

                        @foreach (array_slice($items->toArray(), 0, 1) as $item)
                        <a href="{{ url('Current/'.$item->o_id) }}" class="btn btn-primary">Export to Excel</a>
                       
                        
                    @endforeach
           @endif   
        @if(!empty($records))
        
        <table class="table table-bordered table-striped table-hover" data-sorting="true">
                        <thead>
                                <tr>
                            
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
                        <td> @if($record->Product==0)
                                        DOOR
                                        @elseif($record->Product==1)
                                        SHEETS
                                        @elseif($record->Product==2)
                                        VENEER BALES
                                        @endif</td>
                        <td>{{$record->colID}}</td>
                        <td>{{$record->Action}}</td>
                        
                        <td>{{$record->qty}}</td>
                        
                        
                        </tr>
                        
                        @endforeach  
                        
                            
                        </tbody>  
                    </table>
        @endif  
<script>
  function getOrder()
  {
    var orderID=document.getElementById("orderID").value;
    

    window.open("Pro/"+orderID,"_self");

    
  }endsection
</script>

