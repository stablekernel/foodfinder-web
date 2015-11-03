<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div class="schoolresultmap_page">
                <div class="closebtn1" style="float:left"><a href="" onclick="history.go(-1);"><img
                            src="<?php echo base_url(); ?>img/front/close.png" alt="close" width="70%" height="70%"></a>
                </div>
                <div style="padding-top:3px;" align="center"></div>
                <div class="schoolresult_map">
                    <?php echo $map['js']; ?>
                    <?php echo $map['html']; ?>
                </div>
                <div style="clear:both; height:20px;"><!-- --></div>
                <div align="center" class="footer-text"><a href="https://twitter.com/FoodFinderGA" target="blank">Follow
                        Us On: <img src="<?php echo base_url(); ?>img/front/twitter_iconsm.png"/></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a
                        href="<?php echo base_url(); ?>school/aboutus">About Us</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a
                        href="<?php echo base_url(); ?>school/other_resources">Other Resources</a></div>
            </div>
        </div>
        <div style="clear:both;"><!-- --></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".closebtn").click(function () {
            navigator.geolocation.getCurrentPosition(callback);
            function callback(position) {
                var $lat = position.coords.latitude;
                var $lng = position.coords.longitude;
                var locationdata = {"latitude": $lat, "longitude": $lng};
                if ($lat != '' && $lng != '') {
                    window.location.href = "<?php echo site_url();?>school/locationmap?lat=" + $lat + "&lng=" + $lng;
                } else
                    exit();
            }
        });
    });
</script>