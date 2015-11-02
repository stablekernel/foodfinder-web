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
                <div style="clear:both;"></div>
                <div class="searchschool_form">
                    <form id="addgroup-form" name="home_form" method="post" novalidate='novalidate' class='validate'
                          accept-charset="utf-8">
                        <div align="center">
                            <?php
                            if (isset($_COOKIE["ff_homedata"]))
                                $hmedata = $_COOKIE['ff_homedata'];
                            else
                                $hmedata = '';
                            ?>
                            <p class="inputLabel">Find food resources close to your home</p>
                            <input placeholder="Enter your Street Address, City, Zip Code or County" type="text"
                                   value="<?php echo $hmedata; ?>" name="homeaddress" id="homeaddress"/>
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
    //$(document).ready(function(){
    //$("#submit").click(function(){
    //var cook=confirm("Do you want save the search data for further search?");
    //if(cook == true)
    //{
    //var cname=$("#homeaddress").val();
    //document.cookie="ff_homedata="+cname;
    //$("home_form").submit();
    //}
    //else
    //{
    //$("home_form").submit();
    //}
    //});
    //});
    function savecookie() {

        $(document).ready(function () {

            var cname = $("#homeaddress").val();
            document.cookie = "ff_homedata=" + cname;

        });
    }

    $(document).ready(function () {

        $('#homeaddress').change(function () {


            $.confirm({

                'message': 'Do you want to save this location as home ?',
                'buttons': {
                    'No': {
                        'action': function () {
                        }	// Nothing to do in this case. You can as well omit the action property.
                    },
                    'Yes': {
                        'action': function () {
                            savecookie();
                        }
                    }

                }
            });

        });

    });
</script>

