<?php

namespace App\Http\Controllers\Menu;
use App\Menu;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pid = Auth::id();
        //$date1 = Carbon::now()->addDay();

        //$date = $date1->format('Y-m-d');
        
        $invoice = DB::table('menu_order')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->join('menus' , 'menu_order.menu_id' , '=' , 'menus.id' )
        ->join('students' , 'orders.student_id' , '=' , 'students.id')
        ->where('menu_order.parent_id',$pid)
        ->where('orders.status','Ordering')
        //->where('orders.order_date',$date)
        ->orderBy('students.name')
        ->get(['students.name as stuName' , 'menu_order.*' , 'menus.Name as menName' , 'orders.*']);
        

        $price = DB::table('menu_order')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->where('menu_order.parent_id',$pid)
        ->where('orders.status','Ordering')
        //->where('orders.order_date',$date)
        ->sum('price');

        $user = DB::table('users')
        ->where('users.id' , $pid)
        ->get(['users.*']);

        if($price != '')
            return view('parent.children.invoice')->with('invoice',$invoice)->with('price',$price)->with('user' , $user);
        else
            return redirect()->route('parent.Childrens.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pid = Auth::id();

        $order = DB::table('orders')
        ->select(DB::raw('orders.order_date as Date , sum(menu_order.price) as count , orders.id as ID , organizations.SName as SNAME , sum(menu_order.qty) as QTY'))
        ->join('menu_order' , 'menu_order.order_id' , '=' , 'orders.id')
        ->join('organizations' , 'organizations.id' , '=' , 'orders.o_id')
        ->where('menu_order.parent_id',$pid)
        ->where('orders.status','Paid')
        ->groupBy('orders.id')
        ->orderby('orders.order_date' , 'desc')
        ->get();

        return view('parent.children.orderhistory')->with('order' , $order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$date1 = Carbon::now()->addDay();

        //$date = $date1->format('Y-m-d');

        $oid = $request->oid;
        $id = $request->id;
        $qty = $request->quantity;
        $date = $request->date3;
        $pid = Auth::id();
        $stu = $request->stu;
        $remark = $request->remarks;

        $price = DB::table('menus')
        ->where('id',$id)
        ->value('Price');

        $harga = ($price * $qty);

        if($stu == 0)
        {

            $order_id = DB::table('orders')
            ->where('o_id',$oid)
            ->where('status','Ordering')
            ->where('parent_id',$pid)
            ->where('order_date',$date)
            ->pluck('id');

            $kiraBape = count($order_id);

        
            for($i = 0; $i<$kiraBape ; $i++)
            {
                DB::insert('insert into menu_order (menu_id, order_id , qty , price, parent_id , remarks) values (?, ?, ? , ? , ? , ?)', [$id, $order_id[$i] , $qty , $harga , $pid , $remark]);
            }
        
            $menu = DB::table('Menus')
            ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
            ->where('organization_id' , $oid)
            ->where('status' , 'ACTIVE')
            ->get(['menus.*']);

            return view('parent.children.menuPick')->with('menu',$menu)->with('date3',$date);
        }
        else
        {
            $order_id = DB::table('orders')
            ->where('o_id',$oid)
            ->where('status','Ordering')
            ->where('parent_id',$pid)
            ->where('order_date',$date)
            ->where('student_id', $stu)
            ->value('id');

            DB::insert('insert into menu_order (menu_id, order_id , qty , price, parent_id , remarks) values (?, ?, ? , ? , ? , ?)', [$id, $order_id , $qty , $harga , $pid , $remark]);

            $menu = DB::table('Menus')
            ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
            ->where('organization_id' , $oid)
            ->where('status' , 'ACTIVE')
            ->get(['menus.*']);

            return view('parent.children.menuPick')->with('menu',$menu)->with('date3',$date);
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
        $pid = Auth::id();
        $date1 = Carbon::now()->addDay();
        $date = $date1->format('Y-m-d');
        
        $menuDetails =DB::table('menus')
        ->join('menu_organization' , 'menus.id' , '=' , 'menu_organization.menu_id')
        ->join('menu_order' , 'menus.id' , '=' , 'menu_order.menu_id')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->where('menus.id' ,$id)
        ->where('orders.parent_id' , $pid)
        ->where('orders.order_date' , $date)
        ->where('orders.status' , 'Ordering')
        ->get(['menus.*' , 'menu_organization.organization_id' , 'orders.id as order']);

        return view('parent.children.menuEdit')->with('menuDetails',$menuDetails);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pid = Auth::id();

        $details = DB::table('orders')
        ->join('menu_order', 'menu_order.order_id' , '=' , 'orders.id')
        ->join('menus' , 'menus.id' , '=' , 'menu_order.menu_id')
        ->join('students' , 'students.id' , '=' , 'orders.student_id')
        ->where('orders.id' , $id)
        ->get(['students.Name as NAMA' , 'menu_order.qty as QTY' , 'menus.*']);

        $price = DB::table('menu_order')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->where('orders.id',$id)
        ->sum('price');

        $user = DB::table('users')
        ->where('users.id' , $pid)
        ->get(['users.*']);

       //return $user;
       return view('parent.children.orderdetail')->with('details' , $details)->with('price' , $price)->with('user' , $user); 
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
        $id = $request->student;
        return $id;
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
