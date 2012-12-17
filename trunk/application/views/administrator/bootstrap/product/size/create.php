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
                <h4>尺码设置</h4>
            </div>

            <form class="form-horizontal" method="post" action="<?=url('admin')?>administrator/product_size/save">
                <fieldset>
                    <div class="control-group">
                        <label for="select01" class="control-label">尺码类型</label>
                        <div class="controls">
                            <select name="type" id="select01" class="span2">
                                <?php foreach (config_item('size_type') as $k => $v): ?>
                                <option value="<?=$k?>" <?php if (isset($type) && $type == $k) echo 'selected="selected"'?>><?=$v?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="input01" class="control-label">名称</label>

                        <div class="controls">
                            <input type="text" id="input01" class="input-medium" value="<?=isset($name) ? $name : ''?>" name="name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input02" class="control-label">简介</label>

                        <div class="controls">
                            <input type="text" id="input02" class="input-medium" value="<?=isset($abbreviation) ? $abbreviation : ''?>" name="abbreviation">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input03" class="control-label">描述</label>

                        <div class="controls">
                            <input type="text" id="input03" class="input-medium" value="<?=isset($descr) ? $descr : ''?>" name="descr">
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" name="size_id" value="<?=isset($size_id) ? $size_id : ''?>">
                        <button class="btn btn-primary" type="submit">保存更改</button>
                        <button class="btn" type="reset">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>