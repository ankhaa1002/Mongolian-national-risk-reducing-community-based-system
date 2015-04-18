@extends('teacher.layouts.base')

@section('content')
<div id="dashboard">
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row-fluid">
        <div class="span6 responsive" data-tablet="span6" data-desktop="span6">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="icon-pencil"></i>
                </div>
                <div class="details">
                    <div class="number">
                        {{ $lessonCount }}
                    </div>
                    <div class="desc">									
                        Нийт оруулсан хичээлийн тоо
                    </div>
                </div>
                <a class="more" href="{{ route('adminTeacher.lesson.index') }}">
                    Дэлгэрэнгүй <i class="m-icon-swapright m-icon-white"></i>
                </a>						
            </div>
        </div>

        <div class="span6 responsive" data-tablet="span6" data-desktop="span6">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="icon-globe"></i>
                </div>
                <div class="details">
                    <div class="number pull-left">
                        @if($district)
                        {{ $aimag }} хот {{ $district }} дүүрэг
                        @else
                        {{ $aimag }} аймаг
                        @endif
                    </div>
                </div>				
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
                                                            <b>{{ Session::get('teacher')->username }}</b> {{ $lessonLog->lesson_name }}-г {{ $lessonLog->action }}
                                                            <a href="adminTeacher/lesson/{{$lessonLog->lesson_id}}/edit" class="label label-important label-mini">
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
        jQuery(document).ready(function () {
            // initiate layout and plugins
            App.init();

            $.getJSON('adminTeacher/categoryStat', function (data) {
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
            
            $.getJSON('adminTeacher/channelStat', function (data) {
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

    });
</script>

@stop

@stop