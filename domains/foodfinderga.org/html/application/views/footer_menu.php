<div align="center" class="footer-text">&copy;<?php echo date('Y');?> <a href="http://foodfinderga.org/" target="_blank">FoodFinderGA</a> | Follow Us On: <a href="https://twitter.com/FoodFinderGA" target="blank"><img src="<?php echo base_url(); ?>img/front/twitter_iconsm.png"/></a>&nbsp;&nbsp;<a href="https://www.facebook.com/FoodFinderGA/" target="blank"><img src="<?php echo base_url(); ?>img/front/facebook_icon.png"/></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a id="about_us">About Us</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="/welcome/our_story">Our Story</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>school/supporters">Supporters</a></div>
<div align="center" class="menu_toggle">
    <a  href="<?php echo base_url(); ?>school/terms_conditions" id="about_us">Terms & conditions </a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>school/privacypolicy"  class="cont_focus">Privacy Policy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>school/contactus">Contact Us</a>
</div>
<script>
 $(document).ready(function(){
     $('#about_us').click(function(){
         $('.menu_toggle').toggle();
         $('.cont_focus').focus();
     });
 });    
</script>
