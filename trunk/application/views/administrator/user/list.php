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
    <h2>用户列表</h2>

    <!-- <p id="page-intro">What would you like to do?</p> -->
    <ul class="shortcut-buttons-set">
        <li><a class="shortcut-button" href="<?=config_item('static_url')?>/administrator/user/userList"><span><br/> 用户列表 </span></a></li>
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear">
        <form action="<?=config_item('static_url')?>/administrator/user/search" method="post">
            <p>
                <label><b>输入关键字</b></label>
                <input class="text-input small-input" type="text" id="small-input" name="keyword" value="">
                <select name="s_type" class="small-input">
                    <option value="1">用户ID</option>
                    <option value="2">用户名称</option>
                </select>
                <input type="submit" value="搜索">
            </p>
            </form>
    </div>
    <!-- End .clear -->
    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>用户列表</h3>
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
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>昵称</th>
                        <th>等级</th>
                        <th>用户来源</th>
                        <th>用户积分</th>
                        <th>用户金额</th>
                        <th>状态</th>
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
                        <td><?php echo $v['uid'];?></td>
                        <td><?php echo $v['uname'];?></td>
                        <td><?php echo $v['nickname'];?></td>
                        <td><?php echo $v['lid'];?></td>
                        <td><?php echo $v['source'];?></td>
                        <td><?php echo $v['integral'];?></td>
                        <td><?php echo $v['amount'];?></td>
                        <td><?php echo $v['status'] ? '正常' : '已删除';?></td>
                        <td><?php echo $v['create_time'];?></td>
                        <td>
                            <a href="<?=config_item('static_url')?>/administrator/user/userDetail/<?php echo $v['uid']?>" title="查看用户"><img src="<?=config_item('static_url')?>/images/icons/view.png" alt="查看用户"></a>
                            <a href="<?=config_item('static_url')?>/administrator/user/userEdit/<?php echo $v['uid']?>" title="修改用户"><img src="<?=config_item('static_url')?>/images/icons/pencil.png" alt="修改用户"></a>
                            <a href="<?=config_item('static_url')?>/administrator/user_comment/userCommentList/<?php echo $v['uid']?>" title="查看留言">查看留言</a>
                            <a href="<?=config_item('static_url')?>/administrator/user_favorite/favoriteList/<?php echo $v['uid']?>" title="查看收藏">查看收藏</a>


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