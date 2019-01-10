@extends('employee.master')
@section('title','Thêm bằng cấp')
@section('breadcrumb')
        <div class="cm-flex">
            <div class="cm-breadcrumb-container">
                <ol class="breadcrumb">
                    <li><a href="{{route('employee.pi.detail')}}">Thông tin cá nhân</a></li>
                    <li class="active"><a href="{{route('employee.pi.degree.index')}}">Danh sách bằng cấp</a></li>
                    <li >Cập nhật thông tin bằng cấp</li>
                </ol>
            </div>
        </div>
@endsection

@section('content')
    @include('employee.layouts.Error')
    @if(session()->has('message'))
        <div class="alert alert-success mt-10">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Cập nhật thông tin bằng cấp</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('employee.pi.update.detail.degree',$degree->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Bằng cấp</label>
                        <select required class="form-control" name="degree">
                          <option value="">Chọn bằng cấp</option>
                            @foreach($degrees as $d)
                                @if($d->id == $degree->degree_id)
                                    <option selected value="{{$d->id}}">{{$d->name}}</option>
                                @else
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Chuyên ngành</label>
                        <select required class="form-control" name="specialized">
                          <option value="">Chọn chuyên ngành</option>
                            @foreach($specializes as $s)
                              <option {{$degree->specialized_id == $s->id ? 'selected':''}} value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày cấp</label>
                        <input required type="date" min="1900-01-01" class="form-control" name="date_of_issue" value="{{$degree->date_of_issue}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input required type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$degree->place_of_issue}}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
