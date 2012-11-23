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
    <h2>卡列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardModelAdd"><span><br/> 添加卡模型 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardModelList"><span><br/> 卡模型列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardList"><span><br/> 卡列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_card_model/cardProduct"><span><br/> 卡产品列表 </span></a></li>
    </ul>
    <div class="clear"></div>
    <!-- End .shortcut-buttons-set -->
    <br/>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>卡列表</h3>
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
                        <th>ID</th>
                        <th>卡模型</th>
                        <th>卡类型</th>
                        <th>产品ID</th>
                        <th>产品图片</th>
                        <th>产品名称</th>
                        <th>售价</th>
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
                        <td><?=$v['id'];?></td>
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardProduct/<?=$v['model_id'];?>" title="<?=$model[$v['model_id']]['card_name'];?>">
                            <?=$model[$v['model_id']]['card_name'];?></a>
                        </td>
                        <td><?=$card_type[$v['card_type']]?></td>
                        <td><?=$v['pid'];?></td>
                        <td>
                            <a href="<?=productURL($v['pid'])?>" target="_blank" title="<?=$v['pname'];?>">
                                <img src="<?=config_item('img_url').'product/'.intToPath($v['pid']).'icon.jpg';?>" width="60" height="60"/>
                            </a>
                        </td>
                        <td><a href="<?=productURL($v['pid'])?>" target="_blank" title="<?=$v['pname'];?>"><?=$v['pname'];?></a></td>
                        <td>￥<?=fPrice($v['sell_price']);?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/business_card_model/productDelete/<?=$v['id'].'/';?>" title="删除卡产品">
                                <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除卡产品"/>
                            </a>
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