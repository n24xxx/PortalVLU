@extends('admin.master')
@section('title','Chi tiết công việc')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class=""><a href="{{route('admin.workload.index')}}">Quản lý khối lượng công việc</a></li>
            <li class="active">Chi tiết khối lượng công việc - {{$workload->pi->employee_code}}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
<div id="" style="padding-top: 20px">
    <div class="">
        <div class=" cm-fix-height">
            <div class="col-sm-7">
                <div class="col-sm-12 form-horizontal">
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin môn học <br>
                            <a href="{{route('admin.workload.update',$workload->id)}}">
                                <button type="button" name="button" class="btn btn-xs btn-primary">Cập nhật</button>
                            </a>
                        </div>
                        <div class="panel-body">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-5">Mã môn học</label>
                                    <span for="" class="col-sm-7 text-nowrap">{{$workload->subject_code}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Mã lớp học</label>
                                    <span for="" class="col-sm-7 text-nowrap">{{$workload->class_code}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Tên môn học</label>
                                    <span for="" class="col-sm-7 text-nowrap">{{$workload->subject_name}}</span>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Số sinh viên</label>
                                    <span for="" class="col-sm-7 text-nowrap">{{$workload->number_of_students}} sinh viên </span>
                                </div>

                                <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-5  ">Số tiết học</label>
                                        <span for="" class="col-sm-7 text-nowrap">{{$workload->number_of_lessons}} tiết</span>
                                    </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Tổng số giờ</label>
                                    <span for="" class="col-sm-7 text-nowrap">{{$workload->total_workload}} giờ</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Số giờ lý thuyết</label>
                                    <span for="" class="col-sm-7 text-nowrap">{{$workload->theoretical_hours}} giờ</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-5  ">Số giờ thực hành</label>
                                    <span for="" class="col-sm-7 text-nowrap">{{$workload->practice_hours}} giờ</span>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">

                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin giảng viên<br>
                        </div>
                        <div class="panel-body">
                                <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-5  ">Mã nv</label>
                                            <span for="" class="col-sm-7 text-nowrap">{{$workload->pi->employee_code}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-5  ">Họ tên</label>
                                            <span for="" class="col-sm-7 text-nowrap">{{$workload->pi->full_name}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-5  ">Khoa</label>
                                            <span for="" class="col-sm-7 text-nowrap">{{$workload->pi->unit->name}}</span>
                                        </div>
                                      </form>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Thông tin khai giảng<br>
                        </div>
                        <div class="panel-body">
                                <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-5  ">Học kỳ</label>
                                            <span for="" class="col-sm-7 text-nowrap">{{$workload->semester->alias}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-5  ">Niên khóa</label>
                                            <span for="" class="col-sm-7 text-nowrap">{{$workload->workloadsession->start_year}}-{{$workload->workloadsession->end_year}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-5  ">Khoa</label>
                                            <span for="" class="col-sm-7 text-nowrap">{{$workload->unit->name}}</span>
                                        </div>
                                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".delete_degree").on('click', function(e) {
            e.preventDefault(); //huy bo thao tac mac dinh.
            $("#degree-delete-modal").modal('show'); //show cai div co id pi-delete-modal
            var delete_pi_form = $(this).attr('href'); //lay gia tri href cua class delete_degree
            var modalConfirm = function(callback) {
                //khi nhan nut yes
                $("#btn-pd-yes").on("click", function() {
                    callback(true);
                    $("#degree-delete-modal").modal('hide');
                });
                //khi nhan nut no
                $("#btn-pd-no").on("click", function() {
                    callback(false);
                    $("#degree-delete-modal").modal('hide');
                });
            };
            modalConfirm(function(confirm) {
                if (confirm) {
                    //khi nhan nut yes
                    //thuc hien chuyen tiep den url delete_pi_form = $(this).attr('href');
                    window.location.href = delete_pi_form;

                } else {

                }
            });
        });
    });
</script>
@endsection
