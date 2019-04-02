@extends('admin.master')
@section('title','Cập nhật thông tin nhân viên')
@section('breadcrumb')
    <div class="cm-flex">
        <div class="cm-breadcrumb-container">
            <ol class="breadcrumb">
                {{-- <li><a href="#">Home</a></li> --}}
                <li class=""><a href="{{route('admin.pi.index')}}">Quản lý thông tin nhân viên</a></li>
                <li class="active">Cập nhật thông tin nhân viên</li>
            </ol>
        </div>
    </div>

@endsection
@section('content')
@include('admin.layouts.Error')
@if(session()->has('message'))
    <div class="alert alert-success mt-10">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Cập nhật thông tin cá nhân</div>
        <div class="panel-body">
            <form class="form-horizontal" action="{{route('admin.pi.update',$pi->id)}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Mã nhân viên</label>
                        <input required type="text" class="form-control" name="employee_code" placeholder="Nhập mã nhân viên" value="{{$pi->employee_code}}" readonly="readonly">
                    </div>
                    <div class="col-sm-6">
                        <label>Họ và tên</label>
                        <input required type="text" maxlength="60" class="form-control" name="full_name" placeholder="Nhập họ và tên" value="{{$pi->full_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                      <label>Dân tộc</label>
                      <select required class="form-control" name="nation">
                          <option value="">Chọn dân tộc</option>
                          @foreach($nations as $nation)
                          <option {{$pi->nation_id == $nation->id ? 'selected' : ''}} value="{{$nation->id}}">{{$nation->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Giới tính</label>
                        <div class="radio">
                            <label class="col-sm-4">
                                <input required type="radio" name="gender" value="0" {{$pi->gender ==0 ? "checked":""}}>Nam
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="gender" value="1" {{$pi->gender ==1 ? "checked":""}}>Nữ
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Ngày sinh</label>
                        <input required required type="date" min="1900-01-01"  class="form-control" name="date_of_birth" value="{{$pi->date_of_birth}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Nơi sinh</label>
                        <input required type="text" maxlength="100" class="form-control" name="place_of_birth" placeholder="Nhập nơi sinh" value="{{$pi->place_of_birth}}">
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Địa chỉ thường trú</label>
                                <input required type="text" maxlength="100" class="form-control" name="permanent_address" placeholder="Nhập địa chỉ thường trú" value="{{$permanent_address->address_content}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="">Tỉnh/Thành phố </label>
                                <select required class="form-control" id="province_1" name="province_1">
                                    <option value="">Chọn tỉnh/thành phố</option>
                                    {{-- @foreach($provinces as $item)
                                    <option value="{{$item->code}}">{{$item->name_with_type}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Quận/huyện</label>
                                <select required class="form-control" id="district_1" name="district_1">
                                    <option value="">Vui lòng chọn tỉnh/thành phố</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Phường/xã</label>
                                <select required class="form-control" id="ward_1" name="ward_1">
                                    <option value="">Vui lòng chọn quận/huyện</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="">Địa chỉ tạm trú</label>
                                <input required type="text" maxlength="100" class="form-control" name="contact_address" placeholder="Nhập địa chỉ tạm trú" value="{{old('contact_address')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label for="">Tỉnh/Thành phố </label>
                                <select required class="form-control" id="province_2" name="province_2">
                                    <option value="">Chọn tỉnh/thành phố</option>
                                    {{-- @foreach($provinces as $item)
                                    <option value="{{$item->code}}">{{$item->name_with_type}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Quận/huyện</label>
                                <select required class="form-control" id="district_2" name="district_2">
                                    <option value="">Vui lòng chọn tỉnh/thành phố</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Phường/xã</label>
                                <select required class="form-control" id="ward_2" name="ward_2">
                                    <option value="">Vui lòng chọn quận/huyện</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Số điện thoại</label>
                        <input required type="text" class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{$pi->phone_number}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Địa chỉ Email</label>
                        <input required type="text" class="form-control" name="email_address" placeholder="Nhập địa chỉ Email" value="{{$pi->email_address}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <input required type="text" class="form-control" name="position" placeholder="Nhập chức vụ" value="{{$pi->position}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Ngày tuyển dụng</label>
                        <input required required type="date" min="1900-01-01"  class="form-control" name="date_of_recruitment" value="{{$pi->date_of_recruitment}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức danh chuyên môn</label>
                        <input required type="text" class="form-control" name="professional_title" placeholder="Nhập chức danh chuyên môn" value="{{$pi->professional_title}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Đơn vị</label>
                        <select required class="form-control" name="unit">
                            <option value="">Chọn đơn vị</option>
                            @foreach($units as $unit)
                            <option {{ $pi->unit_id==$unit->id?'selected':'' }} value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6">
                      <label>Chứng minh nhân dân</label>
                      <input required type="text" class="form-control" name="identity_card" placeholder="Nhập chứng minh nhân dân" value="{{$pi->identity_card}}">
                  </div>
                  <div class="col-sm-6">
                      <label>Ngày cấp</label>
                      <input required required type="date" min="1900-01-01"  class="form-control" name="date_of_issue" value="{{$pi->date_of_issue}}">
                  </div>

                </div>
                <div class="form-group">

                    <div class="col-sm-6">
                        <label>Nơi cấp</label>
                        <input required type="text" maxlength="100" class="form-control" name="place_of_issue" placeholder="Nhập nơi cấp" value="{{$pi->place_of_issue   }}">
                    </div>
                    <div class="col-sm-6">
                        <label>Loại cán bộ</label>
                        <select required class="form-control" name="officer_type" data-dependent>
                            <option value="">Chọn loại cán bộ</option>
                            {{-- @foreach($officer_types as $officer_type)
                            <option {{$officer_type->id == old('officer_type') ? 'selected':''}} value="{{$officer_type->id}}">{{$officer_type->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Chức vụ</label>
                        <select required class="form-control" name="position_type" data-dependent>
                            <option value="">Chọn chức vụ</option>
                            {{-- @foreach($position_types as $position_type)
                            <option {{$position_type->id == old('position_type') ? 'selected':''}} value="{{$position_type->id}}">{{$position_type->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Kiêm nhiệm giảng dạy</label>
                        <div class="radio">
                            <label class="col-sm-4">
                                <input required type="radio" name="is_concurrently" value="0" checked>Có
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="is_concurrently" value="1">Không
                            </label>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Loại giảng viên</label>
                        <select required class="form-control" name="teacher_type" data-dependent>
                            <option value="">Chọn loại giảng viên</option>
                            {{-- @foreach($teacher_types as $teacher_type)
                            <option {{$teacher_type->id == old('teacher_type') ? 'selected':''}} value="{{$teacher_type->id}}">{{$teacher_type->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Chức danh nghề nghiệp</label>
                        <select required class="form-control" name="teacher_title" data-dependent>
                            <option value="">Chọn chức danh</option>
                            {{-- @foreach($teacher_titles as $teacher_title)
                            <option {{$teacher_title->id == old('teacher_title') ? 'selected':''}} value="{{$teacher_title->id}}">{{$teacher_title->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label>Danh hiệu</label>
                        <div class="checkbox">
                            <label class="col-sm-4">
                                <input type="checkbox" name="is_excellent_teacher" value="1">Nhà giáo ưu tú
                            </label>
                            <label class="col-sm-4">
                                <input type="checkbox" name="is_national_teacher" value="1">Nhà giáo nhân dân
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Nghỉ hưu</label>
                        <div class="radio">
                            <label class="col-sm-4">
                                <input required type="radio" name="is_retired" value="0" checked>Đã nghỉ hưu
                            </label>
                            <label class="col-sm-4">
                                <input required type="radio" name="is_retired" value="1">Chưa nghỉ hưu
                            </label>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-sm-6  pull-right">
                        <label>Ngày nghỉ hưu</label>
                        <input required type="date" min="1900-01-01" class="form-control" name="date_of_retirement" value="{{old('date_of_retirement')}}">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:0">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="reset" class="btn btn-default">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#province_1').on('change', function(e) {
                var province_code = e.target.value;
                $.get('{{route('res.districts')}}' + '?province_code=' + province_code,
                    function(data) {
                        $('#district_1').empty();
                        $('#district_1').append('<option value="" disabled selected>Chọn quận/huyện</option>');
                        $.each(data, function(index, district) {
                            $('#district_1').append('<option data-old-1="old-'+district.code+'" value="' + district.code + '">' + district.name_with_type + '</option>');
                            var old_district_1 = '{{old('district_1')}}';
                            console.log(district.code);
                            if(district.code == old_district_1){
                              $('option[data-old-1="old-'+district.code+'"]').prop('selected',true);
                            }

                        });
                    });
            });
            $('#district_1').on('change', function(e) {
                var district_code = e.target.value;
                $.get('{{route('res.wards')}}' + '?district_code=' + district_code,
                    function(data) {
                        $('#ward_1').empty();
                        $('#ward_1').append('<option value="" disabled selected>Chọn phường/xã</option>');
                        $.each(data, function(index, ward) {
                            $('#ward_1').append('<option data-old-1="old-'+ward.code+'" value="' + ward.code + '">' + ward.name_with_type + '</option>');
                            var old_ward_1 = '{{old('ward_1')}}';
                            console.log(ward.code);

                            if(ward.code == old_ward_1){
                              $('option[data-old-1="old-'+district.code+'"]').prop('selected',true);
                            }
                        });
                    });
            });
            $('#province_2').on('change', function(e) {
                var province_code = e.target.value;
                $.get('{{route('res.districts')}}' + '?province_code=' + province_code,
                    function(data) {
                        $('#district_2').empty();
                        $('#district_2').append('<option value="" disabled selected>Chọn quận/huyện</option>');
                        $.each(data, function(index, district) {
                            $('#district_2').append('<option value="' + district.code + '">' + district.name_with_type + '</option>')
                        });
                    });


            });


            $('#district_2').on('change', function(e) {
                var district_code = e.target.value;
                $.get('{{route('res.wards')}}' + '?district_code=' + district_code,
                    function(data) {
                        $('#ward_2').empty();
                        $('#ward_2').append('<option value="" disabled selected>Chọn phường/xã</option>');
                        $.each(data, function(index, ward) {
                            $('#ward_2').append('<option value="' + ward.code + '">' + ward.name_with_type + '</option>')
                        });
                    });
            });
        });
    </script>
    @endsection
