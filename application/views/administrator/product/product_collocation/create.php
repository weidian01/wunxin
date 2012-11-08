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
    <h2><?=$type == 'edit' ? '编辑产品搭配' : '添加产品搭配'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/product_collocation/pcAdd/"><span><br/> 添加产品搭配 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/product_collocation/pcList/"><span><br/> 产品搭配列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加产品搭配</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=$type == 'edit' ? '/administrator/product_collocation/pcEditSave' : '/administrator/product_collocation/pcSave';?>" method="post">
                    <input type="hidden" name="id" value="<?=isset($info['id']) ? $info['id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>产品ID</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['pid']) ? $info['pid'] : ''?>" name="pid" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>被搭配的产品ID</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['spid']) ? $info['spid'] : ''?>" name="spid" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>排序</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['sort']) ? $info['sort'] : ''?>" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
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
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>