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
        <li><a href="#tab1" class="default-tab">首页转播图</a></li>
        <li><a href="#tab2">添加今日推荐</a></li>
        <li><a href="#tab3">添加设计图推荐</a></li>
        <li><a href="#tab4">广告推荐</a></li>
        <li><a href="#tab5">男款T恤推荐</a></li>
        <li><a href="#tab6">女款T恤推荐</a></li>
        <li><a href="#tab7">情侣T恤推荐</a></li>
        <li><a href="#tab8">亲子T恤推荐</a></li>
        <li><a href="#tab9">设计师推荐</a></li>

    </ul>
    <div class="clear"></div>
</div>
<!-- End .content-box-header -->
<div class="content-box-content">

<div class="tab-content default-tab" id="tab1">
    <form action="/administrator/product_category/save" method="post">
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
                <input class="text-input small-input" type="text" value="" name="link">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort">
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>

        <div class="clear"></div>
    </form>
    <hr/>
    <br/>
    <img src="/images/recommend/broadcast.png" alt="示例图"><b style="color: red;">示例图</b>
    <div class="clear"></div>
</div>

<div class="tab-content" id="tab2">
    <form action="/administrator/product_category/save" method="post">
        <fieldset>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr">
                <br>
            </p>

            <p>
                <label>链接</label>
                <input class="text-input small-input" type="text" value="" name="link">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort">
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>
        <hr/>
        <img src="/images/recommend/day_recommend.png" alt="示例图"><b style="color: red;">示例图</b>

        <div class="clear"></div>
    </form>
</div>
<!-- End #tab1 -->
<div class="tab-content" id="tab3">
    <form action="/administrator/product_category/save" method="post">
        <p>
            <label>产品ID</label>
            <input class="text-input small-input" type="text" value="" name="pid"> 输入产品ID，用逗号分隔。如：1,2,3
            <br>
        </p>
        <input class="button" type="submit" value="Submit"/>
    </form>
    <hr/>
    <img src="/images/recommend/design.png" alt="示例图"><b style="color: red;">示例图</b>

    <div class="clear"></div>
</div>

<div class="tab-content" id="tab4">
    <form action="/administrator/product_category/save" method="post">

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
                <input class="text-input small-input" type="text" value="" name="link">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort">
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>
        <hr/>
        <img src="/images/recommend/ad.png" alt="示例图"><b style="color: red;">示例图</b>

        <div class="clear"></div>
    </form>
</div>

<div class="tab-content" id="tab5">
    <form action="/administrator/product_category/save" method="post">

        <fieldset>
            <p>
                <label>排放ID</label>
                <input class="text-input small-input" type="text" value="" name="emission">
                <br>
            </p>

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
                <input class="text-input small-input" type="text" value="" name="link">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid"> 输入产品ID，用逗号分隔。如：1,2,3
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>
        <div class="clear"></div>
    </form>
    <hr/>
    <img src="/images/recommend/man.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/> <b style="color: red;">Notes: 如果排放ID为3，只需要填写产品ID即可。</b>

    <div class="clear"></div>
</div>

<div class="tab-content" id="tab6">
    <form action="/administrator/product_category/save" method="post">

        <fieldset>
            <p>
                <label>排放ID</label>
                <input class="text-input small-input" type="text" value="" name="emission">
                <br>
            </p>

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
                <input class="text-input small-input" type="text" value="" name="link">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid"> 输入产品ID，用逗号分隔。如：1,2,3
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>
        <div class="clear"></div>
    </form>
    <hr/>
    <br/>
    <img src="/images/recommend/woman.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/><b style="color: red;">Notes: 如果排放ID为5，只需要填写产品ID即可。</b> <br/>

    <div class="clear"></div>
</div>

<div class="tab-content" id="tab7">
    <form action="/administrator/product_category/save" method="post">
        <fieldset>
            <p>
                <label>排放ID</label>
                <input class="text-input small-input" type="text" value="" name="emission">
                <br>
            </p>

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
                <input class="text-input small-input" type="text" value="" name="link">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid"> 输入产品ID，用逗号分隔。如：1,2,3
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>

        <div class="clear"></div>
    </form>
    <hr/>
    <br/>
    <img src="/images/recommend/lover.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/><b style="color: red;">Notes: 如果排放ID为2，只需要填写产品ID即可。</b> <br/>

    <div class="clear"></div>
</div>
<div class="tab-content" id="tab8">
    <form action="/administrator/product_category/save" method="post">
        <fieldset>
            <p>
                <label>排放ID</label>
                <input class="text-input small-input" type="text" value="" name="emission">
                <br>
            </p>

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
                <input class="text-input small-input" type="text" value="" name="link">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid"> 输入产品ID，用逗号分隔。如：1,2,3
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>

        <div class="clear"></div>
    </form>
    <hr/>
    <br/>
    <img src="/images/recommend/family.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/><b style="color: red;">Notes: 如果排放ID为8，只需要填写产品ID即可。</b> <br/>

    <div class="clear"></div>
</div>

<div class="tab-content" id="tab9">
    <form action="/administrator/product_category/save" method="post">
        <fieldset>
            <p>
                <label>设计师ID</label>
                <input class="text-input small-input" type="text" value="" name="pid">输入设计师ID,以逗号分隔，如：1,2,3
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>

        <div class="clear"></div>
    </form>
    <hr/>
    <br/>
    <img src="/images/recommend/designer.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/><b style="color: red;">Notes: 如果排放ID为8，只需要填写产品ID即可。</b> <br/>

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
