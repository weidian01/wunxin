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
    <!--h2>分类列表</h2-->
    <!--p id="page-intro">产品分类管理</p-->
    <?php require __DIR__. DS . 'menu.php';?>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>模型列表</h3>
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
                        <th>模型ID</th>
                        <th>模型名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($models as $item): ?>
                    <tr>
                        <td>
                            <input type="checkbox"/>
                        </td>
                        <td><?=$item['model_id']?></td>
                        <td><?=$item['model_name']?></td>
                        <td><a href="<?=site_url("administrator/product_models/model_edit/{$item['model_id']}")?>"><img
                            src="<?=config_item('static_url')?>images/icons/pencil.png" alt="Edit"/></a>
                            <a href="<?=site_url("administrator/product_models/model_del/{$item['model_id']}")?>"><img
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
    <?php include(APPPATH.'views/administrator/footer.php');?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>