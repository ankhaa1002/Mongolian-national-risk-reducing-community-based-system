@extends('admin.layouts.base')

@section('content')

<div class="row-fluid">
    <div class="span12">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert"></button>
            <strong>Амжилттай!</strong>
            {{ Session::get('success') }}
        </div>
        @elseif(Session::has('failed'))
        <div class="alert alert-error">
            <button class="close" data-dismiss="alert"></button>
            <strong>Амжилтгүй!</strong>
            {{ Session::get('failed') }}
        </div>
        @endif
        <div class="portlet box blue">
            <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Хайлт</h4>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>

            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="searchPageForm" action="#" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label for="lastname" class="control-label">Овог</label>
                                <div class="controls">
                                    <input id="lastname" name="name" type="text" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label for="firstname" class="control-label">Нэр</label>
                                <div class="controls">
                                    <input id="firstname" name="name" type="text" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row-fluid'>
                        <div class="span6">
                            <div class="control-group">
                                <label for="aimag" class="control-label">Аймаг</label>
                                <div class="controls">
                                    <select id="aimag" class="m-wrap span12">
                                        <option></option>
                                        @foreach($aimags as $aimag)
                                        <option value="{{$aimag['id']}}">{{$aimag['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label for="district" class="control-label">Дүүрэг</label>
                                <div class="controls">
                                    <select id="district" class="m-wrap span12">
                                        <option></option>
                                        @foreach($districts as $district)
                                        <option value="{{$district['id']}}">{{$district['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" onclick="searchTeacher()" class="btn green">Хайх</button>
                                    <button type="button" onclick="clearInput()" class="btn blue">Цэвэрлэх</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->  
            </div>
        </div>
    </div>
    <div class="form-group col-sm-12" style="margin-bottom: 25px;">
        <div class="btn-group">
            <button onclick="addTeacher()" class="btn green">
                Нэмэх <i class="icon-plus"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="editTeacher()" class="btn blue">
                Засах <i class="icon-pencil"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="deleteTeacher()" class="btn red">
                Устгах <i class="icon-minus"></i>
            </button>
        </div>
    </div>

    <table class="table table-hover" id="teacherList">
    </table>
</div>

@section('js')
<script type="text/javascript">
    $(function () {
        $("#aimag").select2({
            placeholder: "Аймаг сонгох"
        });

        $("#district").select2({
            placeholder: "Дүүрэг сонгох"
        });
        $('#teacherList').datagrid({
            url: 'teacherList',
            queryParams: {
                _token: _token
            },
            pagination: true,
            pageSize: 20,
            height: '100%',
            rownumbers: true,
            fitColumns: true,
            singleSelect: false,
            columns: [[
                    {field: 'ck', checkbox: true},
                    {field: 'portrait_image', title: '', width: 10, formatter: function (value, row, index) {
                            if (value) {
                                return '<img width="90" height="90" src="../' + value + '" />';
                            } else {
                                return '<img width="110" height="90" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" />';
                            }
                        }
                    },
                    {field: 'lastname', title: 'Овог', width: 20},
                    {field: 'firstname', title: 'Нэр', width: 20},
                    {field: 'birthdate', title: 'Төрсөн огноо', width: 20},
                    {field: 'profession', title: 'Мэргэжил', width: 20},
                    {field: 'position', title: 'Албан тушаал', width: 20},
                    {field: 'aimag_name', title: 'Аймаг', width: 20},
                    {field: 'district_name', title: 'Дүүрэг', width: 20, formatter: function (value, row, index) {
                            if (value) {
                                return value;
                            } else {
                                return '<i class="icon-remove"></i>';
                            }
                        }
                    },
                    {field: 'email', title: 'Цахим хаяг', width: 20}

                ]]
        });
        
        $('#teacherList').datagrid('reload');
    });

    function searchTeacher() {
        $('#teacherList').datagrid('load', {
            _token: _token,
            lastname: $('#lastname').val(),
            firstname: $('#firstname').val(),
            aimag_id: $("#aimag option:selected").val(),
            district_id: $('#district option:selected').val()
        });
    }

    function addTeacher() {
        window.location.replace("{{ route('admin.teacher.create') }}");
    }

    function editTeacher() {
        var rows = $('#teacherList').datagrid('getSelections');
        if (rows.length > 1) {
            alert('Олон мэдээг зэрэг засах боломжгүй!');
        } else if (rows.length === 0) {
            alert('Засах мэдээгээ сонгоно уу!');
        } else {
            window.location.replace('page/' + rows[0].id + '/edit');
        }
    }

    function deleteTeacher() {

        var dialogName = '#removeDialog';
        if (!$(dialogName).length) {
            $('<div id="' + dialogName.replace('#', '') + '"></div>').appendTo('body');
        }

        var ids = [];
        var rows = $('#teacherList').datagrid('getSelections');

        if (rows.length === 0) {
            alert('Та устгах мэдээгээ сонгоно уу!');
            return;
        } else {
            $.each(rows, function (index, value) {
                ids.push(value['id']);
            });

            $(dialogName).html('Та устгахдаа итгэлтэй байна уу?').dialog({
                cache: false,
                resizable: true,
                bgiframe: true,
                autoOpen: false,
                width: 'auto',
                height: 'auto',
                modal: true,
                buttons: [
                    {text: 'Тийм', class: 'btn', handler: function () {
                            $.ajax({
                                url: "{{ route('admin.page.destroy') }}",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    _token: _token,
                                    _method: 'delete',
                                    ids: ids
                                },
                                success: function (data) {
                                    if (data) {
                                        $('#teacherList').datagrid('reload');
                                        $(dialogName).dialog('close');
                                        new PNotify({
                                            title: 'Амжилттай!', text: 'Амжилттай устгалаа!',
                                            type: 'success', sticker: false
                                        });
                                    }
                                },
                                error: function (e) {
                                    console.log(e);
                                }
                            });
                        }},
                    {text: 'Үгүй', class: 'btn', handler: function () {
                            $(dialogName).dialog('close');
                        }}]
            }).dialog('open');
        }
    }

    function clearInput() {
        document.getElementById("searchPageForm").reset();
        $("#aimag").select2("val", "");
        $("#district").select2("val", "");
    }
</script>
@stop

@stop