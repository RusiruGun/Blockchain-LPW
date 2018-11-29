<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Current;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Order;



use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'help';
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
     return 123;
      
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
    public function ReportCity()
    {
        return view('Report.multiCityReport');
    }
    public function Cuslist()
    {
        if (Auth::user())
        {
           return view('Report.CustomerReport');
       }else
       {
           return view('auth.login');
       }
      
       
        
       // return view('Report.CustomerReport');
    }
    public function State()
    {
        return view('Report.StateReport');
    }
    public function CityExcel(Request $request)
    {
        $city1= $request->input('GetCity1');
        $city2= $request->input('GetCity2');
        $city3= $request->input('GetCity3');

       
       

        $records=DB::table('tbl_customer')
                    ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                    ->whereIn('tbl_orders.o_d_city', [$city1, $city2, $city3,])
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
                 )->get();
                

                 $recordData="";
                  if(count($records)>0)
                  {
                      $recordData.='<table>
                      <tr>
                      <th>Customer Name</th>
                     <th>Customer City</th>
                     <th>COntact Number</th>
                     </tr>
                      ';
                      foreach($records as $record)
                      {
                          $recordData.='
                          <tr>
                          <td>'.$record->c_name.'</td>
                          <td>'.$record->o_d_city.'</td>
                          <td>'.$record->c_phone.'</td>
                          
                          </tr>
                          ';
                      }
                      $recordData.='</table>';
                  }
         header('Content_Type:application/xls');
         header('Content-Disposition:attachment;filename=products.xls');
         echo $recordData;


    }
    public function DurationExcel(Request $request)
    {
        $city1= $request->input('fromDate');
        $city2= $request->input('to_date');
        $records=DB::table('tbl_customer')
                    ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                    ->whereBetween('created_at', [$city1, $city2])
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

                    $recordData="";
                    if(count($records)>0)
                    {
                        $recordData.='<table>
                        <tr>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th> ORDER PRODUCTION QUANTITY</th>
                        <th>ORDER STOCK QUANTITY</th>
                       <th>	ORDER DELIVERED QUANTITY</th>
                      
                       </tr>
                        ';
                        foreach($records as $record)
                        {
                            $recordData.='
                            <tr>
                            <td>'.$record->c_name.'</td>
                            <td>'.$record->o_po_num.'</td>
                            <td>'.$record->o_p_qty.'</td>
                            <td>'.$record->o_stock_qty.'</td>
                            <td>'.$record->o_dilivery_qty.'</td>
                           
                            
                            </tr>
                            ';
                        }
                        $recordData.='</table>';
                    }
           header('Content_Type:application/xls');
           header('Content-Disposition:attachment;filename=products.xls');
           echo $recordData;
    }
    public function CustomerExcel(Request $request)
    {   
        $city1= $request->input('cusName');
        $records=DB::table('tbl_customer')
                    ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                    ->where('tbl_customer.c_name',$city1)
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
        
             $recordData="";
                  if(count($records)>0)
                  {
                      $recordData.='<table>
                      <tr>
                      <th>Customer Name</th>
                      <th>PRODUCTION QTY</th>
                      <th>Order Quantity</th>
                      <th>STOCK QTYr</th>
                     <th>DELIVERY QTY</th>
                     <th>STATE</th>
                     </tr>
                      ';
                      foreach($records as $record)
                      {
                          $recordData.='
                          <tr>
                          <td>'.$record->c_name.'</td>
                          <td>'.$record->o_p_qty.'</td>
                          <td>'.$record->o_stock_qty.'</td>
                          <td>'.$record->o_dilivery_qty.'</td>
                          <td>'.$record->o_state.'</td>
                          
                          </tr>
                          ';
                      }
                      $recordData.='</table>';
                  }
        
         header('Content_Type:application/xls');
         header('Content-Disposition:attachment;filename=products.xls');
         echo $recordData;
    }
    public function DurationDate(Request $request)
    {
        $city1= $request->input('from_date');
        $city2= $request->input('to_date');
      

       
       

        $records=DB::table('tbl_customer')
                    ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                    ->whereBetween('created_at', [$city1, $city2])
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

                  
                    return view('Report.StateReport',compact('city1',$city1,'city2',$city2))->with('items',$records);




      
       
    }
    public function bycity(Request $request)
    {
        $city1= $request->input('cus_name');
        $city2= 1;
       $records=DB::table('tbl_customer')
                    ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                    ->where('tbl_customer.c_name',$city1)
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

                   
                    return view('Report.CustomerReport',compact('city1',$city1,'city2',$city2))->with('items',$records);




      
       
    }
    public function multicity(Request $request)
    {
        $city1= $request->input('City1');
        $city2= $request->input('City2');
        $city3= $request->input('City3');

        $date1= $request->input('from_date');
        $date2= $request->input('to_date');
       
       

        $records=DB::table('tbl_customer')
                    ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
                    ->whereIn('tbl_orders.o_d_city', [$city1, $city2, $city3,])
                    ->whereBetween('created_at', [$date1, $date2])
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

                  
                    return view('Report.multiCityReport',compact('city1',$city1,'city2',$city2,'city3',$city3,'fromdate',$date1,'TOdate',$date2))->with('items',$records);

                     
                  //  return view('Report.multiCityReport')->with('items',$records);
    }
    public function SearchCus(Request $request)
    {
       $customers= $records=DB::table('tbl_customer')->select('tbl_customer.c_name')->get();
        foreach($customers as $customer =>$value)
        {
            $searchResualt[]=$value->c_name;
        }
       return $searchResualt;
return $availableTags = [
	"ActionScript",
	"AppleScript",
	"Asp",
	"BASIC",
	"C",
	"C++",
	"Clojure",
	"COBOL",
	"ColdFusion",
	"Erlang",
	"Fortran",
	"Groovy",
	"Haskell",
	"Java",
	"JavaScript",
	"Lisp",
	"Perl",
	"PHP",
	"Python",
	"Ruby",
	"Scala",
	"Scheme"
  ];
    }
   
}
