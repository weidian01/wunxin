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
    </ul>
    <div class="clear">
        <form action="<?=url('/administrator/business_card_model/cardList');?>" method="post">
            <p>
                <label><b>输入关键字</b></label>
                <input class="text-input small-input" type="text" id="small-input" name="keyword" value="<?=isset($keyword) ? $keyword : ''; ?>">
                <select name="s_type" class="small-input">
                    <?php if (!isset ($searchType)) { $searchType = array(); }
                    foreach ($searchType as $sk => $sv) { ?>
                        <?php if (!isset($sType)) $sType = '';
                        if ($sType == $sk) { ?>
                            <option value="<?=$sk?>" selected="selected"><?=$sv?></option>
                            <?php } else { ?>
                            <option value="<?=$sk?>"><?=$sv?></option>
                            <?php } ?>
                        <?php }?>
                </select>
                <input type="submit" value="搜索">
            </p>
        </form>
    </div>
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
                        <th>卡号</th>
                        <th>卡模型</th>
                        <th>卡金额</th>
                        <th>卡密码</th>
                        <th>换取积分</th>
                        <th>用户ID</th>
                        <th>用户名称</th>

                        <th>使用次数</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <!--<th>操作</th>-->
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
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardList?s_type=1&keyword=<?=$v['card_no'];?>"><?=$v['card_no'];?></a></td>
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardList?s_type=2&keyword=<?=$v['model_id'];?>">
                            <?=$model_data[$v['model_id']]['card_name'];?></a></td>
                        <td>￥<?=fPrice($v['card_amount']);?></td>
                        <td><?=$v['card_pass'];?></td>
                        <td><?=$v['integral'];?></td>
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardList?s_type=3&keyword=<?=$v['uid'];?>"><?=$v['uid'];?></a></td>
                        <td><a href="<?=config_item('static_url')?>administrator/business_card_model/cardList?s_type=3&keyword=<?=$v['uid'];?>"><?=$v['uname'];?></a></td>

                        <td><?=$v['use_num'];?></td>
                        <td><?php $msg = '初始';switch($v['status']){
							case '0':$msg = '已删除';break;
							case '1':$msg = '初始';break;
							case '2':$msg = '已绑定';break;
						}echo $msg;?></td>
                        <td><?=$v['create_time'];?></td>
                        <!--
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/business_card_model/cardDelete/<?=$v['model_id'].'/'.$current_page;?>" title="删除卡模型">
                                <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除卡模型"/>
                            </a>
                        </td>
                        -->
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