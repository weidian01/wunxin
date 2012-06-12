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
        <li><a class="shortcut-button" href="<?=url('administrator/product_category/create')?>"><span>添加分类</span></a>
        </li>
        <li><a class="shortcut-button" href="<?=url('administrator/product_category/index')?>"><span>分类列表</span></a>
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
                <form action="<?=url('administrator/product_category/create')?>" method="post">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>分类名称</label>
                            <input class="text-input small-input" type="text"
                                   value="<?php echo isset($info['cname']) ? $info['cname'] : ''?>" name="cname"/>
                            <span class="input-notification success png_bg">Successful message</span>
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <br/>
                            <small>A small description of the field</small>
                        </p>

                        <p>
                            <label>上级分类</label>
                            <select name="parent_id" class="small-input">
                                <option value="0">顶级分类</option>
                                <?php foreach ($category as $item): ?>
                                <option
                                    value="<?=$item['class_id']?>"><?php echo str_repeat("&nbsp;", $item['floor']), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>

                        <p>
                            <label>商品模型</label>
                            <select name="model_id" class="small-input">
                                <option value="0">选择商品模型</option>
                                <?php foreach ($model as $item): ?>
                                <option value="<?=$item['model_id']?>"><?=$item['model_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>

                        <p>
                            <label>排序</label>
                            <input class="text-input small-input datepicker"
                                   type="text" <?php echo isset($info['sort']) ? $info['sort'] : ''?> name="sort"/>
                            <span class="input-notification error png_bg">Error message</span></p>

                        <p>
                            <label>SEO标题</label>
                            <input class="text-input small-input" type="text"
                                   value="<?php echo isset($info['title']) ? $info['title'] : ''?>" name="title"/>
                            <span class="input-notification success png_bg">Successful message</span>
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <br/>
                            <small>A small description of the field</small>
                        </p>

                        <p>
                            <label>SEO关键字</label>
                            <input class="text-input medium-input" type="text"
                                   value="<?php echo isset($info['keywords']) ? $info['keywords'] : ''?>"
                                   name="keywords"/>
                            <span class="input-notification success png_bg">Successful message</span>
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <br/>
                            <small>A small description of the field</small>
                        </p>

                        <p>
                            <label>SEO描述</label>
                            <textarea class="text-input textarea wysiwyg" name="descr" cols="79"
                                      rows="15"><?php echo isset($info['descr']) ? $info['descr'] : ''?></textarea>
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
