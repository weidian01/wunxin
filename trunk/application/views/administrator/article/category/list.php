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
    <h2>文章分类列表</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/article_category/categoryAdd"><span><br/> 添加分类 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/article_category/categoryList"><span><br/> 分类列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>文章分类列表</h3>
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
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox"/></th>
                        <th>分类ID</th>
                        <th>名称</th>
                        <th>父类ID</th>
                        <th>排序</th>
                        <th>路径</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="pagination">
                                <?php echo isset ($page_html) ? $page_html : '';?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php if (!isset ($data)) $data = array();
                    foreach ($data as $v) {
                        if (empty ($v)) continue;?>

                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><?php echo $v['cid'];?></td>
                        <td><?php echo str_repeat("&nbsp;", $v['floor'] * 4), $v['cname'];?></td>
                        <td><?php echo $v['parent_id'] ? $class_data[$v['parent_id']]['cname'] : '顶级分类';?></td>
                        <td><?php echo $v['sort'];?></td>
                        <td><?php echo $v['path'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="/administrator/article_category/categoryEdit/<?php echo $v['cid'];?>" title="编辑文章分类"><img src="/images/icons/pencil.png" alt="编辑文章分类"/></a>
                            <a href="/administrator/article_category/categoryDelete/<?php echo $v['cid'];?>" title="删除文章分类"><img src="/images/icons/cross.png" alt="删除文章分类"/></a>
                        </td>
                    </tr>
                        <?php }?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
</div>
</div>
</body>
</html>