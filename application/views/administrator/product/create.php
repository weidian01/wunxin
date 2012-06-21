<?php require(dirname(__FILE__) . '/../left.php'); ?>
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
        <li><a class="shortcut-button" href="<?=site_url('administrator/product/create')?>"><span>添加产品</span></a></li><li><a class="shortcut-button" href="<?=site_url('administrator/product/index')?>"><span>产品列表</span></a>
        </li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新分类</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <?=form_open_multipart('administrator/product/save')?>
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>产品名称</label>
                            <input class="text-input small-input" type="text"
                                   value="<?php echo isset($info['pname']) ? $info['pname'] : ''?>" name="pname"/>
                            <input type="hidden" name="pid" value="<?php echo isset($info['pid']) ? $info['pid'] : ''?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <br/>
                            <small>分类名称不能为空</small>
                        </p>

                        <p>
                            <label>上级分类</label>
                            <select name="class_id" class="small-input">
                                <option value="0">顶级分类</option>
                                <?php foreach ($category as $item): ?>
                                <option value="<?=$item['class_id']?>" <?php if(isset($info['parent_id']) && $info['parent_id']==$item['class_id'] ){echo 'selected="selected"';}?>><?php echo str_repeat("&nbsp;", $item['floor']), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>

                        <p>
                            <label>设计图id</label>
                            <input class="text-input" type="text" value="<?php echo isset($info['did']) ? $info['did'] : ''?>" name="did"/>
                        </p>

                        <p>
                            <label>商品模型</label>
                            <select name="model_id" class="small-input" onchange="load_model(this.value)">
                                <option value="0">选择商品模型</option>
                                <?php foreach ($model as $item): ?>
                                <option value="<?=$item['model_id']?>" <?php if(isset($info['model_id']) && $info['model_id']==$item['model_id'] ){echo 'selected="selected"';}?>><?=$item['model_name']?></option>
                                <?php endforeach;?>
                            </select> <br>
                            <small>必须指定模型</small>
                        </p>

                        <p id="model">
                        </p>

                        <p>
                            <label>产品色系</label>
                            <select name="color_id" class="small-input">
                                <option value="0">选择产品色系</option>
                                <?php foreach ($color as $item): ?>
                                <option value="<?=$item['color_id']?>" <?php if(isset($info['color_id']) && $info['color_id']==$item['color_id'] ){echo 'selected="selected"';}?>><?=$item['china_name']?>/<?=$item['english_name']?></option>
                                <?php endforeach;?>
                            </select> <br>
                            <small>必须指定产品色系</small>
                        </p>

                        <p>
                            <label>是否上架</label>
                            上架<input type="radio" value="1" <?php if(isset($info['status']) && $info['status']==1)echo 'checked';?> name="status"/>
                            下架<input type="radio" value="0" checked name="status"/>
                        <p>

                        <p>
                            <label>市场价格</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?php echo isset($info['market_price']) ? $info['market_price'] : ''?>" name="market_price"/> 分

                        <p>

                        <p>
                            <label>销售价格</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?php echo isset($info['sell_price']) ? $info['sell_price'] : ''?>" name="sell_price"/> 分
                        <p>

                        <p>
                            <label>成本价格</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?php echo isset($info['cost_price']) ? $info['cost_price'] : ''?>" name="cost_price"/> 分
                        <p>

                        <p>
                            <label>库存</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?php echo isset($info['stock']) ? $info['stock'] : ''?>" name="stock"/>
                        <p>

                        <p>
                            <label>尺码</label>
                            <select name="type" onchange="setSize(this.value)">
                                <?php foreach(array(0=>'请选择',1=>'T恤',2=>'卫衣',3=>'裤子',) as $k => $v):?>
                                <option value="<?=$k?>"><?=$v?></option>
                                <?php endforeach;?>
                            </select>
                            <span id="size"></span>
                        </p>

                        <p>
                            <label>描述</label>
                            <textarea class="text-input textarea" name="descr" cols="50" rows="15"><?php echo isset($info['descr']) ? $info['descr'] : ''?></textarea>
                        </p>

                        <p>
                            <label>图片</label>
                            <?php if(isset($image)):?><img width="50" height="50" src="<?=config_item('static_url'),'upload/color/',$image?>"><?php endif;?>
                            <input class="" multiple="" type="file" value="" name="images[]"/>
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
function setSize(val)
{
    $("#size").empty()
    if(val == 0)
    {
        return ;
    }
    $.post("<?=site_url('administrator/product_size/sizeinfo')?>", {type: val},
       function(data){
           if(data)
           {
               for(var i in data){
                   $("#size").append('<input type="checkbox" name="size[]" value="'+data[i].size_id+'">'+data[i].name+' ');
                }
           }
       },'json');
}

function load_model(val)
{
    $("#model").empty()
    if(val == 0)
    {
        return ;
    }
    $.post("<?=site_url('administrator/product_model/modelinfo')?>", {model_id: val},
       function(data){
           if(data)
           {
               for(var i in data)
               {
                   create_element(data[i]);
               }
           }
       },'json');
}

function create_element(json) {
    var type;
    switch (parseInt(json.type)) {
        case 1:
            type = 'radio';
            break;
        case 2:
            type = 'checkbox';
            break;
        case 4:
            type = 'text';
            break;
        default :
            type = 'select';
    }

    var tmp = json.attr_value.split(',');
    $("#model").append(json.attr_name + ' :')
    var html='';
    if (type !== 'select') {
        for (var j in tmp) {
            var checked = (type === 'radio' && j == 0) ? 'checked="true"' : '';
            var _class = (type === 'text') ? 'class="text-input"' : '';
            html += ' <input '+_class+' type="' + type + '" name="attr_value[' + json.attr_id + '][]" ' + checked + ' value="' + tmp[j] + '">'
            html += type === 'text' ? '' : tmp[j]
        }
    }
    else
    {
        for (var j in tmp) {

                html += '<option value = '+tmp[j]+'>'+tmp[j]+'</option>';
        }
        html = ' <select name="attr_value[' + json.attr_id + '][]"><option value="">请选择</option>'+html+'</select>';
    }
    $("#model").append(html+'<br />')
}
</script>
