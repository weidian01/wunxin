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
    <h2><?=$type == 'edit' ? '编辑促销活动' : '添加促销活动'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion/create"><span><br/> 添加促销 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion/lists"><span><br/> 促销列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion_category/lists"><span><br/> 促销分类列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion_product/lists"><span><br/> 促销产品列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3><?=$type == 'edit' ? '编辑促销活动' : '添加促销活动'; ?></h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <span style="color: red;"><b>注意：如果"促销范围"选择"特定产品"，则"结算方式"必须选择为"针对产品"</b></span>
                <form action="/administrator/business_promotion/save" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="promotion_id" value="<?=isset($info['promotion_id']) ? $info['promotion_id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>活动名称</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['name']) ? $info['name'] : ''?>" name="name"/>
                            活动名称最好能直接表达活动的规则,请写10个字以上。
                            <br/>
                        </p>
                        <p>
                            <label>促销类型</label>
                            <select name="promotion_type" style="width: 400px;" id="promotion_type" onchange="promotion.init(this.value)">

                            </select>此处用来选择不同类型的活动
                            <br/>
                        </p>
                        <p>
                            <label>活动规则</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['rule']) ? $info['rule'] : ''?>" name="rule" id="rule_id"/>
                            <span id="rule_notice"></span>
                            <br/>
                        </p>
                        <p>
                            <label>促销范围</label>
                            <select name="promotion_range" style="width: 400px;">
                                <?php foreach ($promotion_range as $prk=>$prv): ?>
                                <option value="<?=$prk;?>" <?php if (isset($info['promotion_range']) && $info['promotion_range'] == $prk) { echo 'selected="selected"'; }?>>
                                    <?=$prv;?>
                                </option>
                                <?php endforeach;?>
                            </select>此处用来指定范围，是全场的产品，还是某此产品，如果是某些产品，则添加完活动后，添加相应产品。<br/>
                        </p>
                        <p>
                            <label>是否并列</label>
                            <select name="is_juxtaposed" style="width: 400px;">
                                <?php foreach ($promotion_juxtaposed as $pjk=>$pjv): ?>
                                <option value="<?=$pjk;?>" <?php if (isset($info['is_juxtaposed']) && $info['is_juxtaposed'] == $pjk) { echo 'selected="selected"'; }?>>
                                    <?=$pjv;?>
                                </option>
                                <?php endforeach;?>
                            </select>是否与其他活动一起使用。建议不并列<br/>
                        </p>
                        <p>
                            <label>结算方式</label>
                            <select name="pay_type" style="width: 400px;" id="pay_type_id">
                                <?php foreach ($pay_type as $ptk=>$ptv): ?>
                                <option value="<?=$ptk;?>" <?php if (isset($info['pay_type']) && $info['pay_type'] == $ptk) { echo 'selected="selected"'; }?>>
                                    <?=$ptv;?>
                                </option>
                                <?php endforeach;?>
                            </select>注意，如果是针对订单，则直接在订单总金额的基础上进行操作，如果是针对产品，则对订单中每个产品进行操作。<br/>
                            <br/>
                        </p>
                        <p>
                            <label>优惠类型</label>
                            <select name="discount_type" style="width: 400px;" id="discount_type_id">
                                <?php foreach ($discount_type as $dtk=>$dtv): ?>
                                <option value="<?=$dtk;?>" <?php if (isset($info['discount_type']) && $info['discount_type'] == $dtk) { echo 'selected="selected"'; }?>>
                                    <?=$dtv;?>
                                </option>
                                <?php endforeach;?>
                            </select>选择折扣所属的类型<br/>
                            <br/>
                        </p>
                        <p>
                            <label>优先级</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['priority']) ? $info['priority'] : ''?>" name="priority" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            此处优先级只针对已选择的活动处理优先级，并不包含活动使用优先级
                            <br/>
                        </p>
                        <p>
                            <label>开始时间</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['start_time']) ? $info['start_time'] : ''?>" name="start_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            认真填写开始时间，并精确到秒
                            <br/>
                        </p>
                        <p>
                            <label>结束时间</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['end_time']) ? $info['end_time'] : ''?>" name="end_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            认真填写结束时间，并精确到秒
                            <br/>
                        </p>
                        <p>
                            <label>描述</label>
                            <textarea class="text-input textarea" name="descr" cols="79" rows="15"><?=isset($info['descr']) ? $info['descr'] : ''?></textarea>
                            描述请写20个字以上。
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
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/promotion.js"></script>
<script>
    /*
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
*/
    promotion.init('<?=isset ($info['promotion_type']) ? $info['promotion_type'] : '';?>', '<?=isset ($info['rule']) ? $info['rule'] : '';?>');
</script>