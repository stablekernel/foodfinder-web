<?php if ($this->session->flashdata('updmsg') != ''): ?>

    <div class="notification_text" id="notify_text" style="display:none;">
        <?php echo $this->session->flashdata('updmsg'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('errmsg') != '' || (isset($error_notify) && $error_notify != "")): ?>

    <div class="notification_text" id="error_text" style="display:none;">
        <?php echo $this->session->flashdata('errmsg');
        echo isset($error_notify) ? $error_notify : ""; ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('info') != ''): ?>

    <div class="notification_text" id="notify_info" style="display:none;">
        <?php echo $this->session->flashdata('info'); ?>
    </div>
<?php endif; ?>

<div id="footer">

    <div class="container">

        <div class="row">

            <div class="span6">© 2014 Food Finder GA. All rights reserved</div>
            <!-- /span6 -->

        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

</div> <!-- /#footer -->


<!-- extra js-->
<script defer src="<?php echo base_url(); ?>foodfinderga/common.js" type="text/javascript"
        language="javascript"></script>
<script defer src="<?php echo base_url(); ?>js/libs/jquery.ui.touch-punch.min.js"></script>
<script defer src="<?php echo base_url(); ?>js/libs/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/Theme.js"></script>
<script defer src="<?php echo base_url(); ?>js/Application.js"></script>
<script defer src="<?php echo base_url(); ?>js/plugins/validate/jquery.validate.js"></script>
<script defer src="<?php echo base_url(); ?>js/plugins/validate/additional-methods.js"></script>
<script defer src="<?php echo base_url(); ?>foodfinderga/plugins/tooltip/bootstrap-tooltip.js"></script>
<script defer src="<?php echo base_url(); ?>css/msgGrowl/js/msgGrowl.js" type="text/javascript"
        language="javascript"></script>

<?php if ($pageName == "dashboard") { ?>
    <script src="<?php echo base_url(); ?>js/Charts.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<?php } ?>
</body>
</html>