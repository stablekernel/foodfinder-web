<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div style="padding-top:31px;" align="center"><a href="<?php echo base_url(); ?>"><img
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
                    <form id="addgroup-form" method="post" novalidate='novalidate' class='validate'
                          accept-charset="utf-8">
                        <div align="center">
                            <input type="text" value="" placeholder="Enter your school name here" name="schooladdress"
                                   id="schooladdress" onchange="return tempschooladdress();"
                                   onblur="return tempschooladdress();" onkeyup="return tempschooladdress();"
                                   onfocus="return tempschooladdress();"/>

                            <input type="hidden" name="school_id" id="school_id">
                            <input type="hidden" name="school_name" id="school_name">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">

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
    $("#schooladdress").autocomplete({
        source: "school/testdata",
        select: function (event, ui) {
            if (ui.item) {


                $.ajax({
                    url: "<?php echo base_url();?>school/list_schooladdress",
                    data: {schooladdress: ui.item.value},
                    dataType: "json",
                    type: "POST",
                    success: function (resp) {
                        $("#school_id").val(resp.school_id);
                        $("#school_name").val(resp.school_name);
                        $("#latitude").val(resp.latitude);
                        $("#longitude").val(resp.longitude);

                    }
                });
            }

        }
    });
    function tempschooladdress() {
        var schooladdress = $("#schooladdress").val();
        $.ajax({
            url: "<?php echo base_url();?>school/list_schooladdress",
            data: {schooladdress: $("#schooladdress").val()},
            dataType: "json",
            type: "POST",
            success: function (resp) {
                $("#school_id").val(resp.school_id);
                $("#school_name").val(resp.school_name);
                $("#latitude").val(resp.latitude);
                $("#longitude").val(resp.longitude);

            }
        });

    }
    $('body').on('click', 'a.ui-corner-all', function (evt) {
        evt.preventDefault();

    });
</script>