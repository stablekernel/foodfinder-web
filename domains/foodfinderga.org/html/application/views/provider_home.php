<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div class="schoolprovider_page">


                <div class="back_icon"><a onclick="window.history.back()"><img
                            src="<?php echo base_url(); ?>img/front/close.png" alt="close" width="70%" height="70%"></a>
                </div>
                <div class="home_iconn"><a href="<?php echo base_url(); ?>"><img
                            src="<?php echo base_url(); ?>img/front/homeicon.png"/></a></div>
                <div class="provider_result">
                    <div class="provider_head"><a
                            href="https://www.google.co.in/maps/dir//<?php echo $provider[0]['latitude'] . ',' . $provider[0]['longitude'] ?>/@<?php echo $provider[0]['latitude'] . ',' . $provider[0]['longitude'] ?>"
                            target="_blank"><img src="<?php echo base_url() ?>img/front/map-icon.png"
                                                 title="Click here to get directions"></a>

                        <div class="map_icon_click">Click for directions</div>
                    </div>
                    <div class="provider_address">
                        <div class="p_name"><?php echo $provider[0]['providername']; ?></div>
                        <div class="p_street1"><?php echo $provider[0]['streetaddress1']; ?></div>
                        <div class="p_street2"><?php echo $provider[0]['streetaddress2']; ?></div>
                        <div class="p_city"><?php echo $provider[0]['city']; ?></div>
                        <div class="p_state"><?php echo $provider[0]['state']; ?></div>
                        <div class="p_country"><?php echo $provider[0]['county']; ?></div>
                        <div class="p_zip"><?php echo $provider[0]['zipcode']; ?></div>
                    </div>
                </div>
                <div style="clear:both; height:20px;"><!-- --></div>
                <?php include('footer_menu.php'); ?>
            </div>
        </div>
        <div style="clear:both;"><!-- --></div>
    </div>
</div>
