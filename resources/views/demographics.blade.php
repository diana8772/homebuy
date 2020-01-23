<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment-with-locales.min.js"></script>
        <link href="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('public/js/Chart.js') }} "></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
        <script type="text/javascript"></script>
        <script type="text/javascript">
            function MM_o(selObj){
                location.href=(selObj.options[selObj.selectedIndex].value);
            }
            function insert1() { 
                var selectedValues = $('select[id="select_local"]').val() || [];
                document.getElementById('myElement').value=selectedValues;
                return true;
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
                        if(Request::has("year"))
                            $year = Request::input("year");
                        else
                            $year = 108;
                        if(Request::has("month"))
                            $month = Request::input("month");
                        else
                            $month = 12;
                        if(Request::has("select_local"))
                            $select_local = Request::input("select_local");
                        else
                            $select_local = '';
                    @endphp
                    <table class="table table-bordered" style="width: 90%;position:absolute; top:0%; left:5%;margin-top: 90px">
                        <tr>
                            <th colspan="23" style="text-align: center;font-size: 20PX;" bgcolor="#86cfda">臺中市人口統計</th>
                        </tr>
                        <tr>
                            <td colspan="22">
                                <select onChange="MM_o(this)" id="year">
                                    @for($j = 108;$j>=107;$j--)
                                        @if($j==$year)
                                            <option value="demographics?year={{$j}}&month={{$month}}" selected>{{ $j }}</option>
                                        @else
                                            <option value="demographics?year={{$j}}&month={{$month}}">{{ $j }}</option>
                                        @endif
                                    @endfor
                                </select> 年
                                <select onChange="MM_o(this)">
                                    @for($i=1;$i<=12;$i++)
                                        @if($i==$month)
                                            <option value="demographics?year={{$year}}&month={{$i}}" selected>{{ $i }}</option>
                                        @else
                                            <option value="demographics?year={{$year}}&month={{$i}}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select> 月   地區：
                                <select multiple="multiple" id="select_local" size="6" style="width: 20%">
                                    @if($select_local == "")
                                        <option value="{{''}}" selected>全部</option>
                                    @else
                                        <option value="{{''}}">全部</option>
                                    @endif
                                    @foreach($locals as $row)
                                        @if($row==$select_local)
                                            <option value="{{$row}}" selected>{{ $row }}</option>
                                        @else
                                            <option value="{{$row}}">{{ $row }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="submit" value="查詢" class="btn btn-success" name='insert_save' onclick="javascript:return insert1()">
                                <input type="text" id="myElement" name="select_locals" hidden="">
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align: center;" bgcolor="#86cfda">區域別</th>
                            <th style="text-align: center;" bgcolor="#86cfda">總計</th>
                            <th style="text-align: center;" bgcolor="#86cfda">0-9歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">10-19歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">20-29歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">30-39歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">40-49歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">50-59歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">60-69歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">70-79歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">80-89歲</th>
                            <th style="text-align: center;" bgcolor="#86cfda">90-99歲</th>
                            <th style="text-align: center;" class="tabletrstyle" bgcolor="#86cfda">100歲以上</th>
                        </tr>
                        @foreach($data as $key => $row)
                            <tr>
                                <td class="tabletrstyle" style="text-align: left;"> {{ $row->區域別 }}</td>
                                <td class="tabletrstyle">{{ number_format($row->總計) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y0) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y10) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y20) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y30) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y40) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y50) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y60) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y70) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y80) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y90) }}</td>
                                <td class="tabletrstyle">{{ number_format($row->y100) }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <th colspan="23" style="text-align: center;font-size: 20PX;" bgcolor="#86cfda">
                                各地區人口總數
                            </th>
                        </tr>
                        <tr>
                            <td colspan="23">
                                <canvas id="myChart" width="300" height="150"></canvas>
                            </td>
                        </tr>
                    </table>
                    <script type="text/javascript">
                        var ctx = document.getElementById('myChart');
                        var ctx = document.getElementById('myChart').getContext('10d');
                        var ctx = $('#myChart');
                        var ctx = "myChart";
                        var ctx = document.getElementById('myChart');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                              labels: <?=$local;?>,
                              datasets: [{
                              type: 'bar',
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)','rgba(255, 99,132, 0.2)'
                              ],
                              borderColor: [
                                '#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384',
                                '#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384',
                                '#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384','#FF6384',
                              ],
                              hoverBackgroundColor: [
                                '#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E',
                                '#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E',
                                '#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E','#FFDF7E',
                              ],
                              hoverBorderColor: [
                                '#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464',
                                '#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464',
                                '#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464','#FFB464',
                              ],
                              borderWidth: 1,
                              label: '人口數',
                              data: <?=$number;?>,
                              }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: '人口數',
                                            fontSize: 20,
                                        },
                                        ticks: {
                                            fontSize: 20,
                                            callback: function (value, index, values) {
                                                return value.toLocaleString();
                                            }
                                        }
                                    }],
                                    xAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: '地區',
                                            fontSize: 20,
                                        },
                                        ticks: {
                                            fontSize: 20,
                                        }
                                    }],
                                },
                            }
                        });
                    </script>
                </div>
            </div>
        </form>
    </body>
</html>
