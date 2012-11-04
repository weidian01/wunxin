<?php require(dirname(__FILE__) . '/../../left.php'); ?>
<div id="main-content">
<!-- Main Content Section with everything -->
<noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
        <div> Javascript is disabled or is not supported by your browser. Please
            <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or
            <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a>
            Javascript to navigate the interface properly. Download From
            <a href="http://www.exet.tk">exet.tk</a>
        </div>
    </div>
</noscript>
<!-- Page Head -->
<h2><?=$promotion['name'];?></h2>
<!--p id="page-intro">产品分类管理</p-->
<ul class="shortcut-buttons-set">
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion/create"><span><br/> 添加促销 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion/lists"><span><br/> 促销列表 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion_category/lists"><span><br/> 促销分类列表 </span></a></li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/business_promotion_product/lists"><span><br/> 促销产品列表 </span></a></li>
</ul>
<!-- End .shortcut-buttons-set -->
    <div class="clear">
        <form action="<?=url('administrator/business_promotion_product/p_create/'.$promotion_id);?>" method="post">
            <p>
                <label><b>输入关键字</b></label>
                <input class="text-input small-input" type="text" id="small-input" name="keyword" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                <select name="s_type" class="small-input">
                    <?php if (!isset ($searchType)) { $searchType = array(); }
                    foreach ($searchType as $sk => $sv) { ?>
                        <?php if (!isset($sType)) $sType = '';
                        if ($sType == $sk) { ?>
                            <option value="<?php echo $sk?>" selected="selected"><?php echo $sv?></option>
                            <?php } else { ?>
                            <option value="<?php echo $sk?>"><?php echo $sv?></option>
                            <?php } ?>
                        <?php }?>
                </select>
                <input type="submit" value="搜索">
            </p>
        </form>
    </div>
<!-- End .clear -->
<div class="content-box">
    <!-- Start Content Box -->
    <div class="content-box-header">
        <h3>产品列表</h3>
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
                    <th>商品ID</th>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th>售价</th>
                    <th>市场价</th>
                    <th>成本</th>
                    <th>上架</th>
                    <th>库存</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty ($list) || !is_array($list)) $list = array();foreach ($list as $item): ?>
                <tr>
                    <td>
                        <input type="checkbox"/>
                    </td>
                    <td><?=$item['pid']?></td>
                    <td>
                        <a href="<?=productURL($item['pid'])?>" target="_blank">
                            <img src="<?=config_item('img_url')?>product/<?=intToPath($item['pid'])?>icon.jpg" width="50" height="50" title="<?=$item['pname']?>"/>
                        </a>
                    </td>
                    <td><a href="<?=productURL($item['pid'])?>" target="_blank"><?=$item['pname']?></a></td>
                    <td><?=fPrice($item['sell_price'])?></td>
                    <td><?=fPrice($item['market_price'])?></td>
                    <td><?=fPrice($item['cost_price'])?></td>
                    <td><?php if($item['status']):?>上架<?php else:?>下架<?php endif;?></td>
                    <td><?=empty ($item['stock']) ? '0' : $item['stock']?></td>
                    <td>
                        <a href="<?=config_item('static_url')?>administrator/business_promotion_product/joinPromotion/<?=$promotion['promotion_id'].'/'.$item['pid'];?>"><b>加入活动</b></a>
                    </td>
                </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="pagination">
                        <?php echo isset ($page) ? $page : '';?>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- End #tab1 -->
    </div>
    <!-- End .content-box-content -->
</div>

<div class="clear"></div>
    <?php require(dirname(__FILE__) . '/../../footer.php'); ?>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
<link rel="stylesheet" href="<?=config_item('static_url')?>css/base.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/common.js"></script>
<script type="text/javascript" src="<?=config_item('static_url')?>scripts/artdialog.js"></script>
<script type="text/javascript">
    function alertJoin(promotion_type)
    {
        var html = '';
        switch (promotion_type)
        {
            case '1': html = '';break;
            case '2': html = '';break;
            case '3': html = '';break;
            default : html = '';
        }

        return html;
    }
</script>