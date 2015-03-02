<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
<h3 class="page-title">
    @if(isset($title))
    {{ $title }}
    @endif				
</h3>
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Удирдлага</a> 
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">
            @if(isset($title))
            {{ $title }}
            @endif</a></li>
    <li class="pull-right no-text-shadow">
        <div class="tooltips no-tooltip-on-touch-device responsive">
            <i class="icon-calendar"></i>
            <span>{{date("Y-m-d H:i:s")}}</span>
        </div>
    </li>
</ul>
<!-- END PAGE TITLE & BREADCRUMB-->