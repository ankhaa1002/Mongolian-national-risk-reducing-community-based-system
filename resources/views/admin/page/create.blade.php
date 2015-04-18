@extends('admin.layouts.base')

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
                <form id="addPageForm" action="{{ route('admin.page.store') }}" method="POST" class="horizontal-form" enctype="multipart/form-data">
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
                                    <input type="text" name="title" id="title" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Хуудасны төрөл</label>
                                <div class="controls">
                                    <select id="pageTypes" name="pageTypes[]" class="m-wrap span12 required">
                                        @foreach($pageTypes as $type)
                                        <option value="{{$type['id']}}">{{$type['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row-fluid">
                        <div class="span5">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Огноо</label>
                                <div class="controls">
                                    <input type="text" name="created_date" id="created_date" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="span1 ">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Идэвхтэй эсэх</label>
                                <div class="controls">
                                    <input type="checkbox" name="is_active" id="is_active" class="m-wrap span12" checked="checked">
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
        filebrowserUploadUrl: "{{route('imageUpload')}}?_token=" + token
    });
    $("#pageTypes").select2();
    $('#created_date').datepicker({
        format: 'yyyy-mm-dd'
    });

    var form = $('#addPageForm');
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
            pageTypes: {
                required: true
            },
            created_date: {
                required: true,
                date: true
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
            pageTypes: {
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

    $('#addPageForm').submit(function () {
        if (!form.valid()) {
            e.preventDefault();
        } else {
            $('#addPageForm')[0].submit();
        }
    });
    
    function backToList(){
        window.location.replace("{{route('admin.page.index')}}");
    }

</script>
@stop

@stop