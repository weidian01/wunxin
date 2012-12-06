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
                interface properly.
                Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>添加淘宝产品链接</h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/tool/crawlProductAdd"><span><br/> 添加产品链接 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/tool/crawlProductList"><span><br/> 产品链接列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加淘宝产品链接</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=config_item('base_url')?>administrator/tool/crawlProductSave" method="post">
                    <input type="hidden" name="id" value="<?=isset($info['id']) ? $info['id'] : ''?>">
                    <input type="hidden" name="current_page" value="<?=isset($current_page) ? $current_page : '';?>"/>
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>链接地址</label>
                            <input class="text-input medium-input" type="text" value="<?=isset($info['url']) ? $info['url'] : ''?>" name="url"/>
                            <br/>
                            <?php if (isset ($info['url'])) {?>
                            <a href="<?=$info['url']?>" target="_blank"><?=$info['url']?></a>
                            <?php }?>
                        </p>
                        <p>
                            <label>号码类别</label>
                            <select name="size_type">
                                <?php foreach(config_item('size_type') as $k => $v):?>
                                <option value="<?=$k?>" <?php if(isset($info['size_type']) && $info['size_type'] == $k):?>selected="selected"<?php endif;?>><?=$v?></option>
                                <?php endforeach;?>
                            </select>
                        </p>
                        <p>
                            <label>更新标记</label>
                            <select name="up_flag">
                                <?php foreach ($up_flag as $k=>$v) {?>
                                <!--<option value="<?=$k;?>" <?=(isset ($info['up_flag']) && $k == $info['up_flag']) ? 'selected="selected"' : '' ?>><?=$v;?></option>-->
                                <option value="<?=$k;?>"><?=$v;?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p>
                            <label>品牌</label>
                            <select name="bid">
                                <?php foreach ($brand as $v) {?>
                                <option value="<?=$v['bid']?>" <?=(isset($info['bid'])) && ($v['bid'] == $info['bid']) ? 'selected="selected"' : '';?>><?=$v['name']?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p>
                            <label>分类</label>
                            <select name="cid">
                                <?php foreach ($class as $item): ?>
                                <option value="<?=$item['class_id']?>" <?php if(isset($info['cid']) && $info['cid']==$item['class_id'] ){echo 'selected="selected"';}?>>
                                    <?=str_repeat("&nbsp;", $item['floor']). $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>
                        <p>
                            <input class="button" type="submit" value="Submit"/>
                        </p>
                    </fieldset>
                    <div class="clear"></div>
                    <!-- End .clear -->
                </form>
            </div>
            <!-- End #tab2 -->
        </div>
        <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->

    <!-- <div class="clear"></div> -->
    <?php include(APPPATH.'views/administrator/footer.php');?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
<script>
    $(function () {
        var editor0 = KindEditor.create('textarea[name="specification"]', {
            uploadJson:'/administrator/attached/upload',
            fileManagerJson:'/administrator/attached/manager',
            resizeType:1,
            allowPreviewEmoticons:false,
            allowFileManager:true,
            allowImageUpload:true,
            items:[
                'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
        });

        var editor1 = KindEditor.create('textarea[name="descr"]', {
            uploadJson:'/administrator/attached/upload',
            fileManagerJson:'/administrator/attached/manager',
            resizeType:1,
            allowPreviewEmoticons:false,
            allowFileManager:true,
            allowImageUpload:true,
            items:[
                'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
        });
    });
</script>