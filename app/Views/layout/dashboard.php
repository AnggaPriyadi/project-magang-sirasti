<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Sistem Informasi Infrastruktur IT</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/vendors/images/cropped-inti-2 (2)">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/vendors/images/cropped-inti-2.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/vendors/images/cropped-inti-2.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Hind:wght@700&display=swap" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/custom.css">

	<link rel="stylesheet" type="text/css"
		href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>


	<!-- js -->
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/core.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/script.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/process.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/layout-settings.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/apexcharts/apexcharts.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/jszip.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>


	<!-- buttons for Export datatable -->

	<script src="assets/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="assets/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="assets/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="assets/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="assets/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="assets/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="assets/src/plugins/datatables/js/vfs_fonts.js"></script>
	<script src="https://unpkg.com/jspdf@1.5.3/dist/jspdf.min.js"></script>
	<script src="https://unpkg.com/jspdf-autotable@3.5.4/dist/jspdf.plugin.autotable.js"></script>

	<!-- Datatable Setting js -->
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/datatable-setting.js"></script>

	<!-- <script src="assets/vendors/scripts/dashboard.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/sweetalert2/sweet-alert.init.js"></script>


	<!-- plugin file -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" type="text/javascript">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"
		integrity="sha512-wBcFatf7yQavHQWtf4ZEjvtVz4XkYISO96hzvejfh18tn3OrJ3sPBppH0B6q/1SHB4OKHaNNUKqOmsiTGlOM/g=="
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="assets/src/plugins/jSignature/libs/flashcanvas.js"></script>
	<![endif]-->
</head>

<body>
	<!-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="<?php echo base_url(); ?>assets/vendors/images/logo_inti.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> -->

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Pencarian">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Dari</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Kepada</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subjek</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Cari</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<?php
				// $arrayUser = $_SESSION['user_logged'];
				$userLogin = 'admin';
				$roleUser = 'Administrator';
				?>
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo base_url(); ?>assets/vendors/images/admin.png" alt="">
						</span>
						<span class="user-name text-capitalize"><?= $userLogin ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="<?= site_url('auth/logout') ?>"><i class="dw dw-logout"></i> Log
							Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="left-sidebar">
		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="<?php echo site_url('dashboard'); ?>">
					<img src="assets/vendors/images/Logo-INTI-sidebar.png" alt="" class="light-logo">
					<img src="assets/vendors/images/Logo-INTI_a.svg" alt="" class="dark-logo">
					<span class="mtext" style="font-family: 'Hind', sans-serif; line-height: 40px; letter-spacing: -0.5px; font-size: 95%; padding-top: 10px">&nbsp; SI Infrastruktur IT</span>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu icon-list-style-5">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="<?php echo site_url('dashboard'); ?>" target="_self" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Radius</div>
						</li>
						<li>
							<a href="<?php echo site_url('radius'); ?>" target="_self" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-computer-1"></span>
								<span class="mtext">MAC Address</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Data Center Asset Management</div>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon dw dw-table"></span><span class="mtext">Master Data</span>
							</a>
							<ul class="submenu">
								<li><a href="<?php echo site_url('jenis-perangkat'); ?>" target="_self">Jenis Perangkat</a></li>
								<li><a href="<?php echo site_url('merk-perangkat'); ?>" target="_self">Merk Perangkat</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo site_url('asset-management'); ?>" target="_self" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-bar-chart"></span>
								<span class="mtext">Asset Management</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">IP Management</div>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon dw dw-server"></span><span class="mtext">IP Public</span>
							</a>
							<ul class="submenu">
								<li><a href="<?php echo site_url('ip-public'); ?>" target="_self">Manajemen IP Public</a></li>
								<li><a href="<?php echo site_url('provider'); ?>" target="_self">Data Provider</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo site_url('ip-private'); ?>" target="_self" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-lock"></span>
								<span class="mtext">IP Private</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Data Aplikasi</div>

						<li>
							<a href="<?php echo site_url('list-aplikasi'); ?>" target="_self" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-bar-chart"></span>
								<span class="mtext">List Aplikasi</span>
							</a>
						</li
							<li>
						<div class="dropdown-divider"></div>
						</li>
						<li>
							<div class="sidebar-small-cap">Log Activity</div>
						</li>
						<li>
							<a href="<?php echo site_url('log-activity-datacenter'); ?>" target="_self" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-agenda1"></span>
								<span class="mtext">Aktifitas R. Data Center</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">

								<span class="micon dw dw-list2"></span><span class="mtext">Log Pengecekan</span>
							</a>
							<ul class="submenu">


								<li><a href="<?php echo site_url('log-ceksuhu-datacenter'); ?>" target="_self">Suhu Data Center</a></li>
								<li><a href="<?php echo site_url('log-cek-ups'); ?>" target="_self">UPS</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>
		<?= $this->renderSection('content') ?>


		<div class="footer-wrap pd-20 mb-20 card-box">
			Sistem Informasi Infrastruktur IT By <a href="https://www.inti.co.id" target="_blank">PT INTI (Persero)</a>
		</div>
	</div>
	</div>
</body>

</html>