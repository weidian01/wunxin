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
            <h3>设置属性</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=site_url('administrator/product_models/attrs_save')?>" method="post">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>属性名称</label>
                            <input class="text-input" type="text"
                                   value="<?=isset($attr_name) ? $attr_name : ''?>" name="attr_name"/>
                            <input type="hidden" name="attr_id" value="<?=isset($attr_id) ? $attr_id : ''?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <small>属性名称不可为空</small>
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
<script>
    function add_attr() {
        var size = $("#attrs tr").size() - 1;
        $("#attrs").append('<tr><td><input class="text-input" type="text" name="attr_name[]" value=""><input type="hidden" name="attr_id[]" value=""></td><td><select name="type[]"><option value="1">单选</option><option value="2">复选</option><option value="3">下拉</option><option value="4">文本</option></select></td><td><input class="text-input" type="text" name="attr_value[]" value=""></td><td><input class="text-input" type="text" name="sort[]" value=""></td><td>是<input type="radio" name="search['+size+']" value="1"> 否<input type="radio" name="search['+size+']" value="0" checked></td><td><select name="display[]"><option value="1">显示</option><option value="0">隐藏</option></select></td><td><img src="<?=config_item('static_url')?>images/icons/cross.png" onclick="del_attr(this)" alt="Delete"/></td></tr>');
    }

    function del_attr(obj)
    {
        $(obj).parents('tr').remove();
    }
</script>