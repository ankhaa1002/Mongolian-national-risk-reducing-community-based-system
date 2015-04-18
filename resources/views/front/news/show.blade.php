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
                <div class="cell-9">
                    <div class="blog-posts">
                        <div class="post-item fx" data-animate="fadeInLeft">
                            <div class="details-img">
                                <div class="post-lft-info">
                                    <div class="main-bg">{{ date("d", strtotime($news->created_date)) }}<br>{{ date("m", strtotime($news->created_date)) }} сар<br>{{ date("Y", strtotime($news->created_date)) }}</div>
                                </div>
                                @if($news->featured_image)
                                <img src="{{ asset($news->featured_image) }}" alt="{{ $news->title }}">
                                @endif
                            </div>
                            <article class="post-content">
                                <div class="post-info-container">
                                    <h1 class="main-color">{{ $news->title }}</h1>

                                    <div class="post-info">
                                        <ul class="post-meta">
                                            <li class="meta-user"><i class="fa fa-user"></i>Нийтлэсэн: <a href="#">admin</a></li>
                                            <li><i class="fa fa-folder-open"></i>Мэдээний төрөл: 
                                                <?php $i = 0 ?>
                                                @foreach($news->categories as $cat)
                                                @if($i == sizeof($news->categories) - 1)
                                                <a href="../category/{{$cat->id}}">{{ $cat->name }}</a>
                                                @else
                                                <a href="../category/{{$cat->id}}">{{ $cat->name }},</a>
                                                @endif
                                                <?php $i++ ?>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php echo $news->content ?>
                                <div class="share-post">
                                    <span class="sh">Мэдээг түгээх:</span>
                                    <div id="shareme" data-text="Share this post"></div>
                                </div>
                            </article>
                        </div><!-- .post-item end -->
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