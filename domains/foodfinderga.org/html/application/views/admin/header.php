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
    <title>Food Finder GA</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" href="<?php echo base_url(); ?>img/front/favicon.png" type="image/png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,800">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.8.21.custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/application.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/msgGrowl/css/msgGrowl.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>foodfinderga/customstyle.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/RedStar.css">
    <script src="<?php echo base_url(); ?>js/libs/modernizr-2.5.3.min.js"></script>
    <script src="<?php echo base_url(); ?>js/libs/jquery-1.7.2.min.js" type="text/javascript"
            language="javascript"></script>
    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
    </script>
    <style type="text/css" media="print">
        #noprint {
            display: none;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div class="container">
            <div style="float:left; width:350px; padding-top:20px;"><a href="<?php echo site_url('admin/dashboard'); ?>"
                                                                       style="color:#fff; text-decoration:none;"><h1>
                        Food Finder GA</h1></a></div>
            <div class="nav-collapse" style="padding-top:32px;">
                <ul id="main-nav" class="nav pull-right">
                    <li class="nav-icon <?php if ($pageName == "dashboard") {
                        echo "active";
                    } ?>">
                        <a href="<?php echo site_url('admin/dashboard'); ?>">
                            <i class="icon-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="dropdown <?php if ($pageName == "addschool" or $pageName == "manageschool") {
                        echo "active";
                    } ?>">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i>
                            <span>School</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('admin/manageschool'); ?>">Manage Schools</a></li>
                            <li><a href="<?php echo site_url('admin/addschool'); ?>">Add School</a></li>
                        </ul>
                    </li>
                    <li class="dropdown <?php if ($pageName == "addprovider" or $pageName == "manageprovider") {
                        echo "active";
                    } ?>">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i>
                            <span>Provider</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('admin/manageprovider'); ?>">Manage Providers</a></li>
                            <li><a href="<?php echo site_url('admin/addprovider'); ?>">Add Provider</a></li>
                        </ul>
                    </li>
                    <li class="dropdown" <?php if ($pageName == "changepassword") {
                        echo "active";
                    } ?>">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user"></i>
                        <span>My Account</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('admin/changepassword'); ?>">Change Password</a></li>
                        <li><a href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
                    </ul>
                    </li>
                </ul>

            </div>
            <!-- /.nav-collapse -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /#header -->
    <?php $this->load->view('admin/sidebar/breadcrumb'); ?>
