<!-- BEGIN FOOTER -->
	<div class="footer">
		{{ date('Y') }} &copy; Онцгой байдлын ерөнхий газар
		<div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<script src="{{asset('assets/plugins/jquery-1.8.3.min.js')}}" type="text/javascript"></script>	
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->	
	<script src="{{asset('assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>		
	<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="{{asset('assets/plugins/excanvas.js')}}"></script>
	<script src="{{asset('assets/plugins/respond.js')}}"></script>	
	<![endif]-->	
	<script src="{{asset('assets/plugins/breakpoints/breakpoints.js')}}" type="text/javascript"></script>	
	<!-- IMPORTANT! jquery.slimscroll.min.js depends on jquery-ui-1.10.1.custom.min.js -->	
	<script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/jquery.blockui.js')}}" type="text/javascript"></script>	
	<script src="{{asset('assets/plugins/jquery.cookie.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript" ></script>	
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script type="text/javascript" src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap-daterangepicker/date.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/plugins/jquery-pnofity/pnotify.custom.min.js')}}" type="text/javascript"></script>
        
        @if(isset($js))
        @foreach($js as $jscript)
        <script src="{{asset(''.$jscript.'')}}" type="text/javascript"></script>
        @endforeach
        @endif
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="{{asset('assets/scripts/app.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/scripts/index.js')}}" type="text/javascript"></script>			
	<!-- END PAGE LEVEL SCRIPTS -->	
	<script>
            var _token = '{{csrf_token()}}'; 
            jQuery(document).ready(function() {		
                    App.init(); // initlayout and core plugins
                    Index.init();
//			Index.initJQVMAP(); // init index page's custom scripts
                    Index.initCalendar(); // init index page's custom scripts
//			Index.initCharts(); // init index page's custom scripts
                    Index.initChat();
                    Index.initDashboardDaterange();
                    Index.initIntro();
            });
	</script>
        
        @yield('js')
        
	<!-- END JAVASCRIPTS -->