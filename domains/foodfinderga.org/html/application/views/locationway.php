<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">            
            <div style="padding-top:2%;padding-bottom: 1%;" align="center"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/front/logo.png" border="0" class="img-responsive"></a></div>
            <div align="center" class="homefont">Welcome to Food Finder GA</div>            
            <div align="center" class="homefont1">The easiest and fastest way to find food resources in Gwinnett County.</div>            
            <div class="footer-bg clearfix">
                <div class="back_icon"><a href="<?php echo base_url(); ?>" id="" ><img src="<?php echo base_url(); ?>img/front/close.png" alt="close" width="80%" height="80%"></a></div>
                <div align="center" class="searchschool_font">Type a street address, zip code, city or click the blue pin for your location<br/> to find food resources...</div>
                <div style="clear:both;"></div>
                <div class="searchschool_form">                    
                    <form id="addgroup-form" method="post" novalidate='novalidate' class='validate' accept-charset="utf-8">
                        <div align="center">
                            <input type="text" value="" name="homeaddress" id="homeaddress" />&nbsp;&nbsp;<img class="locimg" src="<?php echo base_url(); ?>img/front/loc_icon.png" title="Click here for location search"/>
                            <button id="submit" name="submit" class="button_searchschool">GO!</button>
                        </div> 
                    </form>                    
                </div>
                <div style="clear:both; height:30px;"><!-- --></div>
                <?php include('footer_menu.php'); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
$(".locimg").click(function(){
	navigator.geolocation.getCurrentPosition(callback);
	function callback(position) {
    var $lat = position.coords.latitude;
    var $lng = position.coords.longitude;
	var locationdata={"latitude":$lat, "longitude":$lng};
	if ($lat != '' && $lng != '') {
    window.location.href = "<?php echo site_url();?>school/locationmap?lat=" + $lat + "&lng=" + $lng;
	} else 
    exit();
	}
});
});
</script>