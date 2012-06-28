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
    <h2>设计师留言详情</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="/administrator/user/userList"><span><br/> 用户列表 </span></a></li>
        <!--
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/paper_content_pencil_48.png" alt="icon"/><br/> Create a New Page </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/image_add_48.png" alt="icon"/><br/> Upload an Image </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="/images/icons/clock_48.png" alt="icon"/><br/> Add an Event </span></a></li>
        <li><a class="shortcut-button" href="#messages" rel="modal"><span> <img src="/images/icons/comment_48.png" alt="icon"/><br/> Open Modal </span></a></li>
        -->
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"> </div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>设计师留言内容</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>标题</th>
                        <th>内容</th>
                        <th>IP地址</th>
                        <th>回复数量</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $message_data['message_id'];?></td>
                        <td><?php echo $message_data['uid'];?></td>
                        <td><?php echo $message_data['uname'];?></td>
                        <td><?php echo $message_data['title'];?></td>
                        <td><?php echo $message_data['content'];?></td>
                        <td><?php echo $message_data['ip'];?></td>
                        <td><?php echo $message_data['reply_num'];?></td>
                        <td><?php echo $message_data['create_time'];?></td>
                        <td>
                            <a href="/administrator/user_comment/commentDelete/<?php echo $message_data['message_id'].'/'.$message_data['uid'].'/'.$current_page?>" title="删除留言"><img src="/images/icons/cross.png" alt="删除留言"></a>
                            <!--<a href="#" title="Edit Meta"><img src="/images/icons/hammer_screwdriver.png"alt="Edit Meta"/></a>-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>设计师留言回复列表</h3>

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
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>留言ID</th>
                        <th>内容</th>
                        <th>IP地址</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="13">
                            <!--
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Choose an action...</option>
                                    <option value="option2">Edit</option>
                                    <option value="option3">Delete</option>
                                </select>
                                <a class="button" href="#">Apply to selected</a>
                            </div>
                            -->
                            <div class="pagination">
                                <?php echo $page_html;?>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php if (empty ($reply_data)) {
                        $reply_data = array();
                    }foreach ($reply_data as $v) { ?>
                    <tr>
                        <td><input type="checkbox"/></td>
                        <td><?php echo $v['id'];?></td>
                        <td><?php echo $v['uid'];?></td>
                        <td><?php echo $v['uname'];?></td>
                        <td><?php echo $v['message_id'];?></td>
                        <td><?php echo $v['content'];?></td>
                        <td><?php echo $v['ip'];?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="/administrator/user_comment/deleteReply/<?php echo $v['id'].'/'.$message_data['message_id'];?>" title="删除评论图回复"> <img src="/images/icons/cross.png" alt="Delete"/></a>
                            <!--<a href="#" title="Edit Meta"><img src="/images/icons/hammer_screwdriver.png"alt="Edit Meta"/></a>-->
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