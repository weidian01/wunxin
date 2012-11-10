<?php include(APPPATH.'views/administrator/left.php');?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a>
                your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface properly. Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2><?=$type == 'edit' ? '编辑卡模型' : '添加卡模型'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardModelAdd"><span><br/> 添加卡模型 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardModelList"><span><br/> 卡模型列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardList"><span><br/> 卡列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3><?=$type == 'edit' ? '修改卡模型' : '添加卡模型'; ?></h3>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="/administrator/business_card_model/cardModelSave" method="post">
                    <input type="hidden" name="model_id" value="<?=isset($info['model_id']) ? $info['model_id'] : ''?>">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>模型名称</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['card_name']) ? $info['card_name'] : ''?>" name="card_name"/> <br/>
                        </p>
                        <p>
                            <label>类型</label>
                            <select name="card_type" onchange="adTypeChange(this.value);">
                                <?php $cardTypes = isset ($info['card_type']) ? $info['card_type'] : '';
                                foreach ($card_type as $k=>$v) { ?>
                                <?php p($v);if ($k == $cardTypes) { ?>
                                    <option value="<?=$k;?>" selected="selected"><?=$v;?></option>
                                    <?php } else { ?>
                                    <option value="<?=$k;?>"><?=$v;?></option>
                                    <?php } ?>
                                <?php }?>
                            </select>
                        </p>
                        <p>
                            <label>金额</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['card_amount']) ? fPrice($info['card_amount']) : ''?>" name="card_amount" onkeyup="value=value.replace(/[^\d]/g, '')"/> <br/>
                        </p>
                        <p>
                            <label>数量</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['card_num']) ? $info['card_num'] : ''?>" name="card_num" onkeyup="value=value.replace(/[^\d]/g, '')"/> <br/>
                        </p>
                        <p>
                            <label>截止日期</label>
                            <input type="text" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})" name="end_time"
                                   value="<?=isset($info['end_time']) ? $info['end_time'] : ''?>" class="text-input small-input">
                        </p>
                        <p id="rule_area">

                        </p>
                        <p>
                            <label>使用说明</label>
                            <textarea rows="10" cols="10" name="descr" class="text-input textarea"><?=isset($info['descr']) ? $info['descr'] : '';?></textarea>
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

<script type="text/javascript">
    var CARD_GOLD = <?=CARD_GOLD;?>;
    var CARD_SILVER = <?=CARD_SILVER;?>;
    var CARD_COPPER = <?=CARD_COPPER;?>;

    var editCardType = <?php echo isset ($info['card_type']) ? $info['card_type'] : '1';?>;

    var html = '';
    function adTypeChange(v, limit, limitUseNum, limitProduct) {
        v = parseInt(v);
        switch (v) {
            case CARD_GOLD:
                limit = wx.isEmpty(limit) ? limit : '0';
                limitUseNum = wx.isEmpty(limitUseNum) ? limitUseNum : '0';
                limitProduct = wx.isEmpty(limitProduct) ? limitProduct : '0';

                html = '限额：<input type="text" name="limit" value="'+limit+'" disabled="disabled"/>限制订单总金额达到多少后才可以使用，如：订单金额500元，才可以使用<br/>';
                html += '限使用卡数量：<input type="text" name="limit_use_num" value="'+wx.fPrice(limitUseNum)+'" disabled="disabled"/>每个订单限制使用卡的数量<br/>';
                html += '限产品：<input type="text" name="limit_product" value="'+limitProduct+'" disabled="disabled"/>限制某些产品才可以使用，0为不限，1为限制<br/>';
                break;
            case CARD_SILVER:
                limit = wx.isEmpty(limit) ? limit : '500';
                limitUseNum = wx.isEmpty(limitUseNum) ? limitUseNum : '1';
                limitProduct = wx.isEmpty(limitProduct) ? limitProduct : '0';

                html = '限额：<input type="text" name="limit" value="'+limit+'"/>限制订单总金额达到多少后才可以使用，如：订单金额500元，才可以使用<br/>';
                html += '限使用卡数量：<input type="text" name="limit_use_num" value="'+wx.fPrice(limitUseNum)+'"/>每个订单限制使用卡的数量<br/>';
                html += '限产品：<input type="text" name="limit_product" value="'+limitProduct+'" disabled="disabled"/>限制某些产品才可以使用，0为不限，1为限制<br/>';
                break;
            case CARD_COPPER:
                limit = wx.isEmpty(limit) ? limit : '0';
                limitUseNum = wx.isEmpty(limitUseNum) ? limitUseNum : '0';
                limitProduct = wx.isEmpty(limitProduct) ? limitProduct : '1';

                html = '限额：<input type="text" name="limit" value="'+limit+'" disabled="disabled"/>限制订单总金额达到多少后才可以使用，如：订单金额500元，才可以使用<br/>';
                html += '限使用卡数量：<input type="text" name="limit_use_num" value="'+wx.fPrice(limitUseNum)+'" disabled="disabled"/>每个订单限制使用卡的数量<br/>';
                html += '限产品：<input type="text" name="limit_product" value="'+limitProduct+'"/>限制某些产品才可以使用，0为不限，1为限制<br/>';
                break;
        }

        $('#rule_area').html(html);
    }

    var initCardType = wx.isEmpty(editCardType) ? editCardType : CARD_GOLD;
    <?php if (isset ($info['rule'])) { $rule = explode(',', $info['rule']);?>
        adTypeChange(initCardType, <?=$rule[0]?>,<?=$rule[1]?>, <?=$rule[2]?>);
    <?php } else {?>
        adTypeChange(initCardType);
    <?php }?>

</script>