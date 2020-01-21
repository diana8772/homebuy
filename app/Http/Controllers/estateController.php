<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirect;
use DB;
use Session;
use Auth;
class estateController extends Controller
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
        $year = ($request->has("year")? $request->input("year"): 108);
        $month = ($request->has("month")? $request->input("month"): 11);
        $minunit = ($request->has("minunit")? $request->input("minunit"): 1);
        $maxunit = ($request->has("maxunit")? $request->input("maxunit"): 50);
        $minarea = ($request->has("minarea")? $request->input("minarea"): 1);
        $maxarea = ($request->has("maxarea")? $request->input("maxarea"): 300);
        $age = ($request->has("age")? $request->input("age"): '');
        $select_loccal = ($request->has("select_loccal")? $request->input("select_loccal"): '');
        if($request->has('insert_save')){
            $insert_local = $request->input('insert_local');
            $insert_unit = $request->input('insert_unit');
            $insert_area = $request->input('insert_area');
            $insert_total = $request->input('insert_total');
            $insert_type = $request->input('insert_type');
            $insert_year = $request->input('insert_year');
            $insert_floor = $request->input('insert_floor');
            $id = DB::table("estate")
                    ->select('id')
                    ->max('id')+1;
            DB::table("estate")
              ->insert([
                  'id' => $id,
                  '區段位置' => $insert_local,
                  '地區' => $insert_area,
                  '交易年月' => $year.$month,
                  '總價' => $insert_total,
                  '單價' => $insert_unit,
                  '總面積' => $insert_area,
                  '型態' => $insert_type,
                  '屋齡' => $insert_year,
                  '樓別' => $insert_floor,
              ]);
        }
        $local = DB::table("estate")
                   ->select('地區')
                   ->groupby('地區')
                   ->pluck('地區');
        $estate = DB::table("estate")
                    ->select('區段位置',
                             '地區',
                             '交易年月',
                             '總價',
                             '單價',
                             '總面積',
                             '型態',
                             '屋齡',
                             '樓別',
                     )
                    ->where('交易年月', $year.$month)
                    ->where('單價', '>=', $minunit)
                    ->where('單價', '<=', $maxunit)
                    ->where('總面積', '>=', $minarea)
                    ->where('總面積', '<=', $maxarea)
                    ->where(function($query) use ($age){
                        if(!empty($age)):
                            $query->Where('屋齡', $age);
                        endif;
                    })
                    ->where(function($query) use ($select_loccal){
                        if(!empty($select_loccal)):
                            $query->Where('地區', $select_loccal);
                        endif;
                    })
                    ->get();
        return view('estate',
            compact(
                'estate',
                'local'
            )
        );
    }
}
