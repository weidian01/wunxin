$(function ($) {
    $("#kza").toggle(
        function () {
            $("#modelAttr").css({height:"180px"});
        },
        function () {
            $("#modelAttr").css({height:"auto"});
        }
    );

    $(".goods-cbox").hover(
        function () {
            $(this).css("border", "1px solid #ac1116");
        },
        function () {
            $(this).css("border", "1px solid #e8e8e8");
        }
    );

    browseHistoryHTML();

    $('img.lazy').lazyload({effect:"fadeIn"});
});

function rankbox(a,b,id) {
    for (var i = 1; i < 4; i++) {
        $("#"+ a + i).css({'borderRight':'1px solid #e5e5e5','borderLeft':'1px solid #e5e5e5','borderTop':'1px solid #e5e5e5'})
        document.getElementById(b + i).style.display = (i == id) ? 'block':"none";
    }
    $("#"+ a + id).css({'borderRight':'1px solid #ca0000','borderLeft':'1px solid #ca0000','borderTop':'1px solid #ca0000'})
}

function browseHistoryHTML()
{
    var str = wx.getCookie('browseHistory');
    if (str) {
        var list = str.split(';').reverse();
        html = '';
        for (k in list) {
            var item = list[k].split('|');
            html += '<div class="vhis">\
            <a class="hoverimg" href="#"><img class="lazy" src="' + wx.img_url + 'images/lazy.gif" data-original="' + wx.img_url + 'upload/product/' + idToPath(item[0]) + 'default.jpg" width="140" height="140" /></a>\
            <p><a href="/product/' + item[0] + '">' + item[1] + '</a></p>\
            <span class="font4">￥' + sprintf('%.2f',parseFloat(item[2])) + '</span></div>';
        }
        $('.viewhis').append(html)
        $('#viewhistory').show();
    }
}