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
    <h2><?php echo $type == 'edit' ? '编辑限时抢购' : '添加限时抢购'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/create"><span><br/> 添加限时抢购 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/lists"><span><br/> 限时抢购列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/c_list"><span><br/> 限时抢购<br/>分类列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_limit_buy/c_create"><span><br/> 限时抢购<br/>分类添加 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3><?php echo $type == 'edit' ? '编辑限时抢购' : '添加限时抢购'; ?></h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=$type == 'edit' ? '/administrator/business_limit_buy/edit_save' : '/administrator/business_limit_buy/save';?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=isset($info['id']) ? $info['id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>分类</label>
                            <select name="cid" style="width: 400px;">
                                <option value="0">默认</option>
                                <?php foreach ($category as $item): ?>
                                <option value="<?=$item['id']?>" <?php if (isset($info['cid']) && $info['cid'] == $item['id']) { echo 'selected="selected"'; }?>>
                                    <?php echo str_repeat("&nbsp;", $item['floor']), $item['name']?>
                                </option>
                                <?php endforeach;?>
                            </select><br/>
                        </p>
                        <p>
                            <label>销售状态</label>
                            <select name="sales_status" style="width: 400px;">
                                <option value="1" <?=(isset ($info['sales_status']) && $info['sales_status']  == '1') ? 'selected="selected"' : '';?>>疯抢</option>
                                <option value="2" <?=(isset ($info['sales_status']) && $info['sales_status']  == '2') ? 'selected="selected"' : '';?>>包邮</option>
                                <option value="3" <?=(isset ($info['sales_status']) && $info['sales_status']  == '3') ? 'selected="selected"' : '';?>>热卖</option>
                                <option value="4" <?=(isset ($info['sales_status']) && $info['sales_status']  == '4') ? 'selected="selected"' : '';?>>新品</option>
                            </select><br/>
                        </p>
                        <p>
                            <label>产品ID</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['pid']) ? $info['pid'] : ''?>" name="pid" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>产品名称</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['pname']) ? $info['pname'] : ''?>" name="pname"/>
                            <br/>
                        </p>
                        <p>
                            <label>产品图片</label>
                            <input class="text-input small-input" type="file" name="product_image"/>
                            <?php echo isset ($info['product_image']) ? '<img src="'.base_url(). str_replace('\\', '/', $info['product_image']) .'" alt="'.$info['pname'].'" width="50" height="50"/>' : '';?>
                            如不上传，则使用产品默认图片
                        </p>
                        <p>
                            <label>抢购价格</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['limit_buy_price']) ? $info['limit_buy_price'] : ''?>" name="limit_buy_price" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            价格单位为分,如：350.38元，填写：35038
                            <br/>
                        </p>
                        <p>
                            <label>库存量</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['inventory']) ? $info['inventory'] : ''?>" name="inventory" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>排序</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['sort']) ? $info['sort'] : ''?>" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>开始时间</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['start_time']) ? $info['start_time'] : ''?>" name="start_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            <br/>
                        </p>
                        <p>
                            <label>结束时间</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['end_time']) ? $info['end_time'] : ''?>" name="end_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            <br/>
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

    <div class="clear"></div>

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
    var editor = KindEditor.create('textarea[name="detail"]', {
        //uploadJson:'/plug/kindeditor-4.1.1/php/upload_json.php',
        uploadJson:'/administrator/attached/upload',
        //fileManagerJson:'/plug/kindeditor-4.1.1/php/file_manager_json.php',
        fileManagerJson:'/administrator/attached/manager',
        resizeType:1,
        allowPreviewEmoticons:false,
        allowFileManager:true,
        allowImageUpload:true,
        items:[
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
    });
});

</script>