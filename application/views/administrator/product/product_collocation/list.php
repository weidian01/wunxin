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
    <h2>产品搭配列表</h2>
    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/product_collocation/pcAdd/"><span><br/> 添加产品搭配 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/product_collocation/pcList/"><span><br/> 产品搭配列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear">
        <form action="<?=config_item('static_url')?>administrator/product_collocation/search" method="post">
            <p>
                <label><b>输入关键字</b></label>
                <input class="text-input small-input" type="text" id="small-input" name="keyword" value="<?=isset ($keyword) ? $keyword : '';?>">
                <select name="s_type" class="small-input">
                    <option value="1" <?=(isset ($s_type) && $s_type == 1) ? 'selected="selected"' : ''; ?>>搭配ID</option>
                    <option value="2" <?=(isset ($s_type) && $s_type == 2) ? 'selected="selected"' : ''; ?>>产品ID</option>
                </select>
                <input type="submit" value="搜索">
            </p>
        </form>
    </div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>产品搭配列表</h3>
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
                        <th>搭配ID</th>
                        <th>产品ID</th>
                        <th>被搭配的产品ID</th>
                        <th>排序</th>
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
                        <td><a href="<?=config_item('static_url')?>administrator/product_collocation/pcList/<?=isset ($current_page) ? $current_page : ''.'/'.$v['pid'];?>"><?=$v['pid'];?></a></td>
                        <td><?=$v['spid'];?></td>
                        <td><?=$v['sort'];?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/product_collocation/pcEdit/<?=$v['id'];?>" title="编辑产品搭配">
                                <img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑产品搭配"/></a>
                            <a href="<?=config_item('static_url')?>administrator/product_collocation/pcDelete/<?=$v['id'].'/'.(isset ($current_page) ? $current_page : '');?>" title="删除产品搭配">
                                <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除产品搭配"/></a>
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