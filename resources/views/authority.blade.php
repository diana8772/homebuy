<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
    </head>
    <script type="text/javascript">
        function del1() { 
            var msg = "確定要刪除嗎？\n\n請確認！"; 
            if (confirm(msg)==true){ 
                return true; 
            }else{ 
                return false; 
            } 
        }
    </script>
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
                        if(Request::has("id"))
                            $id = Request::input("id");
                        else
                            $id = "";
                        if(Request::has("edit"))
                            $edit = key(Request::input("edit"));
                    @endphp
                    <table class="table table-bordered" style="width: 90%;position:absolute;top:10%;left:5%;">
                        <thead>
                            <tr>
                                <th style="text-align: center;">功能</th>
                                <th style="text-align: center;">姓名</th>
                                <th style="text-align: center;">信箱</th>
                                <th style="text-align: center;">權限</th>
                                <th style="text-align: center;">註冊日期</th>
                                <th style="text-align: center;">最新登入日期</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach($users as $row)
                                <tr @if($no%4==1) class="warning" @elseif($no%4==2) class="info" @elseif($no%4==3) class="danger" @else class="sccess" @endif>
                                    <td style="text-align: center;">
                                        @if((Auth::user()->role == '1admin' && $row->role != '1admin'))
                                            <input type="submit" value="刪除" class="btn btn-danger btn-sm" name='delete[{{ $row->id }}]' onclick="javascript:return del1()">
                                        @endif
                                        @if(Auth::user()->role == '1admin' && $row->role != '1admin')
                                            @if(isset($edit) && $edit == $row->id)
                                                <input type="submit" value="儲存" class="btn btn-primary btn-sm" name='edit_save[{{ $row->id }}]'>
                                            @else
                                                <input type="submit" value="編輯" class="btn btn-warning btn-sm" name='edit[{{ $row->id }}]'>
                                            @endif
                                        @endif
                                        <a href="{{ url("authority/person?id=".$row->id) }}" style="text-decoration:none;color: #ffffff;" class="btn btn-success btn-sm">詳細</a>
                                    </td>
                                    <td style="vertical-align: middle;">{{ $row->name }}</td>
                                    <td style="vertical-align: middle;">{{ $row->email }}</td>
                                    <td style="vertical-align: middle;">
                                        @if(Auth::user()->role == '1admin' && $row->name != '1admin')
                                            @if(isset($edit) && $edit == $row->id)
                                                @if($row->role == '3guest')
                                                    <select name="role">
                                                        <option value="3guest">guest</option>
                                                        <option value="2user">user</option>
                                                    </select>
                                                @elseif($row->role == '2user')
                                                    <select name="role">
                                                        <option value="2user">user</option>
                                                        <option value="3guest">guest</option>
                                                    </select>
                                                @elseif($row->role == '')
                                                    <select name="role">
                                                        <option value="2user">user</option>
                                                        <option value="3guest">guest</option>
                                                    </select>
                                                @endif
                                            @else
                                                @if($row->role == '1admin') admin
                                                @elseif($row->role == '2user') user
                                                @elseif($row->role == '3guest')guest
                                                @endif
                                            @endif
                                        @else
                                            @if($row->role == '1admin') admin
                                            @elseif($row->role == '2user') user
                                            @elseif($row->role == '3guest')guest
                                            @endif
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">{{ $row->created_at }}</td>
                                    <td style="vertical-align: middle;">{{ $row->updated_at }}</td>
                                </tr>
                                @php
                                    $no+=1;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>
