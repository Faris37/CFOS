<?php

namespace App\Http\Controllers\Manageorder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use Session;


class Morder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pid = Auth::id();

        

        $OID = DB::table('organizations')
        ->join('users' , 'users.OID' , '=' , 'organizations.ID')
        ->where('users.ID' , '=' , $pid)
        ->pluck('organizations.id');

        $class = DB::table('classes')
        ->where('classes.OID' , $OID)
        ->get(); 

        

        return view('canteen.management.ordermanage')->with('class',$class);

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
        $date = Carbon::now()->format('Y-m-d');

        $order = DB::table('orders')
        ->select(DB::raw('menus.Name as MNAME , sum(menu_order.qty) as count , menus.id as MID'))
        ->join('menu_order' , 'menu_order.order_id' , '=' , 'orders.id')
        ->join('menus' , 'menus.id' , '=' , 'menu_order.menu_id')
        ->join('students' , 'students.id' , '=' , 'orders.student_id' )
        ->join('student_class' , 'students.id' , '=' , 'student_class.student_id')
        ->where('student_class.class_id' , $id)
        ->where('orders.status' , 'Notified')
        ->wheredate('orders.order_date' , $date)
        ->groupBy('menus.id')
        ->get();

        $class = DB::table('classes')
        ->where('id' , $id)
        ->get();


        return view('canteen.management.ordermanage2')->with('order',$order)->with('class' , $class);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $orders = DB::table('orders')
        ->join('students' , 'students.id' , '=' , 'orders.student_id')
        ->join('student_class' , 'students.id' , '=' , 'student_class.student_id')
        ->where('student_class.class_id' , $id)
        ->where('orders.status' , 'Notified')
        ->pluck('orders.id');

        $count = count($orders);

        for($i = 0; $i<$count ; $i++)
        {
            $affected = DB::table('orders')
                        ->where('id', $orders[$i])
                        ->update(['status' =>  'Paid'
                                ]);
        }

        return redirect()->route('manageorder.Manageorder.index');
        
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
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
