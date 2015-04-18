@extends('front.layouts.base')

@section('content')
<!-- Content Start -->
<div id="contentWrapper">
    <div class="page-title title-1">
        <div class="container">
            <div class="row">
                <div class="cell-12">
                    <h1 class="fx" data-animate="fadeInLeft">{{ $lesson->name }}</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="sectionWrapper">
        <div class="container">
            <div class="row">
                <div class="cell-9">
                    <div class="blog-posts">
                        <div class="post-item fx" data-animate="fadeInLeft">
                            <article class="post-content">
                                <div class="post-info-container">
                                    <h1 class="main-color">{{ $lesson->name }}</h1>

                                    <div class="post-info">
                                        <ul class="post-meta">
                                            <li class="meta-user"><i class="fa fa-user"></i>Багш: <a href="{{ route('teacher.show',$lesson->teacher_id) }}">{{ $lesson->teacher_name }}</a></li>
                                            <li><i class="fa fa-folder-open"></i>Төрөл: <a href="{{ route('lesson.category.show',$lesson->category_id) }}">{{ $lesson->category_name }}</a></li>
                                            <li><i class="fa fa-location-arrow"></i>Суваг: <a href="{{ route('lesson.channel.show',$lesson->channel_id) }}">{{ $lesson->channel_name }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                @if($lesson->ppt_url)
                                <p><b><h3>Slide хичээл</h3></b></p>
                                <p style="text-align: center">
                                    <iframe src="http://docs.google.com/gview?url={{ asset($lesson->ppt_url) }}&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>
                                </p>
                                @endif
                                @if($lesson->video_url)
                                <p><b><h3>Видео хичээл</h3></b></p>
                                <p style="text-align: center">
                                    <video width="600" controls>
                                        <source src="{{ asset($lesson->video_url) }}">
                                        Your browser does not support HTML5 video.
                                    </video>
                                </p>
                                @endif
                                <?php echo $lesson->lesson_content ?>
                                <p></p>
                                <div style="
                                     overflow: hidden;
                                     " class="box info-box fx animated fadeInLeft" data-animate="fadeInLeft">
                                    <h3>Нийтлэгч багшийн мэдээлэл</h3>
                                    <div class="cell-2 fx animated fadeInLeft">
                                        <p>
                                            @if($lesson->image)
                                            <img height="150" width="80" src="{{ asset($lesson->image) }}" />
                                            @else
                                            <img height="150" width="80" src="http://www.placehold.it/150x80/EFEFEF/AAAAAA&amp;text=no+image" />
                                            @endif
                                        </p>
                                    </div>
                                    <div class="cell-10 fx animated fadeInRight">
                                        <p>
                                        <ul>
                                            <li><b>Овог:</b> {{ $lesson->teacher_lastname }}</li>
                                            <li><b>Нэр:</b> {{ $lesson->teacher_name }}</li>
                                            <li><b>Цахим шуудан:</b> {{ $lesson->email }}</li>
                                            <li><b><a href="{{ route('teacher.show',$lesson->teacher_id) }}">Нийтэлсэн хичээлүүдийг харах</a></b></li>
                                        </ul>
                                        </p>
                                    </div>
                                </div>
                                <div class="share-post">
                                    <span class="sh">Хичээлийг түгээх:</span>
                                    <div id="shareme" data-text="Share this post"></div>
                                </div>
                            </article>
                        </div><!-- .post-item end -->
                    </div>
                </div>
                <aside class="cell-3 right-sidebar">
                    <ul class="sidebar_widgets">
                        @include('front.includes.lessonSidebar')
                    </ul>
                </aside>
            </div>
        </div>
    </div>

</div>
<!-- Content End -->
@stop