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
                <h4>颜色添加</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?=url('admin')?>administrator/product_color/save" accept-charset="utf-8" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label for="select01" class="control-label">上级分类</label>
                        <div class="controls">
                            <select name="parent_id" id="select01" class="span2">
                                <option value="0">顶级分类</option>
                                <?php foreach ($color as $v): ?>
                                <option <?php if (isset ($parent_id) && $parent_id == $v['color_id']): ?>selected="selected"<?php endif;?> value="<?=$v['color_id']?>"><?=$v['china_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="input01" class="control-label">中文名</label>

                        <div class="controls">
                            <input type="text" id="input01" class="input-medium" value="<?=isset($china_name) ? $china_name : ''?>" name="china_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input02" class="control-label">英文名</label>

                        <div class="controls">
                            <input type="text" id="input02" class="input-medium" value="<?=isset($english_name) ? $english_name : ''?>" name="english_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input03" class="control-label">CODE</label>

                        <div class="controls">
                            <input type="text" id="input03" class="input-medium" value="<?=isset($code) ? $code : ''?>" name="code">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input04" class="control-label">描述</label>

                        <div class="controls">
                            <input type="text" id="input04" class="input-medium" value="<?=isset($descr) ? $descr : ''?>" name="descr">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="fileInput" class="control-label">颜色图片</label>

                        <div class="controls">
                            <?php if(isset($image)):?><img src="<?=url('img').'color/'.$image?>"><?php endif;?>
                            <input type="file" id="fileInput" class="input-file" name="image">
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="color_id" value="<?=isset($color_id) ? $color_id : ''?>">
                        <button class="btn btn-primary" type="submit">保存更改</button>
                        <button class="btn" type="reset">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
