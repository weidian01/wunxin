<?php require(APPPATH . 'views/administrator/bootstrap/header.php');?>
<?php require(APPPATH . 'views/administrator/bootstrap/navbar.php');?>
<div class="container-fluid" >
    <div class="row-fluid">
        <div class="span2">
            <?php require(__DIR__ . DS . '../leftnav.php');?>
        </div>
        <div class="span10">
            <?php require(__DIR__ . DS . 'subnav.php');?>

            <div class="page-header">
                <h4>产品设置</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?=url('admin')?>administrator/product/save" accept-charset="utf-8" enctype="multipart/form-data">
                    <fieldset>
                    <div class="control-group">
                      <label for="input01" class="control-label"> </label>
                      <div class="controls">
                          <a class="btn btn-info" href="javascript:get_product_info()"><i class="icon-info-sign icon-white"></i>获取产品信息参考(来自淘宝的产品)</a>
                      </div>
                    </div>
                      <div class="control-group">
                        <label for="input01" class="control-label">产品名称</label>
                        <div class="controls">
                          <input type="text" id="input01" class="input-xlarge" value="<?=isset($info['pname']) ? $info['pname'] : ''?>" name="pname" placeholder="不可为空">
                        </div>
                      </div>
                        <div class="control-group">
                          <label class="control-label">产品分类</label>
                          <div class="controls">
                              <select name="class_id">
                                  <option value="0">选择产品分类</option>
                                  <?php foreach ($category as $item): ?>
                                  <option value="<?=$item['class_id']?>" <?php if(isset($info['class_id']) && $info['class_id']==$item['class_id'] ){echo 'selected="selected"';}?>><?php echo str_repeat("&nbsp;", ($item['floor']*4) ), $item['cname']?></option>
                                  <?php endforeach;?>
                              </select>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input02" class="control-label">设计图ID</label>
                          <div class="controls">
                            <input type="text" id="input02" class="input-small" value="<?=isset($info['did']) ? $info['did'] : '0'?>" name="did">
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label">产品模型</label>
                          <div class="controls">
                              <select name="model_id" onchange="load_model(this.value)">
                                  <option value="0">选择产品模型</option>
                                  <?php foreach ($model as $item): ?>
                                  <option value="<?=$item['model_id']?>" <?php if(isset($info['model_id']) && $info['model_id']==$item['model_id'] ){echo 'selected="selected"';}?>><?=$item['model_name']?></option>
                                  <?php endforeach;?>
                              </select>
                          </div>
                        </div>

                        <div id="_model" class="control-group <?php if(!isset($attrs)):?>hide<?php endif;?>">
                            <label class="control-label"> </label>
                            <div class="controls">
                            <table id="model" class="table table-striped table-condensed">
                                <?php if(isset($attrs)):?>
                                <?php foreach($attrs as $attr):?>
                                    <?php if ($attr['attrs']):?>
                                    <tr>
                                        <td><?=$attr['attr_name']?></td>
                                        <td>
                                        <?php foreach($attr['attrs'] as $v):?>
                                            <?php if ($attr['type'] == 1): ?>
                                            <label class="radio inline"><input type="radio" name="attr_value[<?=$attr['attr_id']?>][]"  value="<?=$v['value_id']?>" <?php if(isset($pattr[$attr['attr_id']]) && in_array($v['value_id'], $pattr[$attr['attr_id']])):?>checked<?php endif;?>> <?=$v['value_name']?></label>
                                            <?php elseif ($attr['type'] == 2): ?>
                                            <label class="checkbox inline"><input type="checkbox" name="attr_value[<?=$attr['attr_id']?>][]" value="<?=$v['value_id']?>" <?php if(isset($pattr[$attr['attr_id']]) && in_array($v['value_id'], $pattr[$attr['attr_id']])):?>checked<?php endif;?>> <?=$v['value_name']?></label>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                        </td>
                                    <?php endif;?>
                                    </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </table>
                            </div>
                        </div>

                        <div class="control-group">
                          <label class="control-label">产品色系</label>
                          <div class="controls">
                              <select name="color_id">
                                  <option value="0">选择产品色系</option>
                                  <?php foreach ($color as $item):?>
                                  <optgroup label="<?=$item['china_name']?>">
                                  <?php if(isset($item['children'])):foreach ($item['children'] as $v): ?>
                                  <option style="background-color:<?=$v['code']?>;" value="<?=$v['color_id']?>" <?php if(isset($info['color_id']) && $info['color_id']==$v['color_id'] ){echo 'selected="selected"';}?>><?=$v['china_name']?>/<?=$v['english_name']?></option>
                                  <?php endforeach;endif;?>
                                  </optgroup>
                                  <?php endforeach;?>
                              </select>
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label">上架/下架</label>
                          <div class="controls">
                            <label class="radio inline">
                                <input type="radio" value="1" checked name="status"/>上架
                            </label>
                            <label class="radio inline">
                                <input type="radio" value="0"  <?php if(isset($info['status']) && $info['status']==0)echo 'checked';?> name="status"/>下架
                            </label>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input03" class="control-label">市场价格</label>
                          <div class="controls">
                            <div class="input-append"><input type="text" id="input03" class="input-small" value="<?=isset($info['market_price']) ? $info['market_price'] : ''?>" name="market_price" placeholder="单位分"><span class="add-on">分</span></div>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input04" class="control-label">销售价格</label>
                          <div class="controls">
                              <div class="input-append"><input type="text" id="input04" class="input-small" value="<?=isset($info['sell_price']) ? $info['sell_price'] : ''?>" name="sell_price" placeholder="单位分"><span class="add-on">分</span></div>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input05" class="control-label">成本价格</label>
                          <div class="controls">
                              <div class="input-append"><input type="text" id="input05" class="input-small" value="<?=isset($info['cost_price']) ? $info['cost_price'] : ''?>" name="cost_price" placeholder="单位分"><span class="add-on">分</span></div>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input06" class="control-label">库存</label>
                          <div class="controls">
                              <div class="input-append"><input type="text" id="input06" class="input-small" value="<?=isset($info['stock']) ? $info['stock'] : ''?>" name="stock" placeholder="单位件"><span class="add-on">件</span></div>
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label">尺码</label>
                          <div class="controls">
                              <select name="size_type" onchange="load_size(this.value)" class="input-small">
                                  <?php foreach(config_item('size_type') as $k => $v):?>
                                  <option value="<?=$k?>" <?php if(isset($info['size_type']) && $info['size_type'] == $k):?>selected="selected"<?php endif;?>><?=$v?></option>
                                  <?php endforeach;?>
                              </select>
                          </div>
                        </div>

                        <div id="_size" class="control-group <?php if (!isset($size)): ?>hide<?php endif;?>">
                          <label class="control-label"> </label>
                          <div class="controls" id="size">
                              <?php if (isset($size)): ?>
                              <?php foreach ($size as $v): ?>
                              <label class="checkbox inline"><input type="checkbox" name="size[<?=$v['size_id']?>]" value="<?=$v['name']?>" <?php if (in_array($v['size_id'], $psize)): ?>checked<?php endif;?>/><?= $v['name'] ?></label>
                              <?php endforeach; ?>
                              <?php endif;?>
                          </div>
                        </div>

                        <div class="control-group">
                          <label for="input07" class="control-label">SEO关键字</label>
                          <div class="controls">
                            <input type="text" id="input07" class="input-xlarge" value="<?=isset($info['keyword']) ? $info['keyword'] : ''?>" name="keyword" placeholder="keyword">
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input08" class="control-label">SEO描述</label>
                          <div class="controls">
                            <input type="text" id="input08" class="input-xxlarge" value="<?=isset($info['descr']) ? $info['descr'] : ''?>" name="descr" placeholder="description">
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="textarea" class="control-label">产品描述</label>
                          <div class="controls">
                            <textarea rows="15" id="textarea" name="pcontent" class="span9"><?=isset($info['pcontent']) ? $info['pcontent'] : ''?></textarea>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="fileInput" class="control-label">产品图片</label>
                          <div class="controls">
                            <input type="file" multiple="multiple" id="fileInput" class="input-file" name="images[]">
                          </div>
                        </div>
                      <div class="control-group">
                        <label for="fileInput" class="control-label"> </label>
                        <div class="controls">
                            <?php if(isset($photo)):?>
                            <style>.default_photo{border:3px solid #ff4500;}</style>
                            <div id="product_photo">
                            <?php $_view_flag = $_view_last_img_id = 0;foreach($photo as $v):$_view_last_img_id = $v['id'];?>
                                <div id="photo_<?=$v['id']?>">
                                    <img src="<?=url('img')?>product/<?php echo intToPath($v['pid']), str_replace('.','_S.', $v['img_addr'])?>" width="60" height="60" <?php if($v['is_default']==1):?>class="default_photo"<?php endif;?> onclick="select_photo(<?=$v['id']?>)"/>
                                    <a class="btn btn-mini btn-danger" href="javascript:;" onclick="del_photo(<?=$v['id']?>)"><i class="icon-trash icon-white"></i>删除</a>
                                </div>
                                <?php if($v['is_default']==1):$_view_flag = TRUE;?><input type="hidden" id="default_photo" name="default_photo" value="<?=$v['id'];?>"/><?php endif;?>
                            <?php endforeach;?>
                            <?php if($_view_flag == 0):?><input type="hidden" id="default_photo" name="default_photo" value="<?=$_view_last_img_id?>"/><?php endif;?>
                            </div>
                            <?php endif;?>
                        </div>
                      </div>

                        <div class="control-group">
                          <label class="control-label">仓库</label>
                          <div class="controls">
                              <select name="warehouse">
                              <?php foreach ($brands as $v):?>
                              <option value="<?=$v['bid']?>" <?=(isset ($info['brand_id']) && $v['bid'] == $info['brand_id']) ? 'selected="selected"' : '';?>><?=$v['name']?></option>
                              <?php endforeach;?>
                              </select>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input09" class="control-label">货物淘宝地址</label>
                          <div class="controls">
                            <input type="text" id="input09" class="input-xxlarge" value="<?php echo isset($info['product_taobao_addr']) ? $info['product_taobao_addr'] : ''?>" name="product_taobao_addr" placeholder="产品在淘宝的页面地址">
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="input10" class="control-label">备用字段</label>
                          <div class="controls">
                            <input type="text" id="input10" class="input-medium" value="<?php echo isset($info['spare']) ? $info['spare'] : ''?>" name="spare" placeholder="备用字段可为空">
                          </div>
                        </div>

                      <div class="form-actions">
                        <input type="hidden" name="current_page" value="<?=isset ($current_page) ? $current_page : '';?>"/>
                        <input type="hidden" name="pid" value="<?=isset($info['pid']) ? $info['pid'] : ''?>">
                        <button class="btn btn-primary" type="submit">保存更改</button>
                        <button class="btn" type="reset">取消</button>
                      </div>
                    </fieldset>
                  </form>

        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
<script charset="utf-8" src="<?=url('admin')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=url('admin')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
<script type="text/javascript" src="<?=url('admin')?>scripts/artdialog.js"></script>
<link rel="stylesheet" href="<?=url('admin')?>css/artdialog.css" type="text/css" media="screen"/>
<script>
function load_size(val)
{
    $("#size").empty();
    $("#_size").hide();
    if(val == 0)
    {
        return ;
    }
    $.post("<?=url('admin')?>administrator/product_size/sizeinfo", {type: val},
       function(data){
           if(data)
           {
               for(var i in data){
                   $("#size").append('<label class="checkbox inline"><input type="checkbox" name="size['+data[i].size_id+']" value="'+data[i].name+'">'+data[i].name+'</label>');
                }
               $("#_size").fadeIn();
           }
           else
           {
               $("#_size").hide();
           }
       },'json');
}

function load_model(val)
{
    $("#model").empty();
    $("#_model").hide();
    if(val == 0)
    {
        return ;
    }
    $.post("<?=url('admin')?>administrator/product_models/get_model_attr", {model_id: val},
       function(data){
           if(data)
           {
               var count = 0;
               for(var i in data)
               {
                   count += create_element(data[i]);
               }
               count && $("#_model").fadeIn();
           }
           else
           {
               $("#_model").hide();
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
    }
    var html = '';
    $.each(json.attrs, function(i, n){
        var checked = type == 'radio' && !html ? 'checked="checked"':'';
        html += '<label class="'+type+' inline"><input '+checked+' type="' + type + '" name="attr_value[' + json.attr_id + '][]" value="' + n.value_id + '">'+n.value_name+'</label> ';
    });
    if(html)
    {
        $("#model").append('<tr><td>' + json.attr_name + '</td><td>' + html + '</td></tr>');
        return 1;
    }
    return 0
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

                wrap.css({'top': (hide + 'px'), 'left': '0px'})
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