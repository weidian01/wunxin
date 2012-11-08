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
    <h2>广告位置列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad_position/positionAdd"><span><br/> 添加广告位置 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad_position/positionList"><span><br/> 广告位置列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad/adAdd"><span><br/> 添加广告 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad/adList"><span><br/> 广告列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>广告位置列表</h3>
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
                        <th>广告ID</th>
                        <th>位置</th>
                        <th>广告名称</th>
                        <th>广告类型</th>
                        <th>广告内容</th>
                        <th>点击数量</th>
                        <th>状态</th>
                        <th>链接</th>
                        <th>排序</th>
                        <th>描述</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination">
                                <?php echo isset ($page_html) ? $page_html : '';?>
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
                        <td><?php echo $v['ad_id'];?></td>
                        <td><?php echo $position_data[$v['position_id']]['name'];?></td>
                        <td><?php echo $v['ad_name'];?></td>
                        <td><?php echo $v['ad_type'];?></td>
                        <td><?php
                            if (in_array($v['ad_type'], array('1', '2'))) {
                                echo '<img src="'.base_url().$v['ad_content'].'" width="50" height="50">';
                            } else {
                                echo mb_substr($v['ad_content'],0, 20,'utf-8');
                            } ?></td>
                        <td><?php echo $v['click_num'];?></td>
                        <td><?php echo $v['status'] ? '显示' : '不显示';?></td>
                        <td><?php echo $v['ad_link'];?></td>
                        <td><?php echo $v['sort'];?></td>
                        <td><?php echo $v['descr'];?></td>
                        <td><?php echo $v['start_time'];?></td>
                        <td><?php echo $v['end_time'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/business_ad/adEdit/<?php echo $v['ad_id'];?>" title="编辑广告"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑广告"/></a>
                            <a href="<?=config_item('static_url')?>administrator/business_ad/adDelete/<?php echo $v['ad_id'].'/'.$current_page;?>" title="删除广告"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除广告"/></a>
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