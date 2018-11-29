<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Mail\SendMail;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  return Carbon::now();
        
       
        if (Auth::user())
        {
       $items= DB::table('tbl_customer')
           ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
          ->select( 'tbl_customer.c_name',
            'tbl_customer.o_id',
            'tbl_customer.c_phone',
            'tbl_customer.created_at',
            'tbl_orders.0_p_name as o_po_Name',
            'tbl_orders.id',
            'tbl_orders.o_p_length',
            'tbl_orders.o_p_width',
            'tbl_orders.o_p_thikness',
            'tbl_orders.o_p_doorskin',
            'tbl_orders.o_p_type',
            'tbl_orders.o_p_qty',
            'tbl_orders.o_p_note',
            'tbl_orders.o_d_add1',
            'tbl_orders.o_d_add2',
            'tbl_orders.o_d_city',
            'tbl_orders.o_d_date',
            'tbl_orders.o_state',
            'tbl_orders.o_production_qty',
            'tbl_orders.o_stock_qty',
            'tbl_orders.o_dilivery_qty'
            )->orderBy('o_id', 'desc')
            ->get();
                   
           // $items= DB::table('tabel_lpw_customer')
           // ->get();
      
          

           return view('pages.orders')->with('items',$items);
       }else
       {
           return view('auth.login');
       }
      
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $GetIDValue = DB::table('tbl_customer')->max('o_id')+1;
        $product=DB::table('product_table')->get();

        return view('pages.makeorder',compact(['$GetIDValue',$GetIDValue,'productions',$product]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     if (Auth::user())
        {
            $this->validate($request,[
                "order_id"=>'required',
                "po_id"=>'required',
                "cust_name"=>'required',
                "order_date"=>'required',
                "cust_phone"=>'required',
                //"cust_email"=>'required',
                "CUSSadd"=>'required',
                "addl1"=>'required',
                "addl2"=>'required',
                "city"=>'required',
                "notification"=>'required',
               ]);
            
            $order=new Order();
            $order->o_id=$request->input('order_id');	
            $order->c_Name=$request->input('cust_name');	
            $order->c_add=$request->input('CUSSadd');	
            $order->c_phone=$request->input('cust_phone');	
            if(!empty($request->cust_email)){
                $order->c_email=$request->input('cust_email');
            }
            
            $order->c_n_type=$request->input('notification');
            $order->created_at=Carbon::now();	 
            $sucess =$order->save();   

            if($sucess !=0){
                //foreach($request->option as $key => $val)
                $ids=$request->option;
                for ($val = 0; $val < count($ids); $val++)
                        { DB::table('tbl_orders')->insert(
                                    [ 'o_id'=>$request->input('order_id'),
                                        'o_po'=>$request->input('po_id'),	
                                        'o_d_date'=>$request->input('order_date'),	
                                        'o_d_add1'=>$request->input('addl1'),	
                                        'o_d_add2'=>$request->input('addl2'),	
                                        'o_d_city'=>$request->input('city'),
                                        'o_p_length'=>$request->pl[$val],	
                                        'o_p_width'=>$request->pw[$val],	
                                        'o_p_thikness'=>$request->pt[$val],	
                                        'o_p_doorskin'=>$request->dk[$val],
                                        '0_p_name'=>$request->option[$val],	
                                        'o_p_type'=>$request->type[$val],
                                        'o_state'=>'0',
                                        'o_production_qty'=>'0',
                                        'o_stock_qty'=>'0',
                                        'o_dilivery_qty'=>'0',
                                        //'o_doorsign'=>$request->input('o_doorsign'),	
                                        'o_p_qty'	=>$request->qty[$val],
                                        //'o_states'=>$request->input('note'),	
                                        'o_p_note'=>$request->note[$val]
                                        ]
                            );

                }
            }
                //mail send
                if($request->notification=="TEXT (SMS)")
                {
                //sms Send
                        $smsDetails=DB::table('tbl_orders')->where('tbl_orders.o_id',$id)
                        ->select('tbl_orders.0_p_name as o_po_Name',
                        'tbl_orders.o_p_length',
                        'tbl_orders.o_p_width',
                        'tbl_orders.o_p_thikness',
                        'tbl_orders.o_p_doorskin',
                        'tbl_orders.o_p_type',
                        'tbl_orders.o_p_qty',
                        'tbl_orders.o_p_note',
                        'tbl_orders.o_d_add1',
                        'tbl_orders.o_d_add2',
                        'tbl_orders.o_d_city',
                        'tbl_orders.o_d_date',
                        'tbl_orders.o_state',
                        'tbl_orders.o_production_qty',
                        'tbl_orders.o_stock_qty',
                        'tbl_orders.o_dilivery_qty'
                        )
                        ->get(); 

                        foreach($smsDetails as $smsDetail)
                        {
                        
                            $start="Order No:".$request->input('order_id');
                            $text=" Product :".$smsDetail->o_po_Name." Width:".$smsDetail->o_p_width."mm Thickness:".$smsDetail->o_p_thikness."mm Length:".$smsDetail->o_p_length."mm Qty:".$smsDetail->o_p_qty."::D-Date:".$smsDetail->o_d_date;
                        
                            $end=" Thank you! LANKA PLYWOOD MANUFACTURERS PVT LTD.";
                        $message=urlencode($start.$text.$end);
                        
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, "https://cpsolutions.dialog.lk/index.php/cbs/sms/send?destination=".$request->input('cust_phone')."&q=15371617814586&message=".$message);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        
                        $result = curl_exec ($curl);
                        curl_close ($curl);
                }
            }
                else if($request->notification=="EMAIL")
                {
                    Mail::send(new SendMail());

               
               
                    $id=$request->input('order_id');
                    $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$id)
                            ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                            ->select('tbl_customer.c_name',
                             'tbl_customer.o_id',
                             'tbl_customer.c_phone',
                             'tbl_orders.o_po',
                             'tbl_customer.created_at',
                             'tbl_orders.0_p_name as o_po_Name',
                             'tbl_orders.o_p_length',
                             'tbl_orders.o_p_width',
                             'tbl_orders.o_p_thikness',
                             'tbl_orders.o_p_doorskin',
                             'tbl_orders.o_p_type',
                             'tbl_orders.o_p_qty',
                             'tbl_orders.o_p_note',
                             'tbl_orders.o_d_add1',
                             'tbl_orders.o_d_add2',
                             'tbl_orders.o_d_city',
                             'tbl_orders.o_d_date',
                             'tbl_orders.o_state',
                             'tbl_orders.o_production_qty',
                             'tbl_orders.o_stock_qty',
                             'tbl_orders.o_dilivery_qty'
                         )
                             ->get();  
    
                }else
                {
                    if(!empty($request->cust_email)){
                         Mail::send(new SendMail());
                    }
                   

               
               
                    $id=$request->input('order_id');
                    $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$id)
                            ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                            ->select('tbl_customer.c_name',
                             'tbl_customer.o_id',
                             'tbl_customer.c_phone',
                             'tbl_orders.o_po',
                             'tbl_customer.created_at',
                             'tbl_orders.0_p_name as o_po_Name',
                             'tbl_orders.o_p_length',
                             'tbl_orders.o_p_width',
                             'tbl_orders.o_p_thikness',
                             'tbl_orders.o_p_doorskin',
                             'tbl_orders.o_p_type',
                             'tbl_orders.o_p_qty',
                             'tbl_orders.o_p_note',
                             'tbl_orders.o_d_add1',
                             'tbl_orders.o_d_add2',
                             'tbl_orders.o_d_city',
                             'tbl_orders.o_d_date',
                             'tbl_orders.o_state',
                             'tbl_orders.o_production_qty',
                             'tbl_orders.o_stock_qty',
                             'tbl_orders.o_dilivery_qty'
                         )
                             ->get();  
    
    //sms Send
    $smsDetails=DB::table('tbl_orders')->where('tbl_orders.o_id',$id)
    ->select('tbl_orders.0_p_name as o_po_Name',
     'tbl_orders.o_p_length',
     'tbl_orders.o_p_width',
     'tbl_orders.o_p_thikness',
     'tbl_orders.o_p_doorskin',
     'tbl_orders.o_p_type',
     'tbl_orders.o_p_qty',
     'tbl_orders.o_p_note',
     'tbl_orders.o_d_add1',
     'tbl_orders.o_d_add2',
     'tbl_orders.o_d_city',
     'tbl_orders.o_d_date',
     'tbl_orders.o_state',
     'tbl_orders.o_production_qty',
     'tbl_orders.o_stock_qty',
     'tbl_orders.o_dilivery_qty'
      )
     ->get(); 
    
    foreach($smsDetails as $smsDetail)
      {
       
        $start="Order No:".$request->input('order_id');
        $text=" Product :".$smsDetail->o_po_Name." Width:".$smsDetail->o_p_width."mm Thickness:".$smsDetail->o_p_thikness."mm Length:".$smsDetail->o_p_length."mm Qty:".$smsDetail->o_p_qty."::D-Date:".$smsDetail->o_d_date;
     
        $end=" Thank you! LANKA PLYWOOD MANUFACTURERS PVT LTD.";
      $message=urlencode($start.$text.$end);
      
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, "https://cpsolutions.dialog.lk/index.php/cbs/sms/send?destination=".$request->input('cust_phone')."&q=15371617814586&message=".$message);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      
      $result = curl_exec ($curl);
      curl_close ($curl);
      
    }
                }
               
              

return view('OrderPrintPage')->with('items',$items)
                        ->with('success','Order Success') ; 

        }else
        {
            return view('auth.login');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$id)
        ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
        ->select('tbl_customer.c_name',
         'tbl_customer.o_id',
         'tbl_customer.c_phone',
         'tbl_orders.o_po',
         'tbl_customer.created_at',
         'tbl_orders.id',
         'tbl_orders.0_p_name as o_po_Name',
         'tbl_orders.o_p_length',
         'tbl_orders.o_p_width',
         'tbl_orders.o_p_thikness',
         'tbl_orders.o_p_doorskin',
         'tbl_orders.o_p_type',
         'tbl_orders.o_p_qty',
         'tbl_orders.o_p_note',
         'tbl_orders.o_d_add1',
         'tbl_orders.o_d_add2',
         'tbl_orders.o_d_city',
         'tbl_orders.o_d_date',
         'tbl_orders.o_state',
         'tbl_orders.o_production_qty',
         'tbl_orders.o_stock_qty',
         'tbl_orders.o_dilivery_qty'
         )
         ->get();   
        
        
        return view('pages.OrderView')->with('items',$items); 

         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //return 0;

      $items= DB::table('tbl_orders')->where('id',$id)
      ->select(
       'tbl_orders.id',
       'tbl_orders.0_p_name as o_po_Name',
       'tbl_orders.o_p_length',
       'tbl_orders.o_p_width',
       'tbl_orders.o_p_thikness',
       'tbl_orders.o_p_doorskin',
       'tbl_orders.o_p_type',
       'tbl_orders.o_p_qty',
       'tbl_orders.o_p_note',
       'tbl_orders.o_d_add1',
       'tbl_orders.o_d_add2',
       'tbl_orders.o_d_city',
       'tbl_orders.o_d_date',
       'tbl_orders.o_state',
       'tbl_orders.o_production_qty',
       'tbl_orders.o_stock_qty',
       'tbl_orders.o_dilivery_qty'
       )->get();   

      
       return view('pages.edit')->with('items',$items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
   
    
    }
public function updateItem(Request $request, $id)
{
    //return $id;
            
    DB::table('tbl_orders')
            ->where('id', $id)
            ->update([
            'o_p_length'=>$request->length,
             'o_p_width'=>$request->width,          
            'o_p_thikness'=>$request->thckness]);
           
            return redirect('Order')->with('status', 'Successfully Updated!');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function customerPrint($id)
    {
        if (Auth::user())
        {
            $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$id)
                ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                ->select('tbl_customer.c_name',
                 'tbl_customer.o_id',
                 'tbl_customer.c_phone',
                 'tbl_orders.o_po',
                 'tbl_customer.created_at',
                 'tbl_orders.o_p_length',
                 'tbl_orders.o_p_width',
                 'tbl_orders.o_p_thikness',
                 'tbl_orders.o_p_doorskin',
                 'tbl_orders.o_p_type',
                 'tbl_orders.o_p_qty',
                 'tbl_orders.o_p_note',
                 'tbl_orders.o_d_add1',
                 'tbl_orders.o_d_add2',
                 'tbl_orders.o_d_city',
                 'tbl_orders.o_d_date',
                 'tbl_orders.o_state',
                 'tbl_orders.o_production_qty',
                 'tbl_orders.o_stock_qty',
                 'tbl_orders.o_dilivery_qty'
             )
                 ->get();   
                
                //return view('pages.orders')->with('items',$items);

                 return view('pages.OrderPrint.customerPrint')->with('items',$items);
       }else
       {
           return view('auth.login');
       }
   
    }
    public function CompanyPrint($id)
    {
        if (Auth::user())
        {
           
            $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$id)
                ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                ->select('tbl_customer.c_name',
                 'tbl_customer.o_id',
                 'tbl_customer.c_phone',
                 'tbl_customer.created_at',
                 'tbl_orders.o_p_length',
                 'tbl_orders.o_p_width',
                 'tbl_orders.o_p_thikness',
                 'tbl_orders.o_p_doorskin',
                 'tbl_orders.o_p_type',
                 'tbl_orders.o_p_qty',
                 'tbl_orders.o_p_note',
                 'tbl_orders.o_d_add1',
                 'tbl_orders.o_d_add2',
                 'tbl_orders.o_d_city',
                 'tbl_orders.o_d_date',
                 'tbl_orders.o_state',
                 'tbl_orders.o_production_qty',
                 'tbl_orders.o_stock_qty',
                 'tbl_orders.o_dilivery_qty'
                 )
                 ->get();   
                
                
                 return view('pages.OrderPrint.CompanyPrint')->with('items',$items);
       }else
       {
           return view('auth.login');
       }
        
    }
    public function currentOrdrs()
    {
       return view('pages.currentorders');
        
        $items= DB::table('tbl_customer')->where('tbl_customer.o_id',1)
        ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
        ->select('tbl_customer.c_name',
        'tbl_customer.o_id',
        'tbl_customer.c_phone',
        'tbl_customer.created_at',
        'tbl_orders.o_p_length',
        'tbl_orders.o_po',
        'tbl_orders.0_p_name as o_po_num',
        'tbl_orders.o_p_width',
        'tbl_orders.o_p_thikness',
        'tbl_orders.o_p_doorskin',
        'tbl_orders.o_p_type',
        'tbl_orders.o_p_qty',
        'tbl_orders.o_p_note',
        'tbl_orders.o_d_add1',
        'tbl_orders.o_d_add2',
        'tbl_orders.o_d_city',
        'tbl_orders.o_d_date',
        'tbl_orders.o_state',
        'tbl_orders.o_production_remain_qty',
        'tbl_orders.o_stock_remain_qty',
        'tbl_orders.o_delivery_remain_qty',
        'tbl_orders.o_production_qty',
        'tbl_orders.o_stock_qty',
        'tbl_orders.o_dilivery_qty'
        )
         ->get();   
        
        return view('pages.currentorders')->with('items',$items);
        // return view('pages.currentorders')->with('items',$items,'stokes',$stokes);
      //  return view('pages.currentorders',compact('items',$items,'stokes',$stokes,'pends',$pends));
    }
    public function getOrder(Request $request)
    {
        $id=$request->oid;
       
       // $records= DB::table('record')->where('tbl_customer.o_id',$id)-get();
        
        $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$id)
        ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
        ->select('tbl_customer.c_name',
         'tbl_customer.o_id',
         'tbl_customer.c_phone',
         'tbl_customer.created_at',
         'tbl_orders.id',
         'tbl_orders.o_p_length',
         'tbl_orders.o_po',
         'tbl_orders.0_p_name as o_po_num',
         'tbl_orders.o_p_width',
         'tbl_orders.o_p_thikness',
         'tbl_orders.o_p_doorskin',
         'tbl_orders.o_p_type',
         'tbl_orders.o_p_qty',
         'tbl_orders.o_p_note',
         'tbl_orders.o_d_add1',
         'tbl_orders.o_d_add2',
         'tbl_orders.o_d_city',
         'tbl_orders.o_d_date',
         'tbl_orders.o_state',
         'tbl_orders.o_production_remain_qty',
         'tbl_orders.o_stock_remain_qty',
         'tbl_orders.o_delivery_remain_qty',
         'tbl_orders.o_production_qty',
         'tbl_orders.o_stock_qty',
         'tbl_orders.o_dilivery_qty'
         )
         ->get(); 

        $records= DB::table('record')->where('orderID',$id)->orderBy('created_at', 'desc')->get();
        
        return view('pages.currentorders',compact('items',$items,'records',$records));
        
        
       
    }

    function sendProductionfromStock(Request $request)
   {
   $id=$request->ID;
                                
                                        $productName=DB::table('tbl_orders')->where('id',$id)
                                            ->value('0_p_name');
                                            
                                        $AllProductionQty=DB::table('tbl_orders')->where('id',$id)
                                            ->value('o_p_qty');
                                        $AllstockQty=DB::table('tbl_orders')->where('id',$id)
                                            ->value('o_stock_qty');       
                                        $item_Updateqty=(int)$request->input('upQty');
                                    
                                        if($AllProductionQty>=$item_Updateqty)
                                        {
                                            $forProduction=$AllProductionQty-$item_Updateqty;
                                            $forStock=$AllstockQty+$item_Updateqty;

                                            DB::table('tbl_orders')
                                            ->where('id', $id)
                                            ->update(['o_p_qty' =>$forProduction,
                                                    'o_stock_qty'=>$forStock]);

                                                    DB::table('record')->insert(
                                                        [ 'Product'=>$productName,
                                                            'Action'=>"Add to Stock",	
                                                            'orderID'=>$request->itemid,	
                                                            'qty'=>$item_Updateqty,
                                                            'colID'=>$id,
                                                            'created_at'=>Carbon::now(),
                                                            'updated_at'=>Carbon::today()
                                                        
                                                        ]
                                                );
                                                    
                                                    
                                                    //return redirect('Current');
                                                    $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$request->itemid)
                                                    ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                                                    ->select('tbl_customer.c_name',
                                                     'tbl_customer.o_id',
                                                     'tbl_customer.c_phone',
                                                     'tbl_customer.created_at',
                                                     'tbl_orders.id',
                                                     'tbl_orders.o_p_length',
                                                     'tbl_orders.o_po',
                                                     'tbl_orders.0_p_name as o_po_num',
                                                     'tbl_orders.o_p_width',
                                                     'tbl_orders.o_p_thikness',
                                                     'tbl_orders.o_p_doorskin',
                                                     'tbl_orders.o_p_type',
                                                     'tbl_orders.o_p_qty',
                                                     'tbl_orders.o_p_note',
                                                     'tbl_orders.o_d_add1',
                                                     'tbl_orders.o_d_add2',
                                                     'tbl_orders.o_d_city',
                                                     'tbl_orders.o_d_date',
                                                     'tbl_orders.o_state',
                                                     'tbl_orders.o_production_remain_qty',
                                                     'tbl_orders.o_stock_remain_qty',
                                                     'tbl_orders.o_delivery_remain_qty',
                                                     'tbl_orders.o_production_qty',
                                                     'tbl_orders.o_stock_qty',
                                                     'tbl_orders.o_dilivery_qty'
                                                     )
                                                     ->get(); 
                                            
                                                    $records= DB::table('record')->where('orderID',$request->itemid)->orderBy('created_at', 'desc')->get();
                                                    
                                                   // return redirect('Cur');

                                                   return view('pages.currentorders',compact('items',$items,'records',$records)); 
                                                 
                                                    
                                                        

                    
                }
                return 'Invalid Value,Please Back ';
   }

   function sendStockfromDeliver(Request $request)
   {
    $id=$request->ID;
                      
       $productName=DB::table('tbl_orders')->where('id',$id)
    ->value('0_p_name');
    $AllstockQty=DB::table('tbl_orders')->where('id',$id)
           ->value('o_stock_qty');
    $AlldeliverQty=DB::table('tbl_orders')->where('id',$id)
           ->value('o_dilivery_qty');       
    $item_Updateqty=(int)$request->input('upQty');
   
    if($AllstockQty>=$item_Updateqty)
    {
        $forProduction=$AllstockQty-$item_Updateqty;
        $forDeliver=$AlldeliverQty+$item_Updateqty;

        DB::table('tbl_orders')
        ->where('id', $id)
        ->update(['o_dilivery_qty' =>$forDeliver,
                  'o_stock_qty'=> $forProduction]);

       
                  DB::table('record')->insert(
                    [ 'Product'=>$productName,
                        'Action'=>"Add to Deliver",	
                        'orderID'=>$request->itemid,	
                        'qty'=>$item_Updateqty,
                        'colID'=>$id,
                        'created_at'=>Carbon::now(),
                        'updated_at'=>Carbon::today()
                    ]);
                 // return redirect('Current');

                 $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$request->itemid)
                 ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                 ->select('tbl_customer.c_name',
                  'tbl_customer.o_id',
                  'tbl_customer.c_phone',
                  'tbl_customer.created_at',
                  'tbl_orders.id',
                  'tbl_orders.o_p_length',
                  'tbl_orders.o_po',
                  'tbl_orders.0_p_name as o_po_num',
                  'tbl_orders.o_p_width',
                  'tbl_orders.o_p_thikness',
                  'tbl_orders.o_p_doorskin',
                  'tbl_orders.o_p_type',
                  'tbl_orders.o_p_qty',
                  'tbl_orders.o_p_note',
                  'tbl_orders.o_d_add1',
                  'tbl_orders.o_d_add2',
                  'tbl_orders.o_d_city',
                  'tbl_orders.o_d_date',
                  'tbl_orders.o_state',
                  'tbl_orders.o_production_remain_qty',
                  'tbl_orders.o_stock_remain_qty',
                  'tbl_orders.o_delivery_remain_qty',
                  'tbl_orders.o_production_qty',
                  'tbl_orders.o_stock_qty',
                  'tbl_orders.o_dilivery_qty'
                  )
                  ->get(); 
         
                 $records= DB::table('record')->where('orderID',$request->itemid)->orderBy('created_at', 'desc')->get();
                 
                 return view('pages.currentorders',compact('items',$items,'records',$records));    
                 //return view('pages.currentorders')->with('items',$items);
              
    }
        return 'Invalid Value,Please Back ';
   }
   
   function fetch(Request $request)
   {
       return 123;
    if($request->get('query'))
    {
        
     $query = $request->get('query');
     $data = DB::table('tbl_customer')
       ->where('c_name', 'LIKE', "%{$query}%")
       ->get();
     $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
     foreach($data as $row)
     {
      $output .= '
      <li><a href="#">'.$row->country_name.'</a></li>
      ';
     }
     $output .= '</ul>';
     echo $output;
    }
   }

  
}
