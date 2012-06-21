<?php include('/../left.php'); ?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/"
                                                                                        title="Upgrade to a better browser">upgrade</a>
                your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852"
                                   title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface
                properly.
                Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>添加推荐</h2>
    <!--<p id="page-intro">What would you like to do?</p>-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/home_recommend/recommendList"><span><br/> 推荐列表 </span></a>
        </li>
        <li><a class="shortcut-button" href="/administrator/home_recommend/recommendAdd"><span><br/> 添加推荐 </span></a>
        </li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>推荐添加</h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">添加今日推荐</a></li>
                <li><a href="#tab2">添加设计图推荐</a></li>
                <li><a href="#tab3">广告推荐</a></li>
                <li><a href="#tab4">男款T恤推荐</a></li>
                <li><a href="#tab5">女款T恤推荐</a></li>
                <li><a href="#tab6">情侣T恤推荐</a></li>
                <li><a href="#tab7">亲子T恤推荐</a></li>
                <li><a href="#tab8">设计师推荐</a></li>
                <li><a href="#tab9">首页转播图</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <form action="http://wunxin.com/administrator/product_category/save" method="post">
                    <img src="/images/recommend/day_recommend.png" alt="示例图"><b style="color: red;">示例图</b>
                    <hr/>
                    <fieldset>
                        <p>
                            <label>名称</label>
                            <input class="text-input small-input" type="text" value="" name="cname">
                            <br>
                        </p>

                        <p>
                            <label>图片</label>
                            <input class="text-input small-input" type="file" value="" name="img_addr">
                            <br>
                        </p>

                        <p>
                            <label>链接</label>
                            <input class="text-input small-input" type="text" value="" name="img_addr">
                            <br>
                        </p>
                        <input class="button" type="submit" value="Submit"/>
                    </fieldset>
                    <div class="clear"></div>
                </form>
            </div>
            <!-- End #tab1 -->
            <div class="tab-content" id="tab2">
                2
                <div class="clear"></div>
            </div>

            <div class="tab-content" id="tab3">
                3
                <div class="clear"></div>
            </div>

            <div class="tab-content" id="tab4">
                4
                <div class="clear"></div>
            </div>

            <div class="tab-content" id="tab5">
                5
                <div class="clear"></div>
            </div>

            <div class="tab-content" id="tab6">
                6
                <div class="clear"></div>
            </div>
            <div class="tab-content" id="tab7">
                7
                <div class="clear"></div>
            </div>

            <div class="tab-content" id="tab8">
                8
                <div class="clear"></div>
            </div>
            <div class="tab-content" id="tab9">
                9
                <div class="clear"></div>
            </div>
            <!-- End #tab2 -->
        </div>
        <!-- End .content-box-content -->
    </div>


    <!-- End .content-box -->
    <div class="clear"></div>

    <?php require(dirname(__FILE__) . '/../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
