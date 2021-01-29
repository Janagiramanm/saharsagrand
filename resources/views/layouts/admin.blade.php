<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ ucfirst(config('multiauth.prefix')) }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <script src="{{ asset('admin/global_assets/js/main/jquery.min.js') }}"></script>

</head>

<body>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
            <a class="d-inline-block" href="{{ url('back-office/') }}">
                <img src="{{ asset('admin/global_assets/images/logo_light.png') }}" alt="">
            </a>
		</div>
		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
			<span class="navbar-text ml-md-3 mr-md-auto">
				<span class="badge bg-success">Online</span>
			</span>
			<ul class="navbar-nav">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('admin/global_assets/images/placeholders/pic.jpeg') }}" width="38" height="38" class="rounded-circle" alt="">
						<span>Venkat</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						{{-- <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
						<a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
						<a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-blue ml-auto">58</span></a>
						<div class="dropdown-divider"></div> --}}
						<a href="#" class="dropdown-item"><i class="icon-cog5"></i> Change Password</a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i class="icon-switch2"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="{{ asset('admin/global_assets/images/placeholders/pic.jpeg') }}" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp;{{ Auth::user()->address }}
								</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="{{ url("back-office/") }}" class="nav-link <?php if(\Request::is('back-office')){ echo 'active'; } ?>">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('back-office/roles') }}" class="nav-link <?php if(\Request::is('back-office/roles')){ echo 'active'; } ?>"> <i class="icon-user-lock"></i> <span>Admin Roles</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('back-office/users') }}" class="nav-link <?php if(\Request::is('back-office/users')){ echo 'active'; } ?>"><i class="icon-user-plus"></i> <span>Employees</span></a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('back-office/banks') }}" class="nav-link <?php if(\Request::is('back-office/banks')){ echo 'active'; } ?>"><i class="icon-user-plus"></i> <span>Banks</span></a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('back-office/applicationstatus') }}" class="nav-link <?php if(\Request::is('back-office/applicationstatus')){ echo 'active'; } ?>"><i class="icon-user-plus"></i> <span>Application Status</span></a>
                        </li>
                        <li class="nav-item nav-item-submenu <?php if(strpos($_SERVER['REQUEST_URI'], 'back-office/customers')) { echo 'nav-item-expanded nav-item-open'; }?>">
                            <a href="#" class="nav-link"><i class="icon-pencil3"></i> <span>Customers</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Form components">
                                <li class="nav-item"><a href="{{ url('back-office/customers/newleads') }}" class="nav-link  <?php if(\Request::is('back-office/customers/newleads')){ echo 'active'; } ?>">New Leads</a></li>
                                <li class="nav-item"><a href="{{ url('back-office/customers/customers') }}" class="nav-link <?php if(\Request::is('back-office/customers/customers')){ echo 'active'; } ?> ">Pipe Line Customers</a></li>
                                <li class="nav-item nav-item-submenu   <?php if(\Request::is('back-office/customers/loginProcess') || \Request::is('back-office/customers/sanctioned') || \Request::is('back-office/customers/sendtobank')) { echo 'nav-item-expanded nav-item-open'; }?>">
									<a href="#" class="nav-link  <?php if(\Request::is('back-office/customers/loginProcess') || \Request::is('back-office/customers/sanctioned') || \Request::is('back-office/customers/sendtobank')){ echo 'active'; } ?>">Login Process </a>
									<ul class="nav nav-group-sub">
                                        <li class="nav-item"><a href="{{ url('back-office/customers/sendtobank') }}" class="nav-link <?php if(\Request::is('back-office/customers/sendtobank')){ echo 'active'; } ?>">Sent for Login</a></li>
										<li class="nav-item"><a href="{{ url('back-office/customers/loginProcess') }}" class="nav-link <?php if(\Request::is('back-office/customers/loginProcess')){ echo 'active'; } ?>">Logged in Data</a></li>
                                        <li class="nav-item"><a href="{{ url('back-office/customers/sanctioned') }}" class="nav-link <?php if(\Request::is('back-office/customers/sanctioned')){ echo 'active'; } ?> ">Sanctioned Customers</a></li>
									</ul>
                                </li>
                                <li class="nav-item nav-item-submenu  <?php if(\Request::is('back-office/customers/readytodisburse') || \Request::is('back-office/customers/disbursebank') || \Request::is('back-office/customers/disbursedapplications') || \Request::is('back-office/customers/chequefixing')) { echo 'nav-item-expanded nav-item-open'; }?>">
									<a href="#" class="nav-link  <?php if(\Request::is('back-office/customers/readytodisburse') || \Request::is('back-office/customers/disbursebank') || \Request::is('back-office/customers/disbursedapplications') || \Request::is('back-office/customers/chequefixing')) { echo 'active'; }?>">Disbursement Process</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="{{ url('back-office/customers/readytodisburse') }}" class="nav-link <?php if(\Request::is('back-office/customers/readytodisburse')){ echo 'active'; } ?>">Ready for Disbursement</a></li>
                                        <li class="nav-item"><a href="{{ url('back-office/customers/disbursebank') }}" class="nav-link <?php if(\Request::is('back-office/customers/disbursebank')){ echo 'active'; } ?>">Bank Process</a></li>
                                        <li class="nav-item"><a href="{{ url('back-office/customers/chequefixing') }}" class="nav-link <?php if(\Request::is('back-office/customers/chequefixing')){ echo 'active'; } ?>">Cheque Fixing</a></li>
                                        <li class="nav-item"><a href="{{ url('back-office/customers/disbursedapplications') }}" class="nav-link <?php if(\Request::is('back-office/customers/disbursedapplications')){ echo 'active'; } ?>">Disbursed Applications</a></li>
									</ul>
                                </li>

                                <li class="nav-item nav-item-submenu  <?php if(\Request::is('back-office/customers/partdisbursements') || \Request::is('back-office/customers/partchequefixing') || \Request::is('back-office/customers/disbursedapplications') || \Request::is('back-office/customers/chequefixing')) { echo 'nav-item-expanded nav-item-open'; }?>">
									<a href="#" class="nav-link  <?php if(\Request::is('back-office/customers/partdisbursements') || \Request::is('back-office/customers/partchequefixing') || \Request::is('back-office/customers/disbursedapplications') || \Request::is('back-office/customers/chequefixing')) { echo 'active'; }?>">Part Disbursements</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="{{ url('back-office/customers/partdisbursements') }}" class="nav-link <?php if(\Request::is('back-office/customers/partdisbursements')){ echo 'active'; } ?>">Part Disbursements</a></li>
                                        <li class="nav-item"><a href="{{ url('back-office/customers/partchequefixing') }}" class="nav-link <?php if(\Request::is('back-office/customers/partchequefixing')){ echo 'active'; } ?>">Part Cheque Fixing</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item"><a href="{{ url('back-office/customers/allcustomers') }}" class="nav-link <?php if(\Request::is('back-office/customers/allcustomers')){ echo 'active'; } ?>">All Customers</a></li>
                                <li class="nav-item"><a href="{{ url('back-office/customers/droppedcustomers') }}" class="nav-link <?php if(\Request::is('back-office/customers/droppedcustomers')){ echo 'active'; } ?>">Dropped Customers</a></li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('back-office/appointments') }}" class="nav-link <?php if(\Request::is('back-office/appointments')){ echo 'active'; } ?>"><i class="icon-user-plus"></i> <span>Appointments</span></a>
                        </li>

					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - @yield('breadcrum') </h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center">
							<a href="{{ url('back-office/eligibilities') }}" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Eligibility Calc</span></a>
						</div>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
                            <a href="{{ url('back-office') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                            @yield('parent_link')
							<span class="breadcrumb-item active">@yield('breadcrum')</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->

            @section('main-content')

            @show
		</div>
		<!-- /main content -->
	</div>
    <!-- /page content -->
    <!-- Footer -->
	<div class="navbar navbar-expand-lg navbar-light">
		<div class="text-center d-lg-none w-100">
			<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
				<i class="icon-unfold mr-2"></i>
				Footer
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-footer">
			<span class="navbar-text ml-lg-auto">
				&copy; {{ date('Y') }} <a href="#">scopo</a> by <a href="" target="_blank">Venkat Reddy</a>
			</span>
		</div>
	</div>
	<!-- /footer -->

    <!-- Core JS files -->
	<script src="{{ asset('admin/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
    <script src="{{ asset('admin/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>



	<!-- Theme JS files -->
	<script src="{{ asset('admin/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>

    <!-- Theme JS files -->
    <script src="{{ asset('admin/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/pickers/anytime.min.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/pickers/pickadate/picker.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/pickers/pickadate/picker.time.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/pickers/pickadate/legacy.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/demo_pages/picker_date.js') }}"></script>


	<script src="{{ asset('admin/global_assets/js/demo_pages/dashboard.js') }}"></script>
    <!-- /theme JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('admin/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
    <script src="{{ asset('admin/global_assets/js/demo_pages/datatables_advanced.js') }}"></script>




    @section('custom-script')

    @show



</body>
</html>
