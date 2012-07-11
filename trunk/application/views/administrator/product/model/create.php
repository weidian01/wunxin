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
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_model/create')?>"><span>添加模型</span></a>
        </li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_model/index')?>"><span>模型列表</span></a>
        </li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新模型</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=site_url('administrator/product_model/save')?>" method="post">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>模型名称</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($model_name) ? $model_name : ''?>" name="model_name"/>
                            <input type="hidden" name="model_id" value="<?php echo isset($model_id) ? $model_id : ''?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <small>模型名称不能为空</small>
                        </p>

                        <label>扩展属性 <a href="javascript:add_attr();">添加</a></label>
                        <table id="attrs">
                            <tr>
                                <th>属性名</th><th>类型</th><th>属性值</th><th>排序</th><th>是否可搜索</th><th>删除</th>
                            </tr>
                            <?php if (isset($attrs)):foreach ($attrs as $key => $attr): ?>
                            <tr>
                                <td>
                                    <input class="text-input" type="text" name="attr_name[]" value="<?=$attr['attr_name']?>">
                                    <input type="hidden" name="attr_id[]" value="<?=$attr['attr_id']?>">
                                </td>
                                <td>
                                    <select name="type[]">
                                        <option value="1" <?php if ($attr['type'] == 1) echo 'selected="selected"';?>>单选
                                        </option>
                                        <option value="2" <?php if ($attr['type'] == 2) echo 'selected="selected"';?>>复选
                                        </option>
                                        <option value="3" <?php if ($attr['type'] == 3) echo 'selected="selected"';?>>下拉
                                        </option>
                                        <option value="4" <?php if ($attr['type'] == 4) echo 'selected="selected"';?>>文本
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input class="text-input" type="text" name="attr_value[]" value="<?=$attr['attr_value']?>">
                                </td>
                                <td>
                                    <input class="text-input" type="text" name="sort[]" value="<?=$attr['sort']?>">
                                </td>
                                <td>
                                    是<input type="radio" name="search[<?=$key?>]" value="1" <?php if($attr['search']=='1'):?>checked<?php endif;?>> 否<input type="radio" name="search[<?=$key?>]" value="0" <?php if($attr['search']=='0'):?>checked<?php endif;?>>
                                </td>
                                <td>
                                    <img src="<?=config_item('static_url')?>images/icons/cross.png" onclick="del_attr(this)" alt="Delete"/>
                                </td>
                            </tr>
                            <?php endforeach;endif;?>
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
<script>
    function add_attr() {
        var size = $("#attrs tr").size() - 1;
        $("#attrs").append('<tr><td><input class="text-input" type="text" name="attr_name[]" value=""><input type="hidden" name="attr_id[]" value=""></td><td><select name="type[]"><option value="1">单选</option><option value="2">复选</option><option value="3">下拉</option><option value="4">文本</option></select></td><td><input class="text-input" type="text" name="attr_value[]" value=""></td><td><input class="text-input" type="text" name="sort[]" value=""></td><td>是<input type="radio" name="search['+size+']" value="1"> 否<input type="radio" name="search['+size+']" value="0" checked></td><td><img src="<?=config_item('static_url')?>images/icons/cross.png" onclick="del_attr(this)" alt="Delete"/></td></tr>');
    }

    function del_attr(obj)
    {
        $(obj).parents('tr').remove();
    }
</script>