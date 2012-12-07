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
            <h3>属性值列表 &nbsp;&nbsp;&nbsp;&nbsp;
                <?=isset($attr_data['attr_id']) ? '属性ID：'.$attr_data['attr_id'] : ''?>
                <?=isset($attr_data['attr_name']) ? '属性名称：'.$attr_data['attr_name'] : ''?></h3>
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
                <form action="<?=site_url('administrator/product_models/model_attr_value_save')?>" method="post">
                <!-- This is the target div. id must match the href of this div's tab -->
                <table>
                    <thead>
                    <tr>
                        <th>
                            <input class="check-all" type="checkbox"/>
                        </th>
                        <th>属性值</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($attrs as $item): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="value_id[]" <?php if(isset($values[$item['value_id']])):?>checked="checked"<?php endif?> value="<?=$item['value_id']?>"/>
                        </td>
                        <td><?=$item['value_name']?></td>
                    </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                    <p><input type="hidden" name="model_id" value="<?=$model_id?>"><input type="hidden" name="attr_id" value="<?=$attr_id?>">
                        <input class="button" type="submit" value="Submit"/>
                    </p>
                </form>
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