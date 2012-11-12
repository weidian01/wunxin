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
        <li><a class="shortcut-button" href="<?=site_url('administrator/product/create')?>"><span>添加产品</span></a>
        </li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product/index')?>"><span>产品列表</span></a>
        </li>
        <li><a class="shortcut-button" href="<?=site_url('administrator/product_taobao/index')?>"><span>添加淘宝产品</span></a>
        </li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加款式关联</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=site_url('administrator/product_taobao/complete')?>" method="post">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>产品名称</label>
                            <input class="text-input large-input" type="text" value="<?=$public['pname'];?>" name="pname"/>
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <input name="unique_id" type="hidden" value="<?=$public['unique_id'];?>">
                            <input name="url" type="hidden" value="<?=$public['url'];?>">
                        </p>
                        <div style="float: left;width: 40%">
                        <p>
                            <label>产品图片</label>
                        <table>
                            <tr><th><input type="checkbox" class="select_all_def_img" checked="checked" onclick="select_all(this, 'def_img')"></th><th>图片</th><tr>
                        <?php foreach($public['def_img'] as $d_img):?>
                         <tr>
                            <td><input type="checkbox" name="def_img[]" value="<?=$d_img?>" checked="checked"></td>
                             <td><a href="<?=$d_img?>" target="_blank"><img src="<?=$d_img?>" width="100" height="100"></a></td>
                         </tr>
                        <?php endforeach;?>
                        </table>
                        </p>
                            </div>
                        <div style="float: left;width: 40%">
                        <p>
                            <label>产品简介图片</label>
                        <table>
                            <tr><th><input type="checkbox" class="select_all_desc_img" checked="checked" onclick="select_all(this, 'desc_img')"></th><th>图片</th><tr>
                        <?php foreach($public['desc_img'] as $key=>$_img):?>
                         <tr>
                             <td><input type="checkbox" name="desc_img[]" value="<?=$key?>|||||<?=$_img?>" checked="checked"></td>
                             <td><a href="<?=$_img?>" target="_blank"><img src="<?=$_img?>" width="100" height="100"></a></td>
                         </tr>
                        <?php endforeach;?>
                        </table>
                        </p>
                        </div>
                        <div style="clear: both"></div>
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
    function select_all(obj, name) {
        var flag = $(obj).attr('checked');
        if (flag) {
            $("input[name='" + name + "[]']").attr("checked", true);
        }
        else {
            $("input[name='" + name + "[]']").attr("checked", false);
        }
    }
</script>