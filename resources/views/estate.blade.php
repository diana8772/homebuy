<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment-with-locales.min.js"></script>
        <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            function MM_o(selObj){
                location.href=(selObj.options[selObj.selectedIndex].value);
            }
        </script>
        <style>
            .full-height {
                height: 30vh;
            }

            .flex-center {
                align-items: center;
                display:  -webkit-flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .log{
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                background: none;
                border: none;
            }
        </style>
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
                        if(Request::has("year"))
                            $year = Request::input("year");
                        else
                            $year = 108;
                        if(Request::has("month"))
                            $month = Request::input("month");
                        else
                            $month = 11;
                        if(Request::has("minunit"))
                            $minunit = Request::input("minunit");
                        else
                            $minunit = 1;
                        if(Request::has("maxunit"))
                            $maxunit = Request::input("maxunit");
                        else
                            $maxunit = 50;
                        if(Request::has("minarea"))
                            $minarea = Request::input("minarea");
                        else
                            $minarea = 1;
                        if(Request::has("maxarea"))
                            $maxarea = Request::input("maxarea");
                        else
                            $maxarea = 300;
                        if(Request::has("age"))
                            $age = Request::input("age");
                        else
                            $age = '';
                        if(Request::has("select_loccal"))
                            $select_loccal = Request::input("select_loccal");
                        else
                            $select_loccal = '';
                    @endphp
                    <table class="table table-bordered" style="width: 80%;position:absolute; top:40%; left:10%;">
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
                                    @for($j = 108;$j>=99;$j--)
                                        @if($j==$year)
                                            <option value="estate?year={{$j}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $j }}</option>
                                        @else
                                            <option value="estate?year={{$j}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $j }}</option>
                                        @endif
                                    @endfor
                                </select> 年
                                <select onChange="MM_o(this)">
                                    @for($i=1;$i<=12;$i++)
                                        @if($i==$month)
                                            <option value="estate?year={{$year}}&month={{$i}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $i }}</option>
                                        @else
                                            <option value="estate?year={{$year}}&month={{$i}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select> 月 
                            </td>
                            <td colspan="2">
                                單價：
                                <select onChange="MM_o(this)">
                                    @for($q=1;$q<=50;$q++)
                                        @if($q==$minunit)
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$q}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $q }}</option>
                                        @else
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$q}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $q }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp;到
                                <select onChange="MM_o(this)">
                                    @for($k=1;$k<=50;$k++)
                                        @if($k==$maxunit)
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$k}}&minarea={{$minarea}}&maxarea={{$maxarea}}" selected>{{ $k }}</option>
                                        @else
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$k}}&minarea={{$minarea}}&maxarea={{$maxarea}}">{{ $k }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp;萬
                            </td>
                            <td>
                                總面積：
                                <select onChange="MM_o(this)">
                                    @for($a=1;$a<=300;$a++)
                                        @if($a==$minarea)
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$a}}&maxarea={{$maxarea}}" selected>{{ $a }}</option>
                                        @else
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$a}}&maxarea={{$maxarea}}">{{ $a }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp;到
                                <select onChange="MM_o(this)">
                                    @for($b=1;$b<=300;$b++)
                                        @if($b==$maxarea)
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$b}}" selected>{{ $b }}</option>
                                        @else
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$b}}">{{ $b }}</option>
                                        @endif
                                    @endfor
                                </select>&nbsp; 坪
                            </td>
                            <td>
                                屋齡：
                                <select onChange="MM_o(this)">
                                   @if($age == '')
                                        <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{''}}" selected>全部</option>
                                        @for($y=1;$y<=50;$y++)
                                            <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{$y}}">{{ $y }}</option>
                                        @endfor
                                    @else
                                        <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{''}}">全部</option>
                                        @for($y=1;$y<=50;$y++)
                                            @if($y==$age)
                                                <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{$y}}" selected>{{ $y }}</option>
                                            @else
                                                <option value="estate?year={{$year}}&month={{$month}}&minunit={{$minunit}}&maxunit={{$maxunit}}&minarea={{$minarea}}&maxarea={{$maxarea}}&age={{$y}}">{{ $y }}</option>
                                            @endif
                                        @endfor
                                    @endif
                                </select>&nbsp; 年
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered" style="width: 80%;position:absolute; top:60%; left:10%;">
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
                            @if(count($estate) == 0)
                                <tr>
                                    <td colspan='8' class="danger">
                                        無資料
                                    </td>
                                </tr>
                            @else
                                @foreach($estate as $row)
                                    <tr @if($no%4==1) class="warning" @elseif($no%4==2) class="info" @elseif($no%4==3) class="danger" @else class="sccess" @endif>
                                        <td style="text-align: center;">
                                            {{ $no }}
                                        </td>
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
                    {{-- <table class="table table-bordered" style="width: 90%;position:absolute; top:40%; left:5%;margin-top: 90px">
                        <tr>
                            <th colspan="2" style="text-align: center;">個人資訊</th>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#86cfda">姓名 <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check==0)
                                        <input type="text" name="fullname" size="35" value="{{ $person_data->name }}">
                                    @else
                                        <input type="text" name="fullname" size="35" value="{{ $person_data1->name }}">
                                    @endif
                                @else
                                    @if($check!=0)
                                        {{ $person_data1->name }}
                                    @else
                                        {{ $person_data->name }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#ed969e">生日 <font color="red">*</font></th>
                            <td align="left">
                                <div class="input-group date" id='date1'>
                                    @if(Auth::user()->id == $id)
                                        @if($check==0)
                                            <input type="text" class="form-control" name="date">
                                        @else
                                            <input type="text" class="form-control" name="date" value="{{ $person_data1->birthday }}">
                                        @endif
                                        <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    @else
                                        @if($check!=0) {{ $person_data1->birthday }} @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#ffffff">性別 <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check==0)
                                        <input type="radio" name="sexuality" value="男" checked> 男
                                        <input type="radio" name="sexuality" value="女"> 女
                                    @else
                                        @if($person_data1->sexuality == '男')
                                            <input type="radio" name="sexuality" value="男" checked> 男
                                            <input type="radio" name="sexuality" value="女"> 女
                                        @else
                                            <input type="radio" name="sexuality" value="男"> 男
                                            <input type="radio" name="sexuality" value="女" checked> 女
                                        @endif
                                    @endif
                                @else
                                    @if($check!=0) {{ $person_data1->sexuality }} @endif
                                @endif
                                    
                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#ffdf7e">電話 <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check==0)
                                        <input type="text" name="phone" size="35">
                                    @else
                                        <input type="text" name="phone" size="35" value="{{ $person_data1->phone }}">
                                    @endif
                                @else
                                    @if($check!=0) {{ $person_data1->phone }} @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#8fd19e">Email <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check==0)
                                        <input type="text" name="email" size="35" value="{{ $person_data->email }}" readonly="readonly">
                                    @else
                                        <input type="text" name="email" size="35" value="{{ $person_data1->email }}" readonly="readonly">
                                    @endif
                                @else
                                    @if($check!=0)
                                        {{ $person_data1->email }}
                                    @else
                                        {{ $person_data->email }}
                                    @endif
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#7abaff">地址</th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check==0)
                                        <input type="text" name="address" size="35">
                                    @else
                                        <input type="text" name="address" size="35" value="{{ $person_data1->address }}">
                                    @endif
                                @else
                                    @if($check!=0) {{ $person_data1->address }} @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                @if(Auth::user()->id == $id)
                                    @if($check==0)
                                        <input type="submit" value="儲存" class="btn btn-warning" name='insert[{{ $person_data->id }}]'>
                                    @else
                                        <input type="submit" value="儲存" class="btn btn-warning" name='insert[{{ $person_data1->id }}]'>
                                    @endif
                                @else

                                @endif
                            </td>
                        </tr>
                    </table> --}}
                </div>
            </div>
        </form>
    </body>
</html>
