<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

use Carbon\Carbon;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $pid = Auth::id();

        $date = Carbon::now()->format('Y-m-d');

        $userid = DB::table('role_user')
                  ->where('user_id',$pid)
                  ->pluck('role_id');
        
        $oid = DB::table('users')
               ->where('id',$pid)
               ->pluck('OID');
          
        $month = ['1' , '2' , '3' , '4' , '5' , '6' , '7' , '8' , '9' , '10' , '11' , '12'];

        $year = ['Jan', 'Feb', 'March', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if($userid[0] == 2)
        {
        
            $user = [];
            foreach ($month as $key => $value) {
            $user[] = DB::table('menu_order')
                      ->join('orders', 'orders.id' , '=' , 'menu_order.order_id')
                      ->where('orders.parent_id' , $pid )
                      ->where('orders.status' , 'Paid')
                      ->wheremonth('orders.order_date' , $value)
                      ->sum('menu_order.price');
            }

        $child = DB::table('student_user')
                ->where('parentID', $pid)
                ->count();

        $orders = DB::table('orders')
                 ->where('parent_id', $pid)
                 ->where('status' , 'Paid')
                 ->count();
        
        return view('home')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK))->with('child',$child)->with('orders',$orders);

        }

        else if($userid[0] == 4)
        {
            $user = [];
            foreach ($month as $key => $value) {
            $user[] = DB::table('menu_order')
                      ->join('orders', 'orders.id' , '=' , 'menu_order.order_id')
                      ->where('orders.o_id' , $oid )
                      ->where('orders.status' , 'Paid')
                      ->wheremonth('orders.order_date' , $value)
                      ->sum('menu_order.price');
            }

            $menu = DB::table('menu_organization')
                    ->where('organization_id' , $oid)
                    ->count();

            $orders = DB::table('orders')
                 ->where('o_id', $oid)
                 ->wheredate('order_date' ,$date)
                 ->where('status' , 'Notified')
                 ->count();

            return view('home')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK))->with('child',$menu)->with('orders',$orders);
        }

        

        else
        {
            $user = [];
            
            return view('home')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
        }

        
    }
}