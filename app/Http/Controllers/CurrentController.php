<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Current;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Order;


use Illuminate\Http\Request;

class CurrentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
       // $customer_data = DB::table('record')->where('orderID',1)->get()->toArray();
       $records = Current::where('orderID',1)->get();
       
       $recordData="";
            if(count($records)>0)
            {
                $recordData.='<table>
                <tr>
                <th>Product Name</th>
                <th>Action</th>
                <th>Quantity</th>
                <th>created_at</th>

                <th>Order ID</th>
                </tr>
                ';
                foreach($records as $record)
                {
                    $recordData.='
                    <tr>
                    <td>.$record->Product.</td>
                    <td>.$record->Action.</td>
                    <td>.$record->qty.</td>
                    <td>.$record->created_at.</td>
                    
                    </tr>
                    ';
                }
                $recordData.='</table>';
            } $records = Current::where('orderID',1)->get();
       
            $recordData="";
                 if(count($records)>0)
                 {
                     $recordData.='<table>
                     <tr>
                     <th>Product Name</th>
                     <th>Action</th>
                     <th>Quantity</th>
                     <th>created_at</th>
     
                     <th>Order ID</th>
                     </tr>
                     ';
                     foreach($records as $record)
                     {
                         $recordData.='
                         <tr>
                         <td>'.$record->Product.'</td>
                         <td>'.$record->Action.'</td>
                         <td>'.$record->qty.'</td>
                         <td>'.$record->created_at.'</td>
                         
                         </tr>
                         ';
                     }
                     $recordData.='</table>';
                 }
       
        header('Content_Type:application/xls');
        header('Content-Disposition:attachment;filename=products.xls');
        echo $recordData;
       }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
                        'created_at'=>Carbon::today(),
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
                 'tbl_orders.o_dilivery_qty',
                 'tbl_orders.o_production_date',
                 'tbl_orders.o_stock_date',
                 'tbl_orders.o_delivery_date')
                 ->get(); 
        
                $records= DB::table('record')->where('orderID',$id)->get();
               
                return redirect('Pro',compact('items',$items,'records',$records));   
               
                return redirect('Pro');
               
                return view('pages.currentorders',compact('items'));   
                
                    


}
return 'Invalid Value,Please Back ';
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
}
