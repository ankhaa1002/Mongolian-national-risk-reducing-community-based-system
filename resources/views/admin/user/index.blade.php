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
                <form id="searchUserForm" action="#" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label for="username" class="control-label">Хэрэглэгчийн нэр</label>
                                <div class="controls">
                                    <input id="username" name="username" type="text" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" onclick="searchUser()" class="btn green">Хайх</button>
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
            <button onclick="addUser()" class="btn green">
                Нэмэх <i class="icon-plus"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="editUser()" class="btn blue">
                Засах <i class="icon-pencil"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="deleteUser()" class="btn red">
                Устгах <i class="icon-minus"></i>
            </button>
        </div>
    </div>

    <table class="table table-hover" id="userList">
    </table>
</div>

@section('js')
<script type="text/javascript">
    $(function () {
        $('#userList').datagrid({
            url: 'userList',
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
                    {field: 'user_name', title: 'Хэрэглэгчийн нэр', width: 10},
                    {field: 'lastname', title: 'Овог', width: 20},
                    {field: 'firstname', title: 'Нэр', width: 20},
                    {field: 'email', title: 'Цахим хаяг', width: 20},
                    {field: 'is_active', title: 'Идэвхтэй эсэх', formatter: function (value, row, index) {
                        if (value === 1) {
                            return '<i class="icon-ok green"></i>';
                        } else {
                            return '<i class="icon-remove red"></i>';
                        }
                    }}
                ]]
        });

        $('#userList').datagrid('reload');
    });

    function searchUser() {
        $('#userList').datagrid('load', {
            _token: _token,
            username: $('#username').val()
        });
    }

    function addUser() {
        window.location.replace("{{ route('admin.user.create') }}");
    }

    function editUser() {
        var rows = $('#userList').datagrid('getSelections');
        if (rows.length > 1) {
            alert('Олон мэдээг зэрэг засах боломжгүй!');
        } else if (rows.length === 0) {
            alert('Засах мэдээгээ сонгоно уу!');
        } else {
            window.location.replace('user/' + rows[0].id + '/edit');
        }
    }

    function deleteUser() {

        var dialogName = '#removeDialog';
        if (!$(dialogName).length) {
            $('<div id="' + dialogName.replace('#', '') + '"></div>').appendTo('body');
        }

        var ids = [];
        var rows = $('#userList').datagrid('getSelections');

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
                                url: "{{ route('admin.user.destroy') }}",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    _token: _token,
                                    _method: 'delete',
                                    ids: ids
                                },
                                success: function (data) {
                                    if (data) {
                                        $('#userList').datagrid('reload');
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
        document.getElementById("searchUserForm").reset();
    }
</script>
@stop

@stop