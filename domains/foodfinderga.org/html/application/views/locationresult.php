<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div class="schoolresultmap_page">
                <div class="wrap_height">
                    <?php $url_link = $this->uri->segment(2);
                    if ($url_link == 'homeway') {
                        $link = 'homeway';
                    } else {
                        $link = 'locationway';
                    }
                    ?>
                    <div class="back_icon"><a href="<?php echo site_url() ?>school/<?php echo $link ?>"><img
                                src="<?php echo base_url(); ?>img/front/close.png" alt="close" width="80%" height="80%"></a>
                    </div>
                    <div class="home_iconn"><a href="<?php echo base_url(); ?>"><img
                                src="<?php echo base_url(); ?>img/front/homeicon.png"/></a></div>
                    <div class="searchresult_title">
                    </div>
                    <div class="searchresultstab">
                        <li class='searchresults_header'>No food provider was found within your search area.</li>

                    </div>
                    <div style="clear:both; height:20px;"><!-- --></div>
                </div>
                <?php include('footer_menu.php'); ?>
            </div>
        </div>
        <div style="clear:both;"><!-- --></div>
    </div>
</div>
