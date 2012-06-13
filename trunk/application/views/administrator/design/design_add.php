<?php require(dirname(__FILE__) . '/../left.php'); ?>
<div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/"
                                                                                        title="Upgrade to a better browser">upgrade</a>
                your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852"
                                   title="Enable Javascript in your browser">enable</a> Javascript to navigate the
                interface
                properly.
                Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2>添加设计图</h2>
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/design/addDesign"><span> <img
            src="/images/icons/pencil_48.png" alt="icon"/><br/> 添加设计图 </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/pencil_48.png" alt="icon"/><br/> 添加设计图分类 </span></a>
        </li>
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/pencil_48.png"
                                                            alt="icon"/><br/> 设计图分类 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加设计图</h3>
            <!--
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Table</a></li>
                <li><a href="#tab2">Forms</a></li>
            </ul>
            -->
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->

            <div class="tab-content default-tab" id="tab1">
                <form action="<?=url('administrator/design/saveDesign')?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="source" value="1">
                    <fieldset>
                        <p>
                            <label>设计图名称</label>
                            <input class="text-input small-input" type="text" id="small-input" name="design_name" <?php echo isset($dInfo['dname']) ? $dInfo['dname'] : ''; ?>/>
                            <br/>
                        </p>
                        <p>
                            <label>分类</label>
                            <select name="design_category" class="small-input">
                                <?php foreach ($category as $item): ?>
                                <option value="<?=$item['class_id']?>" <?php if (isset($info['parent_id']) && $info['parent_id'] == $item['class_id']) {
                                    echo 'selected="selected"';
                                }?>><?php echo str_repeat("&nbsp;", $item['floor']), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>

                        <p>
                            <label>投票结束时间</label>
                            <input class="text-input small-input" type="text" id="small-input" name="vote_end_time" value="" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
                            <br/>
                        </p>
                        <p>
                            <label>设计图图片</label>
                            <input class="text-input small-input" type="file" id="small-input" name="design_image"/>
                            <br/>
                        </p>
                        <p>
                            <label>设计图介绍</label>
                            <textarea class="text-input textarea wysiwyg" id="textarea" name="design_detail" cols="79" rows="15"></textarea>
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

    <?php require(dirname(__FILE__) . '/../footer.php'); ?>
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
