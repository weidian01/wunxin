<?php include(APPPATH.'views/administrator/left.php');?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please
                <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or
                <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface properly. Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>卡模型列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
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
            <h3>卡模型列表</h3>
            <!--
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Table</a></li>
                <li><a href="#tab2">Forms</a></li>
            </ul>
            -->
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox"/></th>
                        <th>模型ID</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th>金额</th>
                        <th>数量</th>
                        <!--<th>规则</th>-->
                        <th>使用说明</th>
                        <th>截止日期</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination">
                                <?=isset ($page_html) ? $page_html : '';?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php if (!isset ($data)) $data = array();
                    foreach ($data as $v) {
                        if (empty ($v)) continue;?>
                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardList?s_type=2&keyword=<?=$v['model_id'];?>">
                            <?=$v['model_id'];?></a></td>
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardList?s_type=2&keyword=<?=$v['model_id'];?>">
                            <?=$v['card_name'];?></a></td>
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardModelList?model_type=<?=$v['card_type'];?>">
                            <?=$card_type[$v['card_type']];?></a></td>
                        <td>￥<?=fPrice($v['card_amount']);?></td>
                        <td><?=$v['card_num'];?></td>
                        <!--<td><?=$v['rule'];?></td>-->
                        <td><?=$v['descr'];?></td>
                        <td><?=$v['end_time'];?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <?php if ($v['is_generation']) {?>
                                已制
                            <?php } else {?>
                            <a href="javascript:void(0);" onclick="generationCard(<?=$v['model_id'];?>, 'generation_card')" title="生成卡" id="generation_card">
                                制卡
                            </a>
                            <?php }?>
                            <a href="<?=config_item('static_url')?>administrator/business_card_model/cardModelEdit/<?=$v['model_id'];?>" title="编辑卡模型">
                                <img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑卡模型"/></a>
                            <a href="<?=config_item('static_url')?>administrator/business_card_model/cardModelDelete/<?=$v['model_id'].'/'.$current_page;?>" title="删除卡模型">
                                <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除卡模型"/></a>
                            <?php if ($v['card_type'] == CARD_COPPER) {?>
                            <br/><a href="<?=config_item('static_url')?>administrator/business_card_model/joinSales/<?=$v['model_id'];?>" title="将产品加入此卡销售">加入产品</a>
                            <?php }?>
                        </td>
                    </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include(APPPATH.'views/administrator/footer.php');?>
</div>
</div>
</body>
</html>
<script type="text/javascript">
    function generationCard(model_id, bandingId)
    {
        var url = 'administrator/business_card_model/generationCard';
        var param = 'model_id='+model_id;
        var data = wx.ajax(url, param);

        wx.showPop(data.msg, bandingId);
        wx.pageReload();
    }
</script>