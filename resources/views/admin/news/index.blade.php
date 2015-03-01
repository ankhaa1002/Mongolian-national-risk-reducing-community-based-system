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
                <form id="searchNewsForm" action="#" class="form-horizontal">
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
                                <label class="control-label">Ангилал</label>
                                <div class="controls">
                                    <select id='newsCategory' class="m-wrap span12">
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
                                <label for="date" class="control-label">Огноо</label>
                                <div class="controls">
                                    <input id="date" name="date" type="text" class="m-wrap span12" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="span6 ">
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
            <button onclick="addNews()" class="btn green">
                Нэмэх <i class="icon-plus"></i>
            </button>
        </div>
        <div class="btn-group">
            <button class="btn blue">
                Засах <i class="icon-pencil"></i>
            </button>
        </div>
        <div class="btn-group">
            <button class="btn red">
                Устгах <i class="icon-minus"></i>
            </button>
        </div>
    </div>

    <table class="table table-hover" id="newsList">
    </table>
</div>

@section('js')
<script type="text/javascript">
    $('#date').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#newsCategory').select2();

    $('#newsList').datagrid({
        url: 'newslist',
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
                {field: 'title', title: 'Гарчиг', width: 20,
                    formatter: function (val, row, idx) {
                        return '<b>' + val + '</b>';
                    }
                },
                {field: 'username', title: 'Нийтлэгч', width: 20},
                {field: 'categories', title: 'Ангилал', width: 20,
                    formatter: function (val, row, idx) {
                        var cat = "";
                        for (var i = 0; i < val.length; i++) {
                            if (i === val.length - 1) {
                                cat += val[i].name;
                            } else {
                                cat += val[i].name + ', ';
                            }
                        }

                        return cat;
                    }
                },
                {field: 'created_date', title: 'Нийтэлсэн огноо', width: 20}
            ]]
    });

    function searchNews() {
        $('#newsList').datagrid('load', {
            _token: _token,
            title: $('#name').val(),
            date: $('#date').val(),
            category: $("#newsCategory option:selected").val()
        });
    }

    function addNews() {
        window.location.replace("{{ route('admin.news.create') }}");
    }
</script>
@stop

@stop