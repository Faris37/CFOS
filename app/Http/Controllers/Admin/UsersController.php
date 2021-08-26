<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Organization;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersController extends Controller
{

    public function _construct()
    {
       $this->middleware('auth'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('active' , 'Active');
        return view('admin.users.index')->with('users',$users);
    }

    public function add()
    {
        $role = Role::all();
        $org = Organization::all();

        return view('admin.users.UserAdd')->with('role' , $role)->with('org' , $org);
    }

    public function UserData()
    {
      $status = request('add');
      
      if($status == 'add')
      {
        $name = request('name');
        $email = request('email');
        $password = request('password');
        $role = request('role');
        $org = request('org');

        $passhash = Hash::make($password);

        $userid = DB::table('users')->insertGetID([
            'name' => $name,
            'email' => $email,
            'OID' => $org,
            'password' => $passhash,
            'active' => 'Active'
        ]);

        $role = DB::table('role_user')->insert([
            'role_id' => $role,
            'user_id' => $userid
        ]);

        return redirect()->route('admin.users.index');
      }

      else
      {

      }
    }

    public function organization()
    {
        $org = Organization::all();
        return view('admin.users.organization')->with('org',$org);
    }

    public function Oadd()
    {
        return view('admin.users.organizationAdd');
    }

    public function OaddData()
    {
        $name = request('name');
        $address = request('address');
        $phone = request('phone');
        $state = request('state');

        $org = DB::table('organizations')->insert([
            'SName' => $name,
            'SAddress' => $address,
            'SPhone' =>  $phone,
            'SState' => $state
        ]);

        return redirect()->route('admin.users.organization');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit.users'))
        {
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();

        $organization = Organization::all();

        return view('admin.users.edit')->with([
            'user'=> $user,
            'roles' => $roles,
            'organization' => $organization
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete.users'))
        {
            return redirect(route('admin.users.index'));
        }

        $id = $user->id;

        $update = DB::table('users')
        ->where('id' , $id)
        ->update([
            'active' => 'Inactive',
        ]);

        //$user->roles()->detach();
        //$user->delete();

        return redirect()->route('admin.users.index');

        //https://www.youtube.com/watch?v=MFS3q2HJHI4&list=PLxFwlLOncxFLazmEPiB4N0iYc3Dwst6m4&index=12
    }

    //NI SCHOOL ADMIN PUNYA

    public function mainAdmin()
    {
        $id = Auth::id();

        $oid = DB::table('users')
        ->where('id', $id)
        ->pluck('OID');

        $users = DB::table('users')
        ->join('role_user' , 'role_user.user_id' , '=' , 'users.id')
        ->join('roles' , 'roles.id' , '=' , 'role_user.role_id')
        ->where('OID', $oid)
        ->where('roles.id' , '>=' , 4)
        ->where('roles.id' , '<' , 7)
        ->where('users.active' , 'Active')
        ->get(['users.name as UNAME' , 'users.id as UID' , 'users.email as EMAIL' , 'roles.name as RNAME']);

        return view('admin.users.schadm')->with('users',$users);
    }

    public function mainSearch() // SEARCH PAGE SCHOOL ADMIN
    {
        $name = request('search');

        $id = Auth::id();

        $oid = DB::table('users')
        ->where('id', $id)
        ->pluck('OID');

        $users = DB::table('users')
        ->join('role_user' , 'role_user.user_id' , '=' , 'users.id')
        ->join('roles' , 'roles.id' , '=' , 'role_user.role_id')
        ->where('OID', $oid)
        ->where('roles.id' , '>=' , 4)
        ->where('roles.id' , '<' , 7)
        ->where('users.name' , 'like' , '%'. $name .'%')
        ->where('users.active' , 'Active')
        ->get(['users.name as UNAME' , 'users.id as UID' , 'users.email as EMAIL' , 'roles.name as RNAME']);

        return view('admin.users.schadm')->with('users',$users);
    }

    public function inactiveUser() // DELETE USER SCHOOL ADMIN
    {
        $id = request('uid');
        
        DB::table('users')
        ->where('id', $id)
        ->update(['active' => 'Inactive'
         ]);

         return redirect()->route('Admin.SchAdm.mainAdmin');
    }

    public function updateUser($id)
    {
        $users = DB::table('users')
        ->where('id' , $id)
        ->get(['users.*']);

        return view('admin.users.schadmedit')->with('users',$users);
    }

    public function updateDataUser()
    {
        
        $status = request('add');

        if($status == 'edit')
        {
            $name = request('name');
            $email = request('email');
            $id = request('id');

            DB::table('users')
            ->where('id', $id)
            ->update(['name' => $name ,
                      'email' => $email
             ]); 

             return redirect()->route('Admin.SchAdm.mainAdmin');
        }

        else if($status == 'add')
        {
            $uid = Auth::id();

            $oid = DB::table('users')
            ->where('id', $uid)
            ->value('OID');

            $name = request('name');
            $email = request('email');
            $password = request('password');
            $role = request('role');
            
            $passhash = Hash::make($password);

            $userid = DB::table('users')->insertGetId([
                'name' => $name,
                'email' => $email,
                'OID' => $oid,
                'password' => $passhash,
                'active' => 'Active'
            ]);

            $roles = DB::table('role_user')->insert([
                'role_id' => $role,
                'user_id' => $userid
            ]);

            if($role == 6)
            {
                $classes = request('class');

                $class = DB::table('teachers')->insert([
                    'class_id' => $classes,
                    'user_id' => $userid
                ]);
            }

            return redirect()->route('Admin.SchAdm.mainAdmin');
        }
    }

    public function addUser()
    {
        $uid = Auth::id();

        $oid = DB::table('users')
        ->where('id', $uid)
        ->pluck('OID');

        $class = DB::table('classes')
        ->where('OID' , $oid)
        ->get(['classes.*']);

        return view('admin.users.schadmadd')->with('class' , $class);
    }

    public function bannedMenu()
    {
        $id = Auth::id();

        $oid = DB::table('users')
        ->where('id', $id)
        ->value('OID');

        $banned = DB::table('banneds')
        ->where('Oid' , $oid)
        ->where('Active' , 'Active')
        ->get(['banneds.*']);

        return view('admin.users.bannedMenu')->with('banned' , $banned);
    }

    public function searchBanned()
    {
        $menu = request('search');

        $id = Auth::id();

        $oid = DB::table('users')
        ->where('id', $id)
        ->value('OID');        

        $banned = DB::table('banneds')
        ->where('Oid' , $oid)
        ->where('Active' , 'Active')
        ->where('Name' , 'like' , '%' . $menu . '%')
        ->get(['banneds.*']);

        return view('admin.users.bannedMenu')->with('banned' , $banned);
    }

    public function deleteBanned($id)
    {
        $uid = Auth::id();

        $oid = DB::table('users')
        ->where('id', $uid)
        ->value('OID');

        $banned = DB::table('banneds')
        ->where('Oid' , $oid)
        ->where('Active' , 'Active')
        ->get(['banneds.*']);

        DB::table('banneds')
            ->where('id', $id)
            ->update(['Active' => 'Inactive' 
             ]);
             
        return redirect()->route('Admin.SchAdm.bannedMenu');

    }

    public function addBanned()
    {
        return view('admin.users.bannedAddMenu');
    }

    public function addDataBanned()
    {
        $name = request('name');

        $uid = Auth::id();

        $oid = DB::table('users')
        ->where('id', $uid)
        ->value('OID');

        $addBanned = DB::table('banneds')->insert([
                    'Name' => $name ,
                    'Oid' => $oid ,
                    'Active'  => 'Active'
        ]);

        return redirect()->route('Admin.SchAdm.bannedMenu');
    }

    public function priceMenu()
    {
        $uid = Auth::id();

        $oid = DB::table('users')
        ->where('id', $uid)
        ->value('OID');

        $menu = DB::table('price_ranges')
        ->where('OID' , $oid)
        ->where('Active' , 'Active')
        ->get(['price_ranges.*']);

        return view('admin.users.priceRange')->with('menu' , $menu);
    }

    public function searchpriceMenu()
    {
        $name = request('search');

        $uid = Auth::id();

        $oid = DB::table('users')
        ->where('id', $uid)
        ->value('OID');

        $menu = DB::table('price_ranges')
        ->where('OID' , $oid)
        ->where('Active' , 'Active')
        ->where('Name' , 'like' , '%' . $name . '%')
        ->get(['price_ranges.*']);

        return view('admin.users.priceRange')->with('menu' , $menu);
    }

    public function editpriceMenu($id)
    {
        $menu = DB::table('price_ranges')
        ->where('id' , $id)
        ->get(['price_ranges.*']);

        return view('admin.users.priceRangeEdit')->with('menu' , $menu);
    }

    public function addpriceMenu()
    {
        return view('admin.users.priceRangeAdd');
    }

    public function editDatapriceMenu()
    {
        $status = request('add');

        if($status == 'edit')
        {
            $id = request('id');
            $min = request('Min');
            $max = request('Max');
            $name = request('name');

            DB::table('price_ranges')
            ->where('id', $id)
            ->update(['name' => $name ,
                      'Min' => $min ,
                      'Max' => $max
             ]); 

             return redirect()->route('Admin.SchAdm.priceMenu');
        }

        if($status == 'add')
        {
            $uid = Auth::id();

            $oid = DB::table('users')
            ->where('id', $uid)
            ->value('OID');

            $min = request('Min');
            $max = request('Max');
            $name = request('name');

            DB::table('price_ranges')->insert([
                'name' => $name ,
                'Min' => $min ,
                'Max' => $max ,
                'OID' => $oid ,
                'Active' => 'Active'
            ]);

            return redirect()->route('Admin.SchAdm.priceMenu');
        }
        
    }
   
}
