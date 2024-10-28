<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>
<div class="main-container">
	<div class="pd-ltr-20">
		<div class="card-box pd-20 height-100-p mb-30">
			<div class="row align-items-center">
				<div class="col-md-4">
					<img src="assets/vendors/images/banner-img.png" alt="">
				</div>
				<div class="col-md-8">
					<h4 class="font-20 weight-500 mb-10 text-capitalize">
						Selamat Datang <div class="weight-600 font-30 text-blue"><?= session()->get('username') ?>!</div>
					</h4>
					<p class="font-18 max-width-600">Sistem ini digunakan untuk mengelola data perusahaan PT. INTI
						bagian Infrastruktur Teknologi Informasi</p>
				</div>
			</div>
		</div>
		<div class="bg-white pd-20 card-box mb-30">
			<h4 class="h4 text-blue">ASSET MANAJEMEN INFRASTRUKTUR IT</h4>
			<div id="chartasset"></div>
			<?php
			/* foreach($hitung_asset as $data) {
				$jenis = $data->nama_jenis_perangkat;
				$jumlah = $data->total;
			} */

			?>
		</div>

		<!-- <script>
			$(document).ready(function () {
				getDataAsset()
			});
			const data = []

			function getDataAsset() {
				$.ajax({
					type: "post",
					url: "<?php echo base_url('Home/getDataAsset') ?>",
					data: {
						action: 'GET_ASET'
					},
					success: function (response) {
						var data = JSON.parse(response)
						// alert(response)
						// console.log(response)
						NAMA_PERANGKAT = data[0].NAMA_PERANGKAT;
						JUMLAH_PERANGKAT = data[0].JUMLAH_PERANGKAT;

						chart(NAMA_PERANGKAT, JUMLAH_PERANGKAT)
					}
				});
			}

			function chart(NAMA_PERANGKAT, JUMLAH_PERANGKAT) {
				var options = {
					series: [{
						name: 'Jumlah Perangkat',
						data: JUMLAH_PERANGKAT
					}],
					chart: {
						height: 350,
						type: 'bar',
						parentHeightOffset: 0,
						fontFamily: 'Poppins, sans-serif',
						toolbar: {
							show: true,
						},
						animations: {
							enabled: true,
							easing: 'easeinout',
							speed: 800,
							animateGradually: {
								enabled: true,
								delay: 150
							},
							dynamicAnimation: {
								enabled: true,
								speed: 350
							}
						}
					},
					colors: ['#2e81e5', '#f56767'],
					grid: {
						borderColor: '#c7d2dd',
						strokeDashArray: 5,
					},
					plotOptions: {
						bar: {
							horizontal: false,
							columnWidth: '20%',
							endingShape: 'flat'
						},
					},
					dataLabels: {
						enabled: false
					},
					stroke: {
						show: true,
						width: 2,
						colors: ['transparent']
					},
					xaxis: {
						categories: NAMA_PERANGKAT,
						title: {
							text: 'Jenis Perangkat'
						},
						labels: {
							style: {
								colors: ['#353535'],
								fontSize: '16px',
							},
						},
						axisBorder: {
							color: '#8fa6bc',
						}
					},
					yaxis: {
						title: {
							text: 'Total(Unit)',
						},
						min: 0,
						labels: {
							style: {
								colors: '#353535',
								fontSize: '16px',
							},
						},
						axisBorder: {
							color: '#f00',
						}
					},
					legend: {
						horizontalAlign: 'right',
						position: 'top',
						fontSize: '16px',
						offsetY: 0,
						labels: {
							colors: '#353535',
						},
						markers: {
							width: 10,
							height: 10,
							radius: 15,
						},
						itemMargin: {
							vertical: 0
						},
					},
					fill: {
						opacity: 1

					},
					tooltip: {
						style: {
							fontSize: '15px',
							fontFamily: 'Poppins, sans-serif',
						},
						y: {
							formatter: function (val) {
								return val + " Unit"
							}
						}
					}
				};
				var chart = new ApexCharts(document.querySelector("#chartasset"), options);
				chart.render();

			}

		</script> -->
		<?= $this->endSection() ?>