<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div class="schoolresultmap_page">
                <div style="float:left"><a style="cursor:pointer" class="closebtn"><img
                            src="<?php echo base_url(); ?>img/front/close.png" alt="close" width="70%" height="70%"></a>
                </div>
                <div class="home_iconn"><a href="<?php echo base_url(); ?>"><img
                            src="<?php echo base_url(); ?>img/front/homeicon.png"/></a></div>
                <div style="padding-top:3px;" align="center"></div>
                <div class="schoolresult_map">
                    <form action="<?php echo site_url(); ?>school/homeway" method="post" class="schoolform">
                        <input type="hidden" value="<?php echo $this->session->userdata('searchedhome'); ?>" class="n1"
                               name="homeaddress"/>
                    </form>
                    <?php echo $map['js']; ?>
                    <?php echo $map['html']; ?>
                </div>
                <div style="clear:both; height:20px;"><!-- --></div>
                <?php include('footer_menu.php'); ?>
            </div>
        </div>
        <div style="clear:both;"><!-- --></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".closebtn").click(function () {
            $(".schoolform").submit();
        });
    });
</script>