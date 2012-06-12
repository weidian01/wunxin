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
<!--h2>分类列表</h2-->
<!--p id="page-intro">产品分类管理</p-->
<ul class="shortcut-buttons-set">
    <li><a class="shortcut-button" href="<?=url('administrator/product_category/create')?>"><span>添加分类</span></a></li>
    <li><a class="shortcut-button" href="<?=url('administrator/product_category/index')?>"><span>分类列表</span></a></li>
</ul>
<!-- End .shortcut-buttons-set -->
<div class="clear"></div>
<!-- End .clear -->
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>分类信息</h3>
        <!--ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Table</a></li>
            <!-- href must be unique and match the id of target div -->
            <!--li><a href="#tab2">Forms</a></li>
        </ul-->
        <div class="clear"></div>
    </div>
    <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                <thead>
                <tr>
                    <th>
                        <input class="check-all" type="checkbox"/>
                    </th>
                    <th>分类名称</th>
                    <th>分类级别</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="bulk-actions align-left">
                            <select name="dropdown">
                                <option value="option1">Choose an action...</option>
                                <option value="option2">Edit</option>
                                <option value="option3">Delete</option>
                            </select>
                            <a class="button" href="#">Apply to selected</a></div>
                        <div class="pagination"><a href="#" title="First Page">&laquo; First</a><a href="#"
                                                                                                   title="Previous Page">&laquo;
                            Previous</a>
                            <a href="#" class="number" title="1">1</a> <a href="#" class="number" title="2">2</a> <a
                                href="#" class="number current" title="3">3</a>
                            <a href="#" class="number" title="4">4</a> <a href="#"
                                                                          title="Next Page">Next &raquo;</a><a
                                href="#" title="Last Page">Last &raquo;</a></div>
                        <!-- End .pagination -->
                        <div class="clear"></div>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($category as $item): ?>
                <tr>
                    <td>
                        <input type="checkbox"/>
                    </td>

                    <td><?php echo str_repeat("&nbsp;", $item['floor'] * 4), $item['cname'];?></td>
                    <td><?=$item['floor']?></td>
                    <td><a href="<?php echo url("administrator/product_category/edit/{$item['class_id']}")?>"><img
                        src="/images/icons/pencil.png" alt="Edit"/></a> <a
                        href="<?php echo url("administrator/product_category/del/{$item['class_id']}")?>"><img
                        src="/images/icons/cross.png" alt="Delete"/></a>
                    </td>
                </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
            <form action="#" method="post">
                <fieldset>
                    <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Small form input</label>
                        <input class="text-input small-input" type="text" id="small-input" name="small-input"/>
                        <span class="input-notification success png_bg">Successful message</span>
                        <!-- Classes for input-notification: success, error, information, attention -->
                        <br/>
                        <small>A small description of the field</small>
                    </p>
                    <p>
                        <label>Medium form input</label>
                        <input class="text-input medium-input datepicker" type="text" id="medium-input"
                               name="medium-input"/>
                        <span class="input-notification error png_bg">Error message</span></p>

                    <p>
                        <label>Large form input</label>
                        <input class="text-input large-input" type="text" id="large-input" name="large-input"/>
                    </p>

                    <p>
                        <label>Checkboxes</label>
                        <input type="checkbox" name="checkbox1"/>
                        This is a checkbox
                        <input type="checkbox" name="checkbox2"/>
                        And this is another checkbox </p>

                    <p>
                        <label>Radio buttons</label>
                        <input type="radio" name="radio1"/>
                        This is a radio button<br/>
                        <input type="radio" name="radio2"/>
                        This is another radio button </p>

                    <p>
                        <label>This is a drop down list</label>
                        <select name="dropdown" class="small-input">
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                            <option value="option4">Option 4</option>
                        </select>
                    </p>
                    <p>
                        <label>Textarea with WYSIWYG</label>
                        <textarea class="text-input textarea wysiwyg" id="textarea" name="textfield" cols="79"
                                  rows="15"></textarea>
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

<div class="clear"></div>
<!-- Start Notifications -->
<div class="notification attention png_bg"><a href="#" class="close"><img src="/images/icons/cross_grey_small.png"
                                                                          title="Close this notification"
                                                                          alt="close"/></a>

    <div> Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien
        quis fermentum luctus, libero.
    </div>
</div>
<div class="notification information png_bg"><a href="#" class="close"><img src="/images/icons/cross_grey_small.png"
                                                                            title="Close this notification"
                                                                            alt="close"/></a>

    <div> Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien
        quis fermentum luctus, libero.
    </div>
</div>
<div class="notification success png_bg"><a href="#" class="close"><img src="/images/icons/cross_grey_small.png"
                                                                        title="Close this notification"
                                                                        alt="close"/></a>

    <div> Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien
        quis fermentum luctus, libero.
    </div>
</div>
<div class="notification error png_bg"><a href="#" class="close"><img src="/images/icons/cross_grey_small.png"
                                                                      title="Close this notification" alt="close"/></a>

    <div> Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis
        fermentum luctus, libero.
    </div>
</div>
<!-- End Notifications -->
<div id="footer">
    <small>
        <!-- Remove this notice or replace it with whatever you want -->
        &#169; Copyright 2010 Your Company | Powered by <a href="http://www.865171.cn">admin templates</a> | <a
        href="#">Top</a></small>
</div>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>