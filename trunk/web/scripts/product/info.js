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

        //同类产品推荐
        $.getJSON(wx.base_url + "product/ajax/getProductByClass/?class_id="+product.class_id+"&limit=6&jsoncallback=?", function(data){
            var html = '';
            $.each(data, function (i, item) {
                html += ('<div class="vhis">\
                        <a class="hoverimg" href="' + wx.base_url + 'product/' + item.pid + '">\
                        <img src="' + wx.img_url + 'upload/product/'+idToPath(item.pid)+'default.jpg" width="140" height="140" /></a>\
                        <p>' + item.pname + '</p>\
                        <span class="font4">￥' + sprintf('%.2f', item.sell_price / 100) + ' </span>\
                      </div>');
            });
            $('#tlcptj').html(html).parent().show();
        });
        browseHistoryHTML(setBrowseHistory(product.pid, product.pname, product.sell_price));

        //分页绑定事件
        $('#commentsPage a').live('click', function() {
            comment(product.pid, $(this).attr('href','#anchorComment').attr('name'));
        });
        comment(product.pid, 1);
    });

    function browseHistoryHTML(list)
    {
        html='';
        for(k in list)
        {
            var item = list[k].split('|');
            html += '<div class="recordbox"> \
                <a href="/product/'+item[0]+'"><img src="' + wx.img_url + 'upload/product/'+idToPath(item[0])+'default.jpg" width="180" height="200" /></a>\
                    <p><a href="/product/'+item[0]+'">'+item[1]+'</a><br/> \
                      <span class="font19">￥'+item[2]+'</span></p> \
                  </div>';
        }
        $('#browseHistory').append(html).show();
    }

    function clearBrowseHistory()
    {
        wx.setCookie('browseHistory', '', 0);
        $('#browseHistory .recordbox').fadeOut('fast');
    }

    //保存最后查看
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
        if(arr.length > 10) delete arr[0]
        var cookie = '';
        for(k in arr)
        {
            if(cookie) cookie += ';'
            cookie += arr[k];
        }
        wx.setCookie('browseHistory', cookie, 0);
        return re.reverse();
    }

    function select_size(id, name, obj)
    {
        $(".sub-cm").css("border", "2px solid #dddddd");
        $(".selected2").css("display", "none");
        $(obj).css("border", "2px solid #ac1116");
        $(obj).find(".selected2").css('display', 'block');
        $('#product_size').html('<input type="hidden" value="'+id+'">'+name);
    }

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

    function addToCart()
    {
        var p_num = $('#product_num').val();
        var p_size = $('#product_size > input:eq(0)').val();
        if((typeof p_size) == 'undefined')
        {
            alert('请选择产品尺码');
            return;
        }
        $.getJSON(wx.base_url + "cart/addToCart/?pid="+product.pid+"&p_num="+p_num+"&p_size="+p_size+"&jsoncallback=?", function(data){
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

    //对评论进行顶/踩
    function top(o,cid,top)
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

    //获取评论列表
    function comment(pid, page)
    {
        wx.jsonp(wx.base_url+'product/comment/ajaxComment', {'pid':pid, 'pageno':page}, function(data){
            if(data.totalCount > 0)
            {
                var html = '';
                $.each(data.comments, function (i, o) {
                    html += '<div class="cmt-body">\
                      <div class="user-comment">\
                        <div class="u-tx"><img src="http://wunxin.com/images/tx_03.jpg" width="50" height="50" /></div>\
                        <div class="u-cmt"> <span class="font17">'+ o.uname+'</span>\
                          <p>'+ o.content+'</p>\
                        </div>\
                        <div class="u-time"><span class="font2">2012-05-20 12:35 </span></div>\
                      </div>\
                      <div class="u-info">\
                        <table width="100%" border="0" cellspacing="0" cellpadding="0"\
                          <tr>\
                            <td width="70%" height="25">身高：165cm&nbsp;&nbsp;&nbsp;&nbsp;体重：51kg&nbsp;&nbsp;&nbsp;&nbsp;颜色：紫色&nbsp;&nbsp;&nbsp;&nbsp;尺码：L</td>\
                            <td width="13%"><div class="u-ly" onclick="top(this, '+ o.comment_id+' ,1)">对我有用('+ o.is_valid+')</div></td><td width="13%"><div class="u-ly" onclick="top(this, '+ o.comment_id+' ,0)">对我无用('+ o.is_invalid+')</div></td>\
                          </tr>\
                        </table>\
                      </div>\
                    </div>';
                });
                $("#comments").html(html).fadeOut('fast').fadeIn('slow');
                $('#commentsPage').html(pagination(page, 10 , data.totalCount)).show();
            }
        });
    }

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

    $(document).ready(function () {

        $("#rankt1 ul.bdan li").mouseover(function () {
            $("#rankt1 ul.bdan li").removeClass('on');
            $("#rankt1 .bdan").find(".bdimg").css("display", "none");
            $("#rankt1 .bdan").find(".bdprice").css("display", "none");
            $(this).addClass("on");
            $(this).find(".bdimg").css("display", "block");
            $(this).find(".bdimg").css("display", "block");
            $(this).find(".bdprice").css("display", "block");
        });
        $("#rankt2 ul.bdan li").mouseover(function () {
            $("#rankt2 ul.bdan li").removeClass('on');
            $("#rankt2 .bdan").find(".bdimg").css("display", "none");
            $("#rankt2 .bdan").find(".bdprice").css("display", "none");
            $(this).addClass("on");
            $(this).find(".bdimg").css("display", "block");
            $(this).find(".bdimg").css("display", "block");
            $(this).find(".bdprice").css("display", "block");
        });
        $("#rankt3 ul.bdan li").mouseover(function () {
            $("#rankt3 ul.bdan li").removeClass('on');
            $("#rankt3 .bdan").find(".bdimg").css("display", "none");
            $("#rankt3 .bdan").find(".bdprice").css("display", "none");
            $(this).addClass("on");
            $(this).find(".bdimg").css("display", "block");
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
            }
            else {
                document.getElementById(a + i).style.display = "none";
            }
        }
        document.getElementById(a + id).style.display = "block";
    }

    function rankbox(a,b,id) {
        for (var i = 1; i < 4; i++) {
            $("#"+ a + i).css({'borderRight':'1px solid #e5e5e5','borderLeft':'1px solid #e5e5e5','borderTop':'1px solid #e5e5e5'})
            document.getElementById(b + i).style.display = (i == id) ? 'block':"none";
        }
        $("#"+ a + id).css({'borderRight':'1px solid #ca0000','borderLeft':'1px solid #ca0000','borderTop':'1px solid #ca0000'})
    }