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
                           <h1> Update Order</h1>
                    </div>
        </div>
  
<div class="col-md-12">
    <main class="my-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                        <div class="card">
                           
                            <div class="card-body">
                               
                                    
                            
                                    @foreach ($items as $item)
                                  
                                <form  action=" {{ URL('updateItem/'.$item->id) }}" method="get">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                                        
                                  
                                    <div class="form-group row">
                                        <label for="full_name" class="col-md-4 col-form-label text-md-right">Product Name</label>
                                        <div class="col-md-6">
                                            <input type="text" id="full_name" class="form-control" name="full-name" value="{{$item->o_po_Name}}" readonly>
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="email_address" class="col-md-4 col-form-label text-md-right">LENGTH(MM)</label>
                                        <div class="col-md-6">
                                            <input type="text" id="email_address" class="form-control" name="length" value="{{$item->o_p_length}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="user_name" class="col-md-4 col-form-label text-md-right">WIDTH(MM)</label>
                                        <div class="col-md-6">
                                            <input type="text" id="user_name" class="form-control" name="width" value="{{$item->o_p_width}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">THICKNESS(MM)</label>
                                        <div class="col-md-6">
                                            <input type="text" id="phone_number" class="form-control" name="thckness" value="{{$item->o_p_thikness}}">
                                        </div>
                                    </div>
    
                                   <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">QUANTITY</label>
                                        <div class="col-md-6">
                                            <input type="text" id="permanent_address" class="form-control" name="qty" value="{{$item->o_p_qty}}">
                                        </div>
                                    </div>
    
                                  
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                            UPADTE
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    
    </main>
  
</div>
    

</body>
</html>