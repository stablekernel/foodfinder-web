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
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,800">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/ui-lightness/jquery-ui-1.8.21.custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/application.css">
    <script src="<?php echo base_url(); ?>js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body class="login">
<div class="account-container login stacked">
    <div class="content clearfix">
        <div align="center">
            <h1>Food Finder GA</h1></div>
        <?php if ($this->session->flashdata('loginstatus') != ''): ?>
            <div id="infoMessage" class="alert alert-warning">
                <button type="button" class="close"
                        data-dismiss="alert">&times;</button><?php echo $this->session->flashdata('loginstatus'); ?>
            </div>
        <?php endif; ?>
        <form id="addgroup-form" method="post" novalidate='novalidate' class='validate' accept-charset="utf-8">
            <h2>Sign In</h2>

            <div class="login-fields">
                <div class="field controls control-group">
                    <label for="username">E-Mail ID:</label>
                    <input type="text" id="email" name="email" value="" placeholder="E-Mail ID"
                           class="login username-field"/>
                </div>
                <!-- /field -->
                <div class="field controls control-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password"
                           class="login password-field"/>
                </div>
                <!-- /password -->
                <div class="field">
                    <!--	<div style="width:100px; float:left;">Case sensitive</div>
                    </div>
                    <div style="clear:both; height:5px;">  </div> -->

                    <div class="field">
                        <div style="width:100px; float:left;"><?php //echo $image; ?></div>
                        <!--<div class="controls control-group" style="width:200px; float:left; padding-left:20px;"><input type="text" name="word" id="word" style="width:80px; padding:0px 8px 0px 8px; height:30px;" maxlength="6" /></div>
                    </div> <!-- /captcha -->
                    </div>
                    <!-- /login-fields -->
                    <div class="login-actions">
                        <button class="button btn btn-primary btn-large" id="submit" name="submit">Sign In</button>
                    </div>
                    <!-- .actions -->
        </form>
    </div>
    <!-- /content -->
</div>
<!-- /account-container -->
<script src="<?php echo base_url(); ?>js/libs/jquery-1.7.2.min.js"></script>
<script defer src="<?php echo base_url(); ?>foodfinderga/common.js" type="text/javascript"
        language="javascript"></script>
<script defer src="<?php echo base_url(); ?>js/libs/jquery-ui-1.8.21.custom.min.js"></script>
<script defer src="<?php echo base_url(); ?>js/libs/jquery.ui.touch-punch.min.js"></script>
<script defer src="<?php echo base_url(); ?>js/libs/bootstrap/bootstrap.min.js"></script>
<script defer src="<?php echo base_url(); ?>js/Theme.js"></script>
<script defer src="<?php echo base_url(); ?>js/Application.js"></script>
<script defer src="<?php echo base_url(); ?>js/plugins/validate/jquery.validate.js"></script>
<script defer src="<?php echo base_url(); ?>js/plugins/validate/additional-methods.js"></script>
<script defer src="<?php echo base_url(); ?>foodfinderga/plugins/tooltip/bootstrap-tooltip.js"></script>
<script defer src="<?php echo base_url(); ?>css/msgGrowl/js/msgGrowl.js" type="text/javascript"
        language="javascript"></script>
</body>
</html>