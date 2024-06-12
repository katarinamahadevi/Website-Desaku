		<!--end::Modals-->
		<!--begin::Javascript-->
		<script>
			var BASE_URL = BaseUrl = baseUrl = '<?= base_url(); ?>';
			var hostUrl = "<?= base_url(); ?>assets/";
			var css_btn_confirm = 'btn btn-primary';
			var css_btn_cancel = 'btn btn-danger';
			var web_title = 'HPAL |';
			var prev_page = '';
			var domain = '<?= ($_SERVER['SERVER_NAME'] == 'localhost') ? 'new_hpalnickel' : 'hpalnickel.net'; ?>';
			var main_page = ['home','investasi','informasi','profil'];
			addEventListener('keypress', function(e) {
				if (e.keyCode === 13 || e.which === 13) {
					e.preventDefault();
					return false;
				}
			});

		</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?= base_url();?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url();?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="<?= base_url();?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
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
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/type.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/budget.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/settings.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/team.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/targets.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/files.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/complete.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-project/main.js"></script>
		<script src="<?= base_url();?>assets/js/custom/utilities/modals/create-account.js"></script>
		<!--end::Custom Javascript-->
		<script src="<?= base_url();?>assets/js/custom/javascript_pribadi.js"></script>
		<script src="<?= base_url();?>assets/js/function.js"></script>
		<script src="<?= base_url();?>assets/js/mekanik.js"></script>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>