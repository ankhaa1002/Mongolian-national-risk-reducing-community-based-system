@extends('teacher.layouts.base')

@section('content')
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Нэмэх</h4>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="addLessonForm" action="{{ route('adminTeacher.lesson.store') }}" method="POST" class="horizontal-form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="alert alert-error hide">
                        <button class="close" data-dismiss="alert"></button>
                        Та доорx алдаануудыг засна уу
                    </div>
                    <div class="row-fluid">
                        <div class="span12 ">
                            <div class="control-group">
                                <label class="control-label" for="firstName">Гарчиг<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" class="m-wrap span12" placeholder="" required="">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Хичээлийн төрөл<span class="required">*</span></label>
                                <div class="controls">
                                    <select id="categories" name="category" class="m-wrap span12" required>
                                        <option></option>
                                        @foreach($categories as $cat)
                                        <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Хичээлийн суваг<span class="required">*</span></label>
                                <div class="controls">
                                    <select id="channels" name="channel" class="m-wrap span12" required>
                                        <option></option>
                                        @foreach($channels as $channel)
                                        <option value="{{$channel['id']}}">{{$channel['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Power Point файл</label>
                                <div class="controls">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="icon-file fileupload-exists"></i> 
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-file">
                                                <span class="fileupload-new">Файл сонгох</span>
                                                <span class="fileupload-exists">Өөрчлөх</span>
                                                <input type="file" name="power_point_lesson" class="default" />
                                            </span>
                                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Устгах</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Видео хичээл</label>
                                <div class="controls">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="icon-file fileupload-exists"></i> 
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-file">
                                                <span class="fileupload-new">Файл сонгох</span>
                                                <span class="fileupload-exists">Өөрчлөх</span>
                                                <input type="file" name="video_lesson" class="default" />
                                            </span>
                                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Устгах</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Хичээлийн агуулга</label>
                                <div class="controls">
                                    <textarea name="editor1" id="editor1" rows="10" cols="80">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->        

                    <div class="form-actions">
                        <button type="submit" class="btn blue"><i class="icon-ok"></i> Хадгалах</button>
                        <button onclick="backToList()" type="button" class="btn">Буцах</button>
                    </div>
                </form>
                <!-- END FORM--> 
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    var token = '{{csrf_token()}}';
    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{route('teacherImageUpload')}}?_token=" + token
    });

    $("#categories").select2({
        placeholder: "Төрөл сонгох"
    });
    $("#channels").select2({
        placeholder: "Суваг сонгох"
    });
    $('#created_date').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#created_date').datepicker('update', new Date(2011, 2, 5));


    var form = $('#addLessonForm');
    var error1 = $('.alert-error', form);
    var success1 = $('.alert-success', form);
    form.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            title: {
              required: true  
            },
            power_point_lesson: {
                extension: "ppt|pptx"
            },
            video_lesson: {
                extension: "ogg|ogv|avi|mpeg|mov|wmv|flv|mp4"
            }
        },
        messages: {
            title:{
              required: "Та гарчигаа оруулна уу!"  
            },
            power_point_lesson: {
                extension: 'Зөвхөн power point файл байх ёстой!'
            },
            video_lesson: {
                extension: "Зөвхөн видео файл байх ёстой!"
            }
        },
        invalidHandler: function (event, validator) { //display error alert on form submit              
            success1.hide();
            error1.show();
            App.scrollTo(error1, -200);
        },
        highlight: function (element) { // hightlight error inputs
            $(element)
                    .closest('.help-inline').removeClass('ok'); // display OK icon
            $(element)
                    .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change dony by hightlight
            $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
        },
        submitHandler: function (form) {
//            success1.show();
            error1.hide();
        }
    });

    form.submit(function (e) {
        if (!form.valid()) {
            e.preventDefault();
        } else {
            $('#addLessonForm')[0].submit();
        }
    });

    function backToList() {
        window.location.replace("{{route('adminTeacher.lesson.index')}}");
    }

</script>
@stop

@stop