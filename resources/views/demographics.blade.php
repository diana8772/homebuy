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
    <script type="text/javascript" src="{{ asset('public/js/Chart.js') }} "></script>
    <script type="text/javascript" src="{{ asset('public/js/Chart.bundle.js') }} "></script>
    <script type="text/javascript" src="{{ asset('public/js/Chart.bundle.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('public/js/Chart.min.js') }} "></script>
    <script type="text/javascript"></script>
        <script type="text/javascript">
            function MM_o(selObj){
                location.href=(selObj.options[selObj.selectedIndex].value);
            }
        </script>
        <style>
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
            .tabletrstyle{
                text-align: right;
                height: 15px;
                padding: 3px !important;
                vertical-align: middle !important;
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
                            $month = 12;
                    @endphp
                    <table class="table table-bordered" style="width: 90%;position:absolute; top:30%; left:5%;margin-top: 90px">
                        <tr>
                            <th colspan="23" style="text-align: center;font-size: 20PX;" bgcolor="#86cfda">臺中市人口統計</th>
                        </tr>
                        <tr>
                            <td colspan="23">
                                <select onChange="MM_o(this)">
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
                                </select> 月
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
                    @php
                        // dd(json_encode($number));
                    @endphp
                    {{-- <script type="text/javascript">
                        $.get('get_chart_data',function (data, status) {
                            var ctx = document.getElementById("my_chart").getContext("2d");
                                  var my_chart = new Chart(ctx,{
                                    type: 'pie',
                                    data: {
                                        labels: [
                                          "首页文章列表",
                                          "分类文章列表",
                                          "文章详情",
                                          "关于我",
                                        ],
                                        datasets: [{
                                            data: data,
                                            backgroundColor: [
                                                window.chartColors.red,
                                                window.chartColors.orange,
                                                window.chartColors.purple,
                                                window.chartColors.green,
                                            ],
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                    }
                              });
                        });
                        window.chartColors = {
                            red: 'rgb(255, 99, 132)',
                            orange: 'rgb(255, 159, 64)',
                            yellow: 'rgb(255, 205, 86)',
                            green: 'rgb(75, 192, 192)',
                            blue: 'rgb(54, 162, 235)',
                            purple: 'rgb(153, 102, 255)',
                            grey: 'rgb(201, 203, 207)'
                        };
                    </script> --}}

                </div>
            </div>
        </form>
    </body>
</html>
