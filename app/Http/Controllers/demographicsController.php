<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirect;
use DB;
use Session;
use Auth;
class demographicsController extends Controller
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
        $year = ($request->has('year')?$request->input('year'):108);
        $month = ($request->has('month')?str_pad($request->input('month'),2,'0',STR_PAD_LEFT):12);
        $select_local = ($request->has('select_locals')?$request->input('select_locals'):'');
        $pieces = explode(",", $select_local);
        $locals = DB::table("demographics")
                    ->groupby('區域別')
                    ->pluck('區域別');
        if($select_local != ''){
            $data = DB::table("demographics")
                      ->where('date', $year.$month)
                      ->whereIn('區域別', $pieces)
                      ->get();
            $charts = DB::table("demographics")
                        ->select('區域別','總計')
                        ->where('date', $year.$month)
                        ->whereIn('區域別', $pieces)
                        ->get();
        }else{
            $data = DB::table("demographics")
                      ->where('date', $year.$month)
                      ->get();
            $charts = DB::table("demographics")
                        ->select('區域別','總計')
                        ->where('date', $year.$month)
                        ->get();
        }
        
        $local = $charts->pluck('區域別');
        $number = $charts->pluck('總計');
        $local = json_encode($local);
        $number = json_encode($number);
        return view('demographics',
            compact(
                'data',
                'locals',
                'local',
                'number'
            )
        );
    }
}
