@extends('admin.layouts.base')

@section('content')
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Засах</h4>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                {!! Form::model($news,array('method'=>'PATCH','route'=>array('admin.news.update',$news->id),'files' => true,'id'=>'editNewsForm')) !!}
                    <div class="alert alert-error hide">
                        <button class="close" data-dismiss="alert"></button>
                        Та доор алдаануудыг засна уу
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="firstName">Гарчиг</label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" class="m-wrap span12" value="{{ $news->title }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Мэдээний ангилал</label>
                                <div class="controls">
                                    <select id="categories" name="categories[]" class="m-wrap span12" multiple="multiple">
                                        @foreach($categories as $cat)
                                        <option @if(isset($cat['selected']))selected="{{ $cat['selected'] }}"@endif value="{{$cat['id']}}">{{$cat['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Огноо</label>
                                <div class="controls">
                                    <input type="text" name="created_date" value="{{ $news->created_date }}" id="created_date" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="firstName">Нүүрний зураг</label>
                                <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
                                    <div class="fileupload-new thumbnail pull-left" style="width: 100px; height: 70px;margin-right: 10px;">
                                        @if($news->featured_image != null)
                                        <img src="{{ asset(''.$news->featured_image.'') }}" alt="">
                                        @else
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                        @endif
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file"><span class="fileupload-new" style="margin-top: 20px;">Зураг сонгох</span>
                                            <span class="fileupload-exists">Өөрчлөх</span>
                                            <input id="featured_image" name="featured_image" type="file" class="default"></span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Устгах</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Контент</label>
                                <div class="controls">
                                    <textarea name="editor1" id="editor1" rows="10" cols="80">
                                        {{ $news->content }}
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
                {!! Form::close() !!}
                <!-- END FORM--> 
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    var token = '{{csrf_token()}}';
    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{route('imageUpload')}}?_token=" + token
    });
    $("#categories").select2();
    $('#created_date').datepicker({
        format: 'yyyy-mm-dd'
    });

    var form = $('#editNewsForm');
    var error1 = $('.alert-error', form);
    var success1 = $('.alert-success', form);

    form.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            title: {
                maxlength: 1000,
                required: true
            },
            categories: {
                required: true
            },
            created_date: {
                required: true,
                date: true
            },
            featured_image: {
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            title: {
                required: "Та дээр талбарыг заавал бөглөнө үү",
                maxlength: 'Оруулах хязгаар хэтэрсэн байна'
            },
            created_date: {
                required: "Та дээр талбарыг заавал бөглөнө үү",
                date: 'Та заавал огноо оруулах ёстой'
            },
            categories: {
                required: 'Та дээр талбарыг заавал бөглөнө үү'
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
        success: function (label) {
            label
                    .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
        },
        submitHandler: function (form) {
//            success1.show();
            error1.hide();
        }
    });

    $('#editNewsForm').submit(function () {
        if (!form.valid()) {
            e.preventDefault();
        } else {
            $('#editNewsForm')[0].submit();
        }
    });

    function backToList() {
        window.location.replace("{{route('admin.news.index')}}");
    }

</script>
@stop
@stop