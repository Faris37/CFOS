<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Auth::id();

        $class = DB::table('teachers')
        ->where('user_id',$teacher)
        ->pluck('class_id');

        $date = Carbon::now()->format('Y-m-d');

        $order = DB::table('orders')
        ->select(DB::raw('menus.Name as Menu , menu_order.qty as Quantity , menu_order.remarks as Remarks , students.Name as Student'))
        ->join('menu_order' , 'menu_order.order_id' , '=' , 'orders.id')
        ->join('menus' , 'menus.id' , '=' , 'menu_order.menu_id')
        ->join('students' , 'students.id' , '=' , 'orders.student_id' )
        ->join('student_class' , 'students.id' , '=' , 'student_class.student_id')
        ->where('student_class.class_id' , $class)
        ->where('orders.status' , 'Paid')
        ->wheredate('orders.order_date' , $date)
        ->get();

        $kelas = DB::table('classes')
        ->where('id' , $class)
        ->get();

        return view('Teacher.Class.student_class')->with('order',$order)->with('class' , $kelas);
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
        //
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
