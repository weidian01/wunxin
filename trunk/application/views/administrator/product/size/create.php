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
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_size/create')?>"><span>添加号码</span></a>
        </li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_size/index')?>"><span>号码列表</span></a>
        </li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新尺码</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=site_url('administrator/product_size/save')?>" method="post">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>名称</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($name) ? $name : ''?>" name="name"/>
                            <input type="hidden" name="size_id" value="<?php echo isset($size_id) ? $size_id : ''?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <small>名称不能为空</small>
                        </p>
                        <p>
                            <label>简介</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($abbreviation) ? $abbreviation : ''?>" name="abbreviation"/>
                            <small>简介不能为空</small>
                        </p>
                        <p>
                            <label>描述</label>
                            <input class="text-input" type="text"
                                   value="<?php echo isset($descr) ? $descr : ''?>" name="descr"/>
                            <small>描述不能为空</small>
                        </p>
                        <p>
                            <label>类型</label>
                            <select name="type">
                            <?php foreach(array(0=>'请选择',1=>'T恤',2=>'卫衣',3=>'衬衫',4=>'裤子',) as $k => $v):?>
                            <option value="<?=$k?>" <?php if(isset($type) && $type==$k) echo 'selected="selected"'?>><?=$v?></option>
                            <?php endforeach;?>
                            </select>
                            <small>必须选择类型</small>
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

    <?php include(APPPATH.'views/administrator/footer.php');?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>