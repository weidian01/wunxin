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
    <h2><?php echo $type == 'edit' ? '编辑分类' : '添加分类'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/article/articleAdd"><span><br/> 添加文章 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/article/articleList"><span><br/> 文章列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/article_category/categoryAdd"><span><br/> 添加分类 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/article_category/categoryList"><span><br/> 分类列表 </span></a></li>
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
                <form action="<?php echo $type == 'edit' ? '/administrator/article_category/categoryEditSave' : '/administrator/article_category/categorySave';?>" method="post">
                    <input type="hidden" name="cid" value="<?php echo isset($info['cid']) ? $info['cid'] : ''?>">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>分类名称</label>
                            <input class="text-input" type="text" value="<?php echo isset($info['cname']) ? $info['cname'] : ''?>" name="cname"/>
                            <br/>
                        </p>

                        <p>
                            <label>上级分类</label>
                            <select name="parent_id" class="small-input">
                                <option value="0">顶级分类</option>
                                <?php foreach ($data as $item): ?>
                                <option value="<?=$item['cid']?>" <?php if(isset($info['parent_id']) && $info['parent_id']==$item['cid'] ){echo 'selected="selected"';}?>><?php echo str_repeat("&nbsp;", $item['floor']), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>
                        <p>
                            <label>排序</label>
                            <input class="text-input datepicker" type="text" value="<?php echo isset($info['sort']) ? $info['sort'] : ''?>" name="sort"/>

                        <p>
                            <label>存储路径</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['path']) ? $info['path'] : ''?>" name="path"/>
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

    <!-- <div class="clear"></div> -->
    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
