<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirect;
use DB;
use Session;
use Auth;
class authorityController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('logout')){
            Auth::logout();
            return redirect('');
        }
        $edit = ($request->has('edit')?$request->has('edit'):'');
        if($request->has('edit_save')){
             $edit_save = key($request->input('edit_save'));
             $role = $request->input('role');
             DB::table("users")
               ->where('id', $edit_save)
               ->update([
                     'role' => $role,
               ]);
        }
        if($request->has('delete')){
            $delete = key($request->input('delete'));
            DB::table("users")
              ->where('id', $delete)
              ->delete();
            DB::table("person_data")
              ->where('id', $delete)
              ->delete();
        }
        $auth = auth()->user()->role;
        if($auth == '1admin'){
            $users = DB::table("users")
                       ->select('id',
                                'name',
                                'email',
                                'role',
                                'created_at',
                                'updated_at'
                                )
                       ->orderBy('role', 'asc')
                       ->get();
        }elseif($auth == '2user'){
            $users = DB::table("users")
                       ->select('id',
                                'name',
                                'email',
                                'role',
                                'created_at',
                                'updated_at'
                                )
                       ->where('role', '2user')
                       ->orWhere('role', '3guest')
                       ->orderBy('role', 'asc')
                       ->get();
        }elseif($auth == '3guest' || $auth == ''){
            $users = DB::table("users")
                       ->select('id',
                                'name',
                                'email',
                                'role',
                                'created_at',
                                'updated_at'
                                )
                       ->where('id', auth()->user()->id)
                       ->get();
        }
        return view('authority',
            compact(
                'users',
            )
        );
    }
    public function person(Request $request)
    {
        if($request->has('logout')){
            Auth::logout();
            return redirect('');
        }
        $person_data = 0;
        $person_data1 = 0;
        if($request->has('id')) $id = $request->input('id');
        if($request->has('fullname')) $fullname = $request->input('fullname');
        if($request->has('date')) $date = $request->input('date');
        if($request->has('sexuality')) $sexuality = $request->input('sexuality');
        if($request->has('phone')) $phone = $request->input('phone');
        if($request->has('email')) $email = $request->input('email');
        if($request->has('address')) $address = $request->input('address');
        $check = DB::table("person_data")
                   ->where('id',$id)
                   ->get();
        $check = count($check);
        if($request->has('insert')){
            $insert_id = key($request->input('insert'));
            if($fullname != '' || $date != '' || $sexuality !='' || $phone !='' || $email != ''){
                if($check == 0){
                    DB::table("person_data")
                      ->insert([
                          'id' => $insert_id,
                          'name' => $fullname,
                          'birthday' => $date,
                          'sexuality' => $sexuality,
                          'phone' => $phone,
                          'email' => $email,
                          'address' => $address,
                      ]);
                }else{
                    DB::table("person_data")
                      ->where('id', $insert_id)
                      ->update([
                          'name' => $fullname,
                          'birthday' => $date,
                          'sexuality' => $sexuality,
                          'phone' => $phone,
                          'address' => $address,
                      ]);
                }
                $check = DB::table("person_data")
                           ->where('id',$insert_id)
                           ->get();
                $check = count($check);
            }
        }
        if($check == 0){
            $person_data = DB::table("users")
                             ->select('id',
                                      'name',
                                      'email',
                                      )
                             ->where('id',$id)
                             ->get();
            $person_data = $person_data[0];
        }else{
            $person_data1 = DB::table("person_data")
                               ->select('id',
                                        'name',
                                        'birthday',
                                        'sexuality',
                                        'phone',
                                        'email',
                                        'address',
                                        )
                               ->where('id',$id)
                               ->get();
            $person_data1 = $person_data1[0];
        }
        return view('person',
            compact(
                'id',
                'check',
                'person_data',
                'person_data1',
            )
        );
    }
}
