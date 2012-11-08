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
    <h2><?=$type == 'edit' ? '编辑广告' : '添加广告'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad_position/positionAdd"><span><br/> 添加广告位置 </span></a>
        </li>
        <li><a class="shortcut-button"
               href="<?=config_item('static_url')?>administrator/business_ad_position/positionList"><span><br/> 广告位置列表 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad/adAdd"><span><br/> 添加广告 </span></a></li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_ad/adList"><span><br/> 广告列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3><?=$type == 'edit' ? '修改广告' : '添加广告'; ?></h3>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?=$type == 'edit' ? '/administrator/business_ad/adEditSave' : '/administrator/business_ad/adSave';?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="ad_id" value="<?=isset($info['ad_id']) ? $info['ad_id'] : ''?>">
                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>广告名称</label>
                            <input class="text-input" type="text" value="<?=isset($info['ad_name']) ? $info['ad_name'] : ''?>" name="name"/> <br/>
                        </p>
                        <p>
                            <label>广告位置</label>
                            <select name="position_id">
                                <?php $info['position_id'] = isset ($info['position_id']) ? $info['position_id'] : '';foreach ($position_data as $v) { ?>
                                <?php if ($v['position_id'] == $info['position_id']) { ?>
                                    <option value="<?=$v['position_id'];?>"
                                            selected="selected"><?=$v['name'];?></option>
                                    <?php } else { ?>
                                    <option value="<?=$v['position_id'];?>"><?=$v['name'];?></option>
                                    <?php } ?>
                                <?php }?>
                            </select>
                        </p>
                        <p>
                            <label>广告类型</label>
                            <select name="ad_type" onchange="adTypeChange(this)">
                                <option value="1" <?=isset ($info['ad_type']) ? ($info['ad_type'] == 1 ? 'selected="selected"' : '') : '';?>>图片广告</option>
                                <option value="2" <?=isset ($info['ad_type']) ? ($info['ad_type'] == 2 ? 'selected="selected"' : '') : '';?>>flash广告</option>
                                <option value="3" <?=isset ($info['ad_type']) ? ($info['ad_type'] == 3 ? 'selected="selected"' : '') : '';?>>代码广告</option>
                                <option value="4" <?=isset ($info['ad_type']) ? ($info['ad_type'] == 4 ? 'selected="selected"' : '') : '';?>>文字广告</option>
                            </select>
                        </p>
                        <p>
                            <label>广告内容</label>
                            <span id="ad_content_id">
                                <?php $info['ad_type'] = isset($info['ad_type']) ? $info['ad_type'] : '';
                                if (in_array($info['ad_type'], array('1', '2')) || empty ($info['ad_type'])) {?>
                                <input class="text-input small-input" type="file" name="ad_content"/>
                                <img src="<?=base_url().(isset ($info['ad_content']) ? $info['ad_content']: '');?>" alt="<?=isset ($info['ad_name']) ? $info['ad_name']: '';?>" width="50" height="50">
                                <?php } else {?>
                                <textarea class="text-input textarea" name="ad_content" cols="50" rows="15"><?=isset ($info['ad_content']) ? $info['ad_content']: '';?></textarea>
                                <?php }?>
                            </span> <br/>
                        </p>
                        <p>
                            <label>状态</label>
                            <input class="text-input " type="radio" value="1" name="status" <?php if (!isset ($info['status'])) $info['status'] = '';echo $info['status'] ? 'checked="checked"' : '';?>/>显示
                            <input class="text-input " type="radio" value="0" name="status" <?php if (!isset ($info['status'])) $info['status'] = '';echo $info['status'] ? '' : 'checked="checked"';?>/>不显示 <br/>
                        </p>
                        <p>
                            <label>广告链接</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['ad_link']) ? $info['ad_link'] : ''?>" name="ad_link"/> <br/>
                        </p>
                        <p>
                            <label>广告排序</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['sort']) ? $info['sort'] : ''?>" name="sort" onkeyup="value=value.replace(/[^\d]/g, '')"/> <br/>
                        </p>
                        <p>
                            <label>开始时间</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['start_time']) ? $info['start_time'] : ''?>" name="start_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/> <br/>
                        </p>
                        <p>
                            <label>结束时间</label>
                            <input class="text-input small-input" type="text" value="<?=isset($info['end_time']) ? $info['end_time'] : ''?>" name="end_time" onclick="WdatePicker({startDate:'%y-%M-01 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/> <br/>
                        </p>
                        <p>
                            <label>描述</label>
                            <textarea class="text-input textarea" name="descr" cols="50" rows="15"><?=isset ($info['descr']) ? $info['descr'] : '';?></textarea> <br/>
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
    <?php include(APPPATH.'views/administrator/footer.php');?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<script type="text/javascript">
    function adTypeChange(v) {
        if (v.value == '1' || v.value == '2' ) {
            var html = '<input class="text-input small-input" type="file" name="ad_content"/>';
            $('#ad_content_id').html(html);
        } else {
            var html = '<textarea class="text-input textarea" name="ad_content" cols="50" rows="15"></textarea>';
            $('#ad_content_id').html(html);
        }
    }
</script>