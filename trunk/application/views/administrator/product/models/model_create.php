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
            <h3>设置模型</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=site_url('administrator/product_models/model_save')?>" method="post">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>模型名称</label>
                            <input class="text-input" type="text"
                                   value="<?=isset($model['model_name']) ? $model['model_name'] : ''?>" name="model_name"/>
                            <input type="hidden" name="model_id" value="<?=isset($model['model_id']) ? $model['model_id'] : ''?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <small>模型名称不可为空</small>
                        </p>


                        <label>扩展属性 <a href="javascript:add_attr();">添加</a></label>
                        <table id="attrs">
                            <tr><th>属性名</th><th>类型</th><th>排序</th><th>是否可搜索</th><th>默认显示</th><th>删除</th><th>添加属性</th></tr>
                            <?php foreach($attr_conf as $item):?>
                            <tr>
                                <td><input type="hidden" name="id[]" value="<?=isset($item['id']) ? $item['id']: 0;?>">
                                    <select name="attr_id[]"><option value="0">属性选择</option>
                                        <?php foreach($attrs as $attr):?>
                                            <option value="<?=$attr['attr_id']?>" <?php if($item['attr_id'] == $attr['attr_id']):?>selected="selected"<?php endif;?>><?=$attr['attr_name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td><select name="type[]"><option value="1" <?php if($item['type'] == 1):?>selected="selected"<?php endif;?>>单选</option><option value="2" <?php if($item['type'] == 2):?>selected="selected"<?php endif;?>>复选</option></select></td>
                                <td><input class="text-input" name="sort[]" value="<?=isset($item['sort']) ? $item['sort']: 0;?>" type="text"></td>
                                <td><select name="search[]"><option value="1" <?php if($item['search'] == 1):?>selected="selected"<?php endif;?>>是</option><option value="0" <?php if($item['search'] == 0):?>selected="selected"<?php endif;?>>否</option></select></td>
                                <td><select name="display[]"><option value="1" <?php if($item['display'] == 1):?>selected="selected"<?php endif;?>>显示</option><option value="0" <?php if($item['display'] == 0):?>selected="selected"<?php endif;?>>隐藏</option></select></td>
                                <td><img src="http://www.wunxin.com/images/icons/cross.png" onclick="del_attr(this)" alt="Delete"></td>
                                <td><a href="<?=site_url('administrator/product_models/model_attr_value_edit')?>/<?=$item['model_id']?>/<?=$item['attr_id']?>" target="_blank"> + </a></td></tr>
                            <?php endforeach;?>
                        </table>

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
    var count = 11;
    function add_attr() {
        count++;
        var attrs = '<select name="attr_id[]"><option value="0">属性选择</option><?php foreach($attrs as $attr):?><option value="<?=$attr['attr_id']?>"><?=$attr['attr_name']?></option><?php endforeach;?></select>';
        $("#attrs").append('<tr><td>'+attrs+'</td><td><select name="type[]"><option value="1">单选</option><option value="2">复选</option></select></td><td><input class="text-input" type="text" name="sort[]" value="0"></td><td><select name="search[]"><option value="1">是</option><option value="0">否</option></select></td><td><select name="display[]"><option value="1">显示</option><option value="0">隐藏</option></select></td><td><img src="<?=config_item('static_url')?>images/icons/cross.png" onclick="del_attr(this)" alt="Delete"/></td><td>&nbsp;</td></tr>');
    }

    function del_attr(obj)
    {
        $(obj).parents('tr').remove();
    }
</script>