<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div class="schoolresultmap_page">
                <div class="back_icon"><a style="cursor:pointer" href="<?php echo base_url(); ?>school"
                                          class="closebtn"><img src="<?php echo base_url(); ?>img/front/close.png"
                                                                alt="close" width="80%" height="80%"></a></div>
                <div class="home_iconn"><a href="<?php echo base_url(); ?>"><img
                            src="<?php echo base_url(); ?>img/front/homeicon.png"/></a></div>
                <div style="padding-top:3px;" align="center"></div>
                <div class="schoolresult_map clearfix">
                    <form action="<?php echo site_url(); ?>school" method="post" class="schoolform"><input type="hidden"
                                                                                                           value="<?php echo $this->session->userdata('searchedschool'); ?>"
                                                                                                           class="n1"
                                                                                                           name="schooladdress"/>
                    </form> <?php echo $map['js']; ?>            <?php echo $map['html']; ?>
                    <div class="radius_wrap">
                        <div class="radius_wrap_left"><?php echo $searchdata ?></div>
                        <div class="radius_wrap_right">
                            <form action="" method="post" class=""> Radius&nbsp;&nbsp;&nbsp;<input type="text" value="5"
                                                                                                   id="map_radius"
                                                                                                   name="radius"
                                                                                                   title="Enter the radius for your search"/>&nbsp;&nbsp;mi
                                <input type="hidden" value="<?php echo $latit ?>" id="latit" name="latit"/> <input
                                    type="hidden" value="<?php echo $longit ?>" id="longit" name="longit"/> <input
                                    type="hidden" value="<?php echo $searchdata ?>" id="search_data"
                                    name="search_data"/></form>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
                <div style="clear:both; height:20px;"><!-- --></div> <?php include('footer_menu.php'); ?>        </div>
        </div>
        <div style="clear:both;"><!-- --></div>
    </div>
</div>
<script>$(document).ready(function () {
        $(".closebtn").click(function () {
            $(".schoolform").submit();
        });
        $("#map_radius").keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == 13) {
                var radius_data = $(this).val();
                var latit = $('#latit').val();
                var longit = $('#longit').val();
                var search_data = $('#search_data').val();
                var formdata = {"radius": radius_data, "latit": latit, "longit": longit, "search_data": search_data};
                $.ajax({
                    url: '<?php echo site_url();?>school/homeway_radius',
                    data: formdata,
                    type: 'POST',
                    success: function (res) {
                        var data = res;
                        initialize(data);
                    }
                });
                event.preventDefault();
            }
        });
        $("#map_radius").change(function () {
            var radius_data = $(this).val();
            var latit = $('#latit').val();
            var longit = $('#longit').val();
            var search_data = $('#search_data').val();
            var formdata = {"radius": radius_data, "latit": latit, "longit": longit, "search_data": search_data};
            $.ajax({
                url: '<?php echo site_url();?>school/homeway_radius',
                data: formdata,
                type: 'POST',
                success: function (res) {
                    var data = res;
                    initialize(data);
                }
            });
        });
    });
    function initialize(res) {
        var data = eval("(" + res + ")");
        var cradius = data['rad'];
        var clatit = data['latit'];
        var clongit = data['longit'];
        var cname = data['searchdata'];
        var myLatlng = new google.maps.LatLng(clatit, clongit);
        var mapOptions = {zoom: 10, center: myLatlng};
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        var image = '<?php echo base_url();?>img/centermark.png';
        var marker = new google.maps.Marker({position: myLatlng, map: map, click: cname, icon: image});
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(cname);
                infowindow.open(map, marker);
            }
        })(marker, i));
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for (i = 0; i < data.allprovider.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(data.allprovider[i]['latitude'], data.allprovider[i]['longitude']),
                map: map
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    $clicklink = "<a href='<?php echo base_url();?>school/providerdetails_home/" + data.allprovider[i]['provider_id'] + "'>" + data.allprovider[i]['providername'] + "</a>";
                    infowindow.setContent($clicklink);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }</script>