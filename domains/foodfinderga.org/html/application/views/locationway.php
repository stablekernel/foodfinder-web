<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div style="padding-top:2%;padding-bottom: 1%;" align="center"><a href="<?php echo base_url(); ?>"><img
                        src="<?php echo base_url(); ?>img/front/logo.png" border="0" class="img-responsive"></a></div>
            <div align="center" class="homefont">Welcome to Food Finder GA</div>
            <div align="center" class="homefont1">
                The Fastest Way to Find Food Resources in Georgia
            </div>
            <div class="footer-bg clearfix">
                <div class="back_icon"><a href="<?php echo base_url(); ?>" id=""><img
                            src="<?php echo base_url(); ?>img/front/close.png" alt="close" width="80%" height="80%"></a>
                </div>
                <div id="locationWrapper">
                    <p id="locationInstructions" class="searchschool_font">
                        Click or Tap the Blue Pin Below for your Current Location
                    </p>

                    <div style="clear:both;"></div>
                    <div class="searchschool_form">
                        <form id="addgroup-form" method="post" novalidate='novalidate' class='validate'
                              accept-charset="utf-8">
                            <div align="center">
                                <img class="locimg" src="<?php echo base_url(); ?>img/front/loc_icon.png"
                                     title="Click here for location search"/>
                                <input type="text" value="" style="width:85%;"
                                       placeholder="Enter your street address, city name, zip code, or county"
                                       name="homeaddress" id="homeaddress"/>
                                <button id="submit" name="submit" class="button_searchschool">GO!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="clear:both; height:30px;"><!-- --></div>
                <?php include('footer_menu.php'); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".locimg").click(function () {
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