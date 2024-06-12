<div id="kt_app_footer" class="nav-footer app-footer position-fixed bottom-0 w-100 <?= (in_array($this->uri->segment(1),$mainpage) && $this->uri->segment(2) == '') ? 'showin_float' : 'hidin'; ?>">
	<!--begin::Footer container-->
	<div class="app-container container-fluid shadow-sm d-flex justify-content-center align-items-center flex-column flex-md-row flex-center flex-md-stack py-2">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
			<table class="table align-middle gs-0 gy-5">
				<!--begin::Table body-->
				<tbody>
					<tr id="parent_menu_footer">
						<td class="text-center w-100px pb-0">
							<a id="menu_home" onclick="page_to(this,'home')" data-active="true" data-title_page="true">
								<i class='home bx bx-home <?= set_menu_active($this->uri->segment(1), ['home'], 'text-success', 'text-secondary-off') ?> fs-2tx mb-2'></i>
								<span class="home fw-semibold d-block <?= set_menu_active($this->uri->segment(1), ['home'], 'text-success', 'text-secondary-off') ?>">Home</span>	
							</a>
						</td>
						<td class="text-center w-100px pb-0">
							<a id="menu_investasi" onclick="page_to(this,'investasi')" data-active="true" data-title_page="true">
								<i class='investasi bx bx-shape-circle fs-2tx mb-2 <?= set_menu_active($this->uri->segment(1), ['investasi'], 'text-success', 'text-secondary-off') ?>'></i>
								<span class="investasi fw-semibold d-block <?= set_menu_active($this->uri->segment(1), ['investasi'], 'text-success', 'text-secondary-off') ?>">Investasi</span>
							</a>
						</td>
						<td class="text-center w-100px pb-0">
							<a id="menu_informasi" onclick="page_to(this,'informasi')" data-active="true" data-title_page="true">
								<i class='informasi bx bx-compass fs-2tx mb-2 <?= set_menu_active($this->uri->segment(1), ['informasi'], 'text-success', 'text-secondary-off') ?>'></i>
								<span class="informasi fw-semibold d-block <?= set_menu_active($this->uri->segment(1), ['informasi'], 'text-success', 'text-secondary-off') ?>">Informasi</span>
							</a>
						</td>
						<td class="text-center w-100px pb-0">
							<a id="menu_profil" onclick="page_to(this,'profil')" data-active="true" data-title_page="true">
								<i class='profil bx bx-user fs-2tx mb-2 <?= set_menu_active($this->uri->segment(1), ['profil'], 'text-success', 'text-secondary-off') ?>'></i>
								<span class="profil fw-semibold d-block <?= set_menu_active($this->uri->segment(1), ['profil'], 'text-success', 'text-secondary-off') ?>">Profil</span>	
							</a>
						</td>
					</tr>
				</tbody>
				<!--end::Table body-->
			</table>
			<!--end::Table-->
		</div>
		<!--end::Table container-->
	</div>
	<!--end::Footer container-->
</div>

<div id="kt_app_footer_transaksi" class="nav-footer app-footer position-fixed bottom-0 w-100 <?= ($this->uri->segment(1) == 'transaksi') ? 'showin_float' : 'hidin'; ?>">
	<!--begin::Footer container-->
	<div class="app-container container-fluid shadow-sm d-flex justify-content-center align-items-center flex-column flex-md-row flex-center flex-md-stack py-2">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
			<table class="table align-middle gs-0 gy-5">
				<!--begin::Table body-->
				<tbody>
					<tr>
						<td class="text-center pb-0">
							<a data-bs-toggle="offcanvas" href="#canvasTransaksiSandi" role="button" aria-controls="canvasTransaksiSandi" class="btn btn-success" style="border-radius: 15px; min-width: 300px;">
								Investasi
							</a>
						</td>
					</tr>
				</tbody>
				<!--end::Table body-->
			</table>
			<!--end::Table-->
		</div>
		<!--end::Table container-->
	</div>
	<!--end::Footer container-->
</div>

<!--begin::Page loading(append to body)-->
<div id="modal_loading" class="page-loader flex-column bg-dark bg-opacity-25">
    <span class="spinner-border text-primary" role="status"></span>
</div>
<!--end::Page loading-->


		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>
			var BASE_URL = BaseUrl = baseUrl = '<?= base_url(); ?>';
			var hostUrl = "<?= base_url(); ?>assets/";
			var css_btn_confirm = 'btn btn-primary';
			var css_btn_cancel = 'btn btn-danger';
			var web_title = 'HPAL |';
			var prev_page = 'home';
			var domain = '<?= ($_SERVER['SERVER_NAME'] == 'localhost') ? 'new_hpalnickel' : 'hpalnickel.net'; ?>';
			var main_page = ['home','investasi','informasi','profil'];
			var foto_default = "<?= image_check($this->session->userdata('hpalnickel_foto'),'user'); ?>";
			addEventListener('keypress', function(e) {
				if (e.keyCode === 13 || e.which === 13) {
					e.preventDefault();
					return false;
				}
			});
			

		</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url(); ?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url(); ?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="<?= base_url(); ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/type.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/budget.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/settings.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/team.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/targets.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/files.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/complete.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-project/main.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom/utilities/modals/create-account.js"></script>
		<script src="<?= base_url();?>assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
		<!--end::Custom Javascript-->
		<script src="<?= base_url();?>assets/js/custom/javascript_pribadi.js"></script>
		<script src="<?= base_url();?>assets/js/function.js"></script>
		<script src="<?= base_url();?>assets/js/mekanik.js"></script>
		<script src="<?= base_url();?>assets/js/user.js"></script>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>