<?php require(dirname(__FILE__) . '/../../left.php'); ?>
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
    <h2><?php echo $type == 'edit' ? '编辑卡模型' : '添加卡模型'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/business_card_model/cardModelAdd"><span><br/> 添加卡模型 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/business_card_model/cardModelList"><span><br/> 卡模型列表 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/business_card/cardAdd"><span><br/> 添加卡 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/business_card/cardList"><span><br/> 卡列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3><?php echo $type == 'edit' ? '修改卡模型' : '添加卡模型'; ?></h3>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/business_card_model/cardModelEditSave' : '/administrator/business_card_model/cardModelSave';?>" method="post">
                    <input type="hidden" name="model_id" value="<?php echo isset($info['model_id']) ? $info['model_id'] : ''?>">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>模型名称</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['card_name']) ? $info['card_name'] : ''?>" name="card_name"/> <br/>
                        </p>
                        <p>
                            <label>类型</label>
                            <select name="card_type">
                                <?php $info['card_type'] = isset ($info['card_type']) ? $info['card_type'] : '';foreach ($card_type as $v) { ?>
                                <?php if ($v['id'] == $info['card_type']) { ?>
                                    <option value="<?php echo $v['id'];?>" selected="selected"><?php echo $v['name'];?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
                                    <?php } ?>
                                <?php }?>
                            </select>
                        </p>
                        <p>
                            <label>金额</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['card_amount']) ? $info['card_amount'] : ''?>" name="card_amount" onkeyup="value=value.replace(/[^\d]/g, '')"/> <br/>
                        </p>
                        <p>
                            <label>数量</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['card_num']) ? $info['card_num'] : ''?>" name="card_num" onkeyup="value=value.replace(/[^\d]/g, '')"/> <br/>
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
    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<script type="text/javascript">
    function adTypeChange(v) {
        if (v.value == '1' || v.value == '2' ) {
            var html = '<input class="text-input small-input" type="file" name="ad_content"/>';
            $('#ad_content_id').html(html);
        } else {
            var html = '<textarea class="text-input textarea" name="ad_content" cols="50" rows="15"></textarea>';
            $('#ad_content_id').html(html);
        }
    }
</script>