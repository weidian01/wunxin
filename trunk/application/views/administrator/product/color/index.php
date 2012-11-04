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
    <!--h2>分类列表</h2-->
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_color/create')?>"><span>添加颜色</span></a></li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_color/index')?>"><span>颜色列表</span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>颜色列表</h3>
            <!--ul class="content-box-tabs">
<li><a href="#tab1" class="default-tab">Table</a></li>
<!-- href must be unique and match the id of target div -->
            <!--li><a href="#tab2">Forms</a></li>
        </ul-->
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <!-- This is the target div. id must match the href of this div's tab -->
                <table>
                    <thead>
                    <tr>
                        <th>
                            <input class="check-all" type="checkbox"/>
                        </th>
                        <th>名称</th>
                        <th>英文名</th>
                        <th>CODE</th>
                        <th>图片</th>
                        <th>描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $item): ?>
                    <tr>
                        <td>
                            <input type="checkbox"/>
                        </td>
                        <td>
                            <?php if($item['parent_id']==0):?>
                            <a href="<?=site_url("administrator/product_color/index/{$item['color_id']}")?>"><?=$item['china_name']?></a>
                            <?php else:?>
                            <?=$item['china_name']?>
                            <?php endif;?>
                        </td>
                        <td>
                            <?=$item['english_name']?>
                        </td>
                        <td>
                            <div style="float:left;margin-right:5px;display:block;width:20px;height:20px;background-color:<?=$item['code']?>;"></div> <?=$item['code']?>
                        </td>
                        <td>
                            <?php if($item['image']):?><img width="20" height="20" src="<?=config_item('static_url').'upload/color/'.$item['image']?>"><?php endif;?>
                        </td>
                        <td>
                            <?=$item['descr']?>
                        </td>
                        <td><a href="<?php echo site_url("administrator/product_color/edit/{$item['color_id']}")?>"><img
                            src="<?=config_item('static_url')?>images/icons/pencil.png" alt="Edit"/></a>
                            <a href="<?php echo site_url("administrator/product_color/del/{$item['color_id']}")?>"><img
                                src="<?=config_item('static_url')?>images/icons/cross.png" alt="Delete"/></a></td>
                    </tr>
                        <?php endforeach;?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3">
                          <div class="pagination">
                              <?=$page?>
                          </div>
                          <!-- End .pagination -->
                          <div class="clear"></div>
                        </td>
                      </tr>
                    </tfoot>
                </table>
            </div>
            <!-- End #tab1 -->
        </div>
        <!-- End .content-box-content -->
    </div>

    <div class="clear"></div>
    <div id="footer">
        <small>
            <!-- Remove this notice or replace it with whatever you want -->
            &#169; Copyright 2010 Your Company | Powered by <a href="http://www.865171.cn">admin templates</a> | <a
            href="#">Top</a></small>
    </div>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>