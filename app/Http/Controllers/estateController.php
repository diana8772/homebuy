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
        if($request->has('logout'))
        {
            Auth::logout();
            return redirect('');

        }
        if($request->has('year')) $year=$request->input('year');
        else $year=108;
        if($request->has('month')) $month=str_pad($request->input('month'),2,'0',STR_PAD_LEFT);
        else $month=11;
        if($request->has('minunit')) $minunit=$request->input('minunit');
        else $minunit=1;
        if($request->has('maxunit')) $maxunit=$request->input('maxunit');
        else $maxunit=50;
        if($request->has('minarea')) $minarea=$request->input('minarea');
        else $minarea=1;
        if($request->has('maxarea')) $maxarea=$request->input('maxarea');
        else $maxarea=300;
        if($request->has('age')) $age=$request->input('age');
        else $age='';
        if($request->has('select_loccal')) $select_loccal=$request->input('select_loccal');
        else $select_loccal='';
        
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
                    ->where(function($query) use ($age)
                        {
                        if(!empty($age)):
                            $query->Where('屋齡', $age);
                        endif;
                     })
                    ->where(function($query) use ($select_loccal)
                        {
                        if(!empty($select_loccal)):
                            $query->Where('地區', $select_loccal);
                        endif;
                     })
                    ->get();
                    // dd($estate);
        return view('estate',
            compact(
                'estate',
                'local'
            )
        );
    }
}
