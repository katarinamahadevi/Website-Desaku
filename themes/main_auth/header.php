<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href=""/>
		<title>HPAL | <?= (isset($title)) ? $title : '' ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="<?= image_check($setting->icon,'icon') ?>" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?= base_url();?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url();?>assets/css/style_pribadi.css" rel="stylesheet" type="text/css" />
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="page-bg">
		<div class="d-flex justify-content-center align-items-center my-7">
			<img src="<?= image_check($setting->logo,'logo') ?>" width="150" alt="">                                                
		</div>