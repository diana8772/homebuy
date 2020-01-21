<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.bootcss.com/moment.js/2.18.1/moment-with-locales.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
        <script type="text/javascript">
            $(function(){
                $('#date1').datetimepicker({
                    format: 'YYYY-MM-DD',
                    locale: moment.locale('zh-cn')
                });
            });
            function insert1(){ 
                var fullname = document.getElementById("fullname");
                var fullname1 = fullname.value;
                var date = document.getElementById("date");
                var date2 = date.value;
                var phone = document.getElementById("phone");
                var phone1 = phone.value;
                var email = document.getElementById("email");
                var email1 = email.value;
                if(fullname1=='' || date2 =='' || phone1 =='' || email1==''){
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
                    <table class="table table-bordered" style="width: 90%;position:absolute; top:10%; left:5%;">
                        <tr style="background-color: #50b799;height: 50px !important;">
                            <th colspan="2" style="text-align: center;vertical-align: middle;font-size: 16px;">個人資訊</th>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#86cfda">姓名 <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check == 0)
                                        <input type="text" name="fullname" id="fullname" size="35" value="{{ $person_data->name }}">
                                    @else
                                        <input type="text" name="fullname" id="fullname" size="35" value="{{ $person_data1->name }}">
                                    @endif
                                @else
                                    @if($check != 0)
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
                                        @if($check == 0)
                                            <input type="text" class="form-control" name="date" id="date">
                                        @else
                                            <input type="text" class="form-control" name="date" id="date" value="{{ $person_data1->birthday }}">
                                        @endif
                                        <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                    @else
                                        @if($check != 0) {{ $person_data1->birthday }} @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#ffffff">性別 <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check == 0)
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
                                    @if($check != 0) {{ $person_data1->sexuality }} @endif
                                @endif
                                    
                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#ffdf7e">電話 <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check == 0)
                                        <input type="text" name="phone" id="phone" size="35">
                                    @else
                                        <input type="text" name="phone" id="phone" size="35" value="{{ $person_data1->phone }}">
                                    @endif
                                @else
                                    @if($check != 0) {{ $person_data1->phone }} @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th align="center" bgcolor="#8fd19e">Email <font color="red">*</font></th>
                            <td align="left">
                                @if(Auth::user()->id == $id)
                                    @if($check == 0)
                                        <input type="text" name="email" id="email" size="35" value="{{ $person_data->email }}" readonly="readonly">
                                    @else
                                        <input type="text" name="email" id="email" size="35" value="{{ $person_data1->email }}" readonly="readonly">
                                    @endif
                                @else
                                    @if($check != 0)
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
                                    @if($check == 0)
                                        <input type="text" name="address" id="address" size="35">
                                    @else
                                        <input type="text" name="address" id="address" size="35" value="{{ $person_data1->address }}">
                                    @endif
                                @else
                                    @if($check != 0) {{ $person_data1->address }} @endif
                                @endif
                            </td>
                        </tr>
                        <tr style="background-color: #50b799;">
                            <td colspan="2">
                                @if(Auth::user()->id == $id)
                                    @if($check == 0)
                                        <input type="submit" value="儲存" class="btn btn-warning" name='insert[{{ $person_data->id }}]'  onclick="javascript:return insert1()">
                                    @else
                                        <input type="submit" value="儲存" class="btn btn-warning" name='insert[{{ $person_data1->id }}]'  onclick="javascript:return insert1()">
                                    @endif
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>
