@extends('admin.layouts.base')

@section('content')
<div class="row-fluid">
    <div class="span12">
        <div class="span3">
            <ul class="ver-inline-menu tabbable margin-bottom-10">
                <li class="active"><a data-toggle="tab" href="#tab_1-1"><i class="icon-cog"></i>Хувийн мэдээлэл</a><span class="after"></span></li>
                <li class=""><a data-toggle="tab" href="#tab_2-2"><i class="icon-picture"></i> Хөрөг зураг</a></li>
                <li class=""><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i> Нэвтрэх тохиргоо</a></li>
            </ul>
        </div>
        {!! Form::model($teacher,array('method'=>'PATCH','route'=>array('admin.teacher.update',$teacher->id),'files' => true,'id'=>'editTeacherForm')) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="teacher_info_id" value="{{ $teacherInfo->id }}">
        <div class="span9" style="margin-left: 40px">

            <div class="tab-content">
                <div id="tab_1-1" class="tab-pane active">
                    <div style="height: auto;" id="accordion1-1" class="accordion collapse in">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label for="lastname" class="control-label">Овог<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="lastname" maxlength="255" value="{{ $teacherInfo->lastname }}" name="lastname" type="text" class="m-wrap span12" placeholder="Овог" required>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label for="firstname" class="control-label">Нэр<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="firstname" maxlength="255" value="{{ $teacherInfo->firstname }}" name="firstname" type="text" class="m-wrap span12" placeholder="Нэр" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label for="birthdate" class="control-label">Төрсөн огноо<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="birthdate" pattern="^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$" value="{{ $teacherInfo->birthdate }}" name="birthdate" type="text" class="m-wrap span12" placeholder="Төрсөн огноо" required>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label for="gender" class="control-label">Хүйс<span class="required">*</span></label>
                                    <div class="controls">
                                        <select id="gender" name="gender" class="m-wrap span12" required>
                                            <option></option>
                                            @foreach($genders as $gender)
                                            <option @if($gender['id'] == $teacherInfo['gender_id'])selected @endif value="{{$gender['id']}}">{{$gender['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label for="profession" class="control-label">Мэргэжил<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="profession" name="profession"portrait_image value="{{ $teacherInfo->profession }}" maxlength="255" type="text" class="m-wrap span12" placeholder="Мэргэжил" required>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label for="company_name" class="control-label">Байгууллагын нэр<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="company_name" name="company_name" value="{{ $teacherInfo->company_name }}" maxlength="255" type="text" class="m-wrap span12" placeholder="Байгууллагын нэр" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label for="position" class="control-label">Албан тушаал<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="position" name="position" value="{{ $teacherInfo->position }}"  maxlength="255" type="text" class="m-wrap span12" placeholder="Албан тушаал" required>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label for="email" class="control-label">Цахим хаяг</label>
                                    <div class="controls">
                                        <input type="email" id="email" name="email" value="{{ $teacherInfo->email }}" type="text" class="m-wrap span12" placeholder="Цахим хаяг" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label for="phone1" class="control-label">Утас 1<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="phone1" name="phone1" value="{{ $teacherInfo->phone }}" type="text" class="m-wrap span12" placeholder="Утас 1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label for="phone2" class="control-label">Утас 2</label>
                                    <div class="controls">
                                        <input id="phone2" name="phone2" value="{{ $teacherInfo->phone2 }}" type="text" class="m-wrap span12" placeholder="Утас 2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label for="aimag" class="control-label">Аймаг<span class="required">*</span></label>
                                    <div class="controls">
                                        <select onchange="aimagOnChange()" name="aimag" id="aimag" class="m-wrap span12" required>
                                            <option></option>
                                            @foreach($aimags as $aimag)
                                            <option @if($aimag['id'] == $address['aimag_id'])selected @endif value="{{$aimag['id']}}">{{$aimag['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4 district" style="display: none">
                                <div class="control-group">
                                    <label for="gender" class="control-label">Дүүрэг<span class="required">*</span></label>
                                    <div class="controls">
                                        <select id="district" class="m-wrap span12">
                                            <option></option>
                                            @foreach($districts as $district)
                                            <option @if($district['id'] == $address['district_id'])selected @endif value="{{$district['id']}}">{{$district['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="control-group">
                                    <label for="address" class="control-label">Хаяг</label>
                                    <div class="controls">
                                        <input id="address" name="address" value="{{ $address->address_detail }}" type="text" class="m-wrap span12" placeholder="Дэлгэрэнгүй хаяг">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab_2-2" class="tab-pane">
                    <div style="height: auto;" id="accordion2-2" class="accordion collapse in">
                        <p>Багшийн аватар буюу хөрөг зургийг оруулах хэсэг</p>
                        <br>
                        <div class="control-group">
                            <label class="control-label">Хуулах зургаа доор оруулна уу</label>
                            <div class="controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 291px; height: 170px;">
                                        @if($teacherInfo->portrait_image)
                                        <img width="291" height="170" src="{{ asset(''.$teacherInfo->portrait_image.'') }}" alt="" />
                                        @else
                                        <img src="http://www.placehold.it/291x170/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                        @endif
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-file"><span class="fileupload-new">Зураг сонгох</span>
                                            <span class="fileupload-exists">Солих</span>
                                            <input type="file" name="portrait_image" class="default"/></span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Устгах</a>
                                    </div>
                                </div>
                                <span class="label label-important">Санамж!</span>
                                <span>
                                    Зөвхөн jpeg,jpg,png,gif өргөтгөлтэй зураг оруулахыг анхаарна уу!
                                </span>
                            </div>
                        </div>
                        <div class="space10"></div>
                    </div>
                </div>
                <div id="tab_3-3" class="tab-pane">
                    <div style="height: auto;" id="accordion3-3" class="accordion collapse in">
                        <label for="username" class="control-label">Нэвтрэх нэр<span class="required">*</span></label>
                        <input id="username" value="{{ $teacher->username }}" name="username" placeholder="Нэвтрэх нэр" type="text" class="m-wrap span8" required>
                        <div class="controls">
                            <span class="label label-important">Санамж!</span>
                            <span>
                                Хэрэв нууц үгийг хэвээр үлдээх бол хоосон үлдээнэ үү
                            </span>
                        </div>
                        <label for="password" class="control-label">Нууц үг<span class="required">*</span></label>
                        <input id="password" name="password" placeholder="Нууц үг" type="password" class="m-wrap span8">
                        <label for="password2" class="control-label">Нууц үг /давт/<span class="required">*</span></label>
                        <input id="password2" type="password" placeholder="Нууц үг /давт/" name="password_again" class="m-wrap span8">
                    </div>
                </div>

            </div>
            <div class="submit-btn">
                <button type="submit" class="btn green">Хадгалах</button>
                <a href="{{ route('admin.teacher.index') }}" class="btn">Буцах</a>
            </div>

        </div>
        {!! Form::close() !!}
        <!--end span9-->                                   
    </div>
</div>

@section('js')
<script type="text/javascript">
    $(function () {
        var val = $('#aimag').val();
        if (val === "22") {
            $(".district").css("display", "block");
            $('#district').attr('name', 'district');
        } else {
            $(".district").css("display", "none");
            $('#district').removeAttr('name');
        }
    });
    $("#district").select2({
        placeholder: "Дүүрэг сонгох"
    });

    $("#gender").select2({
        placeholder: "Хүйс сонгох"
    });

    $("#aimag").select2({
        placeholder: "Аймаг сонгох"
    });

    $('#birthdate').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#editTeacherForm').on('submit', function () {

        $("#editTeacherForm").validate({
            rules: {
                password_again: {
                    equalTo: "#password"
                }
            }
        });

        if ($("#editTeacherForm").valid()) {
            return true;
        } else {
            return false;
        }

    });

    function aimagOnChange() {
        var val = $('#aimag').val();
        if (val === "22") {
            $(".district").css("display", "block");
            $('#district').attr('name', 'district');
        } else {
            $(".district").css("display", "none");
            $('#district').removeAttr('name');
        }
    }
</script>
@stop
@stop