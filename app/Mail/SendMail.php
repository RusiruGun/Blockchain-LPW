<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(request $request)
    {
        $items= DB::table('tbl_customer')->where('tbl_customer.o_id',$request->order_id)
        ->join('tbl_orders', 'tbl_customer.o_id', '=', 'tbl_orders.o_id')
        ->select('tbl_customer.c_name',
         'tbl_customer.o_id',
         'tbl_customer.c_phone',
         'tbl_customer.created_at',
         'tbl_orders.0_p_name as o_po_num',
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
        
         $subject = 'E-Order Details';
         $name = 'Lanka Playwood ';
         $address = 'ignore@batcave.io';
        return $this->view('mail',['items'=>$items])
                     ->from($address, $name)
                     ->to($request->cust_email)
                     ->subject($subject);

    }
}
