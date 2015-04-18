@extends('front.layouts.base')

@section('content')
<div id="contentWrapper">
    <div class="padd-vertical-30">
        <div class="container">
            <div class="row">
                <div class="cell-9 blog-thumbs">
                    <h3 class="block-head-News"> <span class="icon fa fa-angle-right"></span> Мэдээ, мэдээлэл <a href="news">Бүгдийг үзэх <span class="fa fa-plus"></span></a> </h3>
                    <div class="blog-posts">
                        <?php $i = 0; ?>
                        @foreach($news as $obj)
                        @if($i == 0)
                        <div class="post-item fx animated fadeInLeft" data-animate="fadeInLeft">
                            <div class="post-image">
                                <a href="news/{{ $obj->id }}">
                                    <div class="mask"></div>
                                    <div class="post-lft-info">
                                        <div class="main-bg">{{ date("d", strtotime($obj->created_date)) }}<br>{{ date("m", strtotime($obj->created_date)) }} сар<br>{{ date("Y", strtotime($obj->created_date)) }}</div>
                                    </div>
                                    @if($obj->featured_image)
                                    <img style="width: 393px !important; height: 178px !important;" src="{{ $obj->featured_image }}" alt="{{ $obj->title }}"> 
                                    @endif
                                </a>
                            </div>
                            <article class="post-content">
                                <div class="post-info-container">
                                    <div class="post-info">
                                        <h2>
                                            <a class="main-color" href="news/{{ $obj->id }}">{{ $obj->title }}</a>
                                        </h2>
                                        <ul class="post-meta">
                                            <li class="meta-user"><i class="fa fa-user"></i>Нийтэлсэн: <a href="#">Admin</a></li>
                                            <li><i class="fa fa-folder-open"></i>Ангилал: 
                                                <?php $i = 0 ?>
                                                @foreach($obj->categories as $cat)
                                                @if($i == sizeof($obj->categories) - 1)
                                                <a href="category/{{$cat->id}}">{{ $cat->name }}</a>
                                                @else
                                                <a href="category/{{$cat->id}}">{{ $cat->name }},</a>
                                                @endif
                                                <?php $i++ ?>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p> {{ str_limit(strip_tags($obj->content),200) }}
                                    <a class="read-more" href="news/{{ $obj->id }}">Дэлгэрэнгүй</a> 
                                </p>
                            </article>
                        </div>
                        @endif
                        <?php $i++; ?>
                        @endforeach
                        <div class="small_news">
                            <div class="small_items">
                                <div class="row">
                                    <?php $i = 0; ?>
                                    @foreach($news as $obj)
                                    @if($i != 0)
                                    <div class="cell-6">
                                        <div class="post-item fx animated fadeInLeft" data-animate="fadeInLeft">
                                            <div class="cell-3">
                                                <div class="row"> 
                                                    @if($obj->featured_image)
                                                    <a href="news/{{ $obj->id }}"> 
                                                        <img style="width: 98px !important; height: 58px !important;" src="{{ $obj->featured_image }}" alt="{{ $obj->title }}"> 
                                                    </a> 
                                                    @endif
                                                </div>
                                            </div>
                                            <article class="cell-9">
                                                <h2>
                                                    <a class="main-color" href="news/{{ $obj->id }}">{{ $obj->title }}</a>
                                                </h2>
                                                <ul class="post-meta">
                                                    <li class="meta-user"><i class="fa fa-user"></i>Нийтэлсэн: <a href="#">Admin</a></li>
                                                    <li><i class="fa fa-folder-open"></i>Ангилал: 
                                                        <?php $i = 0 ?>
                                                        @foreach($obj->categories as $cat)
                                                        @if($i == sizeof($obj->categories) - 1)
                                                        <a href="category/{{$cat->id}}">{{ $cat->name }}</a>
                                                        @else
                                                        <a href="category/{{$cat->id}}">{{ $cat->name }},</a>
                                                        @endif
                                                        <?php $i++ ?>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </article>
                                        </div>
                                    </div>
                                    @endif
                                    <?php $i++; ?>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <h3 class="block-head-News"> <span class="icon fa fa-angle-right"></span> Хичээлүүд <a href="lesson">Бүгдийг үзэх <span class="fa fa-plus"></span></a> </h3>
                    <div class="news-masnory">
                        @foreach($lessons as $lesson)
                        <div class="cell-4 post fx animated fadeInLeft" data-animate="fadeInLeft">
                            <article class="post-content">
                                <div class="post-info-container">
                                    <div class="post-info">
                                        <h2 style="margin-bottom: 15px;"><a class="main-color" href="lesson/{{ $lesson->id }}">{{ $lesson->name }}</a></h2>
                                        <ul class="post-meta">
                                            <li class="meta-user"><i class="fa fa-user"></i>Багш: <a href="{{ route('teacher.show',$lesson->teacher_id) }}">{{ $lesson->teacher_name }}</a></li>
                                            <li><i class="fa fa-folder-open"></i>Төрөл: <a href="{{ route('lesson.category.show',$lesson->category_id ) }}">{{ $lesson->category_name }}</a></li>
                                            <li><i class="fa fa-location-arrow"></i>Суваг: <a href="{{ route('lesson.channel.show',$lesson->channel_id) }}">{{ $lesson->channel_name }}</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </article>
                        </div>
                        @endforeach
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
<div style="margin-bottom: 25px;" class="clearfix"></div>
<div class="sectionWrapper gry-bg">
    <div class="container">
        <h3 class="block-head">Хамтрагч байгууллагууд</h3>
        <div class="clients slick-initialized slick-slider">
            <div class="slick-list draggable" tabindex="0"><div class="slick-track" style="opacity: 1; width: 4446px; -webkit-transform: translate3d(-1170px, 0px, 0px);"><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-5.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-6.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-7.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-8.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-9.png"></a>
                    </div><div class="slick-slide slick-active" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-1.png"></a>
                    </div><div class="slick-slide slick-active" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-2.png"></a>
                    </div><div class="slick-slide slick-active" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-3.png"></a>
                    </div><div class="slick-slide slick-active" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-4.png"></a>
                    </div><div class="slick-slide slick-active" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-5.png"></a>
                    </div><div class="slick-slide" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-6.png"></a>
                    </div><div class="slick-slide" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-7.png"></a>
                    </div><div class="slick-slide" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-8.png"></a>
                    </div><div class="slick-slide" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-9.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-1.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-2.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-3.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-4.png"></a>
                    </div><div class="slick-slide slick-cloned" style="width: 234px;">
                        <a class="white-bg" href="#"><img alt="" src="static/images/clients/client-5.png"></a>
                    </div>
                </div>
            </div>

            <button type="button" class="slick-prev" style="display: block;">Previous</button><button type="button" class="slick-next" style="display: block;">Next</button></div>
    </div>
</div>
<div class="sectionWrapper block-bg-1 black-overlay">
    <div class="container">
        <div class="row">
            <div class="cell-3 center">
                <a class="btn main-bg ExtraLargeBtn">Хүүхэд хамгаалал</a>
            </div>
        </div>
    </div>
</div>
@stop