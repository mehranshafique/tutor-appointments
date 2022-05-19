<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('price_access')
                <li class="nav-item">
                    <a href="{{ route("admin.prices.index") }}" class="nav-link {{ request()->is('admin/prices') || request()->is('admin/prices/*') ? 'active' : '' }}">
                        <i class="fa fa-money nav-icon">

                        </i>
                        {{ trans('cruds.price.title') }}
                    </a>
                </li>
            @endcan

            @can('subject_access')
                <li class="nav-item">
                    <a href="{{ route("admin.subjects.index") }}" class="nav-link {{ request()->is('admin/subjects') || request()->is('admin/subjects/*') ? 'active' : '' }}">
                        <i class="fa fa-list-alt nav-icon">

                        </i>
                        {{ trans('cruds.subject.title') }}
                    </a>
                </li>
            @endcan

            @can('child_subject_access')
                <li class="nav-item">
                    <a href="{{ route("admin.child-subjects.index") }}" class="nav-link {{ request()->is('admin/child-subjects') || request()->is('admin/child-subjects/*') ? 'active' : '' }}">
                        <i class="fas fa-book-open nav-icon">

                        </i>
                        {{ trans('cruds.child_subjects.title') }}
                    </a>
                </li>
            @endcan

            @can('teacher_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fas fa-chalkboard-teacher nav-icon">

                        </i>
                        {{ trans('cruds.teacher.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('teacher_list_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.teachers.index") }}" class="nav-link {{ request()->is('admin/teachers') || request()->is('admin/teachers/*') ? 'active' : '' }}">
                                    <i class="fas fa-chalkboard-teacher nav-icon">

                                    </i>
                                    {{ trans('cruds.teacher.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('teacher_availbility_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.availbilities.index") }}" class="nav-link {{ request()->is('admin/availbilities') || request()->is('admin/availbilities/*') ? 'active' : '' }}">
                                    <i class="far fa-clock nav-icon">

                                    </i>
                                    {{ trans('cruds.teacherAvailbility.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('teacher_calendar_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.teacherCalendar") }}" class="nav-link {{ request()->is('admin/teacher-calendar') || request()->is('admin/teacher-calendar/*') ? 'active' : '' }}">
                                    <i class="nav-icon fa-fw fas fa-calendar">

                                    </i>
                                    {{ trans('cruds.teacherAvailbility.calendar') }}
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('find_teacher')
                <li class="nav-item">
                    <a href="{{ url("student/find-teacher") }}" class="nav-link {{ request()->is('student/find-teacher') || request()->is('student/find-teacher/*') ? 'active' : '' }}">
                        <i class="fa fa-search nav-icon">

                        </i>
                        {{ trans('cruds.teacher.find_teacher') }}
                    </a>
                </li>
            @endcan
            @can('teacher_reports_access')
                <li class="nav-item">
                    <a href="{{ route("admin.teachers.report.view") }}" class="nav-link {{ request()->is('admin/teachers/report/') || request()->is('admin/teachers/report/*') ? 'active' : '' }}">
                        <i class="fas fa-file nav-icon">

                        </i>
                        {{ trans('cruds.teacherReport.title') }}
                    </a>
                </li>
            @endcan

            @can('client_access')
                <li class="nav-item">
                    <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'active' : '' }}">
                        <i class="fas fa-solid fa-user-graduate nav-icon">

                        </i>
                        {{ trans('cruds.client.title') }}
                    </a>
                </li>
            @endcan
            @can('appointment_access')
                <li class="nav-item">
                    <a href="{{ route("admin.appointments.index") }}" class="nav-link {{ request()->is('admin/appointments') || request()->is('admin/appointments/*') ? 'active' : '' }}">
                        <i class="fas fa-bell nav-icon">

                        </i>
                        {{ trans('cruds.appointment.title') }}
                    </a>
                </li>
            @endcan
            @can('student_appointment_access')
                <li class="nav-item">
                    <a href="{{ route("student.appointments.index") }}" class="nav-link {{ request()->is('admin/appointments') || request()->is('admin/appointments/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon"></i>
                        {{ trans('cruds.appointment.title') }}
                    </a>
                </li>
            @endcan
            @can('system_calendar')
            <li class="nav-item">
                <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">

                    </i>
                    {{ trans('global.systemCalendar') }}
                </a>
            </li>
            @endcan
            @can('student_calendar')
            <li class="nav-item">
              @if (isset(Auth::user()->id))
                <a href="{{ url("student/student-calendar/".Auth::user()->id ) }}" class="nav-link {{ request()->is('student/student-calendar') || request()->is('student/student-calendar/*') ? 'active' : '' }}">
                    <i class="nav-icon fa-fw fas fa-calendar">

                    </i>
                    {{ trans('global.systemCalendar') }}
                </a>
              @endif
            </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
