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
                <li class="{{ Request::is('admin/news*') ? 'active' : '' }}">
                    <a href="{{route('admin.news.index')}}">
                        <i class="icon-book"></i>
                        Мэдээ
                    </a>
                </li>
                <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
                    <a href="admin/news-category">
                        <i class="icon-pushpin"></i>
                        Мэдээний төрөл	
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>