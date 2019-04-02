@extends('employee.master')
@section('title','Chi tiết bằng cấp')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Thông tin cá nhân</a></li>
                <li >Danh sách bằng cấp</li>
            </ol>
        </div>
    </div>
@endsection
@section('menu-tabs')
<nav class="cm-navbar cm-navbar-default cm-navbar-slideup">
        <div class="cm-flex">
            <div class="nav-tabs-container  table-responsive">
                <ul class="nav nav-tabs">
                    <li class="{{url()->current() == route('employee.faculty.detail',$pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.detail',$pi->id) }}">Thông tin cá nhân</a></li>
                    <li class="{{url()->current() == route('employee.faculty.workload',$pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.workload',$pi->id)}}">khối lượng công việc</a></li>
                    <li class="{{url()->current() == route('employee.faculty.sb',$pi->id) ? 'active':''}}"><a href="{{ route('employee.faculty.sb',$pi->id) }}">lý lịch khoa học</a></li>
                </ul>
            </div>
        </div>
</nav>
@endsection
@section('content')
  @if(session()->has('message'))
      <div class="alert alert-success mt-10">
          {{ session()->get('message') }}
      </div>
  @endif
<div class="panel panel-default">
    <div class="panel-heading">Danh sách bằng cấp<br>
        {{-- <a href="{{route('employee.faculty.degree.list')}}">
            <button type="button" name="button" class="btn btn-xs btn-success">Thêm mới</button>
        </a> --}}
    </div>
    <div class="table-responsive">
        <table class="table table-hover" action="{{ route('employee.faculty.degree.list',$pi->id) }}" method="get" style="margin-bottom:0">
            <thead>
                <tr>
                    <th>Loại</th>
                    <th>Chuyên ngành</th>
                    <th>Ngày Cấp </th>
                    <th>Nơi Cấp</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @if($degrees->count() >0)
             @foreach($degrees as $degree)
                    <tr>
                    <td class="">{{$degree->degree->name}}</td>
                    <td class="">{{ $degree->industry->name}}</td> 
                    <td class="">{{$degree->specialized}}</td>
                    <td class="">{{date('d-m-Y', strtotime($degree->date_of_issue))}}</td>
                        {{--{{date('d-m-Y',($degree->date_of_issue))}}--}}
                    <td class="">{{$degree->place_of_issue}}</td>
                    <td class="">{{$degree->country->country_name}}</td>
                    {{-- @can('cud', $pi) --}}
                    {{-- <td class="">
                        <a href="{{route('employee.pi.update.detail.degree',$degree->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cập nhật" class="tooltip-test">
                      <span class=""><i class="fa fa-lg fa-edit text-primary"></i>
                          <span class="mdi mdi-close"></span>
                      </span>
                        </a>
                        <a href="{{route('employee.pi.degree.delete',$degree->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Xóa"  class="delete_degree tooltip-test ml-10">
                      <span class=""><i class="fa fa-lg fa-trash text-danger"></i>
                          <span class="mdi mdi-close"></span>
                      </span>
                        </a>
                    </td> --}}
                    {{-- @else --}}
                    <td></td>
                    {{-- @endcan --}}
                    </tr>
                    {{-- @can('cud', $pi) --}}
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="degree-delete-modal">

                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bạn thực sự muốn xoá bằng cấp này ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btn-pd-yes">Có</button>
                                    <button type="button" class="btn btn-default" id="btn-pd-no">Không</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endcan --}}
            @endforeach
          @else
            <tr>
              <td colspan="5" class="text-center">Không có bất kỳ dữ liệu nào được tìm thấy</td>
            </tr>
          @endif
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".delete_degree").on('click',function (e) {
                e.preventDefault(); //huy bo thao tac mac dinh.
                $("#degree-delete-modal").modal('show'); //show cai div co id pi-delete-modal
                var delete_pi_form = $(this).attr('href'); //lay gia tri href cua class delete_degree
                var modalConfirm = function(callback){
                    //khi nhan nut yes
                    $("#btn-pd-yes").on("click", function(){
                        callback(true);
                        $("#degree-delete-modal").modal('hide');
                    });
                    //khi nhan nut no
                    $("#btn-pd-no").on("click", function(){
                        callback(false);
                        $("#degree-delete-modal").modal('hide');
                    });
                };
                modalConfirm(function(confirm){
                    if(confirm){
                        //khi nhan nut yes
                        //thuc hien chuyen tiep den url delete_pi_form = $(this).attr('href');
                        window.location.href = delete_pi_form;

                    }else{

                    }
                });
            });
        });
    </script>
@endsection