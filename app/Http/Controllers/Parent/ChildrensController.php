<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Student;
use App\Classes;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ChildrensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();

        $school = DB::select("SELECT DISTINCT o.id , o.SName FROM organizations o
        JOIN classes c ON o.id = c.OID
        JOIN student_class sc ON c.id = sc.class_id
        JOIN students s ON sc.student_id = s.id
        JOIN student_user su ON s.id = su.ChildrenID
        JOIN users u ON su.ParentID = u.id
        WHERE u.id = $id");

        return view('parent.children.school')->with('school',$school);
        
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

        $id = $request->student[0];
        $student = $request->student;
        $date3 = $request->datefield;

        $pid = Auth::id();
        $oid = DB::table('Organizations')
        ->join('classes', 'Organizations.id', '=', 'classes.OID')
        ->join('student_class', 'classes.id', '=', 'student_class.class_id')
        ->where('student_class.student_id',$id)
        ->value('Organizations.id');

        $update = DB::table('orders')
                        ->where('parent_id', $pid)
                        ->where('status' , 'Ordering')
                        ->where('order_date' , '!=' , $date3)
                        ->update(['status' => 'Cancel'
                                ]);


        $countStu = count($student);
        $date1 = Carbon::now()->addDay();

        $date = $date1->format('Y-m-d');
        
        for($i = 0; $i < $countStu ; $i++)
        {
            DB::insert('insert into orders (student_id, o_id , order_date, status, parent_id) values (?, ?, ? , ? , ?)', [$student[$i], $oid , $date3 , 'Ordering' , $pid]);
        }
        

        $studentid = DB::table('orders')
        ->where('o_id',$oid)
        ->where('order_date',$date3)
        ->get();

        
        $menu = DB::table('Menus')
        ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
        ->where('organization_id' , $oid)
        ->where('status' , 'ACTIVE')
        ->get(['menus.*']);

        return view('parent.children.menuPick')->with('menu',$menu)->with('date3',$date3);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $student =DB::table('students')
        ->join('student_class', 'students.id', '=', 'student_class.student_id')
        ->join('classes', 'student_class.class_id', '=', 'classes.id')
        ->where('classes.OID' ,$id)
        ->get();

        return view('parent.children.index')->with('student',$student);
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

    public function editing($id , $date)
    {
        
        $menuDetails =DB::table('menus')
        ->join('menu_organization' , 'menus.id' , '=' , 'menu_organization.menu_id')
        ->where('menus.id' ,$id)
        ->get(['menus.*' , 'menu_organization.organization_id']);

        $stuName = DB::table('orders')
        ->join('students' , 'orders.student_id' , '=' , 'students.id')
        ->where('orders.order_date' , $date)
        ->get(['students.*']);

        return view('parent.children.menuDetail')->with('menuDetails',$menuDetails)->with('stuName',$stuName)->with('date',$date);
    }

    public function backing($id)
    {

        $date3 = DB::table('orders')
        ->where('orders.id',$id)
        ->value('order_date');

        $oid = DB::table('orders')
        ->where('orders.id',$id)
        ->value('o_id');

        $menu = DB::table('Menus')
        ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
        ->where('organization_id' , $oid)
        ->where('status' , 'ACTIVE')
        ->get(['menus.*']);

        return view('parent.children.menuPick')->with('menu',$menu)->with('date3',$date3);
    }

    public function menuEdit($id , $menu_id)
    {
        $menuDetails =DB::table('menus')
        ->join('menu_organization' , 'menus.id' , '=' , 'menu_organization.menu_id')
        ->join('menu_order' , 'menus.id' , '=' , 'menu_order.menu_id')
        ->join('orders' , 'menu_order.order_id' , '=' , 'orders.id')
        ->where('menus.id' ,$menu_id)
        ->where('orders.id' , $id)
        ->get(['menus.*' , 'menu_organization.organization_id' , 'orders.id as order']);

        return view('parent.children.menuEdit')->with('menuDetails',$menuDetails);
    }
}
