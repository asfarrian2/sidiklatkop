<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">
    <title>SI-Diklatkop Kalsel</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/assets/plugins/fontawesome/css/all.min.css">

    <!-- Datepicker CSS -->
	<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">

	<!-- Datatables CSS -->
	<link rel="stylesheet" href="/assets/plugins/datatables/datatables.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="/assets/css/feather.css">


	<!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index.html" class="logo">
					<img src="/assets/img/logo.png" width="35" height="35" alt=""> <span>SI-Diklatkop</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><img src="/assets/img/icons/bar-icon.svg"  alt=""></a>
            <a id="mobile_btn" class="mobile_btn float-start" href="#sidebar"><img src="/assets/img/icons/bar-icon.svg"  alt=""></a>
            <ul class="nav user-menu float-end">
				<li class="nav-item dropdown has-arrow user-profile-list">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-bs-toggle="dropdown">
						<div class="user-names">
							<h5>Asfar Rian </h5>
                        	<span>Super Admin</span>
						</div>
						<span class="user-img">
							<img  src="/assets/img/profile.png"  alt="Admin">
						</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<a class="dropdown-item" href="login.html">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-end">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
						<li>
							<a href="/adm/dashboard"><span class="menu-side"><img src="/assets/img/icons/menu-icon-01.svg" alt=""></span> <span> Dashboard </span></a>
						</li>
                            <li class="menu-title">Master</li>
                        <li>
							<a href="/adm/seksi" class="{{ Request::is('adm/seksi') ? 'active' : '' }}" ><span class="menu-side"><i class="fa fa-sitemap"></i></span> <span> Seksi / Bidang </span></a>
						</li>
                        <li>
							<a href="/adm/skpd" class="{{ Request::is('adm/skpd') ? 'active' : '' }}"><span class="menu-side"><i class="fa fa-building"></i></span> <span> SKPD / UPTD </span></a>
						</li>
                        <li class="submenu">
							<a href="#"><span class="menu-side"><i class="fa fa-user-plus"></i></span> <span> Biodata </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="{{ Request::is('adm/instruktur*') ? 'active' : '' }}" href="/adm/instruktur">Pengajar</a></li>
								<li><a href="payments.html">Peserta</a></li>
							</ul>
						</li>
                        <li class="submenu">
							<a href="#"><span class="menu-side"><i class="fa fa-tasks"></i></span> <span> Data Lainnya </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                                <li><a class="{{ Request::is('adm/kota*') ? 'active' : '' }}" href="/adm/kota">Kabupaten/Kota</a></li>
								<li><a class="{{ Request::is('adm/jeniskoperasi*') ? 'active' : '' }}" href="/adm/jeniskoperasi">Jenis Koperasi</a></li>
                                <li><a class="{{ Request::is('adm/sektorusaha*') ? 'active' : '' }}" href="/adm/sektorusaha">Sektor Usaha UMKM</a></li>
                                <li><a class="{{ Request::is('adm/kategoridiklat*') ? 'active' : '' }}" href="/adm/kategoridiklat">Kategori Diklat</a></li>
                                <li><a class="{{ Request::is('adm/tahunanggaran*') ? 'active' : '' }}" href="/adm/tahunanggaran">Tahun Anggaran</a></li>
							</ul>
						</li>
                        <li class="menu-title">Manajemen Diklat</li>
                        <li>
							<a href="/adm/diklat"  class="{{ Request::is('adm/diklat*') ? 'active' : '' }}"><span class="menu-side"><i class="fa fa-calendar"></i></span> <span> Kegiatan Diklat </span></a>
						</li>
                        <li>
							<a href="#"><span class="menu-side"><i class="fa fa-user-md"></i></span> <span> Pengajar Diklat </span></a>
						</li>
                        <li>
							<a href="#"><span class="menu-side"><i class="fa fa-users"></i></span> <span> Peserta Diklat</span></a>
						</li>
                        <li class="menu-title">Manajemen Akun</li>
                        <li class="submenu">
							<a href="#"><span class="menu-side"><i class="fa fa-user-circle"></i></span> <span> Akun </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                                <li><a class="{{ Request::is('adm/admin*') ? 'active' : '' }}" href="/adm/admin">Admin</a></li>
								<li><a class="{{ Request::is('adm/operator*') ? 'active' : '' }}" href="/adm/jeniskoperasi">Operator</a></li>
							</ul>
						</li>
                        <br><br><br><br><br><br><br><br><br>
                        <li class="menu-title"><span>© 2025 Balatkop-UK Kalsel</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">

                @yield('content')

            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- jQuery -->
    <script src="/assets/js/jquery-3.7.1.min.js"></script>


	<!-- Bootstrap Core JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

	<!-- Feather Js -->
	<script src="/assets/js/feather.min.js"></script>

	<!-- Slimscroll -->
    <script src="/assets/js/jquery.slimscroll.js"></script>

	<!-- Select2 Js -->
	<script src="/assets/js/select2.min.js"></script>

	<!-- Datatables JS -->
	<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables/datatables.min.js"></script>

	<!-- counterup JS -->
	<script src="/assets/js/jquery.waypoints.js"></script>
	<script src="/assets/js/jquery.counterup.min.js"></script>

	<!-- Apexchart JS -->
	<script src="/assets/plugins/apexchart/apexcharts.min.js"></script>
	<script src="/assets/plugins/apexchart/chart-data.js"></script>

    <!-- Datepicker Core JS -->
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Custom JS -->
    <script src="/assets/js/app.js"></script>

    @stack('myscript')





</body>

</html>
