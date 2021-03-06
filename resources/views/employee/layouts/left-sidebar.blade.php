<div id="cm-menu">
    <nav class="cm-navbar cm-navbar-primary">
        <div class="cm-flex"><a href="{{route('employee.pi.detail')}}" class="vlu-logo"></a></div>
        <div class="btn btn-primary md-menu-white" data-toggle="cm-menu"></div>
    </nav>
    <div id="cm-menu-content">
        <div id="cm-menu-items-wrapper">
            <div id="cm-menu-scroller">
                <ul class="cm-menu-items">

                    <li class="{{url()->current() == route('employee.pi.detail') ? 'active':''}}">
                      <a href="{{route('employee.pi.detail')}}" class="sf-profile">Thông tin cá nhân</a>
                    </li>
                    <li class="{{url()->current() == route('employee.workload.index') ? 'active':''}}">
                        <a href="{{route('employee.workload.index')}}" class="sf-dashboard">Khối lượng giảng dạy</a>
                    </li>
                    <li class="{{url()->current() == route('employee.srworkload.index') ? 'active':''}}">
                        <a href="{{route('employee.srworkload.index')}}" class="sf-dashboard-alt">Khối lượng NCKH</a>
                    </li>
                    <li class="{{url()->current() == route('employee.sb.detail') ? 'active':''}}">
                        <a href="{{route('employee.sb.detail')}}" class="sf-file-text">Lý lịch khoa học</a>
                    </li>
                    <li class="{{url()->current() == route('employee.confirmation.index') ? 'active':''}}">
                            <a href="{{route('employee.confirmation.index')}}" class=" sf-notepad">Yêu cầu xác nhận</a>
                        </li>

                    @can('actAsFacultyLeader',Auth::guard('employee')->user()->pi)
                    <li class="{{url()->current() == route('employee.faculty.index') ? 'active':''}}">
                        <a href="{{route('employee.faculty.index')}}" class="sf-profile-group">Quản lý khoa</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
</div>
