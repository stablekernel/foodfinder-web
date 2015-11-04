<script defer src="<?php echo base_url(); ?>js/Flipcause.js"></script>

<div id="fc-fade" class="fc-black_overlay" onclick="close_window()"></div>
<div id="fc-light" class="fc-white_content">
    <div id="fc-main" class="fc-main-box">
        <div id="fc-close" class="fc-widget_close" onclick="close_window()">
        </div>
        <iframe id="fc-myFrame" height="580" width="925" style="frameborder: 0; " scrolling="no" src=""></iframe>
    </div>
</div>

<div align="center">
    <button class="donate_button" onclick="open_window('MTUwOQ==')">DONATE</button>
</div>

<div align="center" class="footer-text">&copy;<?php echo date('Y'); ?>
    <a href="http://foodfinderga.org/" target="_blank">FoodFinderGA</a> | Follow Us On:
    <a href="https://twitter.com/FoodFinderGA" target="blank"><img
            src="<?php echo base_url(); ?>img/front/twitter_iconsm.png"/>
    </a>&nbsp;&nbsp;<a href="https://www.facebook.com/FoodFinderGA/" target="blank"><img
            src="<?php echo base_url(); ?>img/front/facebook_icon.png"/>
    </a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a id="about_us">About Us</a>&nbsp;&nbsp;&nbsp;
    |&nbsp;&nbsp;&nbsp;<a href="/welcome/our_story">Our Story</a>&nbsp;&nbsp;&nbsp;
    |&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>school/supporters">Supporters</a>
<!--    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="javascript:open_window('MTUwOQ==')">Donate</a>-->


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
