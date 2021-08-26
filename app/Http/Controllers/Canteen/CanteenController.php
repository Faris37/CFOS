<?php

namespace App\Http\Controllers\Canteen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CanteenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pid = Auth::id();

        $oid = DB::table('users')
        ->where('id' , $pid)
        ->value('OID');

        $menu = DB::table('Menus')
        ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
        ->where('organization_id' , $oid)
        ->where('status' , 'ACTIVE')
        ->get(['menus.*']);

        //return $menu;
        return view('canteen.management.index')->with('menu',$menu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pid = Auth::id();

        $oid = DB::table('users')
        ->where('id' , $pid)
        ->value('OID');

        $pricerange = DB::table('price_ranges')
        ->where('OID' , $oid)
        ->where('Active' , 'Active')
        ->get(['price_ranges.id as PRICEID' , 'price_ranges.Name as NAMA']);

        return view('canteen.management.add')->with('pricerange' , $pricerange);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah = $request->add;

//___________________________________________________________________________NI TAMBAH MENU______________________________________________________________//
        if($tambah == 'add')
        {
            if($request->hasFile('file'))
            {
                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png' 
                ]);

                $fileNameToStore = $request->file->hashName();

                $file = $request->file;

                $file->move("assets/product/", $fileNameToStore);
                
//_______________________________________________________GET ORGANIZATION ID BASED ON USERID_______________________________________________________

                $pid = Auth::id();

                $oid = DB::table('users')
                        ->where('id' , $pid)
                        ->value('OID');

//_______________________________________________________NI NK CHECK KALO ADE NAMA SAMA DLM TABLE___________________________________________________

                $name = DB::table('menus')
                ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
                ->where('organization_id' , $oid)
                ->where('Name' , $request->name)
                ->where('status' , 'ACTIVE')
                ->value('menus.id');

//_______________________________________________________KALO X DE YG SAMA_____________________________________________________________________________                

                if($name == '')
                {
                    $truncated = Str::of($request->name)->words(2 , ' >>>');

                    $string = Str::of($truncated)->trim('>>>');

                    $banned = DB::table('banneds')
                    ->where('name' , 'like' , '%' . $string . '%')
                    ->where('Oid' , $oid)
                    ->value('id');

                    if($banned == '')
                    {
                        $priceid = $request->pricerange;

                        $min = DB::table('price_ranges')
                        ->where('OID' , $oid)
                        ->where('id' , $priceid)
                        ->value('Min');

                        $max = DB::table('price_ranges')
                        ->where('OID' , $oid)
                        ->where('id' , $priceid)
                        ->value('Max');
                        
                        if($request->price >= $min && $request->price <= $max)
                        {

                            $id = DB::table('menus')->insertGetId([
                                'Name' => $request->name,
                                'Price' => $request->price,
                                'Description' => $request->desc,
                                'file_path' => $fileNameToStore,
                                'status' => 'ACTIVE'
                            ]);
    
                            DB::table('menu_organization')->insert([
                                'menu_id' => $id,
                                'organization_id' => $oid
                            ]);
                    
                            if($id != NULL)
                            {
                                return redirect()->route('canteen.Canteen.index');
                            }
    
                            else
                            {
                                return view('canteen.management.add');
                            }
                        }
                        else
                        {
                            return redirect()->back()->with('alert', 'The Price Is Not Compatible');
                        }
                    }
                    else
                    {
                        return redirect()->back()->with('alert', 'The Banned Name Is In Used');
                    }
                }

                else
                {
                    return redirect()->back()->with('alert', 'The Name Is In Used');
                }
            }
            
            
        }
        /*if($request->hasFile('file'))
        {
            return "ada";
        }
        $Uid = Auth::id();

        $id = DB::table('menus')->insertGetId([
            'Name' => $request->name,
            'Price' => $request->price,
            'Description' => $request->desc
        ]);

        $oid = DB::table('users')
        ->where('id' , $Uid)
        ->value('OID');

        DB::table('menu_organization')->insert([
            'menu_id' => $id,
            'organization_id' => $oid
        ]);
        */

//______________________________________________________________________NI UPDATE MENU___________________________________________________________________//

        else{

            if($request->hasFile('file'))
            {
                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png' 
                ]);

                $fileNameToStore = $request->file->hashName();

                $file = $request->file;

                $file->move("assets/product/", $fileNameToStore);
            }

                $name = DB::table('menus')
                ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
                ->where('organization_id' , $oid)
                ->where('Name' , $request->name)
                ->where('status' , 'ACTIVE')
                ->value('menus.id');

                if($name == '')
                {
                    $truncated = Str::of($request->name)->words(2 , ' >>>');

                    $string = Str::of($truncated)->trim('>>>');

                    $banned = DB::table('banneds')
                    ->where('name' , 'like' , '%' . $string . '%')
                    ->where('Oid' , $oid)
                    ->value('id');

                    if($banned == '')
                    {
                        
                        $min = DB::table('price_ranges')
                        ->where('OID' , $oid)
                        ->where('Name' , 'like' , '%' . $request->name . '%')
                        ->value('Min');

                        $max = DB::table('price_ranges')
                        ->where('OID' , $oid)
                        ->where('Name' , 'like' , '%' . $request->name . '%')
                        ->value('Max');
                        
                        if($request->price >= $min && $request->price <= $max)
                        {
                
                            $affected = DB::table('menus')
                            ->where('id', $request->id)
                            ->update(['Name' => $request->name,
                                      'Price' => $request->price,
                                      'Description' => $request->desc,
                                      'file_path' => $fileNameToStore,
                                      'status' => 'ACTIVE'
                                    ]);

                            $pid = Auth::id();

                            $oid = DB::table('users')
                                    ->where('id' , $pid)
                                    ->value('OID');
                
                            $menu = DB::table('Menus')
                                    ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
                                    ->where('organization_id' , $oid)
                                    ->get();
                
                
        
                            if($affected)
                            {
                                return redirect()->route('canteen.Canteen.index');
                            }
                        }
                        else
                        {
                            return redirect()->back()->with('alert', 'The Price Is Not Compatible');
                        }
                    }
                    else
                    {
                        return redirect()->back()->with('alert', 'The Banned Name Is In Used');
                    }
                }

                else
                {
                    return redirect()->back()->with('alert', 'The Name Is In Used');
                }
            
        
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
        $date = Carbon::now()->format('Y-m-d');

        $order = DB::table('orders')
        ->select(DB::raw('menus.Name as Menu , menu_order.qty as Quantity , students.Name as Student'))
        ->join('menu_order' , 'menu_order.order_id' , '=' , 'orders.id')
        ->join('menus' , 'menus.id' , '=' , 'menu_order.menu_id')
        ->join('students' , 'students.id' , '=' , 'orders.student_id' )
        ->join('student_class' , 'students.id' , '=' , 'student_class.student_id')
        ->where('student_class.class_id' , $id)
        ->where('orders.status' , 'Notified')
        ->wheredate('orders.order_date' , $date)
        ->get();

        view()->share('order',$order);
        $pdf = PDF::loadView('studentpdf', $order);

        Storage::put('public/pdf/invoice.pdf', $pdf->output());

        $class = DB::table('Classes')
        ->where('id',$id)
        ->value('CNAME');

        
        return $pdf->download($class.'_'.$date.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = DB::table('Menus')
        ->where('id' , $id)
        ->get();

        return view('canteen.management.edit')->with('menu', $menu);
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
        //DB::table('menus')->delete($id);
        //DB::table('menu_organization')->where('menu_id', $id)->delete();

        DB::table('menus')
        ->where('id', $id)
        ->update(['status' => 'INACTIVE'
         ]);

        return redirect()->route('canteen.Canteen.index');
    }

    public function search()
    {
        
        $menu = request('search');

        $pid = Auth::id();

        $oid = DB::table('users')
        ->where('id' , $pid)
        ->value('OID');

        $menu = DB::table('Menus')
        ->join('menu_organization' , 'Menus.id' , '=' , 'menu_organization.menu_id')
        ->where('organization_id' , $oid)
        ->where('status' , 'ACTIVE')
        ->where('Name' , 'like' , '%' . $menu . '%')
        ->get(['menus.*']);

        
        return view('canteen.management.index')->with('menu',$menu);
    }
}
