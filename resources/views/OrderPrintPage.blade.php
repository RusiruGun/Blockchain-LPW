@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


            
        </div>


    </div>

   
</div>

<div class="col-md-12 ">
        @foreach (array_slice($items->toArray(), 0, 1) as $item)
        <div class="row text-center text-uppercase" style="padding-bottom:50px;">
    
            <div class="col-md-6 ">
                
                    <a class="btn btn-warning" style="border-rdius:0px !important;" href="{{ url('PrintCus/'.$item->o_id) }}">Customer Print </a>
                
            </div>

            <div class="col-md-6">
                
                    <a class="btn btn-success" style="border-rdius:0px !important;" href="{{ url('PrintCom/'.$item->o_id) }}">Production Print</a>
               
            </div>
    
        </div>

    <div>
            
 {{-- company details --}}
    <h4 align="center">LANKA PLYWOOD MANUFACTURERS (PVT) LTD.</h4>
    <p align="center">Industrial Estate,Pallekale,Kandy</p>
    <p align="center">Tel -081 4953318 ,0777663920 Fax-0814545657</p>
    <p align="center"> Email-info@lankaplywood.lk</p>


    </div>
    
    
   
    <div align="left" class="col-md-6">
      {{-- @foreach($items  as $item) --}}
      {{-- @foreach ($items->slice(0, 1) as $items) --}}
      <h4 class="text-uppercase">Customer details</h4>
      <ul>
            <h5>Customer Name :{{$item->c_name}}</h5> 
            <h5>Order ID      :{{$item->o_id}}</h5> 
            <h5>PO Number      :{{$item->o_po}}</h5> 
      </ul>
            
   
    </div>
    <div align="right" class="col-md-6">
        <h4 class="text-uppercase" >Delivery Adress</h4>
        <ul>
            <h5>{{$item->o_d_add1}}</h5>
            <h5>{{$item->o_d_add2}}</h5>
            <h5>{{$item->o_d_city}}</h5>
        </ul>
    </div>
        @endforeach
        {{-- end details --}}
    <div class="col-md-12">
            <table class="table table-bordered footable">
                    <thead>
                        <tr class="text-center text-uppercase">
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
                        <td>{{$item->o_po_Name}}</td>
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
    {{-- <button onclick="window.print();" class="only_sc btn btn-info float-right">Print</button>   --}}

    <script type="text/javascript">
        $(document).ready(function(){
            $('.footable').footable();
        });
    </script>
</div>
@endsection
