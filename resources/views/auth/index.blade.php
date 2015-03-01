<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Нэвтрэх хэсэг</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style-metro.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>    
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/css/pages/login.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->
        <link rel="shortcut icon" href="assets/img/favico.png" />
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <img src="assets/img/big_logo.png" alt="" /> 
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="form-vertical login-form" role="form" method="POST" action="{{ url('auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h3 class="form-title">Нэвтрэх</h3>
                @if(Session::has('fail'))
                <div class="alert alert-error hide" style="display: block;">
                    <button class="close" data-dismiss="alert"></button>
                    <span>{{ Session::get('fail') }}</span>
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success hide" style="display: block;">
                    <button class="close" data-dismiss="alert"></button>
                    <span>{{ Session::get('success') }}</span>
                </div>
                @endif
                <div class="control-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Нэр</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Нэр" name="username"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label visible-ie8 visible-ie9">Түлхүүр үг</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Түлхүүр үг" name="password"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green pull-right">
                        Нэвтрэх <i class="m-icon-swapright m-icon-white"></i>
                    </button>            
                </div>
            </form>
            <!-- END LOGIN FORM -->        
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright">
            {{date("Y")}} &copy; <a target="_blank" href="http://nema.gov.mn">Онцгой байдлын ерөнхий газар</a>
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
        <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->  
        <script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>    
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
        <script src="assets/plugins/excanvas.js"></script>
        <script src="assets/plugins/respond.js"></script> 
        <![endif]-->  
        <script src="assets/plugins/breakpoints/breakpoints.js" type="text/javascript"></script>  
        <!-- IMPORTANT! jquery.slimscroll.min.js depends on jquery-ui-1.10.1.custom.min.js -->  
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery.blockui.js" type="text/javascript"></script> 
        <script src="assets/plugins/jquery.cookie.js" type="text/javascript"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>  
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/scripts/app.js" type="text/javascript"></script>    
        <!-- END PAGE LEVEL SCRIPTS --> 
        <script>
        jQuery(document).ready(function () {
            App.init();
            Login.init();
        });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>