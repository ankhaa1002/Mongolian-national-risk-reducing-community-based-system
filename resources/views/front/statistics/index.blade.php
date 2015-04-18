@extends('front.layouts.base')

@section('content')
<div id="contentWrapper" style="min-height: 102px;">
    <div class="page-title title-1">
        <div class="container">
            <div class="row">
                <div class="cell-12">
                    <h1 class="fx animated fadeInLeft" data-animate="fadeInLeft">{{ $title }}</span></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="sectionWrapper">
        <div class="container">
            <div class="cell-12">
                <h3 class="block-head">Хичээлийн үзүүлэлт</h3>
            </div>
        </div>
    </div>

</div>
@stop