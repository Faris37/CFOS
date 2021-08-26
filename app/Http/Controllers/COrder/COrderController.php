<?php

namespace App\Http\Controllers\COrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class COrderController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $oid = $request->oid;
        $order = $request->orderid;
        $qty = $request->quantity;
        $pid = Auth::id();

        $affected = false;

        $price = DB::table('menus')
        ->where('id',$id)
        ->value('Price');

        $harga = ($price * $qty);

        if($harga != 0)
        {
            $affected = DB::table('menu_order')
                        ->where('order_id', $order)
                        ->where('menu_id' , $id)
                        ->update(['qty' => $qty , 'price' => $harga]);
        }

        $rege = DB::table('menu_order')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->where('menu_order.parent_id',$pid)
        ->where('orders.status','Ordering')
        ->where('orders.id',$order)
        ->sum('price');

        if($rege == 0)
        {
            DB::table('orders')->delete($order);  
        }

        if($harga == 0)
        {
            DB::table('menu_order')->where('menu_id', $id)->where('order_id',$order)->delete();
        }

        if($affected)
        {
            return redirect()->route('menu.Menu.index');
        }
        else
            return redirect()->route('menu.Menu.index');
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
        $oid = $request->oid;
        $id = $request->id;
        $qty = $request->quantity;
        $pid = Auth::id();

        $order_id = DB::table('orders')
        ->where('o_id',$oid)
        ->where('status','Ordering')
        ->where('parent_id',$pid)
        ->where('order_date',$date)
        ->pluck('id');

        $invoice = DB::table('menu_order')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->join('menus' , 'menu_order.menu_id' , '=' , 'menus.id' )
        ->join('students' , 'orders.student_id' , '=' , 'students.id')
        ->where('menu_order.parent_id',$pid)
        ->where('orders.status','Ordering')
        ->where('orders.order_date',$date)
        ->get(['students.name as stuName' , 'menu_order.*' , 'menus.Name as menName' , 'orders.*']);

        $user = DB::table('users')
        ->where('users.id' , $pid)
        ->get(['users.*']);

        $price = DB::table('menu_order')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->where('menu_order.parent_id',$pid)
        ->where('orders.status','Ordering')
        ->where('orders.order_date',$date)
        ->sum('price');

        if($price == 0)
        {
            DB::table('orders')->delete($order_id);  
        }

        DB::table('menu_order')->where('menu_id', $id)->delete();

        return view('parent.children.invoice')->with('invoice',$invoice)->with('price',$price)->with('user' , $user); 
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
