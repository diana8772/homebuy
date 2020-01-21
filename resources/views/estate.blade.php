<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment-with-locales.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
        <script type="text/javascript">
            function MM_o(selObj){
                location.href=(selObj.options[selObj.selectedIndex].value);
            }
            function insert1() { 
                var insert_local = document.getElementById("insert_local");
                var insert_local1 = insert_local.value;
                var insert_unit = document.getElementById("insert_unit");
                var insert_unit1 = insert_unit.value;
                var insert_area = document.getElementById("insert_area");
                var insert_area1 = insert_area.value;
                var insert_total = document.getElementById("insert_total");
                var insert_total1 = insert_total.value;
                var insert_type = document.getElementById("insert_type");
                var insert_type1 = insert_type.value;
                var insert_year = document.getElementById("insert_year");
                var insert_year1 = insert_year.value;
                var insert_floor = document.getElementById("insert_floor");
                var insert_floor1 = insert_floor.value;
                if (insert_local1=='' || insert_unit1=='' || insert_area1=='' || insert_total1=='' || insert_type1=='' || insert_year1 == '' || insert_floor1 == ''){ 
                    alert("有欄位未輸入！" );
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <form id="form" name="query" method="post">
        {{ csrf_field() }}
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                            Hi!   {{ Auth::user()->name }}
                            <input type="submit" class="log" value="log out" name='logout'>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <div class="content">
                    @php
                        $year = (Request::has("year")?Request::input("year"):108);
                        $month = (Request::has("month")?Request::input("month"):11);
                        $minunit = (Request::has("minunit")?Request::input("minunit"):1);
                        $maxunit = (Request::has("maxunit")?Request::input("maxunit"):50);
                        $minarea = (Request::has("minarea")?Request::input("minarea"):1);
                        $maxarea = (Request::has("maxarea")?Request::input("maxarea"):300);
                        $age = (Request::has("age")?Request::input("age"):'');
                        $select_loccal = (Request::has("select_loccal")?Request::input("select_loccal"):'');
                        if (Request::has("insert"))  $insert = Request::input("insert");
                    @endphp
                    <table class="table table-bordered" style="width: 80%;position:absolute; top:10%; left:10%;">
                        <tr style="background-color: #b8daff;">
                            <td colspan="2">
                                地區：
                                <select onChange="MM_o(this)">
                                    @if($select_loccal == '')
                                        <option value="estate?select_loccal={{''}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>全部</option>
                                        @for($t=0;$t<count($local);$t++)
                                            <option value="estate?select_loccal={{$local[$t]}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $local[$t] }}</option>
                                        @endfor
                                    @else
                                        <option value="estate?select_loccal={{''}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">全部</option>
                                        @for($t=0;$t<count($local);$t++)
                                            @if($t==$select_loccal)
                                                <option value="estate?select_loccal={{$local[$t]}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $local[$t] }}</option>
                                            @else
                                                <option value="estate?select_loccal={{$local[$t]}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $local[$t] }}</option>
                                            @endif
                                        @endfor
                                    @endif
                                </select>
                            </td>
                            <td colspan="2">
                                <select onChange="MM_o(this)">
                                    @for($j=108;$j>=99;$j--)
                                        @if($j==$year)
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$j}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $j }}</option>
                                        @else
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$j}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $j }}</option>
                                        @endif
                                    @endfor
                                </select> 年
                                <select onChange="MM_o(this)">
                                    @for($i=1;$i<=12;$i++)
                                        @if($i==$month)
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$i}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $i }}</option>
                                        @else
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$i}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select> 月 
                            </td>
                            <td colspan="2">
                                單價：
                                <select onChange="MM_o(this)">
                                    @for($q=1;$q<=50;$q++)
                                        @if($q==$minunit)
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$q}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $q }}</option>
                                        @else
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$q}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $q }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp;到
                                <select onChange="MM_o(this)">
                                    @for($k=1;$k<=50;$k++)
                                        @if($k==$maxunit)
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$k}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $k }}</option>
                                        @else
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$k}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $k }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp;萬
                            </td>
                            <td>
                                總面積：
                                <select onChange="MM_o(this)">
                                    @for($a=1;$a<=300;$a++)
                                        @if($a==$minarea)
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$a}}&maxarea={{$maxarea}}" selected>{{ $a }}</option>
                                        @else
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$a}}&maxarea={{$maxarea}}">{{ $a }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp;到
                                <select onChange="MM_o(this)">
                                    @for($b=1;$b<=300;$b++)
                                        @if($b==$maxarea)
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$b}}" selected>{{ $b }}</option>
                                        @else
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$b}}">{{ $b }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp; 坪
                            </td>
                            <td>
                                屋齡：
                                <select onChange="MM_o(this)">
                                   @if($age == '')
                                        <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{''}}" selected>全部</option>
                                        @for($y=1;$y<=50;$y++)
                                            <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{$y}}">{{ $y }}</option>
                                        @endfor
                                    @else
                                        <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{''}}">全部</option>
                                        @for($y=1;$y<=50;$y++)
                                            @if($y==$age)
                                                <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{$y}}" selected>{{ $y }}</option>
                                            @else
                                                <option value="estate?select_loccal={{$select_loccal}}&year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{$y}}">{{ $y }}</option>
                                            @endif
                                        @endfor
                                    @endif
                                </select>&nbsp; 年
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered" style="width: 80%;position:absolute; top:15%; left:10%;">
                        <tr>
                            <td colspan="8">
                                @if(Auth::user()->role == '1admin')
                                    @if(isset($insert))
                                        <input type="submit" value="儲存" class="btn btn-success" name='insert_save' onclick="javascript:return insert1()">
                                    @else
                                        <input type="submit" value="新增" class="btn btn-warning" name='insert'>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #b8daff;">
                                <th style="text-align: center;" width="5%">編號</th>
                                <th style="text-align: center;" width="20%">區段位置</th>
                                <th style="text-align: center;" width="10%">單價 (萬/坪)</th>
                                <th style="text-align: center;" width="10%">總面積 (坪)</th>
                                <th style="text-align: center;" width="10%">總價 (萬)</th>
                                <th style="text-align: center;" width="25%">型態</th>
                                <th style="text-align: center;" width="10%">屋齡</th>
                                <th style="text-align: center;" width="10%">樓別 / 樓高</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @if(isset($insert))
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="text" name="insert_local" id="insert_local">
                                    </td>
                                    <td>
                                        <input type="text" name="insert_unit" id="insert_unit" size="6">
                                    </td>
                                    <td>
                                        <input type="text" name="insert_area" id="insert_area" size="6">
                                    </td>
                                    <td>
                                        <input type="text" name="insert_total" id="insert_total" size="6">
                                    </td>
                                    <td>
                                        <input type="text" name="insert_type" id="insert_type">
                                    </td>
                                    <td>
                                        <input type="text" name="insert_year" id="insert_year" size="3">
                                    </td>
                                    <td>
                                        <input type="text" name="insert_floor" id="insert_floor" size="5">
                                    </td>
                                </tr>
                            @endif
                            @if(count($estate) == 0)
                                <tr>
                                    <td colspan='8' class="danger">無資料</td>
                                </tr>
                            @else
                                @foreach($estate as $row)
                                    <tr @if($no%4==1) class="warning" @elseif($no%4==2) class="info" @elseif($no%4==3) class="danger" @else class="sccess" @endif>
                                        <td style="text-align: center;">{{ $no }}</td>
                                        <td style="text-align: center;">{{ $row->區段位置 }}</td>
                                        <td style="vertical-align: middle;">
                                            @if($row->單價 != 0)
                                                {{ $row->單價 }}
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">{{ $row->總面積 }}</td>
                                        <td style="vertical-align: middle;">{{ number_format($row->總價) }}</td>
                                        <td style="vertical-align: middle;">{{ $row->型態 }}</td>
                                        <td style="vertical-align: middle;">
                                            @if($row->屋齡 != 0)
                                                {{ $row->屋齡 }}年
                                            @else
                                                1年
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">{{ $row->樓別 }}</td>
                                    </tr>
                                    @php
                                        $no+=1;
                                    @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>
