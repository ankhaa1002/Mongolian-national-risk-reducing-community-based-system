@extends('admin.layouts.base')

@section('content')
<div class="row-fluid">
    <div class="span-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Мэдээлэл</h4>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                {!! Form::model($user,array('method'=>'PATCH','route'=>array('admin.user.update',$user->id),'files' => true,'id'=>'editUserForm')) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <legend>Хувийн мэдээлэл</legend>
                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="lastName">Овог</label>
                                <div class="controls">
                                    <input type="text" id="lastName" maxlength="255" value="{{ $user->lastname }}" name="lastName" class="m-wrap span12" placeholder="Овог" required>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label" for="firstName">Нэр</label>
                                <div class="controls">
                                    <input type="text" id="firstName" maxlength="255" value="{{ $user->firstname }}" name="firstName" class="m-wrap span12" placeholder="Нэр" required>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label">Цахим хаяг</label>
                                <div class="controls">
                                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="m-wrap span12" placeholder="Имэйл" required>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->       
                </fieldset>
                <fieldset>
                    <legend>Хэрэглэгчийн тохиргоо</legend>
                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label">Хэрэглэгчийн нэр</label>
                                <div class="controls">
                                    <input placeholder="Хэрэглэгчийн нэр" value="{{ $user->user_name }}" name="username" maxlength="255" type="text" class="m-wrap span12" required>
                                </div>
                            </div>
                        </div>
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label">Идэвхтэй эсэх</label>
                                <div class="controls">
                                    <input type="checkbox" name="is_active" @if($user->is_active == 1) checked @endif class="m-wrap span12">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label">Нууц үг</label>
                                <div class="controls">
                                    <input id="password" placeholder="Нууц үг" name="password" type="password" class="m-wrap span12"> 
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label">Нууц үг /давт/</label>
                                <div class="controls">
                                    <input id="password2" placeholder="Нууц үг /давт/" name="password_again" type="password" class="m-wrap span12"> 
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="controls">
                        <span class="label label-important">Санамж!</span>
                        <span>
                            Хэрэв нууц үгийг хэвээр үлдээх бол хоосон үлдээнэ үү
                        </span>
                    </div>
                    <!--/row-->           

                </fieldset>
                <div class="form-actions">
                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Хадгалах</button>
                    <button type="button" class="btn">Буцах</button>
                </div>
                {!! Form::close() !!}
                <!-- END FORM--> 
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
    $('#createUserForm').on('submit', function () {
        $("#createUserForm").validate({
            rules: {
                password_again: {
                    equalTo: "#password"
                }
            }
        });

        if ($("#createUserForm").valid()) {
            return true;
        } else {
            return false;
        }
    });
</script>
@stop

@stop