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
            $(function () {
                $('#date1').datetimepicker({
                    format: 'YYYY-MM-DD',
                    locale: moment.locale('zh-cn')
                });
            });
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
                    <table class="table table-bordered" style="width: 90%;position:absolute; top:40%; left:5%;margin-top: 90px">
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
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>
