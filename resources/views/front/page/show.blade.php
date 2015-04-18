@extends('front.layouts.base')

@section('content')
<!-- Content Start -->
<div id="contentWrapper">
    <div class="page-title title-1">
        <div class="container">
            <div class="row">
                <div class="cell-12">
                    <h1 data-animate="fadeInUp" class="fx" data-animate="fadeInLeft">{{ $page->name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="sectionWrapper">
        <div class="container">
            <div class="row">
                <div class="cell-9">
                    <?php echo $page->content ?>
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