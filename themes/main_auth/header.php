<!DOCTYPE html>

<html lang="en">

<head>
    <base href="../" />
    <title><?= MAINTITLE; ?> <?= (isset($title)) ? '| ' . $title : '';  ?></title>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <link rel="shortcut icon" href="<?= image_check($setting->icon,'icon'); ?>" />
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="<?= base_url(); ?>assets/public/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/public/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="<?= base_url(); ?>assets/public/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/admin/css/admin.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/public/css/custom_pribadi.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <?php
    if (isset($css_add) && is_array($css_add)) {
        foreach ($css_add as $css) {
            echo $css;
        }
    } else {
        echo (isset($css_add) && ($css_add != "") ? $css_add : "");
    }
    ?>
</head>

<body>