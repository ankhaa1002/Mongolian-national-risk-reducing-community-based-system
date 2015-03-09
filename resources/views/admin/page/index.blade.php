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
                        <div class="span4">
                            <div class="control-group">
                                <label for="name" class="control-label">Нэр</label>
                                <div class="controls">
                                    <input id="name" name="name" type="text" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Төрөл</label>
                                <div class="controls">
                                    <select id='pageType' class="m-wrap span12">
                                        <option></option>
                                        @foreach($pageTypes as $type)
                                        <option value="{{$type['id']}}">{{$type['page_type_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" onclick="searchNews()" class="btn green">Хайх</button>
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
            <button onclick="addPage()" class="btn green">
                Нэмэх <i class="icon-plus"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="editPage()" class="btn blue">
                Засах <i class="icon-pencil"></i>
            </button>
        </div>
        <div class="btn-group">
            <button onclick="deletePage()" class="btn red">
                Устгах <i class="icon-minus"></i>
            </button>
        </div>
    </div>

    <table class="table table-hover" id="pageList">
    </table>
</div>

@section('js')
<script type="text/javascript">
    $("#pageType").select2({
        placeholder: "Төрөл сонгох"
    });

    $('#pageList').datagrid({
        url: 'pageList',
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
                {field: 'name', title: 'Гарчиг', width: 20,
                    formatter: function (val, row, idx) {
                        console.log(row);
                        return '<b><a href="page/' + row.id + '/edit">' + val + '</a></b>';
                    }
                },
                {field: 'page_type_name', title: 'Хуудасны төрөл', width: 20},
                {field: 'created_date', title: 'Үүсгэсэн огноо', width: 20},
                {field: 'updated_date', title: 'Сүүлд шинэчилсэн', width: 20, formatter: function (value, row, index) {
                        if (value === null) {
                            return 'Одоогоор шинэчлэгдээгүй';
                        } else {
                            return value;
                        }
                    }},
                {field: 'is_active', title: 'Идэвхтэй эсэх', formatter: function (value, row, index) {
                        if (value === 1) {
                            return '<i class="icon-ok green"></i>';
                        } else {
                            return '<i class="icon-remove red"></i>';
                        }
                    }}
            ]]
    });

    function searchNews() {
        $('#pageList').datagrid('load', {
            _token: _token,
            name: $('#name').val(),
            page_type_id: $("#pageType option:selected").val()
        });
    }

    function addPage() {
        window.location.replace("{{ route('admin.page.create') }}");
    }

    function editPage() {
        var rows = $('#pageList').datagrid('getSelections');
        if (rows.length > 1) {
            alert('Олон мэдээг зэрэг засах боломжгүй!');
        } else if (rows.length === 0) {
            alert('Засах мэдээгээ сонгоно уу!');
        } else {
            window.location.replace('page/' + rows[0].id + '/edit');
        }
    }

    function deletePage() {

        var dialogName = '#removeDialog';
        if (!$(dialogName).length) {
            $('<div id="' + dialogName.replace('#', '') + '"></div>').appendTo('body');
        }

        var ids = [];
        var rows = $('#pageList').datagrid('getSelections');

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
                                        $('#pageList').datagrid('reload');
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
        $("#pageType").select2("val", "");
    }
</script>
@stop

@stop