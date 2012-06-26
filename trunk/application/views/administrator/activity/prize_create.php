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
                interface properly.
                Download From <a href="http://www.exet.tk">exet.tk</a></div>
        </div>
    </noscript>
    <!-- Page Head -->
    <h2><?php echo $type == 'edit' ? '编辑活动' : '添加活动'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/activity/activityAdd"><span><br/> 添加活动 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/activity/activityList"><span><br/> 活动列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新活动</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/activity_prize/prizeEditSave' : '/administrator/activity_prize/prizeSave';?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="activity_id" value="<?php echo isset($info['activity_id']) ? $info['activity_id'] : ''?>">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>活动</label>
                            <select name="activity_id">
                                <?php foreach ($a_data as $v) {?>
                                <option value="<?php echo $v['activity_id'];?>" <?php echo (isset ($activity_id) && $activity_id == $v['activity_id']) ? 'selected="selected"' : '';?>><?php echo $v['subject'];?></option>
                                <?php }?>
                            </select>
                            <br/>
                        </p>
                        <p>
                            <label>奖品名称</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['prize_name']) ? $info['prize_name'] : ''?>" name="prize_name"/>
                            <br/>
                        </p>
                        <p>
                            <label>奖品图片</label>
                            <input class="text-input small-input" type="file" value="<?php echo isset($info['img_addr']) ? $info['img_addr'] : ''?>" name="img_addr"/>
                            <br/>
                        </p>
                        <p>
                            <label>奖品数量</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['number']) ? $info['number'] : ''?>" name="number" onkeyup="value=value.replace(/[^\d]/g, '')"/>
                            <br/>
                        </p>
                        <p>
                            <label>奖品说明</label>
                            <textarea class="text-input textarea wysiwyg" id="textarea" name="descr" cols="79" rows="15" style="display: none; "><?php echo isset($info['descr']) ? $info['descr'] : ''?></textarea>
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
    <?php require(dirname(__FILE__) . '/../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
