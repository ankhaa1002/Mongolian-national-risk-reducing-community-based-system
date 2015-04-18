@extends('admin.layouts.base')

@section('content')
<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row-fluid">
        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="icon-edit"></i>
                </div>
                <div class="details">
                    <div class="number">
                        {{ $newsCount }}
                    </div>
                    <div class="desc">									
                        Нийтлэгдсэн мэдээ
                    </div>
                </div>
                <a class="more" href="{{ route('admin.news.index') }}">
                    Дэлгэрэнгүй <i class="m-icon-swapright m-icon-white"></i>
                </a>						
            </div>
        </div>
        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="icon-book"></i>
                </div>
                <div class="details">
                    <div class="number">{{ $pagesCount }}</div>
                    <div class="desc">Хуудас</div>
                </div>
                <a class="more" href="{{ route('admin.page.index') }}">
                    Дэлгэрэнгүй <i class="m-icon-swapright m-icon-white"></i>
                </a>						
            </div>
        </div>
        <div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
            <div class="dashboard-stat purple">
                <div class="visual">
                    <i class="icon-tasks"></i>
                </div>
                <div class="details">
                    <div class="number">{{ $lessonsCount }}</div>
                    <div class="desc">Нийтлэгдсэн хичээлүүд</div>
                </div>
                <a class="more" href="{{ route('admin.lesson.index') }}">
                    Дэлгэрэнгүй <i class="m-icon-swapright m-icon-white"></i>
                </a>						
            </div>
        </div>
        <div class="span3 responsive" data-tablet="span6" data-desktop="span3">
            <div class="dashboard-stat yellow">
                <div class="visual">
                    <i class="icon-group"></i>
                </div>
                <div class="details">
                    <div class="number">{{ $teachersCount }}</div>
                    <div class="desc">Нийт багш</div>
                </div>
                <a class="more" href="{{ route('admin.teacher.index') }}">
                    Дэлгэрэнгүй <i class="m-icon-swapright m-icon-white"></i>
                </a>						
            </div>
        </div>
    </div>
    <!-- END DASHBOARD STATS -->
    <div class="clearfix"></div>
    <div class="row-fluid">
        <div class="span3">
            <!-- BEGIN REGIONAL STATS PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <h4><i class="icon-globe"></i>Хичээлийн төрлийн статистик</h4>
                </div>
                <div class="portlet-body">
                    <div id="graph_1" class="chart"></div>
                </div>
            </div>
            <!-- END REGIONAL STATS PORTLET-->
        </div>
        <div class="span3">
            <!-- BEGIN REGIONAL STATS PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <h4><i class="icon-globe"></i>Хичээлийн сувгийн статистик</h4>
                </div>
                <div class="portlet-body">
                    <div id="graph_2" class="chart"></div>
                </div>
            </div>
            <!-- END REGIONAL STATS PORTLET-->
        </div>
        <div class="span6">
            <!-- BEGIN PORTLET-->
            <div class="portlet paddingless">
                <div class="portlet-title line">
                    <h4><i class="icon-bell"></i>Хичээлийн оруулсан түүх</h4>
                </div>
                <div class="portlet-body">
                    <!--BEGIN TABS-->
                    <div class="tabbable tabbable-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1_1" data-toggle="tab">Түүхүүд</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1_1">
                                <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible="0">
                                    <ul class="feeds">
                                        @foreach($lessonLogs as $lessonLog)
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        @if($lessonLog->action == 'үүсгэсэн')
                                                        <div class="label label-success">	
                                                            <i class="icon-plus"></i>
                                                        </div>
                                                        @else
                                                        <div class="label label-info">	
                                                            <i class="icon-pencil"></i>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            <b>{{ $lessonLog->firstname }}</b> {{ $lessonLog->lesson_name }}-г {{ $lessonLog->action }}
                                                            <a href="admin/lesson/{{$lessonLog->lesson_id}}/edit" class="label label-important label-mini">
                                                                Харах
                                                                <i class="icon-share-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    {{ date("Y.m.d", strtotime($lessonLog->created_date)) }}
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END TABS-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
</div>

@section('js')
<script>
    jQuery(document).ready(function () {
        Index.initCharts(); // init index page's custom scripts
        $.getJSON('admin/lessonByCategory', function (data) {
            $.plot($("#graph_1"), data, {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
        });

        $.getJSON('admin/lessonByChannel', function (data) {
            $.plot($("#graph_2"), data, {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
        });
    });
</script>

@stop

@stop