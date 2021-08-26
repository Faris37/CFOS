<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment.pay.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'jadi';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $set = $request->add;


        if($set == 'index')
        {
            $user = $request->username;
            
            $harga = $request->test;

            return view('payment.pay.verified')->with('user',$user)->with('test',$harga);
        }

        else if($set == 'verified')
        {
            $pass = $request -> password;
            $pid = $request->test;

            $date1 = Carbon::now()->addDay();

            $date = $date1->format('Y-m-d');

            $orderid = DB::table('orders')
            ->join('menu_order' , 'orders.id' , '=' , 'menu_order.order_id')
            ->join('menus' , 'menu_order.menu_id' , '=' , 'menus.id')
            //->where('orders.order_date' , $date)
            ->where('orders.parent_id' , $pid)
            ->where('orders.status' , 'Ordering')
            ->get(['menu_order.*' , 'menus.Name as menName' , 'orders.*']);

            $price = DB::table('menu_order')
            ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
            ->where('menu_order.parent_id',$pid)
            //->where('orders.status','Ordering')
            ->where('orders.order_date',$date)
            ->sum('price');

            $org = DB::table('organizations')->distinct('SName')
            ->join('menu_organization' , 'organizations.id' , '=' , 'menu_organization.organization_id')
            ->join('menus' , 'menus.id' , '=' , 'menu_organization.menu_id')
            ->join('menu_order' , 'menus.id' , '=' , 'menu_order.menu_id')
            ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
            ->where('orders.parent_id' , $pid)
            //->where('orders.order_date' , $date)
            ->where('orders.status' , 'Ordering')
            ->get(['organizations.*']);

            return view('payment.pay.approvement')->with('orderid' , $orderid)->with('price' , $price)->with('org', $org)->with('pid' , $pid);
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

        $date1 = Carbon::now()->addDay();

        $date = $date1->format('Y-m-d');

        $update = DB::table('orders')
                    ->where('parent_id', $id)
                    //->where('order_date', $date)
                    ->where('status' , 'Ordering')
                    ->update(['status' => 'Notified'
                            ]);
        
        
        return redirect()->route('home');
        //return view('payment.pay.approved')->with('order', $order);
        
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
        //
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
