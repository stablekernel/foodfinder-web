<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div class="schoolresult_page">
                <div class="wrap_height">
                    <div class="back_icon"><a href="<?php echo base_url(); ?>school"><img
                                src="<?php echo base_url(); ?>img/front/close.png" alt="close" width="80%" height="80%"></a>
                    </div>
                    <div class="home_iconn"><a href="<?php echo base_url(); ?>"><img
                                src="<?php echo base_url(); ?>img/front/homeicon.png"/></a></div>
                    <div class="searchresult_title">
                        <?php if (!empty($searchresult)) { ?>Great! Here are your results.<br/>
                            Click on your school to see resources nearby...<?php } ?>
                    </div>
                    <div class="searchresultstab">
                        <li class="searchresults_header">School Name: <?php echo $searchdata; ?></li>
                        <?php
                        if (empty($searchresult)) {
                            echo "<li class='searchresults'>The school you searched for was not found. Please enter the school name you are searching for.</li>";
                        } else {
                            for ($t = 0; $t < count($searchresult); $t++) { ?>
                                <a href="<?php echo base_url(); ?>school/schoolmap/<?php echo $searchresult[$t]["school_id"]; ?>/<?php echo $searchresult[$t]["school_name"]; ?>/<?php echo $searchresult[$t]["latitude"]; ?>/<?php echo $searchresult[$t]["longitude"]; ?>">
                                    <li class="searchresults"><?php echo $searchresult[$t]["school_name"]; ?></li>
                                </a>
                            <?php }
                        } ?>
                    </div>
                    <div style="clear:both; height:20px;"><!-- --></div>
                </div>
                <?php include('footer_menu.php'); ?>
            </div>
        </div>
        <div style="clear:both;"><!-- --></div>
    </div>
</div>
