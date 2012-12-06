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
    <h2>淘宝产品链接列表</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/tool/crawlProductAdd"><span><br/> 添加产品链接 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/tool/crawlProductList"><span><br/> 产品链接列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>淘宝产品链接列表
                <a href="<?=config_item('static_url')?>administrator/tool/crawlProductList/<?=$current_page?>/0">初始</a>
                <a href="<?=config_item('static_url')?>administrator/tool/crawlProductList/<?=$current_page?>/1">待抓取</a>
                <a href="<?=config_item('static_url')?>administrator/tool/crawlProductList/<?=$current_page?>/2">已抓取</a>
            </h3>
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
                        <th>链接</th>
                        <th>号码类型</th>
                        <th>更新标记</th>
                        <th>品牌</th>
                        <th>分类</th>
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
                        <td><a href="<?=$v['url'];?>" target="_blank"><?=$v['url'];?></a></td>
                        <td><?=isset ($size_type[$v['size_type']]) ? $size_type[$v['size_type']] : $v['size_type'];?></td>
                        <td><?=isset ($up_flag[$v['up_flag']]) ? $up_flag[$v['up_flag']] : $v['up_flag'];?></td>
                        <td><?=isset ($brand[$v['bid']]['name']) ? $brand[$v['bid']]['name'] : $v['bid'];?></td>
                        <td><?=isset ($category[$v['cid']]['cname']) ? $category[$v['cid']]['cname'] : $v['cid'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/tool/crawlProductEdit/<?=$v['id'].'/'.$current_page;?>" title="编辑">
                                <img alt="Edit" src="http://www.wunxin.com/images/icons/pencil.png">
                            </a>
                            <a href="<?=config_item('static_url')?>administrator/tool/crawl_product_delete/<?=$v['id'].'/'.$current_page;?>" title="删除">
                                <img alt="Delete" src="http://www.wunxin.com/images/icons/cross.png">
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