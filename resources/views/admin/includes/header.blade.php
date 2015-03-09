<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>
        @if(isset($title))
        {{ $title }}
        @endif
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>	
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style-metro.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{ asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    

    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->	
    <link href="{{ asset('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar/bootstrap-fullcalendar.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/select2_metro.css')}}" />
    <link href="{{asset('assets/plugins/jquery-pnofity/pnotify.custom.min.css')}}" rel="stylesheet" type="text/css"/>
    @if(isset($css))
    @foreach($css as $style)
    <link href="{{asset(''.$style.'')}}" rel="stylesheet" type="text/css"/>
    @endforeach
    @endif
    <!-- END PAGE LEVEL STYLES -->
    <link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}" />
</head>
<!-- END HEAD -->