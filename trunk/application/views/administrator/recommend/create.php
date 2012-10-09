<?php include(APPPATH.'views/administrator/left.php');?>
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
    <li><a class="shortcut-button" href="/administrator/recommend_home/recommendList"><span><br/> 推荐列表 </span></a>
    </li>
    <li><a class="shortcut-button" href="/administrator/recommend_home/recommendAdd"><span><br/> 添加推荐 </span></a>
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
        <li><a href="#tab10">搜索关键字推荐</a></li>

    </ul>
    <div class="clear"></div>
</div>
<!-- End .content-box-header -->
<div class="content-box-content">

<div class="tab-content default-tab" id="tab1">
    <form action="/administrator/recommend_home/broadcastRecommendSave" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr"> 尺寸：696*400
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
    <form action="/administrator/recommend_home/dayRecommendSave" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr"> 尺寸：95*120
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
    <form action="/administrator/recommend_home/designRecommendSave" method="post">
        <p>
            <label>产品ID</label>
            <input class="text-input small-input" type="text" value="" name="pid"> 输入产品ID，用逗号分隔。如：1,2,3
            <br>
        </p>

        <p>
            <label>排序</label>
            <input class="text-input small-input" type="text" value="" name="sort">
            <br>
        </p>
        <input class="button" type="submit" value="Submit"/>
    </form>
    <hr/>
    <img src="/images/recommend/design.png" alt="示例图"><b style="color: red;">示例图</b>

    <div class="clear"></div>
</div>

<div class="tab-content" id="tab4">
    <form action="/administrator/recommend_home/adRecommendSave" method="post" enctype="multipart/form-data">

        <fieldset>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr"> 尺寸：978*200
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
    <form action="/administrator/recommend_home/manRecommendSave" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label>排放ID</label>
                <!--<input class="text-input small-input" type="text" value="" name="emission">-->
                <select name="emission" onchange="manFormChanage(this)">
                    <option value="1">排放ID1</option>
                    <option value="2">排放ID2</option>
                    <option value="3">排放ID3</option>
                    <option value="4">排放ID4</option>
                </select>
                <br>
            </p>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name" id="man_name_id">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr" id="man_img_addr_id">
                <br>
            </p>

            <p>
                <label>链接</label>
                <input class="text-input small-input" type="text" value="" name="link" id="man_link_id">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort" id="man_sort_id">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid" id="man_pid_id">
                输入产品ID，用逗号分隔。如：1,2,3
                <br>
            </p>
            <input class="button" type="submit" value="Submit"/>
        </fieldset>
        <div class="clear"></div>
    </form>
    <hr/>
    <img src="/images/recommend/man.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/> <b style="color: red;">Notes: 如果排放ID为1或4，只需要填写产品ID即可。</b>

    <div class="clear"></div>
</div>

<div class="tab-content" id="tab6">
    <form action="/administrator/recommend_home/womanRecommendSave" method="post" enctype="multipart/form-data">

        <fieldset>
            <p>
                <label>排放ID</label>
                <select name="emission" onchange="womanFormChanage(this)">
                    <option value="1">排放ID1</option>
                    <option value="2">排放ID2</option>
                    <option value="3">排放ID3</option>
                    <option value="4">排放ID4</option>
                    <option value="5">排放ID5</option>
                    <option value="6">排放ID6</option>
                    <option value="7">排放ID7</option>
                </select>
                <br>
            </p>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name" id="woman_name_id">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr" id="woman_img_addr_id">
                <br>
            </p>

            <p>
                <label>链接</label>
                <input class="text-input small-input" type="text" value="" name="link" id="woman_link_id">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort" id="woman_sort_id">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid" id="woman_pid_id">
                输入产品ID，用逗号分隔。如：1,2,3
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
    <form action="/administrator/recommend_home/loverRecommendSave" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label>排放ID</label>
                <select name="emission" onchange="loverFormChanage(this)">
                    <option value="1">排放ID1</option>
                    <option value="2">排放ID2</option>
                </select>
                <br>
            </p>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name" id="lover_name_id">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr" id="lover_img_addr_id"> 尺寸：948*299
                <br>
            </p>

            <p>
                <label>链接</label>
                <input class="text-input small-input" type="text" value="" name="link" id="lover_link_id">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort" id="lover_sort_id">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid" id="lover_pid_id">
                输入产品ID，用逗号分隔。如：1,2,3
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
    <form action="/administrator/recommend_home/familyRecommendSave" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label>排放ID</label>
                <select name="emission" onchange="familyFormChanage(this)">
                    <option value="1">排放ID1</option>
                    <option value="2">排放ID2</option>
                    <option value="3">排放ID3</option>
                    <option value="4">排放ID4</option>
                    <option value="5">排放ID5</option>
                    <option value="6">排放ID6</option>
                    <option value="7">排放ID7</option>
                    <option value="8">排放ID8</option>
                </select>
                <br>
            </p>
            <p>
                <label>名称</label>
                <input class="text-input small-input" type="text" value="" name="name" id="family_name_id">
                <br>
            </p>

            <p>
                <label>图片</label>
                <input class="text-input small-input" type="file" value="" name="img_addr" id="family_img_addr_id">
                <br>
            </p>

            <p>
                <label>链接</label>
                <input class="text-input small-input" type="text" value="" name="link" id="family_link_id">
                <br>
            </p>

            <p>
                <label>排序</label>
                <input class="text-input small-input" type="text" value="" name="sort" id="family_sort_id">
                <br>
            </p>

            <p>
                <label>产品ID</label>
                <input class="text-input small-input" type="text" value="" name="pid" id="family_pid_id">
                输入产品ID，用逗号分隔。如：1,2,3
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
    <form action="/administrator/recommend_home/designerRecommendSave" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label>设计师ID</label>
                <input class="text-input small-input" type="text" value="" name="pid">输入设计师ID,以逗号分隔，如：1,2,3
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
    <img src="/images/recommend/designer.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/><b style="color: red;"><!--Notes: 如果排放ID为8，只需要填写产品ID即可。--></b> <br/>

    <div class="clear"></div>
</div>

<div class="tab-content" id="tab10">
    <form action="/administrator/recommend_home/keywordRecommendSave" method="post" enctype="multipart/form-data">
        <fieldset>
            <p>
                <label>关键字</label>
                <input class="text-input small-input" type="text" value="" name="keyword">输入搜索关键字，如：T恤，卫衣
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
    <img src="/images/recommend/search_keyword.png" alt="示例图"><b style="color: red;">示例图</b>
    <br/><b style="color: red;"><!--Notes: 如果排放ID为8，只需要填写产品ID即可。--></b> <br/>

    <div class="clear"></div>
</div>

<!-- End #tab2 -->
</div>
<!-- End .content-box-content -->
</div>


<!-- End .content-box -->
<div class="clear"></div>

<?php include(APPPATH.'views/administrator/footer.php');?>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<script type="text/javascript">
    function manFormChanage(v) {
        var mName = document.getElementById('man_name_id');
        var mImgAddr = document.getElementById('man_img_addr_id');
        var mLink = document.getElementById('man_link_id');
        var mSort = document.getElementById('man_sort_id');
        var mPid = document.getElementById('man_pid_id');
        if (v == null) {
            mName.setAttribute('disabled', 'disabled');
            mImgAddr.setAttribute('disabled', 'disabled');
            mLink.setAttribute('disabled', 'disabled');
            mSort.setAttribute('disabled', 'disabled');
            mPid.removeAttribute('disabled');
            return;
        }
        switch (v.value) {
            case '1':
                mName.setAttribute('disabled', 'disabled');
                mImgAddr.setAttribute('disabled', 'disabled');
                mLink.setAttribute('disabled', 'disabled');
                mSort.setAttribute('disabled', 'disabled');
                mPid.removeAttribute('disabled');
                break;
            case '2':
                mName.removeAttribute('disabled');
                mImgAddr.removeAttribute('disabled');
                mLink.removeAttribute('disabled');
                mSort.removeAttribute('disabled');
                mPid.setAttribute('disabled', 'disabled');
                break;
            case '3':
                mName.removeAttribute('disabled');
                mImgAddr.removeAttribute('disabled');
                mLink.removeAttribute('disabled');
                mSort.removeAttribute('disabled');
                mPid.setAttribute('disabled', 'disabled');
                break;
            case '4':
                mName.setAttribute('disabled', 'disabled');
                mImgAddr.setAttribute('disabled', 'disabled');
                mLink.setAttribute('disabled', 'disabled');
                mSort.setAttribute('disabled', 'disabled');
                mPid.removeAttribute('disabled');
                break;
        }
    }
    manFormChanage();

    function womanFormChanage(v) {
        var wmName = document.getElementById('woman_name_id');
        var wmImgAddr = document.getElementById('woman_img_addr_id');
        var wmLink = document.getElementById('woman_link_id');
        var wmSort = document.getElementById('woman_sort_id');
        var wmPid = document.getElementById('woman_pid_id');
        if (v == null) {
            wmName.removeAttribute('disabled');
            wmImgAddr.removeAttribute('disabled');
            wmLink.removeAttribute('disabled');
            wmSort.removeAttribute('disabled');
            wmPid.setAttribute('disabled', 'disabled');
            return
        }

        if (v.value == '7') {
            wmName.setAttribute('disabled', 'disabled');
            wmImgAddr.setAttribute('disabled', 'disabled');
            wmLink.setAttribute('disabled', 'disabled');
            wmSort.setAttribute('disabled', 'disabled');
            wmPid.removeAttribute('disabled');
        } else {
            wmName.removeAttribute('disabled');
            wmImgAddr.removeAttribute('disabled');
            wmLink.removeAttribute('disabled');
            wmSort.removeAttribute('disabled');
            wmPid.setAttribute('disabled', 'disabled');
        }
    }
    womanFormChanage();

    function loverFormChanage(v) {
        var lName = document.getElementById('lover_name_id');
        var lImgAddr = document.getElementById('lover_img_addr_id');
        var lLink = document.getElementById('lover_link_id');
        var lSort = document.getElementById('lover_sort_id');
        var lPid = document.getElementById('lover_pid_id');

        if (v == null) {
            lName.removeAttribute('disabled');
            lImgAddr.removeAttribute('disabled');
            lLink.removeAttribute('disabled');
            lSort.removeAttribute('disabled');
            lPid.setAttribute('disabled', 'disabled');
            return
        }

        if (v.value == 2) {
            lName.setAttribute('disabled', 'disabled');
            lImgAddr.setAttribute('disabled', 'disabled');
            lLink.setAttribute('disabled', 'disabled');
            lSort.setAttribute('disabled', 'disabled');
            lPid.removeAttribute('disabled');
        } else {
            lName.removeAttribute('disabled');
            lImgAddr.removeAttribute('disabled');
            lLink.removeAttribute('disabled');
            lSort.removeAttribute('disabled');
            lPid.setAttribute('disabled', 'disabled');
        }
    }
    loverFormChanage();

    function familyFormChanage(v) {
        var fName = document.getElementById('family_name_id');
        var fImgAddr = document.getElementById('family_img_addr_id');
        var fLink = document.getElementById('family_link_id');
        var fSort = document.getElementById('family_sort_id');
        var fPid = document.getElementById('family_pid_id');

        if (v == null) {
            fName.removeAttribute('disabled');
            fImgAddr.removeAttribute('disabled');
            fLink.removeAttribute('disabled');
            fSort.removeAttribute('disabled');
            fPid.setAttribute('disabled', 'disabled');
            return
        }

        if (v.value == 8) {
            fName.setAttribute('disabled', 'disabled');
            fImgAddr.setAttribute('disabled', 'disabled');
            fLink.setAttribute('disabled', 'disabled');
            fSort.setAttribute('disabled', 'disabled');
            fPid.removeAttribute('disabled');
        } else {
            fName.removeAttribute('disabled');
            fImgAddr.removeAttribute('disabled');
            fLink.removeAttribute('disabled');
            fSort.removeAttribute('disabled');
            fPid.setAttribute('disabled', 'disabled');
        }
    }
    familyFormChanage();

</script>