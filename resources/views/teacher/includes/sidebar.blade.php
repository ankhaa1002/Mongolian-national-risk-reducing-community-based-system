<div class="page-sidebar nav-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->        	
    <ul>
        <li>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler hidden-phone"></div>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>
        <li class="start {{ Request::is('adminTeacher') ? 'active' : '' }} ">
            <a href="{{route('adminTeacher')}}">
                <i class="icon-home"></i> 
                <span class="title">Удирдлагын хэсэг</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="{{ Request::is('adminTeacher/lesson*') ? 'active' : '' }}">
            <a href="#">
                <i class="icon-edit"></i> 
                <span class="title">Хичээл</span>
                <span class="arrow  open"></span>
            </a>
            <ul class="sub-menu" style="display: block">
                <li class="{{ Request::is('adminTeacher/lesson/create*') ? 'active' : '' }}">
                    <a href="{{route('adminTeacher.lesson.create')}}">
                        <i class="icon-edit"></i>
                        Хичээл оруулах
                    </a>
                </li>
                <li class="{{ Request::is('adminTeacher/lesson') ? 'active' : '' }}">
                    <a href="{{route('adminTeacher.lesson.index')}}">
                        <i class="icon-edit"></i>
                        Оруулсан хичээлүүд
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>