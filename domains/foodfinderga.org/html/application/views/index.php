<div class="full-wdith">
    <div class="desktop-bg">
        <div class="login-bg">
            <div style="padding-top:3%;padding-bottom: 2%;" align="center"><a href="<?php echo base_url(); ?>"><img
                        src="<?php echo base_url(); ?>img/front/logo.png" border="0" class="img-responsive"></a></div>
            <div align="center" class="homefont">Welcome to Food Finder GA</div>
            <div align="center" class="homefont1">
                The Fastest Way to Find Food Resources in Georgia
            </div>

            <div class="footer-bg clearfix">
                <div align="center" class="homefont2">Click or Tap a Button To Find Food Near Your:</div>
                <div id="mainNav" class="icon_layout_outer">
                    <div class="icon_layout_inner">
                        <div class="icon_div"><a href="<?php echo site_url('school'); ?>"><img
                                    src="<?php echo base_url(); ?>img/front/school_new.png" border="0">School</a></div>
                        <div class="icon_div"><a href="<?php echo site_url('school/homeway'); ?>"><img
                                    src="<?php echo base_url(); ?>img/front/home_new.png" border="0">Home</a></div>
                        <!--                   <div class="icon_div"><a href="<?php //echo site_url('school/locationway'); ?>"><img src="<?php //echo base_url(); ?>img/front/location.png" border="0""></a></div> -->
                        <div class="icon_div"><a href="<?php echo site_url('school/locationway'); ?>"><img
                                    src="<?php echo base_url(); ?>img/front/location_new.png" border="0">Current
                                Location</a></div>

                        <div style="clear:both"></div>


                    </div>
                    <!-- Home responsive slider start -->
                    <div id="img-grp-wrap">
                        <div class="container">
                            <div class="slider_wrapper">
                                <ul id="image_slider">
                                    <a href="<?php echo site_url('school'); ?>">
                                        <li><img src="<?php echo base_url(); ?>img/front/school_slider.png"></li>
                                    </a>
                                    <a href="<?php echo site_url('school/homeway'); ?>">
                                        <li><img src="<?php echo base_url(); ?>img/front/home_slider.png"></li>
                                    </a>
                                    <a href="<?php echo site_url('school/locationway'); ?>">
                                        <li><img src="<?php echo base_url(); ?>img/front/location_slider.png"></li>
                                    </a>
                                </ul>
                                <span class="nvgt" id="prev"></span>
                                <span class="nvgt" id="next"></span>
                            </div>
                            <ul id="pager">
                            </ul>
                        </div>

                    </div>
                    <!-- slider end -->
                </div>
                <?php include('footer_menu.php'); ?>
            </div>
        </div>
    </div>
</div>
<!-- <a href="https://twitter.com/FoodFinderGA" target="_blank" id="fixed-div" style="top:0; right:0; border:0; display:block;"><img src="<?php // echo base_url(); ?>img/front/twitter.png" alt="twitter"></a> -->

<script>


    //1. set ul width
    //2. image when click prev/next button
    var ul;
    var liItems;
    var imageNumber;
    var imageWidth;
    var prev, next;
    var currentPostion = 0;
    var currentImage = 0;


    function init() {
        ul = document.getElementById('image_slider');
        liItems = ul.children;
        imageNumber = liItems.length;
        imageWidth = liItems[0].children[0].clientWidth;
        ul.style.width = parseInt(imageWidth * imageNumber) + 'px';
        prev = document.getElementById("prev");
        next = document.getElementById("next");
        generatePager(imageNumber);
        //.onclike = slide(-1) will be fired when onload;
        /*
         prev.onclick = function(){slide(-1);};
         next.onclick = function(){slide(1);};*/
        prev.onclick = function () {
            onClickPrev();
        };
        next.onclick = function () {
            onClickNext();
        };
    }

    function animate(opts) {
        var start = new Date;
        var id = setInterval(function () {
            var timePassed = new Date - start;
            var progress = timePassed / opts.duration;
            if (progress > 1) {
                progress = 1;
            }
            var delta = opts.delta(progress);
            opts.step(delta);
            if (progress == 1) {
                clearInterval(id);
                opts.callback();
            }
        }, opts.delay || 17);
        //return id;
    }

    function slideTo(imageToGo) {
        var direction;
        var numOfImageToGo = Math.abs(imageToGo - currentImage);
        // slide toward left

        direction = currentImage > imageToGo ? 1 : -1;
        currentPostion = -1 * currentImage * imageWidth;
        var opts = {
            duration: 1000,
            delta: function (p) {
                return p;
            },
            step: function (delta) {
                ul.style.left = parseInt(currentPostion + direction * delta * imageWidth * numOfImageToGo) + 'px';
            },
            callback: function () {
                currentImage = imageToGo;
            }
        };
        animate(opts);
    }

    function onClickPrev() {
        if (currentImage == 0) {
            slideTo(imageNumber - 1);
        }
        else {
            slideTo(currentImage - 1);
        }
    }

    function onClickNext() {
        if (currentImage == imageNumber - 1) {
            slideTo(0);
        }
        else {
            slideTo(currentImage + 1);
        }
    }

    function generatePager(imageNumber) {
        var pageNumber;
        var pagerDiv = document.getElementById('pager');
        for (i = 0; i < imageNumber; i++) {
            var li = document.createElement('li');
            pageNumber = document.createTextNode(parseInt(i + 1));
            li.appendChild(pageNumber);
            pagerDiv.appendChild(li);
            // add event inside a loop, closure issue.
            li.onclick = function (i) {
                return function () {
                    slideTo(i);
                }
            }(i);
        }
        var computedStyle = document.defaultView.getComputedStyle(li, null);
        //border width 1px; offsetWidth = 22
        var liWidth = parseInt(li.offsetWidth);
        var liMargin = parseInt(computedStyle.margin.replace('px', ""));
        pagerDiv.style.width = parseInt((liWidth + liMargin * 2) * imageNumber) + 'px';
    }
    window.onload = init;

</script>
