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
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=site_url('administrator/product/create')?>"><span>添加产品</span></a></li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product/index')?>"><span>产品列表</span></a></li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_taobao/index')?>"><span>添加淘宝产品</span></a></li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product/copy_attr')?>" target="_blank"><span>复制产品属性</span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新产品</h3>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <a href="javascript:get_product_info()">获取产品信息参考(来自淘宝的产品)</a>
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <?=form_open_multipart('administrator/product/save')?>
                <input type="hidden" name="current_page" value="<?=isset ($current_page) ? $current_page : '';?>"/>
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>产品名称</label>
                            <input class="text-input medium-input" type="text"
                                   value="<?=isset($info['pname']) ? $info['pname'] : ''?>" name="pname"/>
                            <input type="hidden" name="pid" value="<?=isset($info['pid']) ? $info['pid'] : ''?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <br/>
                            <small>分类名称不能为空</small>
                        </p>

                        <p>
                            <label>上级分类</label>
                            <select name="class_id" class="small-input">
                                <option value="0">顶级分类</option>
                                <?php foreach ($category as $item): ?>
                                <option value="<?=$item['class_id']?>" <?php if(isset($info['class_id']) && $info['class_id']==$item['class_id'] ){echo 'selected="selected"';}?>><?=str_repeat("&nbsp;", $item['floor']). $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>

                        <p>
                            <label>设计图id</label>
                            <input class="text-input" type="text" value="<?=isset($info['did']) ? $info['did'] : ''?>" name="did"/>
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
                            <?php if(isset($attrs)):?>
                                <?php foreach($attrs as $attr):?>
                                <?php if ($attr['attrs']):?>
                                    <?=$attr['attr_name']?> ：
                                    <?php foreach($attr['attrs'] as $v):?>
                                        <?php if ($attr['type'] == 1): ?>
                                        <input type="radio" name="attr_value[<?=$attr['attr_id']?>][]"  value="<?=$v['value_id']?>" <?php if(isset($pattr[$attr['attr_id']]) && in_array($v['value_id'], $pattr[$attr['attr_id']])):?>checked<?php endif;?>> <?=$v['value_name']?>
                                        <?php elseif ($attr['type'] == 2): ?>
                                        <input type="checkbox" name="attr_value[<?=$attr['attr_id']?>][]" value="<?=$v['value_id']?>" <?php if(isset($pattr[$attr['attr_id']]) && in_array($v['value_id'], $pattr[$attr['attr_id']])):?>checked<?php endif;?>> <?=$v['value_name']?>
                                        <?php endif;?>
                                    <?php endforeach;?><br />
                                <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </p>

                        <p>
                            <label>产品色系</label>
                            <select name="color_id" class="small-input">
                                <option value="0">选择产品色系</option>
                                <?php foreach ($color as $item):?>
                                <optgroup label="<?=$item['china_name']?>">
                                <?php if(isset($item['children'])):foreach ($item['children'] as $v): ?>
                                <option style="background-color:<?=$v['code']?>;" value="<?=$v['color_id']?>" <?php if(isset($info['color_id']) && $info['color_id']==$v['color_id'] ){echo 'selected="selected"';}?>><?=$v['china_name']?>/<?=$v['english_name']?></option>
                                <?php endforeach;endif;?>
                                </optgroup>
                                <?php endforeach;?>
                            </select> <br>
                            <small>必须指定产品色系</small>
                        </p>

                        <p>
                            <label>是否上架</label>
                            上架<input type="radio" value="1" checked name="status"/>
                            下架<input type="radio" value="0"  <?php if(isset($info['status']) && $info['status']==0)echo 'checked';?> name="status"/>
                        <p>

                        <p>
                            <label>市场价格</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?=isset($info['market_price']) ? $info['market_price'] : ''?>" name="market_price"/> 分

                        <p>

                        <p>
                            <label>销售价格</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?=isset($info['sell_price']) ? $info['sell_price'] : ''?>" name="sell_price"/> 分
                        <p>

                        <p>
                            <label>成本价格</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?=isset($info['cost_price']) ? $info['cost_price'] : ''?>" name="cost_price"/> 分
                        <p>

                        <p>
                            <label>库存</label>
                            <input class="text-input datepicker"
                                   type="text" value="<?=isset($info['stock']) ? $info['stock'] : ''?>" name="stock"/>
                        <p>

                        <p>
                            <label>尺码</label>
                            <select name="size_type" onchange="load_size(this.value)">
                                <?php foreach(config_item('size_type') as $k => $v):?>
                                <option value="<?=$k?>" <?php if(isset($info['size_type']) && $info['size_type'] == $k):?>selected="selected"<?php endif;?>><?=$v?></option>
                                <?php endforeach;?>
                            </select>
                            <span id="size">
                                <?php if(isset($size)):?>
                                <?php foreach($size as $v):?>
                                <input type="checkbox" name="size[<?=$v['size_id']?>]" value="<?=$v['name']?>" <?php if(in_array($v['size_id'], $psize)):?>checked<?php endif;?>/><?=$v['name']?>
                                <?php endforeach;?>
                                <?php endif;?>
                            </span>
                        </p>

                        <p>
                            <label>SEO关键字</label>
                            <input class="text-input medium-input"
                                   type="text" value="<?=isset($info['keyword']) ? $info['keyword'] : ''?>" name="keyword"/>
                        <p>

                        <p>
                            <label>SEO描述</label>
                            <input class="text-input large-input"
                                   type="text" value="<?=isset($info['descr']) ? $info['descr'] : ''?>" name="descr"/>
                        <p>

                        <p>
                            <label>产品描述</label>
                            <textarea class="text-input textarea" name="pcontent" cols="50" rows="15"><?=isset($info['pcontent']) ? $info['pcontent'] : ''?></textarea>
                        </p>

                        <p>
                            <label>图片</label>
                            <?php if(isset($image)):?><img width="50" height="50" src="<?=config_item('static_url').'upload/color/'.$image?>"><?php endif;?>
                            <input class="" multiple="" type="file" value="" name="images[]"/>
                        </p>

                        <?php if(isset($photo)):?>
                        <style>.default_photo{border:3px solid #ff4500;}</style>
                        <div id="product_photo">
                        <?php $_view_flag = false;foreach($photo as $v):?>
                            <div id="photo_<?=$v['id']?>">
                                <img src="<?=config_item('static_url').'upload/product/'.intToPath($v['pid']).str_replace('.','_S.', $v['img_addr'])?>"
                                     width="60" height="60" <?php if($v['is_default']==1):?>class="default_photo"<?php endif;?> onclick="select_photo(<?=$v['id']?>)"/>
                                <a href="javascript:void(null);" onclick="del_photo(<?=$v['id']?>)">删除</a></div>
                            <?php if($v['is_default']==1):$_view_flag = true;?><input type="hidden" id="default_photo" name="default_photo" value="<?=$v['id'];?>"/><?php endif;?>
                        <?php endforeach;?>
                        <?php if($_view_flag == false):?><input type="hidden" id="default_photo" name="default_photo" value="<?=$v['id']?>"/><?php endif;?>
                        </div>
                        <?php endif;?>
                        <p>
                            <label>仓库</label>
                            <select name="warehouse">
                            <?php foreach ($brands as $v) {?>
                            <option value="<?=$v['bid']?>" <?=(isset ($info['brand_id']) && $v['bid'] == $info['brand_id']) ? 'selected="selected"' : '';?>><?=$v['name']?></option>
                            <?php }?>
                            </select>
                            <!--<input class="text-input" id="" name="warehouse" type="text" value="<?=isset($info['warehouse']) ? $info['warehouse'] : ''?>">-->
                            <small style="color:red;">不包含http:// 例 : jsbike.taobao.com</small>
                        </p>
                        <p>
                            <label>货物淘宝地址</label>
                            <input class="text-input large-input" name="product_taobao_addr" type="text" value="<?php echo isset($info['product_taobao_addr']) ? $info['product_taobao_addr'] : ''?>">

                        </p>
                        <p>
                            <label>备用字段</label>
                            <input class="text-input small-input" name="spare" type="text" value="<?php echo isset($info['spare']) ? $info['spare'] : ''?>">
                        </p>
                        <p id="hidden">
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
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
<link rel="stylesheet" href="<?=config_item('static_url')?>css/artdialog.css" type="text/css" media="screen"/>
<script>
function load_size(val)
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
                   $("#size").append('<input type="checkbox" name="size['+data[i].size_id+']" value="'+data[i].name+'">'+data[i].name+' ');
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
    $.post("<?=site_url('administrator/product_models/get_model_attr')?>", {model_id: val},
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
    var html= '';
    $.each(json.attrs, function(i, n){
        html += ' <input type="' + type + '" name="attr_value[' + json.attr_id + '][]" value="' + n.value_id + '"> ' + n.value_name
    });
    html = html ? json.attr_name + ' ：' + html + '<br>' : '';
    $("#model").append(html)
    return;
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

function del_photo(id)
{
    $("#hidden").append('<input type="hidden" name="delphoto[]" value="'+id+'" />');
    var tmp = $("#photo_"+id).children(".default_photo").attr('class');

    $("#photo_"+id).remove();
    if (typeof tmp !== 'undefined') {
        var img_obj = $('#product_photo > div:first > img:first').addClass("default_photo");
        var div_id = img_obj.parent().attr('id');
        if(typeof div_id !== 'undefined')
        {
            set_default_photo(0);
        }
        else
        {
            set_default_photo(div_id.substr(6));
        }
    }
}

function select_photo(id)
{
    $('#product_photo > div').each(
        function(){
            if('photo_'+id == $(this).attr('id'))
            {
                $('img', this).addClass("default_photo");
                set_default_photo(id);
            }else{
                $('img', this).removeClass("default_photo");
            }
        }
    );
}

function set_default_photo(id)
{
    $('#default_photo').val(id);
}

$(function () {
    var editor = KindEditor.create('textarea[name="pcontent"]', {
        //uploadJson:'/plug/kindeditor-4.1.1/php/upload_json.php',
        uploadJson:'/administrator/attached/upload',
        //fileManagerJson:'/plug/kindeditor-4.1.1/php/file_manager_json.php',
        fileManagerJson:'/administrator/attached/manager',
        resizeType:1,
        allowPreviewEmoticons:false,
        allowFileManager:true,
        allowImageUpload:true,
        items:[
            'source', 'preview', 'fullscreen', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
    });
});

function get_product_info()
{
    var url = $("input[name='product_taobao_addr']").val();
    $.post("/administrator/product_taobao/get_product_info", { 'url': url, 'spare':"<?php echo isset($info['spare']) ? $info['spare'] : ''?>" },
       function(data){
           _alert(data);
       });


}

function _alert(text)
{
    artDialog.notice = function (options) {
        var opt = options || {},
            api, aConfig, hide, wrap, top,
            duration = 800;

        var config = {
            id: 'Notice',
            left: '100%',
            top: '100%',
            fixed: true,
            drag: false,
            resize: false,
            follow: null,
            lock: false,
            init: function(here){
                api = this;
                aConfig = api.config;
                wrap = api.DOM.wrap;
                top = parseInt(wrap[0].style.top);
                hide = top + wrap[0].offsetHeight;

                wrap.css('top', hide + 'px')
                    .animate({top: top + 'px'}, duration, function () {
                        opt.init && opt.init.call(api, here);
                    });
            },
            close: function(here){
                wrap.animate({top: hide + 'px'}, duration, function () {
                    opt.close && opt.close.call(this, here);
                    aConfig.close = $.noop;
                    api.close();
                });

                return false;
            }
        };

        for (var i in opt) {
            if (config[i] === undefined) config[i] = opt[i];
        };

        return artDialog(config);
    };

    art.dialog.notice({
        title: false,//'万象网管',
        width: 220,// 必须指定一个像素宽度值或者百分比，否则浏览器窗口改变可能导致artDialog收缩
        content: text,
        icon: 'face-sad',
        time: false
    });
}
</script>


