    $(function ($) {
        $('#button_next').click(function () {
            var list = $('#img_list > div');
            var size = list.size();
            var offset = 0;
            var show = 5;
            if (size < show) return;
            list.each(function (i) {
                var display = $(this).css('display');
                if (display != 'none') {
                    offset = i;
                    return false;
                }
            });
            if ((size - offset) > show)
                $('#img_list > div:eq(' + offset + ')').slideUp();
        });

        $('#button_prev').click(function () {
            var list = $('#img_list > div');
            var size = list.size();
            var offset = 0;
            var show = 5;
            if (size < show) return;
            list.each(function (i) {
                var display = $(this).css('display');
                if (display == 'none') {
                    offset = i;
                }
            });
            $('#img_list > div:eq(' + offset + ')').slideDown();
        });

        $('.jqzoom').jqzoom({
            zoomType:'standard',
            zoomWidth:418,
            zoomHeight:418,
            showEffect:'fadein',
            hideEffect:'fadeout',
            lens:false,
            preloadImages:false,
            alwaysOn:false,
            showPreload:false
        });

        $("#product_num").blur(function(){
            var product_num = parseInt($(this).val());
            if(isNaN(product_num) || product_num<1) $(this).val(1);
        });

        /*分页绑定事件*/
        $('#commentsPage a').live('click', function () {
            productComment(product.pid, $(this).attr('href', '#anchorComment').attr('name'));
        });

        browseHistoryHTML(setBrowseHistory(product.pid, product.pname, product.sell_price));
        getProductByClass(product.class_id, product.pid)/*获取同类产品*/
        getHotComment();
        productComment(product.pid, 1);/*获取产品评论*/
        productAppraise(product.pid);/*产品评价等级*/
        lazyload("img.lazy");
        lazyload("#product_detail img.lazy");/*不知道为什么 这里的图片绑定不到lazyload 所以重复绑定一次*/
        productShare(product.pid, 11, 0);
        productQa(product.pid, 10, 0);/*载入产品互动问答*/
    });

//    function favorite(pid)
//    {
//        wx.jsonp(wx.base_url + "product/favorite/add", {'pid':pid}, function(data){
//            alert(data.msg);
//        });
//    }

    /*设置浏览记录*/
    function browseHistoryHTML(list)
    {
        html='';
        for(k in list)
        {
            var item = list[k].split('|');
            html += '<div class="recordbox"> \
                <a href="'+wx.productURL(item[0])+'"><img class="lazy" src="'+wx.static_url+'images/lazy.gif" data-original="' + wx.img_url + 'product/'+idToPath(item[0])+'default.jpg" width="180" height="200" /></a>\
                    <p><a href="'+wx.productURL(item[0])+'">'+item[1]+'</a><br/> \
                      <span class="font19">￥'+sprintf('%.2f', parseFloat(item[2]))+'</span></p> \
                  </div>';
        }
        $('#browseHistory').append(html).show();
    }

    /*清空最近浏览*/
    function clearBrowseHistory()
    {
        wx.setCookie('browseHistory', '', 0);
        $('#browseHistory .recordbox').fadeOut('fast');
    }

    /*保存最近浏览*/
    function setBrowseHistory(id, name, price)
    {
        var value = id+'|'+name+'|'+price;
        var str = wx.getCookie('browseHistory');
        if(str == null) str = '';
        var arr = re = str.split(';');
        if($.inArray(value, arr) < 0)
        {
            arr.push(value);
        }
        if(arr.length > 12) delete arr[0]
        var cookie = '';
        for(k in arr)
        {
            if(cookie) cookie += ';'
            cookie += arr[k];
        }
        wx.setCookie('browseHistory', cookie, 0);
        return re.reverse();
    }

    /*选择产品号码*/
    function select_size(id, name, obj)
    {
        $(".sub-cm").css("border", "2px solid #dddddd");
        $(".selected2").css("display", "none");
        $(obj).css("border", "2px solid #ac1116");
        $(obj).find(".selected2").css('display', 'block');
        $('#product_size').html('<input type="hidden" value="'+id+'">'+name);
    }

    /*设置产品数量*/
    function product_num(model)
    {
       var product_num = parseInt($('#product_num').val());
       if(model === '+')
       {
           $('#product_num').val(++product_num)
       }
        else
       {
           if(product_num < 2)
               return ;
           $('#product_num').val(--product_num)
       }
    }

    /*添加产品到购物车*/
    function addToCart()
    {
        var p_num = $('#product_num').val();
        var p_size = $('#product_size > input:eq(0)').val();
        if((typeof p_size) == 'undefined')
        {
            alert('请选择产品尺码');
            return;
        }
        wx.jsonp(wx.base_url + "cart/addToCart", {'pid':product.pid, 'p_num':p_num, 'p_size':p_size},function(data){
            if(data.error == 0)
            {
                alert('成功将产品添加到购物车中');
                wx.cartGlobalInit();
            }
            else
            {
                alert(data.msg);
            }
        });
    }

    /*对评论进行顶/踩*/
    function tops(o,cid,top)
    {
        wx.jsonp(wx.base_url+'product/comment/ajaxTop', {'cid':cid, 'top':top}, function(data){
            if (data.error != 0) {
                alert(data.msg)
            } else {
                var tmp = $(o).html().split(/\(|\)/);
                $(o).html(tmp[0]+'('+(parseInt(tmp[1])+1)+')');
            }
        });
    }

    /*获得同类产品*/
    function getProductByClass(class_id, pid)
    {
        wx.jsonp(wx.base_url + "product/ajax/getProductByClass", {'class_id':class_id, 'pid':pid, 'limit':6}, function (data) {
            var html = '';
            $.each(data, function (i, item) {
                html += '<div class="vhis">\
                    <a class="hoverimg" href="'+wx.productURL(item.pid)+'">\
                    <img class="lazy" src="' + wx.static_url + 'images/lazy.gif" data-original="' + wx.img_url + 'product/' + idToPath(item.pid) + 'default.jpg" width="140" height="140" /></a>\
                    <p><a href="'+wx.productURL(item.pid)+'">' + item.pname + '</a></p>\
                    <span class="font4">￥' + sprintf('%.2f', item.sell_price / 100) + ' </span></div>';
            });
            $('#tlcptj').html(html).parent().show();
            lazyload(".vhis img.lazy");
        });
    }

    function getHotComment()
    {
        wx.jsonp(wx.base_url + "product/ajax/hotComment", {}, function (data) {
            var html = '';
            $.each(data, function (i, item) {
                html += '<div class="bdan2">\
                          <table width="95%" border="0" cellspacing="0" cellpadding="0">\
                            <tr>\
                              <td><a href="'+wx.productURL(item.pid)+'">'+item.pname+'</a></td>\
                              <td><span class="font4">￥'+sprintf('%.2f', item.sell_price/100)+'</span></td>\
                            </tr>\
                          </table>\
                          <div class="bdimg"><img class="lazy" src="' + wx.static_url + 'images/lazy.gif" data-original="' + wx.img_url + 'product/' + idToPath(item.pid) +'icon.jpg" width="53" height="54" /></div>\
                          <div class="bdancont2" style="float:left;"><span class="font2">'+item.uname+'</span>(会员)<br/>\
                            '+item.content+'</div>\
                        </div>';
            });
            $('#hotComment').html(html).show();
            lazyload(".bdimg img.lazy");
        });
    }


    /*载入晒单*/
    function productShare(pid, limit, offset)
    {
        //offset > 0 && $('#more_qa').html('<a href="javascript:;">载入中...</a>');
        wx.jsonp(wx.base_url + "product/share/ajaxGetShareByPid", {'pid':pid, 'offset':offset, 'limit':limit}, function (data) {
            if(data.total > 0)
            {
                var html = '';
                var main = '';
                $.each(data.share, function (i, o) {

                    if(offset == 0 && !main)
                    {
                        main = '<table class="tab1" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="83%">' + o.title + '<img src="' + wx.img_url + 'images/kk_23.jpg" width="39" height="15" /></td><td width="17%">来自：' + o.uname + '</td></tr></table>\
                                <div class="sd-main">\
                                  <div style="text-align:center"><img class="lazy" src="' + wx.static_url + 'images/lazy.gif" data-original="' + wx.img_url+ 'product_share/' + o.img_addr + '" /></div>\
                                  <table class="tab6" width="100%" border="0" cellspacing="0" cellpadding="0">\
                                    <tr><td align="center" bgcolor="#f3f3f3">达人麻豆</td><td align="center" bgcolor="#f3f3f3">身高/体重</td><td align="center" bgcolor="#f3f3f3">三围</td><td align="center" bgcolor="#f3f3f3">颜色</td><td align="center" bgcolor="#f3f3f3">尺码</td></tr>\
                                    <tr><td align="center">999</td><td align="center">' + o.height + 'cm / ' + o.weight + 'kg</td><td align="center">1 / 2 / 3</td><td align="center">' + o.color + '</td><td align="center">' + o.size + '</td></tr>\
                                  </table>\
                                  <p>' + o.content + '</p>\
                                </div>';
                        $('#share_main').replaceWith(main);
                    }
                    else
                    {
                        html += '<div class="sd-cont">\
                                    <div class="sd-cbox">\
                                        <div class="sdimg"><img class="lazy" src="' + wx.static_url + 'images/lazy.gif" data-original="' + wx.img_url+ 'product_share/' + o.img_addr + '" width="107" height="143" /></div>\
                                        <div class="sdtext"><strong>' + o.title + '</strong><br/>' + o.content + '</div>\
                                    </div>\
                                </div>';
                    }
                });
                $('#share_total').text(data.total);
                $('.sd-other').append(html).show();
                lazyload("#shaidan img.lazy");
            }
        });
    }

    /*载入互动问答*/
    function productQa(pid, limit, offset)
    {
        offset > 0 && $('#more_qa').html('<a href="javascript:;">载入中...</a>');
        wx.jsonp(wx.base_url + "product/qa/ajaxGetQaByPid", {'pid':pid, 'offset':offset, 'limit':limit}, function (data) {
            var html = '';
            var leight = 0;
            $.each(data, function (i, o) {leight++;
                html += '<div class="q-a"><div class="q-a-u">' + o.uname + '&nbsp;&nbsp;<span class="font2">发表于</span>&nbsp;&nbsp;' + o.create_time + '</div>\
                         <div class="q-a-wt">咨询内容：' + o.qa_content + '</div><div class="q-a-hd">客服回复：' + o.reply_content + '</div></div>';
            });
            var more = leight == limit ? '<a href="javascript:;" onclick="productQa(' + pid + ',' + limit + ',' + (offset + limit) + ')"><span class="font10">查看更多</span></a>' : '<a href="javascript:;">无更多内容</a>';
            $('#more_qa').html(more).show();
            html && $('.q-a-box').append(html);
        });
    }

    /*获取产品评论*/
    function productComment(pid, page)
    {
        wx.jsonp(wx.base_url+'product/comment/ajaxComment', {'pid':pid, 'pageno':page}, function(data){
            if(data.totalCount > 0)
            {
                var html = '';
                $.each(data.comments, function (i, o) {
                    html += '<div class="cmt-body">\
                      <div class="user-comment">\
                        <div class="u-tx"><img class="lazy" src="'+wx.static_url+'images/lazy.gif" data-original="'+wx.img_url+'designer/'+idToPath(o.uid)+'icon.jpg'+'" width="50" height="50" /></div>\
                        <div class="u-cmt"><span class="font17">'+ o.uname+'</span><p>'+ o.content+'</p></div>\
                        <div class="u-time"><span class="font2">'+ o.create_time+' </span></div>\
                      </div>\
                      <div class="u-info">\
                        <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>\
                            <td width="70%" height="25">身高：'+ o.height+'cm&nbsp;&nbsp;&nbsp;&nbsp;体重：'+ o.weight+'kg&nbsp;&nbsp;&nbsp;&nbsp;颜色：'+ o.color+'&nbsp;&nbsp;&nbsp;&nbsp;尺码：'+ o.size+'</td>\
                            <td width="13%"><div class="u-ly" onclick="tops(this, '+ o.comment_id+' ,1)">对我有用('+ o.is_valid+')</div></td><td width="13%"><div class="u-ly" onclick="tops(this, '+ o.comment_id+' ,0)">对我无用('+ o.is_invalid+')</div></td>\
                          </tr></table>\
                      </div>\
                    </div>';
                });
                $("#totalCount").text(data.totalCount);/*设置评论数量*/
                $(".pfstar > div > a > span").text(data.totalCount);/*设置评论数量*/
                $('#commentsPage').html(pagination(page, 10 , data.totalCount)).show();/*设置评论分页*/
            } else {
                var html = '暂无评论';
            }
            $("#comments").html(html).fadeOut('fast').fadeIn('slow');/*设置评论列表*/
            lazyload(".u-tx img.lazy");
        });
    }

    /*产品评价星级*/
    function productAppraise(pid)
    {
        wx.jsonp(wx.base_url+'product/comment/ajaxAppraise', {'pid':pid}, function(data){
            $.each(data, function (i, o) {
                if(i == 'size_deviation')
                {
                    o.star[0] && $('#chima_x').text(parseInt(o.star[0] / o.count * 100) + '%');
                    o.star[1] && $('#chima_z').text(parseInt(o.star[1] / o.count * 100) + '%');
                    o.star[2] && $('#chima_d').text(parseInt(o.star[2] / o.count * 100) + '%');
                }
                else
                {
                    var html = '';
                    for (var k = 5; k > 0; k--) {
                        var star = '';
                        for (j = 0; j < 5; j++)
                            star += (j < k) ? '<span class="fullstar3"></span>' : '<span class="emptystar3"></span>';
                        html += '<tr><td width="32%">' + star + '</td>\
                      <td width="46%"><div class="cmtbar"><div class="colorbar" style="width:' + (o.star[k] ? (o.star[k] / o.count * 100) : 0) + '%"></div></div></td>\
                      <td width="22%">' + o.star[k] + '</td></tr>';
                    }
                    var max = o.point > 0 ? (o.point / o.count) : 0;
                    if (max) {
                        var level = '';
                        for (var s = 0; s < max; s++)
                            level += (s + 1) > max ? '<span class="ban-st"></span>' : '<span class="full-st"></span>';
                        $("#product_" + i + " > div").append(sprintf("%.1f", max) + level);
                        if (i == 'rank') {
                            $(".pfstar > span").each(function (i) {
                                if (i < (max - 1))
                                    $(this).removeClass("emptystar").addClass('fullstar');
                            });
                            $(".pfstar > div > span").text(sprintf("%.1f", max));
                        }
                    }
                    $("#product_" + i + " > table").html(html);
                }
            });
        });
    }

    function lazyload(selector)
    {
        $(selector).lazyload({effect:"fadeIn"});
    }

    /*分页函数*/
    function pagination(pageno, pagesize, total)
    {
        var n = 5;
        var html = '';
        if((typeof pagesize) == 'undefined') pagesize = 10;
        var max = Math.ceil(total/pagesize);
        if (max > 1) {
            var i = 1;
            if ((pageno - n) > 0)
                i = pageno - n;
            var end = max;
            if ((pageno + n) < max)
                end = pageno + n;
            for (i; i <= end; i++) {
                if (pageno == i) {
                    html += '<span class="current">' + i + '</span>';
                }
                else {
                    html += '<a href="javascript:;" name="'+i+'">' + i + '</a>';
                }
            }
            if (pageno > 1)
                html = '<a href="javascript:;" name="1">首页</a> <a href="javascript:;" name="'+(pageno-1)+'">上一页</a>' + html;
            if (pageno < max)
                html += '<a href="javascript:;" name="'+(pageno+1)+'">下一页</a> <a href="javascript:;" name="'+max+'">尾页</a>';
        }
        return html;
    }

    /*获得设计师其他设计图*/
    function getDesignByUser(uid)
    {
        if(! uid) return;
        var dom = $('#dsnbox2 > div');
        if(dom.text()) return;
        wx.jsonp(wx.base_url + "design/design/ajaxDesignByUser", {'uid':uid}, function (data) {
            var html = '';
            $.each(data, function (i, item) {
                html += '<div class="vhis vew-designer">\
                    <a class="imgborder" href="#"><img src="'+ wx.img_url+ 'design/' + idToPath(item.did) +'icon.jpg" width="140" height="140" /></a>\
                    <p>'+item.dname+'</p>\
                    收藏数:<span class="font4">'+item.favorite_num+'</span>\
                    </div>';
            });
            dom.html(html);
        });
    }

    /*获得设计师其他产品*/
    function getProductByUser(uid)
    {
        if(! uid) return;
        var dom = $('#dsnbox3 > div');
        if(dom.text()) return;
        wx.jsonp(wx.base_url + "product/ajax/productByUser", {'uid':uid}, function (data) {
            var html = '';
            $.each(data, function (i, item) {
                html += '<div class="vhis vew-designer">\
                    <a class="imgborder" href="/product/'+item.pid+'"><img src="'+ wx.img_url+ 'product/' + idToPath(item.pid) +'default.jpg" width="140" height="140" /></a>\
                    <p>'+item.pname+'</p>\
                    价格:<span class="font4">￥'+sprintf('%.2f', item.sell_price/100)+'</span>\
                    </div>';
            });
            dom.html(html);
        });
    }

    $(document).ready(function () {

        $(".rankbox ul.bdan li").mouseover(function () {
            $("li", $(this).parent()).removeClass('on');
            $("li", $(this).parent()).find(".bdimg").css("display", "none");
            $("li", $(this).parent()).find(".bdprice").css("display", "none");

            $(this).addClass("on");
            $(this).find(".bdimg").css("display", "block");
            $(this).find(".bdprice").css("display", "block");
        });

        $(".ginfo-tle1").click(function () {
            $(".ginfo-tle1").css("background-position", "0px -32px");
            $(".ginfo-tle1").find("span").css({"background-position":"right -98px", "color":"#333333"});
            $(this).css("background-position", "0px 0px");
            $(this).find("span").css({"background-position":"right -66px", "color":"#ffffff"});

        });
        $(".dinfo-tle1").click(function () {
            $(".dinfo-tle1").css("background-position", "0px -32px");
            $(".dinfo-tle1").find("span").css({"background-position":"right -98px", "color":"#333333"});
            $(this).css("background-position", "0px 0px");
            $(this).find("span").css({"background-position":"right -66px", "color":"#ffffff"});

        });
    });

    function showtab(a,id,num)
    {
        for (var i = 1; i < num; i++) {
            document.getElementById(a + i).style.display = "none";
        }
        document.getElementById(a + id).style.display = "block";
    }

    function showtab2(a, id, num) {
        for (var i = 1; i < num; i++) {
            if (id == 1) {
                document.getElementById(a + i).style.display = "block";
            } else {
                document.getElementById(a + i).style.display = "none";
            }
        }
        document.getElementById(a + id).style.display = "block";
    }

    function rankbox(a,b,id) {
        var size = $('.bdan').size();
        for (var i = 1; i <= size; i++) {
            $("#"+ a + i).css({'borderRight':'1px solid #e5e5e5','borderLeft':'1px solid #e5e5e5','borderTop':'1px solid #e5e5e5'})
            document.getElementById(b + i).style.display = (i == id) ? 'block':"none";
        }
        $("#"+ a + id).css({'borderRight':'1px solid #ca0000','borderLeft':'1px solid #ca0000','borderTop':'1px solid #ca0000'})
    }