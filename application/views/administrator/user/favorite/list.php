<?php include('/../../left.php'); ?>
<div id="main-content">
<!-- Main Content Section with everything -->
<noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
        <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/"
                                                                                    title="Upgrade to a better browser">upgrade</a>
            your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852"
                               title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface
            properly.
            Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
</noscript>
<!-- Page Head -->
<h2>用户收藏</h2>
<!--<p id="page-intro">What would you like to do?</p>-->
<ul class="shortcut-buttons-set">
    <li><a class="shortcut-button" href="/administrator/user/userList"><span><br/> 用户列表 </span></a></li>
</ul>
<!-- End .shortcut-buttons-set -->
<div class="clear"></div>
<!-- End .clear -->
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>收藏列表</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" <?php echo ($type == '1') ? 'class="default-tab"' : '';?> >设计师收藏</a></li>
            <li><a href="#tab2" <?php echo ($type == '2') ? 'class="default-tab"' : '';?> >产品收藏</a></li>
            <li><a href="#tab3" <?php echo ($type == '3') ? 'class="default-tab"' : '';?> >设计图收藏</a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content <?php echo  ($type == '1') ? 'default-tab"' : '';?>" id="tab1">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>设计师ID</th>
                    <th>IP地址</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($designer_favorite_data as $dfdv) {?>
                    <tr>
                        <td>
                            <input type="checkbox"/>
                        </td>
                        <td><?php echo $dfdv['designer_favorite_id'];?></td>
                        <td><?php echo $dfdv['favorite_uid'];?></td>
                        <td><?php echo $dfdv['favorite_uname'];?></td>
                        <td><?php echo $dfdv['uid'];?></td>
                        <td><?php echo $dfdv['ip'];?></td>
                        <td><?php echo $dfdv['create_time'];?></td>
                        <td>
                            <a href="/administrator/user_favorite/favoriteDelete/<?php echo $dfdv['designer_favorite_id'].'/'.$uid.'/1';?>" title="删除收藏"><img src="/images/icons/cross.png" alt="删除收藏"></a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content <?php echo  ($type == '2') ? 'default-tab"' : '';?>" id="tab2">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>产品ID</th>
                    <th>IP地址</th>
                    <th>收藏时间</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($product_favorite_data)) {
                    $product_favorite_data = array();
                } //echo '<pre>';print_r($receivable);exit;
                foreach ($product_favorite_data as $pfdv) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?php echo $pfdv['id'];?></td>
                    <td><?php echo $pfdv['uid'];?></td>
                    <td><?php echo $pfdv['uname'];?></td>
                    <td><?php echo $pfdv['pid'];?></td>
                    <td><?php echo $pfdv['ip'];?></td>
                    <td><?php echo $pfdv['create_time'];?></td>
                    <td>
                        <a href="/administrator/user_favorite/favoriteDelete/<?php echo $pfdv['id'].'/'.$uid.'/2';?>" title="删除收藏"><img src="/images/icons/cross.png" alt="删除收藏"></a>
                    </td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        <div class="tab-content <?php echo  ($type == '3') ? 'default-tab"' : '';?>" id="tab3">
            <table>
                <thead>
                <tr>
                    <th><input class="check-all" type="checkbox"/></th>
                    <th>ID</th>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>设计图ID</th>
                    <th>IP地址</th>
                    <th>收藏时间</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($design_favorite_data)) {
                    $design_favorite_data = array();
                }
                foreach ($design_favorite_data as $dfvd) {
                    ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?php echo $dfvd['id'];?></td>
                    <td><?php echo $dfvd['uid'];?></td>
                    <td><?php echo $dfvd['uname'];?></td>
                    <td><?php echo $dfvd['did'];?></td>
                    <td><?php echo $dfvd['ip'];?></td>
                    <td><?php echo $dfvd['create_time'];?></td>
                    <td>
                        <a href="/administrator/user_favorite/favoriteDelete/<?php echo $dfvd['id'].'/'.$uid.'/3';?>" title="删除收藏"><img src="/images/icons/cross.png" alt="删除收藏"></a>
                    </td>
                </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
</div>

<!-- End .content-box -->
<div class="clear"></div>

<?php require(dirname(__FILE__) . '/../../footer.php'); ?>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
