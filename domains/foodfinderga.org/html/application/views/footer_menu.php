<script defer src="<?php echo base_url(); ?>js/Flipcause.js"></script>

<div id="fc-fade" class="fc-black_overlay" onclick="close_window()"></div>
<div id="fc-light" class="fc-white_content">
    <div id="fc-main" class="fc-main-box">
        <div id="fc-close" class="fc-widget_close" onclick="close_window()">
        </div>
        <iframe id="fc-myFrame" height="580" width="925" style="frameborder: 0; " scrolling="no" src=""></iframe>
    </div>
</div>

<!--<div class="floating_button" style="background:#f1bc31; border-radius:5px 5px 0px 0px; font-weight:normal; font-family:Arial, Helvetica, sans-serif; bottom:-2px; right: 150px; padding:4px 10px 4px 10px; font-size:24px; color:#fff;text-align:center; cursor:pointer;border:2px solid #fff;box-shadow: 0 0 8px rgba(0, 0, 0, 0.5); z-index:999999" onclick="open_window('MTUwOQ==')">DONATE</div>-->

<div align="center" class="footer-text">&copy;<?php echo date('Y'); ?>
    <a href="http://foodfinderga.org/" target="_blank">FoodFinderGA</a> | Follow Us On:
    <a href="https://twitter.com/FoodFinderGA" target="blank"><img
            src="<?php echo base_url(); ?>img/front/twitter_iconsm.png"/>
    </a>&nbsp;&nbsp;<a href="https://www.facebook.com/FoodFinderGA/" target="blank"><img
            src="<?php echo base_url(); ?>img/front/facebook_icon.png"/>
    </a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a id="about_us">About Us</a>&nbsp;&nbsp;&nbsp;
    |&nbsp;&nbsp;&nbsp;<a href="/welcome/our_story">Our Story</a>&nbsp;&nbsp;&nbsp;
    |&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>school/supporters">Supporters</a>&nbsp;&nbsp;&nbsp;
    |&nbsp;&nbsp;&nbsp;<a href="javascript:open_window('MTUwOQ==')">Donate</a>


</div>
<div align="center" class="menu_toggle">
    <a href="<?php echo base_url(); ?>school/terms_conditions" id="about_us">Terms & conditions </a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a
        href="<?php echo base_url(); ?>school/privacypolicy" class="cont_focus">Privacy Policy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a
        href="<?php echo base_url(); ?>school/contactus">Contact Us</a>
</div>
<script>
    $(document).ready(function () {
        $('#about_us').click(function () {
            $('.menu_toggle').toggle();
            $('.cont_focus').focus();
        });
    });
</script>
