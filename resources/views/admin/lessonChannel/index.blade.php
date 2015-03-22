@extends('admin.layouts.base')

@section('content')
<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Хайлт</h4>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>

            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="searchLessonChannelForm" action="#" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label for="name" class="control-label">Нэр</label>
                                <div class="controls">
                                    <input id="name" name="name" type="text" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="span6 ">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" onclick="searchLessonChannel()" class="btn green">Хайх</button>
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
            <button onclick="addLessonChannel()" class="btn green">
                Нэмэх <i class="icon-plus"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="editLessonChannel()" class="btn blue">
                Засах <i class="icon-pencil"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="deleteLessonChannel()" class="btn red">
                Устгах <i class="icon-minus"></i>
            </button>
        </div>
    </div>

    <table class="table table-hover" id="lessonChannelList">
    </table>

    <div id="dialog-lessonChannel"></div>
</div>

@section('js')
<script type="text/javascript">
    $('#lessonChannelList').datagrid({
        url: "{{ route('lessonChannelList') }}",
        queryParams: {
            _token: _token
        },
        pagination: true,
        pageSize: 20,
        rownumbers: true,
        fitColumns: true,
        singleSelect: false,
        columns: [[
                {field: 'ck', checkbox: true},
                {field: 'name', title: 'Нэр', width: '100'}
            ]]
    });

    function searchLessonChannel() {
        $('#lessonChannelList').datagrid('load', {
            _token: _token,
            name: $('#name').val()
        });
    }

    function clearInput() {
        document.getElementById("searchLessonChannelForm").reset();
    }

    function addLessonChannel() {
        var dialogName = '#dialog-lessonChannel';

        $.ajax({
            type: 'post',
            url: "{{ route('addLessonChannel') }}",
            data: {
                _token: _token
            },
            dataType: "json",
            beforeSend: function () {
            },
            success: function (data) {

                $(dialogName).empty().html(data.Html);

                $(dialogName).dialog({
                    autoOpen: false,
                    title: data.title,
                    width: "800",
                    height: "auto",
                    position: ['center', 90],
                    modal: true,
                    open: function () {
                    },
                    close: function () {
                        $(dialogName).empty().dialog('destroy');
                    },
                    buttons: [
                        {text: data.save_btn, class: 'btn btn-sm green pull-left', handler: function () {
                                if ($('.lessonChannelName').val() === '') {
                                    new PNotify({
                                        title: 'Алдаа!', text: 'Ангилалын нэрийг оруулна уу!',
                                        type: 'error', sticker: false
                                    });
                                } else {
                                    $.ajax({
                                        type: 'post',
                                        url: "{{ route('admin.lessonChannel.store') }}",
                                        dataType: 'json',
                                        data: {_token: _token, name: $('.lessonChannelName').val()},
                                        beforeSend: function () {
                                        },
                                        success: function (data) {
                                            if (data.status === 'success') {
                                                new PNotify({
                                                    title: 'Амжилттай!', text: data.message,
                                                    type: 'success', sticker: false
                                                });

                                                $('#lessonChannelList').datagrid('reload');
                                            } else {
                                                new PNotify({
                                                    title: 'Алдаа!',
                                                    text: data.message,
                                                    type: 'error',
                                                    sticker: false
                                                });
                                            }
                                        }
                                        ,
                                        error: function (msg) {
                                            console.log(msg);
                                        }
                                    });
                                }

                                $(dialogName).dialog("close");
                            }
                        },
                        {text: data.close_btn, class: 'btn btn-sm', handler: function () {
                                $(dialogName).dialog('close');
                            }}
                    ]
                });
                $(dialogName).dialog('open');
            },
            error: function (msg) {
                console.log(msg);
            }
        });
    }

    function editLessonChannel() {
        var rows = $('#lessonChannelList').datagrid('getSelections');
        var dialogName = '#dialog-lessonChannel';
        if (rows.length === 0) {
            alert('Засах мэдээний ангилалаа сонгоно уу!');
        } else if (rows.length > 1) {
            alert('Зөвхөн нэгийг сонгоно уу!');
        } else {
            $.ajax({
                type: 'post',
                url: "lessonChannel/" + rows[0]['id'] + "/edit",
                data: {
                    _method: 'GET',
                    _token: _token
                },
                dataType: "json",
                beforeSend: function () {
                },
                success: function (data) {

                    $(dialogName).empty().html(data.Html);

                    $(dialogName).dialog({
                        autoOpen: false,
                        title: data.title,
                        width: "800",
                        height: "auto",
                        position: ['center', 90],
                        modal: true,
                        open: function () {
                        },
                        close: function () {
                            $(dialogName).empty().dialog('destroy');
                        },
                        buttons: [
                            {text: data.save_btn, class: 'btn btn-sm green pull-left', handler: function () {
                                    if ($('.lessonChannelName').val() === '') {
                                        new PNotify({
                                            title: 'Алдаа!', text: 'Ангилалын нэрийг оруулна уу!',
                                            type: 'error', sticker: false
                                        });
                                    } else {
                                        $.ajax({
                                            type: 'post',
                                            url: "lessonChannel/" + rows[0]['id'],
                                            dataType: 'json',
                                            data: {_token: _token, _method: 'PATCH', name: $('.lessonChannelName').val()},
                                            beforeSend: function () {
                                            },
                                            success: function (data) {
                                                if (data.status === 'success') {
                                                    new PNotify({
                                                        title: 'Амжилттай!', text: data.message,
                                                        type: 'success', sticker: false
                                                    });

                                                    $('#lessonChannelList').datagrid('reload');
                                                } else {
                                                    new PNotify({
                                                        title: 'Алдаа!',
                                                        text: data.message,
                                                        type: 'error',
                                                        sticker: false
                                                    });
                                                }
                                            }
                                            ,
                                            error: function (msg) {
                                                console.log(msg);
                                            }
                                        });
                                    }

                                    $(dialogName).dialog("close");
                                }
                            },
                            {text: data.close_btn, class: 'btn btn-sm', handler: function () {
                                    $(dialogName).dialog('close');
                                }}
                        ]
                    });
                    $(dialogName).dialog('open');
                },
                error: function (msg) {
                    console.log(msg);
                }
            });
        }
    }

    function deleteLessonChannel() {
        var dialogName = '#removeDialog';
        if (!$(dialogName).length) {
            $('<div id="' + dialogName.replace('#', '') + '"></div>').appendTo('body');
        }

        var ids = [];
        var rows = $('#lessonChannelList').datagrid('getSelections');

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
                                url: "{{ route('admin.lessonChannel.destroy') }}",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    _token: _token,
                                    _method: 'delete',
                                    ids: ids
                                },
                                success: function (data) {
                                    if (data) {
                                        $('#lessonChannelList').datagrid('reload');
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