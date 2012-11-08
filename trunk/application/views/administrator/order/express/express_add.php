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
                interface
                properly.
                Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2><?=($type == 'edit') ? '编辑快递公司' : '添加快递公司'; ?></h2>
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order/orderList"><span> 订单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_receiver/receivableList"><span> 收款单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_picking/pickingList"><span> 配货单列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_express/addExpressCompany"><span> 添加快递公司 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/order_express/expressList"><span> 快递公司列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3><?=($type == 'edit') ? '编辑快递公司' : '添加快递公司'; ?></h3>
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
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=($type == 'edit') ? url('administrator/order_express/saveEditExpressCompany') : url('administrator/order_express/saveExpress');?>"
                    method="post" enctype="multipart/form-data">
                    <input type="hidden" name="eid" value="<?=isset($data['ed_id']) ? $data['ed_id'] : ''; ?>">
                    <fieldset>
                        <p>
                            <label>快递名称</label>
                            <input class="text-input small-input" type="text" id="small-input" name="name"
                                   value="<?=isset($data['name']) ? $data['name'] : ''; ?>"/>
                            <br/>
                        </p>
                        <p>
                            <label>网址</label>
                            <input class="text-input small-input" type="text" id="small-input" name="website"
                                   value="<?=isset($data['website']) ? $data['website'] : ''; ?>"/>
                            <br/>
                        </p>

                        <p>
                            <label>排序</label>
                            <input class="text-input small-input" type="text" id="small-input" name="order"
                                   value="<?=isset($data['sort']) ? $data['sort'] : ''; ?>"/>
                            <br/>
                        </p>

                        <p>
                            <label>快递描述</label>
                            <textarea class="text-input textarea wysiwyg" id="textarea" name="detail" cols="79" rows="15"><?=isset($data['descr']) ? $data['descr'] : ''; ?></textarea>
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
    <div class="clear"></div>

    <?php include(APPPATH.'views/administrator/footer.php');?>
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
