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
    <h2>设计图评论回复列表</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/design/addDesign"><span> <!--<img src="<?=config_item('static_url')?>images/icons/pencil_48.png" alt="icon"/>--><br/> 添加设计图 </span></a>
        </li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/design/designList"><span> <!--<img src="<?=config_item('static_url')?>images/icons/pencil_48.png" alt="icon"/>--><br/> 设计图列表 </span></a>
        </li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/design_category/create"><span> <!--<img src="<?=config_item('static_url')?>images/icons/pencil_48.png" alt="icon"/>--><br/> 添加设计图分类 </span></a>
        </li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/design_category/index"><span> <!--<img src="<?=config_item('static_url')?>images/icons/pencil_48.png" alt="icon"/>--><br/> 设计图分类列表 </span></a>
        </li>
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/design_comment/commentList"><span> <!--<img src="<?=config_item('static_url')?>images/icons/pencil_48.png" alt="icon"/>--><br/> 设计图评论列表 </span></a>
        </li>

        <!--
        <li><a class="shortcut-button" href="#"><span> <img src="<?=config_item('static_url')?>images/icons/paper_content_pencil_48.png" alt="icon"/><br/> Create a New Page </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="<?=config_item('static_url')?>images/icons/image_add_48.png" alt="icon"/><br/> Upload an Image </span></a></li>
        <li><a class="shortcut-button" href="#"><span> <img src="<?=config_item('static_url')?>images/icons/clock_48.png" alt="icon"/><br/> Add an Event </span></a></li>
        <li><a class="shortcut-button" href="#messages" rel="modal"><span> <img src="<?=config_item('static_url')?>images/icons/comment_48.png" alt="icon"/><br/> Open Modal </span></a></li>
        -->
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"> </div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>设计图评论内容</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>

                        <th>评论ID</th>
                        <th>设计图ID</th>
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>评论标题</th>
                        <th>评论内容</th>
                        <th>IP地址</th>
                        <th>回复数量</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?=$comment_data['comment_id'];?></td>
                        <td><a
                            href="<?=config_item('static_url')?>administrator/design_comment/designCommentList/<?=$comment_data['did'];?>"><?=$comment_data['did'];?></a>
                        </td>
                        <td><a
                            href="<?=config_item('static_url')?>administrator/design_comment/userCommentList/<?=$comment_data['uid'];?>"><?=$comment_data['uid'];?></a>
                        </td>
                        <td><?=$comment_data['uname'];?></td>
                        <td><?=$comment_data['title'];?></td>
                        <td><?=$comment_data['content'];?></td>
                        <td><?=$comment_data['ip'];?></td>
                        <td><?=$comment_data['reply_num'];?></td>
                        <td><?=$comment_data['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/design_comment/deleteComment/<?=$comment_data['comment_id'];?>"
                               title="删除评论图评论"> <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="Delete"/></a>
                            <!--<a href="#" title="Edit Meta"><img src="<?=config_item('static_url')?>images/icons/hammer_screwdriver.png"alt="Edit Meta"/></a>-->
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
            <h3>评论回复列表</h3>

            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <table>
                    <thead>
                    <tr>
                        <th><input class="check-all" type="checkbox"/></th>
                        <th>回复ID</th>
                        <th>评论ID</th>
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>回复内容</th>
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
                                <?=$page_html;?>
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
                        <td><?=$v['id'];?></td>
                        <td><?=$v['comment_id'];?></td>
                        <td><a href="<?=config_item('static_url')?>administrator/design_comment/userCommentList/<?=$v['uid'];?>"
                               title="查看用户所有评论"><?=$v['uid'];?></a></td>
                        <td><?=$v['uname'];?></td>
                        <td><?=$v['content'];?></td>
                        <td><?=$v['ip'];?></td>
                        <td><?=$v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>administrator/design_comment/deleteReply/<?=$v['id'].'/'.$comment_data['comment_id'];?>"
                               title="删除评论图回复"> <img src="<?=config_item('static_url')?>images/icons/cross.png" alt="Delete"/></a>
                            <!--<a href="#" title="Edit Meta"><img src="<?=config_item('static_url')?>images/icons/hammer_screwdriver.png"alt="Edit Meta"/></a>-->
                        </td>
                    </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include(APPPATH.'views/administrator/footer.php');?>
</div>
</div>
</body>
</html>