<div class="page-sidebar nav-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->        	
    <ul>
        <li>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler hidden-phone"></div>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>
        <li class="start {{ Request::is('admin') ? 'active' : '' }} ">
            <a href="{{route('adminIndex')}}">
                <i class="icon-home"></i> 
                <span class="title">Удирдлагын хэсэг</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="{{ Request::is('admin/news*') ? 'active' : '' }}">
            <a href="javascript:;">
                <i class="icon-pencil"></i> 
                <span class="title">Мэдээ, мэдээлэл</span>
                <span class="arrow  closed"></span>
            </a>
            <ul class="sub-menu">
                <li class="{{ Request::is('admin/news/*') || Request::is('admin/news') ? 'active' : '' }}">
                    <a href="{{route('admin.news.index')}}">
                        <i class="icon-book"></i>
                        Мэдээ
                    </a>
                </li>
                <li class="{{ Request::is('admin/newsCategory*') ? 'active' : '' }}">
                    <a href="{{ route('admin.newsCategory.index') }}">
                        <i class="icon-pushpin"></i>
                        Мэдээний ангилал
                    </a>
                </li>
            </ul>
        </li>
        <li class="start {{ Request::is('admin/page*') ? 'active' : '' }} ">
            <a href="{{route('admin.page.index')}}">
                <i class="icon-book"></i> 
                <span class="title">Хуудас</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="{{ Request::is('admin/teacher*') ? 'active' : '' }}">
            <a href="javascript:;">
                <i class="icon-user"></i> 
                <span class="title">Хэрэглэгчийн удирдлага</span>
                <span class="arrow  closed"></span>
            </a>
            <ul class="sub-menu">
                <li class="{{ Request::is('admin/teacher*') ? 'active' : '' }}">
                    <a href="{{route('admin.teacher.index')}}">
                        <i class="icon-user"></i>
                        Багш
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>