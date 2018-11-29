@extends('layouts.app')

@section('content')

<div class="col-md-12">
	
		<div class="panel panel-primary">
		  <div class="panel-heading">MAKE ORDER</div>
			  <div class="panel-body">

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                  @endif
                  @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                  @endif

                				
      <form method="post" action="{{ action('OrderController@store') }}" accept-charset="UTF-8">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="col-md-3">
                        
	
                            <!-- CUSTOMER DETAILS-->
                            <div class="col-md-6">
                                    <div class="form-group"><!--order id-->
                                        <label for="order_id">ORDER NO:</label>
                                        <input type="text"value="{{$OrderNO}}" readonly class="form-control" id="order_id" name="order_id">
                                   
                                    </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                    <div class="form-group"><!--purchase order id-->
                                        <label for="po_id">PO NO:</label>
                                        <input type="text" class="form-control" id="po_id" name="po_id" required>
                                        @if($errors->has('po_id'))
                                        <div class="alert alert-warning">
                                           Not Null
                                        </div>
                                    @endif
                                    </div>
                                    </div>
                                    
                                    <div class="form-group"><!--customer name-->
                                    <label for="cust_name">CUSTOMER NAME:</label>
                                    <input type="text" class="form-control" id="cust_name" name="cust_name">
                                    @if($errors->has('cust_name'))
                                    <div class="alert alert-warning">
                                        Please Enter Employee Name
                                    </div>
                                @endif
                                    </div>
                                    
                                    <div class="form-group"><!--DELIVERY date-->
                                    <label for="order_date">DELIVERY DATE:</label>
                                    <input type="date" class="form-control" id="order_date" name="order_date" required>
                                    @if($errors->has('order_date'))
                                    <div class="alert alert-warning">
                                        Please Enter Order Date
                                    </div>
                                @endif
                                    </div>
                                    
                                    <div class="form-group"><!--Customer contact number-->
                                    <label for="cust_phone">CONTACT NUMBER:</label>
                                    <input type="text" class="form-control" id="cust_phone" name="cust_phone" required>
                                    @if($errors->has('cust_phone'))
                                    <div class="alert alert-warning">
                                        Please Enter Contact number
                                    </div>
                                @endif
                                    </div>
                                    
                                    <div class="form-group"><!--Customer email-->
                                    <label for="cust_email">EMAIL ADDRESS:</label>
                                    <input type="email" class="form-control" id="cust_email" name="cust_email">
                                    @if($errors->has('cust_email'))
                                    <div class="alert alert-warning">
                                        Please Enter valid Email
                                    </div>
                                @endif 
                                    </div>

                                    
                                    <div class="form-group"><!--Customer Adressl-->
                                        <label for="cust_email">CUSTOMER ADDRESS:</label>
                                        <input type="text" class="form-control" id="cust_address" name="CUSSadd" placeholder="LINE 1" required>
                                        @if($errors->has('CUSSadd'))
                                        <div class="alert alert-warning">
                                            Please Enter Customer Adress
                                        </div>
                                         @endif 
                                    </div>
                                    
                                    <div class="form-group"><!--Customer email-->
                                    <label for="cust_email">SHIPPING ADDRESS:</label>
                                    <input type="text" class="form-control" id="cust_email" name="addl1" placeholder="LINE 1" required>
                                    @if($errors->has('addl1'))
                                    <div class="alert alert-warning">
                                        Please Enter Shipping Address
                                    </div>
                                    @endif
                                    <input type="text" class="form-control" id="cust_email" name="addl2" placeholder="LINE 2" required>
                                    @if($errors->has('addl2'))
                                    <div class="alert alert-warning">
                                        Please Enter Address line 1
                                    </div>
                                     @endif
                                    <input type="text" class="form-control" id="cust_email" name="city" placeholder="CITY" required>
                                    @if($errors->has('city'))
                                    <div class="alert alert-warning">
                                        Please Enter City
                                    </div>
                                     @endif
                                    
                                    </div>
                                    
                                    <!-- CUSTOMER NOTIFICATION TYPE-->
                                    <div class="form-group">
                                    <label for="sel1">CUSTOMER NOTIFICATION TYPE</label>
                                    <select class="form-control" id="sel1" name="notification">
                                    <option value="email">EMAIL</option>
                                    <option value="sms">TEXT (SMS)</option>
                                    <option value="smsmail">EMAIL + TEXT (SMS)</option>
                                    </select>
                                    @if($errors->has('notification'))
                                    <div class="alert alert-warning">
                                        Please Enter Notification Type
                                    </div>
                                     @endif
                                    </div>
                                </div>
                                

                                    <div class="col-md-9">
			
                                            <!-- PRODUCTS DETAILS-->
                                            <div class="panel-group" id="accordion">
    
                                                    <!--product 1-->
                                                    <div class="panel panel-default">
                                                      <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">PRODUCTS</a>
                                                        </h4>
                                                      </div>
                                                      <div id="collapse1" class="panel-collapse collapse in">
                                                        <div class="panel-body">
                                                        
																<div class="table-responsive">
                                                                <table class="table">
                                                                        <thead>
                                                                          <tr>
                                                                            <th>PRODUCT</th>
                                                                            <th>LENGTH</th>
                                                                            <th>WIDTH</th>
                                                                            <th>THICKNESS</th>
                                                                            <th>DOOR SKIN</th>
                                                                            <th>TYPE</th>
                                                                            <th>QUANTITY</th>
                                                                            <th>NOTES</th>
                                                                            <th><a class="ddRow" href="#" onclick="addrow()"> <i class="glyphicon glyphicon-plus"></i></a></th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                          
                                                                                 <tr>
                                                                                        <td><select class="form-control" id="sel1" name="option[]">
                                                                                        <option value="DOORS">DOORS</option>
                                                                                        <option value="SHEETS">SHEETS</option>
                                                                                        <option value="VENEER">VENEER BALES</option>
                                                                                        </select></td>
                                                                                        <td><input type="txt" class="form-control" id="pl" name="pl[]"></td>
                                                                                        <td><input type="txt" class="form-control" id="pw" name="pw[]"></td>
                                                                                        <td><input type="txt" class="form-control" id="pt" name="pt[]"></td>
                                                                                        <td><input type="txt" class="form-control" id="dk" name="dk[]"></td>
                                                                                        <td><input type="txt" class="form-control" id="type" name="type[]" placeholder="S/NS"></td>
                                                                                        <td><input type="txt" class="form-control" id="qty" name="qty[]" required></td>
                                                                                        <td><input type="txt" class="form-control" id="none" name="note[]" placeholder="NOTES"></td>
                                                                                        
                                                                                        </tr> 
                                                                           
                                                                          
                                                                          
                                                                          
                                                                        </tbody>
                                                                </table>
																</div>
                                                        
                                                        </div>
                                                      </div>
                                                    </div>
                                                        
                                                    
                                            </div> 
                        
                                        </div>
                                    
                                      
                                                    
                                        <button type="submit" class="btn btn-primary">PLACE ORDER</button>
                                        <button type="reset" class="btn btn-link">RESET</button>       
                         </form>   
                             
                    </div>

                   
              </div>
        </div>
    </div>


    <script>
       
$('.addRow').on('click',function(){
        addrow;
    });
        function addrow()
        {
            var adROW=
            '<tr class="Addrow">'+
                '<td><select class="form-control" id="sel1" name="option[]">'+
                '<option value="DOORS">DOORS</option>'+
                '<option value="SHEETS">SHEETS</option>'+
                '<option value="VENEERBALES">VENEER BALES</option>'+
                '</select></td>'+
                '<td><input type="txt" class="form-control" id="pl" name="pl[]"></td>'+
                '<td><input type="txt" class="form-control" id="pw" name="pw[]"></td>'+
                '<td><input type="txt" class="form-control" id="pt" name="pt[]"></td>'+
                '<td><input type="txt" class="form-control" id="dk" name="dk[]"></td>'+
                '<td><input type="txt" class="form-control" id="type" name="type[]" placeholder="S/NS"></td>'+
                '<td><input type="txt" class="form-control" id="qty" name="qty[]" required></td>'+
                '<td><input type="txt" class="form-control" id="none" name="note[]" placeholder="NOTES"></td>'+
                '<td><a type="button" class="btn btn-danger"onClick="$(this).parent().parent().remove();"><i class="glyphicon glyphicon-remove"></i></a> </td>'+
               ' </tr>';
               $('tbody').append(adROW);
        };
       
       
        

    </script> 

@endsection
