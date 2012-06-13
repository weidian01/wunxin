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
    <h2>设计图管理</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/design/addDesign"><span> <img src="/images/icons/pencil_48.png" alt="icon"/><br/> 添加设计图 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/design_category/create"><span> <img src="/images/icons/pencil_48.png" alt="icon"/><br/> 添加设计图分类 </span></a></li>
        <li><a class="shortcut-button" href="/administrator/design_category/index"><span> <img src="/images/icons/pencil_48.png" alt="icon"/><br/> 设计图分类列表 </span></a></li>
        <!--
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/paper_content_pencil_48.png" alt="icon"/><br/> Create a New Page </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/image_add_48.png" alt="icon"/><br/> Upload an Image </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/clock_48.png" alt="icon"/><br/> Add an Event </span></a></li>
        <li><a class="shortcut-button" href="#messages" rel="modal"><span> <img src="/images/icons/comment_48.png" alt="icon"/><br/> Open Modal </span></a></li>
        -->
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>Content box</h3>
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
                        <th>ID</th>
                        <th>分类ID</th>
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>设计图图片</th>
                        <th>设计图名称</th>
                        <th>介绍</th>
                        <th>投票人数</th>
                        <th>总分数</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Choose an action...</option>
                                    <option value="option2">Edit</option>
                                    <option value="option3">Delete</option>
                                </select>
                                <a class="button" href="#">Apply to selected</a>
                            </div>
                            <div class="pagination">
                            <?php echo $page_html;?>
                            </div>
                            <!--

                                <a href="#" title="First Page">&laquo; First</a>
                                <a href="#" title="Previous Page">&laquo; Previous</a>
                                <a href="#" class="number" title="1">1</a>
                                <a href="#" class="number" title="2">2</a>
                                <a href="#" class="number current" title="3">3</a>
                                <a href="#" class="number" title="4">4</a>
                                <a href="#" title="Next Page">Next &raquo;</a>
                                <a href="#" title="Last Page">Last &raquo;</a>

                            -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($data as $v) { ?>
                    <tr>
                        <td> <input type="checkbox" /> </td>
                        <td><?php echo $v['did'];?></td>
                        <td><?php echo $v['class_id'];?></td>
                        <td><?php echo $v['uid'];?></td>
                        <td><?php echo $v['uname'];?></td>
                        <td><img src="<?php echo $v['design_img'];?>" alt="<?php echo $v['dname'];?> width="50" height="50"/></td>
                        <td><?php echo $v['dname'];?></td>
                        <td><?php echo $v['ddetail'];?></td>
                        <td><?php echo $v['total_num'];?></td>
                        <td><?php echo $v['total_fraction'];?></td>
                        <td><?php echo $v['status'] ? '正常' : '删除';?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="#" title="Edit"><img src="/images/icons/pencil.png" alt="Edit"/></a>
                            <a href="#" title="Delete"> <img src="/images/icons/cross.png" alt="Delete"/></a>
                            <a href="#" title="Edit Meta"><img src="/images/icons/hammer_screwdriver.png"
                                                               alt="Edit Meta"/></a>
                        </td>
                    </tr>
                        <?php }?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require(dirname(__FILE__) . '/../footer.php'); ?>
</div>
</div>
</body>
</html>