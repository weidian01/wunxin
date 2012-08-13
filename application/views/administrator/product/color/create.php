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
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_color/create')?>"><span>添加颜色</span></a>
        </li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_color/index')?>"><span>颜色列表</span></a>
        </li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新颜色</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <?=form_open_multipart('administrator/product_color/save')?>
                <!--form action="<?php //echo site_url('administrator/product_color/save')?>" method="post"-->
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>上级分类</label>
                            <select name="parent_id">
                                <option value="0">顶级分类</option>
                                <?php foreach($color as $v):?>
                                <option <?php if($parent_id == $v['color_id']):?>selected="selected"<?php endif;?> value="<?=$v['color_id']?>"><?=$v['china_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>
                        <p>
                            <label>中文名</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($china_name) ? $china_name : ''?>" name="china_name"/>
                            <input type="hidden" name="color_id" value="<?php echo isset($color_id) ? $color_id : ''?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <small>不能为空</small>
                        </p>
                        <p>
                            <label>英文名</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($english_name) ? $english_name : ''?>" name="english_name"/>
                            <small>不能为空</small>
                        </p>
                        <p>
                            <label>CODE</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($code) ? $code : ''?>" name="code"/>
                            <small>不能为空</small>
                        </p>
                        <p>
                            <label>描述</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($descr) ? $descr : ''?>" name="descr"/>
                            <small>不能为空</small>
                        </p>
                        <p>
                            <label>图片</label>
                            <?php if(isset($image)):?><img width="50" height="50" src="<?=config_item('static_url'),'upload/color/',$image?>"><?php endif;?>
                            <input class="" type="file" value="" name="image"/>
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