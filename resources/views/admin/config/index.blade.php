@extends('admin.layouts.base')

@section('content')
<div class="row-fluid">
    <div class="span-12">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert"></button>
            <strong>Амжилттай!</strong>
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="portlet box blue">
            <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Тохиргооны хэсэг</h4>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="createConfigForm" action="{{ route('admin.config.store') }}" method="POST" class="horizontal-form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <legend>Цахим хуудасны тохиргоо</legend>
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="siteTitle">Сайтын нэр</label>
                                    <div class="controls">
                                        <input type="text" id="siteTitle" value="{{ $config->site_title }}" maxlength="255" name="siteTitle" class="m-wrap span12" placeholder="Сайтын нэр" required>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label" for="siteDescription">Сайтын тайлбар</label>
                                    <div class="controls">
                                        <input type="text" id="siteDescription" value="{{ $config->site_description }}" maxlength="255" name="siteDescription" class="m-wrap span12" placeholder="Сайтын тайлбар" required>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->       
                    </fieldset>
                    <fieldset>
                        <legend>Харилцаа холбоо</legend>
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Дэлгэрэнгүй хаяг</label>
                                    <div class="controls">
                                        <input placeholder="Хаяг" value="{{ $config->address }}" name="address" maxlength="255" type="text" class="m-wrap span12" required>
                                    </div>
                                </div>
                            </div>
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Цахим хуудас</label>
                                    <div class="controls">
                                        <input placeholder="Цахим хуудас" value="{{ $config->website }}" name="website" maxlength="255" type="text" class="m-wrap span12" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Утас</label>
                                    <div class="controls">
                                        <input id="phone" placeholder="Утас" value="{{ $config->phone }}" name="phone" type="text" class="m-wrap span12" required> 
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Facebook хаяг</label>
                                    <div class="controls">
                                        <input id="facebookUrl" placeholder="Facebook хаяг" value="{{ $config->facebook }}" name="facebookLink" type="text" class="m-wrap span12" required> 
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Twitter хаяг</label>
                                    <div class="controls">
                                        <input id="twitterLink" placeholder="Twitter хаяг" value="{{ $config->twitter }}" name="twitterLink" type="text" class="m-wrap span12" required> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->           
                    </fieldset>
                    <fieldset>
                        <legend>Мэдээ, хичээл</legend>
                        <div class="row-fluid">
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Хуудсанд гарах мэдээллийн тоо</label>
                                    <div class="controls">
                                        <input id="blogPerPage" value="{{ $config->blog_per_page }}" placeholder="Хуудсанд гарах мэдээллийн тоо" name="blogPerPage" type="text" class="m-wrap span12" required> 
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="span6 ">
                                <div class="control-group">
                                    <label class="control-label">Хуудсанд гарах хичээлийн тоо</label>
                                    <div class="controls">
                                        <input id="lessonPerPage" value="{{ $config->lesson_per_page }}" placeholder="Хуудсанд гарах хичээлийн тоо" name="lessonPerPage" type="text" class="m-wrap span12" required> 
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <button type="submit" class="btn blue"><i class="icon-ok"></i> Хадгалах</button>
                        <button type="button" class="btn">Буцах</button>
                    </div>
                </form>
                <!-- END FORM--> 
            </div>
        </div>
    </div>
</div>

@stop