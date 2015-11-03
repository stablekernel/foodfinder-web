<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Food Finder GA</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" href="<?php echo base_url(); ?>img/front/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/front/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/front/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/front/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/application.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.8.21.custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/front/jquery-ui-1.10.4.custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/front/jquery_confirm.css">
    <script src="<?php echo base_url(); ?>js/jquery-ui-1.10.4.custom.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#schooladdress').focus();
            $('#homeaddress').focus();
        });
    </script>

    <?php
    $check_url = $this->uri->segment(2);
    if ($check_url != 'supporters' || $check_url != 'contactus' || $check_url != 'privacypolicy' || $check_url != 'terms_conditions') {
        ?>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-51767777-1', 'foodfinderga.org');
            ga('send', 'pageview');

        </script>
    <?php } ?>

</head>
<body>