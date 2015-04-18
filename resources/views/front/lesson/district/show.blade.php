@extends('front.layouts.base')

@section('content')
<!-- Content Start -->
<div id="contentWrapper">
    <div class="page-title title-1">
        <div class="container">
            <div class="row">
                <div class="cell-12">
                    <h1 class="fx" data-animate="fadeInUp">{{ $title }}</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="sectionWrapper">
        <div class="container">
            <div class="row">
                <div class="cell-9 masonry">
                    <div class="blog-posts">
                        @foreach($lessons as $lesson)
                        <div class="post-item fx" data-animate="fadeInLeft">

                            <article class="post-content">
                                <div class="post-info-container">
                                    @if($lesson->image)
                                    <a href="{{ route('teacher.show',$lesson->teacher_id) }}">
                                        <img class="pull-left" style="margin-right: 10px;" width="70" height="70" src="{{ asset($lesson->image) }}" />
                                    </a>
                                    @else
                                    <a href="{{ route('teacher.show',$lesson->teacher_id) }}">
                                        <img class="pull-left" style="margin-right: 10px;" src="http://www.placehold.it/70x70/EFEFEF/AAAAAA&amp;text=no+image" />
                                    </a>
                                    @endif
                                    <div class="post-info">
                                        <h2><a class="main-color" href="{{ route('lesson.show',$lesson->id) }}">{{ $lesson->name }}</a></h2>
                                        <ul class="post-meta">
                                            <li class="meta-user"><i class="fa fa-user"></i>Багш: <a href="{{ route('teacher.show',$lesson->teacher_id) }}">{{ $lesson->teacher_name }}</a></li>
                                            <li><i class="fa fa-folder-open"></i>Төрөл: <a href="{{ route('lesson.category.show',$lesson->category_id) }}">{{ $lesson->category_name }}</a></li>
                                            <li><i class="fa fa-location-arrow"></i>Суваг: <a href="{{ route('lesson.channel.show',$lesson->channel_id) }}">{{ $lesson->channel_name }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                        <div class="pager skew-25">
                            <?php echo $lessons->render() ?>
                        </div>
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