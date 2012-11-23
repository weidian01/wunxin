<?php include(APPPATH.'views/administrator/left.php');?>
<div id="main-content" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
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
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardProduct"><span><br/> 卡产品列表 </span></a></li>
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
                            <span style="color: red;font-size: 20px;font-weight: bold;">所有卡类型，在同一订单中不能并列使用，每个订单只能使用同一类型的卡,例如：使用金象卡，则不能再使用银象、万象、千象卡。</span>
                        </p>
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
                            </select>&nbsp;&nbsp;&nbsp;&nbsp;<span id="card_type_id"></span>
                        </p>
                        <p id="rule">
                            <label>规则</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['rule']) ? fPrice($info['rule']) : ''?>"
                                   name="rule" onkeyup="value=value.replace(/[^\d|.]/g, '')"/>
                            单元为元 &nbsp;&nbsp;&nbsp;&nbsp;<span id="rule_id" style="color: red;font-weight: bold;"></span>
                            <br/>
                        </p>
                        <p>
                            <label>金额</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['card_amount']) ? fPrice($info['card_amount']) : ''?>"
                                   name="card_amount" onkeyup="value=value.replace(/[^\d|.]/g, '')"/>
                            单元为元
                            <br/>
                        </p>
                        <p>
                            <label>数量</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['card_num']) ? $info['card_num'] : ''?>"
                                   name="card_num" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            制卡的数量，请认真填写。
                            <br/>
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
    var CARD_MILLION = <?=CARD_MILLION;?>;
    var CARD_THOUSAND = <?=CARD_THOUSAND;?>

    var editCardType = <?=isset ($info['card_type']) ? $info['card_type'] : '1';?>;

    var html = '';
    var ruleNotice = '';
    function adTypeChange(v) {
        v = parseInt(v);
        switch (v) {
            case CARD_GOLD:
                html += '不限制使用金额，不限制使用张数，不限制使用产品范围。相当于代金卡！';
                ruleNotice = '不需要填写';
                $('#rule').hide();
                break;
            case CARD_SILVER:
                html += '不限制使用金额，不限制使用张数，限制使用产品范围。相当于代金卡！';
                ruleNotice = '不需要填写';
                $('#rule').hide();
                break;
            case CARD_MILLION:
                html += '限制使用金额，限制使用张数，不限制使用产品范围。相当于满减卡！';
                ruleNotice = '此处填写订单满多少才能使用，例如：1000。即为订单满1000元才可以使用卡';
                $('#rule').show();
                break;
            case CARD_THOUSAND:
                html += '限制使用金额，限制使用张数，限制使用产品范围。相当于满减卡！';
                ruleNotice = '此处填写订单满多少才能使用，例如：1000。即为订单满1000元才可以使用卡';
                $('#rule').show();
                break;
        }

        $('#card_type_id').html(html);
        $('#rule_id').html(ruleNotice);
        html = '';
        ruleNotice = '';
    }

    var initCardType = wx.isEmpty(editCardType) ? editCardType : CARD_GOLD;
    adTypeChange(initCardType);

</script>