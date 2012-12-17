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
                <h4>分类设置</h4>
            </div>

            <form class="form-horizontal" action="<?=url('admin')?>administrator/product_category/save" method="post">
                <fieldset>
                    <div class="control-group">
                        <label for="input00" class="control-label">分类名称</label>

                        <div class="controls">
                            <input type="text" id="input00" class="input-medium" value="<?=isset($info['cname']) ? $info['cname'] : ''?>" name="cname">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="select01" class="control-label">上级分类</label>

                        <div class="controls">
                            <select name="parent_id" id="select01" class="span2">
                                <option value="0">顶级分类</option>
                                <?php foreach ($category as $item): ?>
                                <option value="<?=$item['class_id']?>" <?php if(isset($info['parent_id']) && $info['parent_id']==$item['class_id'] ){echo 'selected="selected"';}?>><?=str_repeat("&nbsp;", ($item['floor'] * 4)), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="select02" class="control-label">模型</label>

                        <div class="controls">
                            <select name="model_id" id="select02" class="span2">
                                <option value="0">选择产品模型</option>
                                <?php foreach ($model as $item): ?>
                                <option value="<?=$item['model_id']?>" <?php if(isset($info['model_id']) && $info['model_id']==$item['model_id'] ){echo 'selected="selected"';}?>><?=$item['model_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input01" class="control-label">排序</label>

                        <div class="controls">
                            <input type="text" id="input01" class="input-medium" value="<?=isset($info['sort']) ? $info['sort'] : ''?>" name="sort">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input02" class="control-label">URL</label>

                        <div class="controls">
                            <input type="text" id="input02" class="input-xxlarge" value="<?=isset($info['url']) ? $info['url'] : ''?>" name="url">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input03" class="control-label">SEO标题</label>

                        <div class="controls">
                            <input type="text" id="input03" class="input-medium" value="<?=isset($info['title']) ? $info['title'] : ''?>" name="title">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input04" class="control-label">SEO关键字</label>

                        <div class="controls">
                            <input type="text" id="input04" class="input-xxlarge" value="<?=isset($info['keywords']) ? $info['keywords'] : ''?>" name="keywords">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">SEO描述</label>

                        <div class="controls">
                            <textarea rows="5" id="textarea" class="input-xxlarge" name="descr"><?=isset($info['descr']) ? $info['descr'] : ''?></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="class_id" value="<?=isset($info['class_id']) ? $info['class_id'] : ''?>">
                        <button class="btn btn-primary" type="submit">保存更改</button>
                        <button class="btn" type="reset">取消</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require(APPPATH . 'views/administrator/bootstrap/footer.php');?>
