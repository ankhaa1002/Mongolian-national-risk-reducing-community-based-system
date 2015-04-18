@extends('teacher.layouts.base')

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
                <form id="searchLessonForm" action="#" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label for="title" class="control-label">Хичээлийн нэр</label>
                                <div class="controls">
                                    <input id="title" name="title" type="text" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="span6 ">
                            <div class="control-group">
                                <label class="control-label">Хичээлийн төрөл</label>
                                <div class="controls">
                                    <select id="lessonCategory" name="lessonCategory" class="m-wrap span12">
                                        <option></option>
                                        @foreach($categories as $cat)
                                        <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6 ">
                            <div class="control-group">
                                <label for="date" class="control-label">Хичээлийн суваг</label>
                                <div class="controls">
                                    <select id="lessonChannel" name="lessonChannel" class="m-wrap span12">
                                        <option></option>
                                        @foreach($channels as $channel)
                                        <option value="{{$channel['id']}}">{{$channel['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="span6 ">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" onclick="searchLesson()" class="btn green">Хайх</button>
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
            <button onclick="addLesson()" class="btn green">
                Нэмэх <i class="icon-plus"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="editLesson()" class="btn blue">
                Засах <i class="icon-pencil"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="deleteLesson()" class="btn red">
                Устгах <i class="icon-minus"></i>
            </button>
        </div>
    </div>

    <table class="table table-hover" id="lessonList">
    </table>
</div>
@section('js')
<script type="text/javascript">
    $('#lessonCategory').select2({
        placeholder: "Төрөл сонгох"
    });

    $('#lessonChannel').select2({
        placeholder: "Суваг сонгох"
    });

    $('#lessonList').datagrid({
        url: 'lessonlist',
        queryParams: {
            _token: _token,
            title: $('#title').val(),
            category: $('#lessonCategory').val(),
            channel: $('#lessonChannel').val()
        },
        pagination: true,
        pageSize: 20,
        rownumbers: true,
        fitColumns: true,
        singleSelect: false,
        columns: [[
                {field: 'ck', checkbox: true},
                {field: 'lesson_name', title: 'Хичээлийн нэр', width: 20,
                    formatter: function (val, row, idx) {
                        return '<b><a href="lesson/' + row.id + '/edit">' + val + '</a></b>';
                    }
                },
                {field: 'categoryname', title: 'Хичээлийн төрөл', width: 20},
                {field: 'channelname', title: 'Хичээлийн суваг', width: 20},
                {field: 'created_date', title: 'Нийтлэгдсэн огноо', width: 20},
                {field: 'updated_date', title: 'Шинэчлэгдсэн огноо', width: 20, formatter: function (value, row, index) {
                        if (value === null) {
                            return "Одоогоор шинэчлэгдээгүй байна";
                        } else {
                            return value;
                        }
                    }
                }
            ]]
    });

    function searchLesson() {
        $('#lessonList').datagrid('load', {
            _token: _token,
            title: $('#title').val(),
            category: $('#lessonCategory').val(),
            channel: $('#lessonChannel').val()
        });
    }

    function clearInput() {
        document.getElementById("searchLessonForm").reset();
        $("#lessonCategory").select2("val", "");
        $("#lessonChannel").select2("val", "");
    }

    function addLesson() {
        window.location.replace("{{ route('adminTeacher.lesson.create') }}");
    }

    function editLesson() {
        var rows = $('#lessonList').datagrid('getSelections');
        if (rows.length > 1) {
            alert('Олон мэдээг зэрэг засах боломжгүй!');
        } else if (rows.length === 0) {
            alert('Засах мэдээгээ сонгоно уу!');
        } else {
            window.location.replace('lesson/' + rows[0].id + '/edit');
        }
    }

    function deleteLesson() {

        var dialogName = '#removeDialog';
        if (!$(dialogName).length) {
            $('<div id="' + dialogName.replace('#', '') + '"></div>').appendTo('body');
        }

        var ids = [];
        var rows = $('#lessonList').datagrid('getSelections');

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
                                url: "{{ route('adminTeacher.lesson.destroy') }}",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    _token: _token,
                                    _method: 'delete',
                                    ids: ids
                                },
                                success: function (data) {
                                    if (data) {
                                        $('#lessonList').datagrid('reload');
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
</script>
@stop

@stop