<?php include(APPPATH.'views/administrator/left.php');?>
<div id="main-content">
<!-- Main Content Section with everything -->
<noscript>
    <!-- Show a notification if the user has disabled javascript -->
    <div class="notification error png_bg">
        <div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a>
            your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the
            interface properly. Download From <a href="http://www.exet.tk">exet.tk</a></div>
    </div>
</noscript>
<!-- Page Head -->
<h2>推荐列表</h2>
<!--<p id="page-intro">What would you like to do?</p>-->
<ul class="shortcut-buttons-set">
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/recommend_home/recommendList"><span><br/> 推荐列表 </span></a>
    </li>
    <li><a class="shortcut-button" href="<?=config_item('static_url')?>administrator/recommend_home/recommendAdd"><span><br/> 添加推荐 </span></a>
    </li>
</ul>
<!-- End .shortcut-buttons-set -->
<div class="clear"></div>
<!-- End .clear -->
<div class="content-box">
<!-- Start Content Box -->
<div class="content-box-header">
    <h3>推荐列表</h3>
    <ul class="content-box-tabs">
        <li><a href="#tab1" class="default-tab">首页转播图</a></li>
        <li><a href="#tab2">今日推荐</a></li>
        <li><a href="#tab3">设计图推荐</a></li>
        <li><a href="#tab4">广告推荐</a></li>
        <li><a href="#tab5">男款T恤推荐</a></li>
        <li><a href="#tab6">女款T恤推荐</a></li>
        <li><a href="#tab7">情侣T恤推荐</a></li>
        <li><a href="#tab8">亲子T恤推荐</a></li>
        <li><a href="#tab9">设计师推荐</a></li>
        <li><a href="#tab10">搜索关键字推荐</a></li>

    </ul>
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
            <th>标题</th>
            <th>链接</th>
            <th>图片</th>
            <th>排序</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($broadcast_recommend)) $broadcast_recommend = array();
        foreach ($broadcast_recommend as $brv) { if (empty ($brv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$brv['id'];?></td>
            <td><?=$brv['title'];?></td>
            <td><?=$brv['link'];?></td>
            <td><img src="<?=base_url().$brv['img_addr'];?>" alt="<?=$brv['title'];?>" width="50" height="50"/></td>
            <td><?=$brv['sort'];?></td>
            <td><?=$brv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$brv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$brv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>
        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="tab-content" id="tab2">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>标题</th>
            <th>链接</th>
            <th>图片</th>
            <th>排序</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($day_recommend)) $day_recommend = array();
        foreach ($day_recommend as $drv) { if (empty ($drv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$drv['id'];?></td>
            <td><?=$drv['title'];?></td>
            <td><?=$drv['link'];?></td>
            <td><img src="<?=base_url().$drv['img_addr'];?>" alt="<?=$brv['title'];?>" width="50" height="50"/></td>
            <td><?=$drv['sort'];?></td>
            <td><?=$drv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$drv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$drv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>
        </tbody>
    </table>
        <div class="clear"></div>
    </form>
</div>
<!-- End #tab1 -->
<div class="tab-content" id="tab3">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>产品ID</th>
            <th>排序</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($design_recommend)) $design_recommend = array();
        foreach ($design_recommend as $derv) { if (empty ($derv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$derv['id'];?></td>
            <td><?=$derv['pid'];?></td>
            <td><?=$derv['sort'];?></td>
            <td><?=$derv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$derv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$derv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>


        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="tab-content" id="tab4">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>标题</th>
            <th>链接</th>
            <th>图片</th>
            <th>排序</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($AD_recommend)) $AD_recommend = array();
        foreach ($AD_recommend as $adrv) { if (empty ($adrv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$adrv['id'];?></td>
            <td><?=$adrv['title'];?></td>
            <td><?=$adrv['link'];?></td>
            <td><img src="<?=base_url().$adrv['img_addr'];?>" alt="<?=$adrv['title'];?>" width="50" height="50"/></td>
            <td><?=$adrv['sort'];?></td>
            <td><?=$adrv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$adrv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$adrv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>


        </tbody>
    </table>
        <div class="clear"></div>
    </form>
</div>

<div class="tab-content" id="tab5">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>标题</th>
            <th>链接</th>
            <th>图片</th>
            <th>产品ID</th>
            <th>排序</th>
            <th>排放ID</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($man_recommend)) $man_recommend = array();
        foreach ($man_recommend as $mrv) { if (empty ($mrv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$mrv['id'];?></td>
            <td><?=$mrv['title'];?></td>
            <td><?=$mrv['link'];?></td>
            <td><?=$mrv['img_addr'] ? '<img src="'.base_url().$mrv['img_addr'].'" alt="'.$mrv['title'].'" width="50" height="50">' : '';?></td>
            <td><?=$mrv['pid'];?></td>
            <td><?=$mrv['sort'];?></td>
            <td><?=$mrv['emission'];?></td>
            <td><?=$mrv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$mrv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$mrv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>


        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="tab-content" id="tab6">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>标题</th>
            <th>链接</th>
            <th>图片</th>
            <th>产品ID</th>
            <th>排序</th>
            <th>排放ID</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($woman_recommend)) $woman_recommend = array();
        foreach ($woman_recommend as $wrv) { if (empty ($wrv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$wrv['id'];?></td>
            <td><?=$wrv['title'];?></td>
            <td><?=$wrv['link'];?></td>
            <td><?=$wrv['img_addr'] ? '<img src="'.base_url(). $wrv['img_addr'].'" alt="'.$wrv['title'].'" width="50" height="50">' : '';?></td>
            <td><?=$wrv['pid'];?></td>
            <td><?=$wrv['sort'];?></td>
            <td><?=$wrv['emission'];?></td>
            <td><?=$wrv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$wrv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$wrv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>


        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="tab-content" id="tab7">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>标题</th>
            <th>链接</th>
            <th>图片</th>
            <th>产品ID</th>
            <th>排序</th>
            <th>排放ID</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($lover_recommend)) $lover_recommend = array();
        foreach ($lover_recommend as $lrv) { if (empty ($lrv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$lrv['id'];?></td>
            <td><?=$lrv['title'];?></td>
            <td><?=$lrv['link'];?></td>
            <td><img src="<?=base_url().$lrv['img_addr'];?>" alt="<?=$lrv['title'];?>" width="50" height="50"></td>
            <td><?=$lrv['pid'];?></td>
            <td><?=$lrv['sort'];?></td>
            <td><?=$lrv['emission'];?></td>
            <td><?=$lrv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$lrv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$lrv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>


        </tbody>
    </table>
    <div class="clear"></div>
</div>
<div class="tab-content" id="tab8">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>分类</th>
            <th>标题</th>
            <th>链接</th>
            <th>图片</th>
            <th>产品ID</th>
            <th>排序</th>
            <th>排放ID</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($family_recommend)) $family_recommend = array();
        foreach ($family_recommend as $frv) { if (empty ($frv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$frv['id'];?></td>
            <td><?=$frv['cid'];?></td>
            <td><?=$frv['title'];?></td>
            <td><?=$frv['link'];?></td>
            <td><img src="<?=base_url().$frv['img_addr'];?>" alt="<?=$frv['title'];?>" width="50" height="50"></td>
            <td><?=$frv['pid'];?></td>
            <td><?=$frv['sort'];?></td>
            <td><?=$frv['emission'];?></td>
            <td><?=$frv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$frv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$frv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>


        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="tab-content" id="tab9">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>设计师ID</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($designer_recommend)) $designer_recommend = array();
        foreach ($designer_recommend as $derrv) { if (empty ($derrv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$derrv['id'];?></td>
            <td><?=$derrv['pid'];?></td>
            <td><?=$derrv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$derrv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$derrv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>
        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="tab-content" id="tab10">
    <table>
        <thead>
        <tr>
            <th><input class="check-all" type="checkbox"/></th>
            <th>ID</th>
            <th>关键字</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!isset ($search_keyword_recommend)) $search_keyword_recommend = array();
        foreach ($search_keyword_recommend as $skrv) { if (empty ($skrv)) continue;?>
        <tr>
            <td><input type="checkbox"/></td>
            <td><?=$skrv['id'];?></td>
            <td><?=$skrv['title'];?></td>
            <td><?=$skrv['create_time'];?></td>
            <td>
                <!--<a href="<?=config_item('static_url')?>administrator/article/articleEdit/<?=$skrv['id'];?>" title="编辑文章"><img src="<?=config_item('static_url')?>images/icons/pencil.png" alt="编辑文章"/></a>-->
                <a href="<?=config_item('static_url')?>administrator/recommend_home/recommendDelete/<?=$skrv['id'];?>" title="删除推荐"><img src="<?=config_item('static_url')?>images/icons/cross.png" alt="删除推荐"/></a>
            </td>
        </tr>
            <?php }?>
        </tbody>
    </table>
    <div class="clear"></div>
</div>


<!-- End #tab2 -->
</div>
<!-- End .content-box-content -->
</div>


<!-- End .content-box -->
<div class="clear"></div>

<?php include(APPPATH.'views/administrator/footer.php');?>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
