@extends('admin.master')
@section('title','Đổi mật khẩu')
@section('breadcrumb')
    <nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    <li><a href="{{route('admin.pi.index')}}">Home</a></li>
                    <li class="active">Thay đổi mật khẩu</li>
                </ol>
            </div>
        </div>
    </nav>
@endsection
@section('content')
    @include('admin.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Đổi mật khẩu Admin</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.pi.change.pass',$admin->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Tên đăng nhập</label>
                        <input readonly type="text" class="form-control" name="username" value="{{$admin->username}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Mật khẩu hiện tại</label>
                        <input type="password" maxlength="15" class="form-control" name="password" placeholder="nhập mật khẩu hiện tại" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mật khẩu mới</label>
                        <input type="password" maxlength="15" class="form-control" name="newpassword" placeholder="nhập mật khẩu mới" >
                    </div>
                    <div class="col-sm-6">
                        <label>Xác nhận mật khẩu mới</label>
                        <input type="password" maxlength="15" class="form-control" name="comfirmpassword" placeholder="nhập lại mật khẩu mới" >
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">quay lại</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection