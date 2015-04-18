@extends('front.layouts.base')

@section('content')
<!-- Content Start -->
<div id="contentWrapper">
    <div class="page-title title-1">
        <div class="container">
            <div class="row">
                <div class="cell-12">
                    <h1 class="fx" data-animate="fadeInLeft">Мэдээ <span>мэдээлэл</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="sectionWrapper">
        <div class="container">
            <div class="row">
                <div class="cell-9 blog-thumbs">
                    <div class="blog-posts">
                        @foreach($news as $obj)
                        <div class="post-item fx" data-animate="fadeInLeft">
                            <div class="post-image">
                                <a href="{{ route('news.show',$obj->id) }}">
                                    <div class="mask"></div>
                                    <div class="post-lft-info">
                                        <div class="main-bg">{{ date("d", strtotime($obj->created_date)) }}<br>{{ date("m", strtotime($obj->created_date)) }} сар<br>{{ date("Y", strtotime($obj->created_date)) }}</div>
                                    </div>
                                    @if($obj->featured_image)
                                    <img style="height: 177px; width: 300px;" src="{{ asset($obj->featured_image) }}" alt="{{ $obj->title }}">
                                    @endif
                                </a>
                            </div>
                            <article class="post-content">
                                <div class="post-info-container">
                                    <div class="post-info">
                                        <h2><a class="main-color" href="{{ route('news.show',$obj->id) }}">{{ $obj->title }}</a></h2>
                                        <ul class="post-meta">
                                            <li class="meta-user"><i class="fa fa-user"></i>Нийтэлсэн: <a href="#">Admin</a></li>
                                            <li><i class="fa fa-folder-open"></i>Ангилал: 
                                                <?php $i = 0 ?>
                                                @foreach($obj->categories as $cat)
                                                @if($i == sizeof($obj->categories) - 1)
                                                <a href="{{route('category.show',$cat->id)}}">{{ $cat->name }}</a>
                                                @else
                                                <a href="{{route('category.show',$cat->id)}}">{{ $cat->name }},</a>
                                                @endif
                                                <?php $i++ ?>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p> {{ str_limit(strip_tags($obj->content),200) }}
                                    <a class="read-more" href="{{ route('news.show',$obj->id) }}">Дэлгэрэнгүй</a> 
                                </p>
                            </article>
                        </div>
                        @endforeach
                        <div class="pager skew-25">
                            <?php echo $news->render() ?>
                        </div>

                    </div>
                </div>
                <aside class="cell-3 right-sidebar">
                    <ul class="sidebar_widgets">
                        @include('front.includes.blogSidebar')
                    </ul>
                </aside>
            </div>
        </div>
    </div>

</div>
<!-- Content End -->
@stop