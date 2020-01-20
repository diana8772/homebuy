<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirect;
use DB;
use Session;
use Auth;
class personController extends Controller
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
        if($request->has('logout'))
        {
            Auth::logout();
            return redirect('');

        }
        if($request->has('id')) $id=$request->input('id');
        // $users = DB::table("users")
        //           ->select('id',
        //                    'name',
        //                    'email',
        //                    'role',
        //                    'created_at',
        //                    'updated_at'
        //                    )
        //           ->get();
        return view('person',
            compact(
                'id'
            )
        );
    }
}
