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
    <h2><?php echo $type == 'edit' ? '编辑分类' : '添加分类'; ?></h2>
    <!--p id="page-intro">产品分类管理</p-->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/article/articleAdd"><span><br/> 添加文章 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/article/articleList"><span><br/> 文章列表 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/article_category/categoryAdd"><span><br/> 添加分类 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/article_category/categoryList"><span><br/> 分类列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>添加新文章</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <!-- End #tab1 -->
            <div class="tab-content default-tab" id="tab1">
                <form action="<?php echo $type == 'edit' ? '/administrator/article/articleEditSave' : '/administrator/article/articleSave';?>" method="post">
                    <input type="hidden" name="id" value="<?php echo isset($info['id']) ? $info['id'] : ''?>">
                    <fieldset>
                        <p>
                            <label>文章标题</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['title']) ? $info['title'] : ''?>" name="title"/>
                            <br/>
                        </p>
                        <p>
                            <label>文章分类</label>
                            <select name="cid" class="small-input">
                                <option value="0">顶级分类</option>
                                <?php foreach ($class_data as $item): ?>
                                <option value="<?=$item['cid']?>" <?php if(isset($info['cid']) && $info['cid']==$item['cid'] ){echo 'selected="selected"';}?>><?php echo str_repeat("&nbsp;", $item['floor']), $item['cname']?></option>
                                <?php endforeach;?>
                            </select>
                        </p>
                        <p>
                            <label>关键字</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['keywords']) ? $info['keywords'] : ''?>" name="keyword"/>

                        <p>
                            <label>描述</label>
                            <input class="text-input small-input" type="text" value="<?php echo isset($info['descr']) ? $info['descr'] : ''?>" name="descr"/>
                            <br/>
                        </p>
                        <p>
                            <label>是否显示</label>
                            <input type="radio" value="1" <?php echo isset($info['visiblity']) && $info['visiblity'] === '1' ? 'checked="checked"' : '';?> name="visiblity"/> 显示
                            <input type="radio" value="0" <?php echo isset($info['visiblity']) && $info['visiblity'] === '0' ? 'checked="checked"' : '';?> name="visiblity"/> 不显示
                            <br/>
                        </p>
                        <p>
                            <label>是否置顶</label>
                            <input type="radio" value="1" <?php echo isset($info['top']) && $info['top'] === '1' ? 'checked="checked"' : '';?> name="top"/> 置顶
                            <input type="radio" value="0" <?php echo isset($info['top']) && $info['top'] === '1' ? 'checked="checked"' : '';?> name="top"/> 不置顶
                            <br/>
                        </p>
                        <p>
                            <label>内容</label>
                            <textarea class="text-input textarea" name="content" cols="50" rows="15"><?php echo isset($info['content']) ? $info['content']: '';?></textarea>
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

    <div class="clear"></div>

    <?php require(dirname(__FILE__) . '/../footer.php'); ?>
    <!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/kindeditor-min.js"></script>
<script charset="utf-8" src="<?=config_item('static_url')?>scripts/kindeditor-4.1.1/lang/zh_CN.js"></script>
<script>
    $(function () {
        var editor = KindEditor.create('textarea[name="content"]', {
            uploadJson:'/administrator/attached/upload',
            fileManagerJson:'/administrator/attached/manager',
            resizeType:1,
            allowPreviewEmoticons:false,
            allowFileManager:true,
            allowImageUpload:true,
            items:[
                'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'unlink']
        });
    });
</script>