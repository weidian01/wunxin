/* SVN.committedRevision=8024 */
/* FILE BEGIN threePages.js */
$.suning || ($.suning = {});
$.suning.productThird = {};
$PT = $.suning.productThird;
$.extend({removeCookie:function (c) {
    var d = new Date();
    d.setTime(d.getTime() - 1);
    document.cookie = c + "=;expires=" + d.toGMTString()
}});
$PT.sibOpera = function (p, k, i, n, m) {
    var o = $("#" + p).find("dl");
    var j = o.length;
    if (j > 11) {
        $("#allCategor").show();
        l()
    }
    function l() {
        for (var a = 10; a < j - 1; a++) {
            o.eq(a).hide()
        }
    }

    $("#allCategor").toggle(function () {
        $("#" + p).find("dl").show();
        $(this).find("b").addClass("up")
    }, function () {
        l()
    });
    $("#" + p).find(k).click(function () {
        $(this).parent().addClass("foc").siblings().removeClass("foc");
        $(this).addClass("foc").parent().siblings().find("dt").removeClass("foc");
        $(this).siblings().addClass("foc").parent().siblings().find("dd").removeClass("foc");
        if (p == "navBarConIndex" && n) {
            if (m != null && m == "2" && m != "") {
                $("#" + n).parents("dt").addClass("foc").siblings().addClass("foc");
                $("#" + n).bind("click", function () {
                    return false
                });
                $("#" + n).parents("dt").parents("dl").addClass("foc")
            } else {
                $("#" + n).addClass("foc").parents("dd").addClass("foc").siblings().addClass("foc");
                $("#" + n).addClass("foc").parents("dd").parents("dl").addClass("foc")
            }
        }
    });
    $("#" + p).find("span").find("a").click(function () {
        $("#" + p).find("dt").removeClass("foc");
        $("#" + p).find("dd").removeClass("foc");
        $("#" + p).find("a").removeClass("foc");
        $(this).addClass("foc").parent().parent().addClass("foc").siblings().addClass("foc")
    })
};
$PT.filter = function (f, v, t, i, q, w) {
    var u = f.find("dl"), p = u.length, o = window.screen.width;
    u.each(function () {
        if ($(this).find("dd").hasClass("fList brand")) {
            var b = $(this).find("a").length;
            if (o > 1200) {
                if (b > 6) {
                    $(this).find(".fList").css("height", "49px")
                }
                if (b > 12) {
                    $(this).find(".more").show()
                }
            } else {
                if (b > 4) {
                    $(this).find(".fList").css("height", "49px")
                }
                if (b > 8) {
                    $(this).find(".more").show()
                }
            }
        } else {
            new slashAdvFilterDescrib();
            var a = $(this).find(".fList")[0].scrollHeight;
            if (a > 83) {
                $(this).find(".fList").css("height", "49px");
                $(this).find(".more").show()
            }
        }
    });
    if (p > 5) {
        q.show()
    }
    filtersLineGenerator();
    for (var s = 5; s < p; s++) {
        u.eq(s).hide()
    }
    q.toggle(function () {
        for (var a = 5; a < p; a++) {
            u.eq(a).slideDown("fast")
        }
        $(this).addClass("filterUp").html("向上收起")
    }, function () {
        for (var a = 5; a < p; a++) {
            u.eq(a).slideUp("fast")
        }
        $(this).removeClass("filterUp").html("显示全部")
    });
    i.toggle(function () {
        var a = $(this).parent().siblings(".fList")[0].scrollHeight, b = $(this).parent().siblings(".fList");
        b.animate({height:+a - 8 + "px"}, 200);
        $(this).html("收起").addClass("up")
    }, function () {
        var a = $(this).parent().siblings(".fList");
        a.animate({height:"49px"}, 200);
        $(this).html("更多").removeClass("up")
    });
    t.click(function () {
        w.show();
        var b = $(this).parent().attr("class"), c = $(this).html();
        if (f.find(".filterCond").hasClass("searchT")) {
            f.find(".searchT").show();
            f.find(".searchKeyT").addClass("searchKeyTS")
        }
        if ($("#topFilter a").hasClass(b)) {
            $("#topFilter").find("." + b).html(c)
        } else {
            $("#topFilter").append('<a href="javascript:void(0);" class="' + b + '">' + c + "</a>")
        }
        if ($(this).hasClass("foc")) {
            $(this).removeClass("foc");
            $("#topFilter").find("." + b).remove()
        } else {
            $(this).blur().toggleClass("foc").siblings().removeClass("foc")
        }
        (function a(d) {
            $("#topFilter a").click(function () {
                var e = $(this).attr("class");
                $(this).remove();
                f.find("." + e).find("a").removeClass("foc")
            })
        })()
    });
    w.click(function () {
        if (f.find(".filterCond").hasClass("searchT")) {
            $(this).parent().parent().hide();
            f.find(".searchKeyT").removeClass("searchKeyTS")
        } else {
            $(this).hide()
        }
        $(this).blur();
        $("#topFilter").html("");
        f.find("a").removeClass();
        resetAllFilters()
    });
    (function n() {
        var a = $("#sPrice");
        a.click(function () {
            var d = $("#bPrice").val(), b = $("#ePrice").val(), c = /^\+?[1-9][0-9]*$/;
            if (!c.test(d) || !c.test(b) || d >= b) {
                popTip("#fullBg", "#tipI", "请输入正确的价格区间.", ".closePop");
                return false
            }
        })
    })();
    filters = $("#historyFilters").find("tr");
    if (filters && filters.length != 0) {
        matchHistoryFilters(filters);
        $("#resetFilter").show()
    }
};
$PT.proSort = function (j) {
    var i = j == null ? 5 : parseInt(j);
    var f = $("#sort li").eq(i);
    $("#sort").find("b").html(f.html());
    var g = 0;
    var h = "5";
    $("#sortTile").removeClass().addClass(f.attr("class"));
    $("#sort li").click(function () {
        $("#sort").find("b").html(f.html());
        var a = $(this).attr("class");
        $("#sortTile").removeClass().addClass(a);
        $(this).parent().removeClass("foc");
        switch ($(this).index()) {
            case 0:
                g = 8;
                break;
            case 1:
                g = 9;
                break;
            case 2:
                g = 10;
                break;
            case 3:
                g = 6;
                break;
            case 4:
                g = 2;
                break;
            default:
                g = 0
        }
        h = $(this).index();
        sortByFeature(h, g)
    });
    $("#sortTile a").click(function () {
        var a = $(this).attr("rel");
        if (a != "priceChange") {
            $(this).parent().removeClass().addClass(a);
            if (a == "sales") {
                h = 0;
                g = 8;
                $("#sort").find("b").html($("#sort li.sales").html())
            } else {
                if (a == "eval") {
                    h = 3;
                    g = 6;
                    $("#sort").find("b").html($("#sort li.eval").html())
                } else {
                    if (a == "timeS") {
                        h = 4;
                        g = 2;
                        $("#sort").find("b").html($("#sort li.timeS").html())
                    }
                }
            }
            sortByFeature(h, g)
        }
    });
    $("#priceChange").click(function () {
        var a = $(this).parent().attr("class");
        if (a != "priceUp") {
            $(this).parent().removeClass().addClass("priceUp");
            g = 9;
            h = 1;
            $("#sort").find("b").html($("#sort li.priceUp").html())
        } else {
            if (a == "priceUp") {
                $(this).parent().removeClass().addClass("priceDown");
                g = 10;
                h = 2;
                $("#sort").find("b").html($("#sort li.priceDown").html())
            }
        }
        sortByFeature(h, g)
    })
};
$PT.topPager = function (k, i, j) {
    var n = k == null ? 1 : parseInt(k);
    var m = i == null ? 1 : parseInt(i);
    var l = $("#prev"), h = $("#next");
    this.init = function () {
        if (m == 0) {
            $("#pageThis,#pageTotal").html("0")
        }
        if (m <= 1) {
            l.removeClass();
            h.removeClass()
        } else {
            if (n == 1) {
                l.removeClass();
                h.addClass("use")
            } else {
                if (n >= m) {
                    l.addClass("use");
                    h.removeClass()
                } else {
                    l.addClass("use");
                    h.addClass("use")
                }
            }
        }
        if (l.hasClass("use")) {
            l.click(function (c) {
                changePage(parseInt(n - 2))
            })
        }
        if (h.hasClass("use")) {
            h.click(function (c) {
                changePage(n)
            })
        }
        var a = (n - 1) * 36 <= 0 ? 1 : (n - 1) * 36 + 1;
        var b = 0;
        if (n == i) {
            b = j
        } else {
            b = n * 36 <= 36 ? 36 : n * 36
        }
        if (j < 36) {
            b = j;
            if (j == 0) {
                a = 0
            }
        }
        $("#proStart").html(a);
        $("#proEnd").html(b)
    }
};
$PT.buttomPager = function (q, o) {
    var x = q == null ? 1 : parseInt(q);
    var v = o == null ? 1 : parseInt(o);
    var w = $("a.prev"), n = $("a.next");
    var p = $(".pagesubmit");
    var m = $("div.snPages").find("a").not("a.next").not("a.prev");
    var s = "<span class='prev'><b></b> 上一页</span>";
    var u = "<span class='next'><b></b> 下一页</span>";
    var t = "<a  href='###' class='prev'><b></b> 上一页</a>";
    var y = "<a href='###' class='next'><b></b> 下一页</a>";
    this.init = function () {
        this.setStatus();
        this.setPage()
    };
    this.setStatus = function () {
        if (v == 0) {
            $("div.snPages").hide()
        } else {
            $("div.snPages").show()
        }
        if (v <= 1) {
            $("div.snPages").find("span.prev,a.next").remove();
            $("#pageFirst").before(s);
            $("#pageFirst").after(u);
            p.find("input").attr("disabled", true)
        } else {
            if (x == 1) {
                $("div.snPages").find("a.prev").remove();
                if (!$("span.prev")[0]) {
                    $("#pageFirst").before(s)
                }
                if (!$("a.next")[0]) {
                    $("#pageLast").after(y)
                }
            } else {
                if (x >= v) {
                    $("div.snPages").find("span.prev,a.next").remove();
                    $("#pageFirst").before(t);
                    $("#pageLast").after(u)
                } else {
                    $("div.snPages").find("span.prev").remove();
                    $("#pageFirst").before(t);
                    if (!$("a.next")[0]) {
                        $("#pageLast").after(u)
                    }
                }
            }
        }
        m.each(function (b) {
            var a = parseInt($(this).html());
            if (a == x) {
                $(this).addClass("current").css("color", "#FF6600")
            } else {
                $(this).removeClass("current")
            }
        })
    };
    this.setPage = function () {
        $("a.prev").click(function (a) {
            changePage(parseInt(x - 2))
        });
        $("a.next").click(function () {
            changePage(x)
        });
        p.click(function (c) {
            var a = /^[\d]+$/;
            var b = $.trim((p.siblings()).val());
            if (!a.test(b)) {
                alert("请输入正确的数字!")
            } else {
                if (b <= 0 || b > v) {
                    alert("请输入正确的页码!")
                } else {
                    if (b != x) {
                        changePage(parseInt(b - 1))
                    }
                }
            }
        });
        m.click(function (b) {
            if (!$(this).hasClass("current")) {
                $(this).addClass("current").siblings().removeClass("current");
                var a = parseInt($(this).html());
                changePage(parseInt(a - 1))
            }
        })
    }
};
$PT.showTab = function (c) {
    var d = c ? c : "0";
    if (c == "0") {
        $("#showTab").removeClass("spanLS");
        $("#proShow").removeClass().addClass("proListTile")
    } else {
        $("#showTab").addClass("spanLS");
        $("#proShow").removeClass().addClass("proLists")
    }
    $("#listS").click(function () {
        $(this).parent().addClass("spanLS");
        if ($("#proShow").html() != "") {
            $("#proShow").removeClass().addClass("proLists")
        }
    });
    $("#layS").click(function () {
        if ($("#proShow").html() != "") {
            $("#proShow").removeClass().addClass("proListTile")
        }
        $(this).parent().removeClass("spanLS")
    })
};
function stopA() {
    $("a").click(function (b) {
        if ($(this).attr("href") == "javascript:void(0)") {
            b.preventDefault()
        }
    })
}
$PT.compare = function (A, w, i) {
    var t = $("#compare");
    var y = [];
    var D = $(window).scrollTop();
    if (!window.XMLHttpRequest) {
        $(window).scroll(function () {
            var a = $(window).scrollTop();
            t.css("top", a + 200)
        })
    }
    if ($.trim(i)) {
        var C = i.split("|||");
        var G = [], x = "";
        for (var z = 0, E = C.length; z < E; z++) {
            var j, F, u;
            G = C[z].split("||");
            j = G[0];
            F = decodeURIComponent(G[1]);
            u = decodeURIComponent(G[2]);
            if (j) {
                y.push(j);
                x += "<dl id='" + j + "cpar'><dt><img src='" + F + "'/></dt><dd>" + u + "<b class='compareClose'></b></dd></dl>";
                if ($("#" + G[0]).size() != 0) {
                    $("#" + G[0]).find(".opre").find("a").eq(2).html("取消").css("color", "#f60")
                }
            }
        }
        $("#" + w).html(x);
        if (!window.XMLHttpRequest) {
            t.css("top", D + 200)
        }
        t.show();
        v()
    }
    $("#proShow a." + A).click(function () {
        var b = $(this).parent().parent().parent();
        var a = b.find("img").attr("src");
        var d = b.find("span a:not(em)").html();
        var f = b.attr("id");
        var e = $(this).html();
        $("#tipInfor").find("i").css("background-position", "-316px -26px");
        $("#tipInfor").find("i").css("left", "20px");
        $("#tipInfor").find("p").css("padding-left", "62px");
        for (var c = 0; c < y.length; c++) {
            if (f === y[c] && e == "对比") {
                globalAlert("对不起,此商品已存在对比框中.", "info");
                return
            }
            if (f === y[c]) {
                $(this).html("对比").css("color", "#333");
                $("#compareCon dl[id='" + f + "cpar']").remove();
                y.splice(c, 1);
                B();
                return
            }
        }
        if (y.length > 3) {
            globalAlert("对不起,您最多只可选择4个商品对比.", "info");
            return
        }
        $(this).html("取消").css("color", "#f60");
        y.push(f);
        $("#" + w).append("<dl id='" + f + "cpar'><dt><img src='" + a + "'/></dt><dd>" + d + "<b class='compareClose'></b></dd></dl>");
        t.show();
        v();
        B()
    });
    function v() {
        $("#compareCon").find(".compareClose").click(function () {
            $(this).parent().parent().remove();
            var d = $(this).parent().parent().attr("id");
            var b = d.replace("cpar", "");
            var c = $("#compareCon").find(".compareClose").length;
            $("#" + b).find(".opre").find("a").eq(2).html("对比").css("color", "#333");
            if (c == 0) {
                $("#compareCon").parent().hide();
                y = []
            }
            for (var a = 0; a < y.length; a++) {
                if (b === y[a]) {
                    y.splice(a, 1)
                }
            }
            B()
        })
    }

    $("#boxClose").click(function () {
        $("#compare").hide();
        $("#compareCon").html("");
        y = [];
        $("#proShow .opre a").each(function () {
            if ($(this).html() == "取消") {
                $(this).html("对比").css("color", "#333")
            }
        });
        $.cookie("compare", "", {domain:URLPrefix.cookie_domain, path:"/"})
    });
    t.find(".compareAll").click(function () {
        var a = y.length;
        var c = y[0];
        var e = y[1];
        var b = y[2];
        var d = y[3];
        if (a < 2) {
            globalAlert("对不起,少于2个商品无法使用对比功能.", "info");
            return false
        } else {
            if (a == 2) {
                window.open(URLPrefix.commerce_emall + "/ProductCompareView?catalogId=10051&storeId=10052&compareIds=" + c + "&compareIds=" + e)
            } else {
                if (a == 3) {
                    window.open(URLPrefix.commerce_emall + "/ProductCompareView?catalogId=10051&storeId=10052&compareIds=" + c + "&compareIds=" + e + "&compareIds=" + b)
                } else {
                    if (a == 4) {
                        window.open(URLPrefix.commerce_emall + "/ProductCompareView?catalogId=10051&storeId=10052&compareIds=" + c + "&compareIds=" + e + "&compareIds=" + b + "&compareIds=" + d)
                    }
                }
            }
        }
    });
    function B() {
        $.cookie("compare", "", {domain:URLPrefix.cookie_domain, path:"/"});
        var a = $("#compareCon").find("dl");
        if (a.size() != 0) {
            var e = "";
            var c, d, b;
            a.each(function () {
                c = $(this).attr("id").replace("cpar", "");
                d = $(this).find("img").attr("src");
                b = $(this).find("dd").text();
                e += c + "||" + encodeURIComponent(d) + "||" + encodeURIComponent(b) + "|||"
            });
            e = e.substr(0, e.length - 3);
            $.cookie("compare", e, {domain:URLPrefix.cookie_domain, path:"/"})
        }
    }
};
$PT.customPrice = function (d, c) {
    $("#" + c).click(function () {
        var k = $.trim($("#startM").val()), m = $.trim($("#endM").val());
        var n = parseInt(parseFloat(k)), b = parseInt(parseFloat(m));
        var j = /(^\+?[1-9]+[\d]*$)|(^[0]+$)/, a = /^\+?[1-9][0-9]*$/;
        if (!j.test(k) || !a.test(m) || n >= b) {
            globalAlert("请输入正确的价格区间.", "info");
            $("#startM,#endM").val("");
            return false
        } else {
            var l = parseInt(k) + "-" + parseInt(m);
            $("#filterContent").find("dl[class='filterPrice']").find("a").each(function () {
                $(this).blur().removeClass("foc")
            });
            if (l == $.trim($("#startMendM").val())) {
                window.location.reload()
            } else {
                searchFilterPage("price", l)
            }
        }
    });
    if ($.trim($("#startM").val()) != "") {
        $("#cPrice").css("display", "inline")
    }
};
$PT.evaluLen = function (b) {
    var b = $(b);
    b.each(function () {
        var f = $(this).html();
        var e = f.length;
        var a = e - 3;
        if (e > 5) {
            f = f / Math.pow(10, a);
            f = Math.floor(f);
            $(this).html(f + "...")
        }
    })
};
$PT.evalCharLen = function (e, f) {
    var d = $(e);
    f = f || 7;
    d.each(function () {
        var a = $.trim($(this).html());
        if (a.length > f) {
            $(this).html(a.substr(0, f) + "...")
        }
    })
};
$PT.scroll = function (l, m, q, o, k) {
    var l = $("#" + l);
    var i = $("." + m).width();
    var q = $("#" + q);
    var k = $("#" + k);
    var s = q.find("li").length || 7;
    var n = Math.ceil(s / o);
    var p = 1;
    l.click(function () {
        $(this).blur();
        if (p == 1) {
            return false
        } else {
            q.animate({left:"+=" + i}, 240);
            p--
        }
    });
    k.click(function () {
        $(this).blur();
        var a = $(this).siblings().find("img[src3]");
        a.each(function () {
            $(this).attr("src", $(this).attr("src3")).removeAttr("src3")
        });
        if (p == n) {
            return false
        } else {
            q.animate({left:"-=" + i}, 240);
            p++
        }
    })
};
$PT.comparePage = function (h, e, g, f) {
    var g = $("b." + g);
    var h = $("table." + h);
    h.find("tr.title").toggle(function () {
        $(this).find("td").addClass("shrink");
        $(this).siblings().hide()
    }, function () {
        $(this).siblings().show();
        $(this).find("td").removeClass("shrink")
    });
    g.each(function () {
        var a = $(this).html();
        var c = a.length;
        var b = c - 5;
        if (c > 7) {
            a = a / Math.pow(10, b);
            a = Math.floor(a);
            $(this).html(a + "...")
        }
    });
    $("a." + e).click(function () {
        var c = $(this).parent();
        var m = c.index();
        c.parent().append("<li class='last'><a href='" + f + "' class='thirdBg cancal'>增加对比选项</a></li>");
        c.remove();
        h.find("tr").not(".title").each(function () {
            $(this).find("td").eq(m).remove();
            $(this).append("<td></td>")
        });
        var a = $("#showPros").find("td");
        if (a.eq(1).find("div").size()) {
            var b = "";
            var d, n, l;
            a.each(function () {
                if ($(this).find("div").size()) {
                    d = $(this).find("div").eq(0).attr("id");
                    n = $(this).find("img").attr("src");
                    l = $(this).find("span p").eq(0).text();
                    b += d + "||" + encodeURIComponent(n) + "||" + encodeURIComponent(l) + "|||"
                }
            });
            b = b.substr(0, b.length - 3);
            $.cookie("compare", b, {domain:URLPrefix.cookie_domain, path:"/"})
        } else {
            $.cookie("compare", "", {domain:URLPrefix.cookie_domain, path:"/"})
        }
    })
};
$PT.cityBox = function () {
    var l = $("#citybox");
    var o, t = false, n, q, k, p, m = false, s;
    var u;
    return{init:function (a) {
        u = a || (function (b) {
            alert(b)
        });
        if (l.length == 0) {
            return
        }
        n = this;
        o = $("#citybox_btn");
        o.click(function (b) {
            if (l.css("display") == "none") {
                $(this).addClass("select");
                l.show()
            } else {
                $(this).removeClass("select");
                l.hide()
            }
            b.preventDefault()
        });
        l.mouseover(function () {
            $(this).show();
            $("#citybox_btn").addClass("select")
        }).mouseleave(function () {
            $(this).hide();
            $("#citybox_btn").removeClass("select")
        });
        l.find("table a").click(function (b) {
            var c = this.href;
            n.x = parseInt($(this).offset().left - $(".province").offset().left);
            n.y = parseInt($(this).offset().top - $(".province").offset().top);
            b.preventDefault();
            if (q != null) {
                q.remove();
                q = null
            }
            m = false;
            clearTimeout(s);
            p = $(this).offset();
            (function () {
                $.get(c, function (d) {
                    n.addCity(d, $(this).parent())
                })
            })();
            $(this).css({"z-index":111, position:"relative"});
            $(this).css("position", "relative");
            $(this).addClass("on").parent().parent().siblings().find("a").removeClass("on");
            $(this).addClass("on").parent().siblings().find("a").removeClass("on");
            $(this).addClass("on").siblings().removeClass("on")
        }).mouseleave(function (b) {
                $(this).css({"z-index":10, position:"relative"});
                s = setTimeout(function () {
                    if (!m && q != null) {
                        q.remove();
                        $(".province").find("a").removeClass("on");
                        q = null;
                        l.css({height:"auto"})
                    }
                }, 200)
            });
        l.find(".closeIco").click(function (b) {
            l.hide();
            b.preventDefault()
        })
    }, addCity:function (b, e) {
        var y = /([A-Za-z]+)([0-9]+)(.[^\|]+)()/g;
        var g = {};
        var h = {};
        while (r = y.exec(b)) {
            if (!g[r[1]]) {
                g[r[1]] = [r[3]];
                h[r[1]] = [r[2]]
            } else {
                g[r[1]].push(r[3]);
                h[r[1]].push(r[2])
            }
        }
        var c = 0;
        var a = '<table class="citys"><tr>';
        var A = "";
        for (var f in g) {
            var i = g[f];
            var d = h[f];
            for (var z = 0; z < d.length; z++) {
                A += "<a name=" + d[z] + ' href="#">' + i[z] + "</a>"
            }
            c++
        }
        a += '<td class="td03">' + A + "</td></tr><tr>";
        a = a.substring(0, a.length - 5) + "</table>";
        var j = l.height();
        q = $(a);
        l.append(q);
        if (this.y + q.height() + 30 < j) {
            l.css("height", j)
        } else {
            l.css({height:this.y + q.height() + 30})
        }
        q.mouseover(function (v) {
            m = true
        }).mouseleave(function (v) {
            m = false;
            q.remove();
            q = null;
            l.css({height:"auto"});
            $(".province").find("a").removeClass("on")
        });
        q.find("a").click(function (v) {
            setTimeout(function () {
                l.hide();
                $("#citybox_btn").removeClass("select");
                l.css({height:"auto", "z-index":20})
            }, 300);
            $("#citybox_btn .ctext").html(this.innerHTML);
            v.preventDefault();
            changeCity(this.innerHTML, this.name)
        });
        q.css({left:10 + "px", top:this.y + 19 + "px"})
    }}
};
$PT.catalogTree = function (c, d) {
    $("#navBarCon dl:first-child").children().addClass("foc");
    if (c) {
        $("#navBarCon dl:first-child").addClass("foc")
    }
    if (d) {
        $("#" + d).addClass("foc").parents("dt").parents("dl").addClass("foc");
        $("#" + d).addClass("foc").parents("dd").parents("dl").addClass("foc");
        $("#" + d).addClass("foc").parents("dd").addClass("foc").siblings().addClass("foc");
        if (!c) {
            $("#" + d).click(function (a) {
                a.preventDefault()
            })
        }
    }
};
$PT.goTopBox = function () {
    var d = window.screen.width, c = 0;
    if (d < 1200) {
        c = ($(window).width() - 960) / 2 - 50
    } else {
        c = ($(window).width() - 1160) / 2 - 50
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() > 0) {
            $("#back_top").css("right", c).fadeIn(200)
        } else {
            $("#back_top").fadeOut()
        }
        if (!window.XMLHttpRequest) {
            $("#back_top").css("top", $(window).scrollTop() + $(window).height() - 100)
        }
    })
};
function SnLazyLoad(i, l) {
    l = l || {};
    var n = l.multiple || 1.5;
    var m = $(i);
    var h = m.find("img[src2], iframe[src2]");
    var j = navigator.userAgent.toLowerCase().match(/iPad/i) == "ipad";
    var k = document.documentElement.clientHeight;
    this.load = function () {
        var a = j ? window.pageYOffset : Math.max(document.documentElement.scrollTop, document.body.scrollTop);
        h.each(function () {
            var d = $(this);
            var b = d.offset().top;
            if (b <= (a + parseInt(k * n))) {
                var c = d.attr("src2");
                if (c) {
                    d.attr("src", c).removeAttr("src2")
                }
            }
        })
    };
    this.bindScroll = function () {
        $(window).bind("scroll", this.load)
    };
    this.bindScroll();
    this.load()
}
function priceWavy(g, h) {
    g = g || "";
    var l = $(g + ".liprice").length;
    var k = $(g + ".liprice");
    for (var j = 0; j < l; j++) {
        var i;
        if (k.eq(j).attr("src")) {
            i = k.eq(j).attr("src").replace("~", h);
            k.eq(j).attr("src", i)
        } else {
            if (k.eq(j).attr("src1")) {
                i = k.eq(j).attr("src1").replace("~", h);
                k.eq(j).attr("src", i).removeAttr("src1")
            } else {
                if (k.eq(j).attr("src2")) {
                    i = k.eq(j).attr("src2").replace("~", h);
                    k.eq(j).attr("src", i).removeAttr("src2")
                } else {
                    if (k.eq(j).attr("src3")) {
                        i = k.eq(j).attr("src3").replace("~", h);
                        k.eq(j).attr("src", i).removeAttr("src3")
                    }
                }
            }
        }
    }
}
$PT.recTxt = function (d) {
    var c = d.html();
    d.click(function () {
        $(this).html("")
    });
    d.blur(function () {
        if ($(this).html() == "" || $(this).html() == c) {
            $(this).html(c);
            return false
        }
    })
};
function specPBLen() {
    var c = $("#specPB"), d = c.find("li").length;
    c.css("width", (d * 253) + "px");
    $PT.recTxt($("#recTxt"))
}
function matchHistoryFilters(d) {
    if (typeof(d) != null && d.size != 0) {
        $(".filterCond").show()
    }
    var c = false;
    d.each(function () {
        var a = $(this).find("td").eq(0).html();
        var g = $(this).find("td").eq(1).html();
        $("#" + a).find("a").each(function () {
            if ($.trim(g) == $.trim($(this).attr("id"))) {
                var e = $(this).parent().attr("class"), m = $.trim($(this).html());
                var f = parseInt(e.substring(2));
                if (f > 5) {
                    c = true
                }
                $(this).addClass("foc");
                var l = "'" + $(this).parent().parent().parent().attr("id") + "'";
                l = l == "'brand_Id_Name'" ? "'brand_Name_FacetAll'" : l;
                l = l == "'filterPrice'" ? "'price'" : l;
                var n = "'" + $(this).attr("id") + "'";
                $("#topFilter").append('<a href="###" class="' + e + '" onclick="searchFilterPage(' + l + "," + n + ')">' + m + "</a>");
                $(this).find("a").addClass("foc").siblings().removeClass("foc");
                showAll($(this).find("a").find("em"))
            }
        });
        if ("price" == a && !$("#price a").hasClass("foc")) {
            var b = g.split("-")[0];
            var h = g.split("-")[1];
            $("#startM").val(b);
            $("#endM").val(h);
            if (parseInt(parseFloat(b)) == 0) {
                $("#startM").val("0")
            }
            $("#startM").parent("div").show()
        }
    });
    if (c) {
        $("#filterContent").find("dl").show();
        $("#filterShrink").addClass("filterUp").html("向上收起")
    }
}
function showAll(h) {
    if ($(h).parent().parent().parent().parent().parent().css("display") == "none") {
        $(h).parent().parent().parent().parent().parent().siblings().not("#historyFilters").each(function () {
            if ($(this).css("display") == "none") {
                $(this).css("display", "block")
            }
        });
        var g = $("#filterContent").find("dl");
        var e = g.length;
        $(h).parent().parent().parent().parent().parent().css("display", "block");
        g.eq(4).css("border-bottom", "1px dotted #ccc");
        g.eq(e - 1).css("border", "none");
        for (var f = 5; f < e; f++) {
            g.eq(f).slideDown("fast")
        }
        $("#filterShrink").addClass("filterUp").html("向上收起")
    }
}
function submit(c) {
    var d = document.createElement("form");
    d.action = "search.do?keyword=" + c;
    d.method = "get";
    d.id = "omiiForm";
    d.name = "omiiForm";
    d.style.display = "none";
    document.body.appendChild(d);
    setTimeout("omiiFormDoSubmit()", 10)
}
function omiiFormDoSubmit() {
    $("#omiiForm")[0].submit()
}
function resubmitSearchin1(h, f) {
    var i = $.trim(document.getElementById("reword").value);
    f = (f) ? f : ((window.event) ? window.event : "");
    keyCode = f.keyCode ? f.keyCode : (f.which ? f.which : f.charCode);
    if (13 == keyCode) {
        if (i === "") {
            window.location.reload()
        } else {
            var j = URLPrefix.search + "/search.do?keyword=" + encodeURIComponent(i);
            var g = $.cookie("cityId");
            if (!g) {
                g = 9173
            }
            j = j + "&cityId=" + g;
            window.location.href = j
        }
    }
}
function resubmitSearchin(h) {
    var e = $("#reword").val();
    if (e == "") {
        e = h;
        var f = URLPrefix.search + "/search.do?keyword=" + encodeURIComponent(h)
    } else {
        var f = URLPrefix.search + "/search.do?keyword=" + encodeURIComponent(e)
    }
    var g = $.cookie("cityId");
    if (!g) {
        g = 9173
    }
    f = f + "&cityId=" + g;
    window.location.href = f
}
if (typeof param != "undefined") {
    var href = param.holdURL;

    function searchFilterPage(d, c) {
        href = param.holdURL + getShowType() + param.sortType + param.inventory + "&cf=" + d + ":" + c + param.historyFilter;
        window.parent.location = href
    }

    function clearCustomerPrice() {
        if (param.historyFilter != "") {
            $("#startM,#endM").val("");
            $("#cPrice").hide();
            searchFilterPage("price", $("#startMendM").val())
        }
    }

    function sortByFeature(d, c) {
        href = param.holdURL + "&cp=0" + getShowType();
        if (d != null) {
            href = href + "&si=" + d
        }
        if (c != null) {
            href = href + "&st=" + c
        }
        href = href + param.inventory + param.historyFilter;
        window.parent.location = href
    }

    function changePage(b) {
        href = param.holdURL + "&cp=" + b + getShowType() + param.sortType + param.inventory + param.historyFilter;
        window.parent.location = href
    }

    function checkForInventory(b) {
        href = param.holdURL + "&cp=0" + getShowType() + param.sortType;
        if (b == "1") {
            href = href + "&iy=1"
        }
        href = href + param.historyFilter;
        window.parent.location = href
    }
}
$(".disAll").click(function () {
    if ($("#inventory").val() == "1") {
        checkForInventory(0)
    } else {
        checkForInventory(1)
    }
});
function getShowType() {
    var b = $("#showTab").hasClass("spanLS") ? "1" : "0";
    return"&il=" + b
}
function resetAllFilters() {
    window.parent.location = href
}
function slashAdvFilterDescrib() {
    var c = $(".advFilValDes");
    c.each(function () {
        var a = $.trim($(this).html());
        var b = slasher(a, 30, false);
        $(this).html(b)
    });
    var d = $(".advFilValDesBrand");
    d.each(function () {
        var a = $.trim($(this).html());
        var b = slasher(a, 14, true);
        $(this).html(b)
    })
}
function slashNoResPageRelatedWords(d) {
    d *= 2;
    var c = $(".noResultPageRw");
    c.each(function () {
        var a = $(this).html();
        var b = slasher(a, d, true);
        $(this).html(b)
    })
}
function slasher(m, i, n) {
    if (m == null || typeof(m) == "undefined") {
        return
    }
    var s = 0;
    var o = "";
    var l = /[^\x00-\xff]/g;
    var p = "";
    var k = m.replace(l, "**").length;
    for (var q = 0; q < k; q++) {
        p = m.charAt(q).toString();
        if (p.match(l) != null) {
            s += 2
        } else {
            s++
        }
        if (s > i) {
            break
        }
        o += p
    }
    if (k > i && n) {
        o += "..."
    }
    return o
}
function backToTop() {
    if (document.body) {
        $(document.body).animate({scrollTop:0})
    }
    $("html").animate({scrollTop:0})
}
function sideToolsAct() {
    var u = $("#sideTools");
    var p = $(window).height();
    var m = u.height();
    var y = u.find(".stMore");
    var t = u.find(".miniNav a");
    var w = u.find(".stMoreClose");
    var q = false;
    var n;
    var x = !!window.ActiveXObject;
    var v = x && !window.XMLHttpRequest;
    u.css({top:(p - m) - 100 + "px"});
    if (v) {
        u.css({bottom:"200px"})
    }
    u.removeClass("hide");
    u.hover(function () {
        clearTimeout(n);
        u.stop().animate({right:0})
    }, function () {
        if (!q) {
            n = setTimeout(function () {
                u.stop(true, true).animate({right:"-52px"})
            }, 300)
        }
    });
    t.click(function () {
        o()
    });
    w.click(function () {
        o()
    });
    function o() {
        var b = y.height();
        if (!q) {
            t.addClass("on");
            y.show().height("auto");
            var c = y.height();
            y.height(0).hide();
            var a = (p - m - c + 14) / 2;
            var d = u.css("right");
            if (d < 0) {
                u.animate({right:0}, 1)
            }
            if (a < 0) {
                a = 0
            }
            y.show().animate({height:c + "px"}, 400);
            if (v) {
                u.css({top:$(document).scrollTop() + 42 + "px"})
            } else {
                u.stop().animate({top:a + "px"}, 350)
            }
            w.show();
            q = true
        } else {
            t.removeClass("on");
            y.animate({height:0}, 180);
            if (v) {
                u.css({top:$(document).scrollTop() + 42 + "px"})
            } else {
                u.stop().animate({top:(p - m) / 2 + "px"}, 350, function () {
                    y.hide()
                })
            }
            w.hide();
            q = false
        }
    }

    function s() {
        if (v) {
            var a = (p - m) / 2;
            u.css({position:"absolute", right:"-54px", top:a + "px"});
            $(window).scroll(function () {
                var d = u.height();
                var b = (p - d) - 100;
                var c = $(document).scrollTop();
                u.stop().animate({top:b + c + "px"}, 500)
            })
        }
    }

    s()
}
function filtersLineGenerator() {
    var e = $("#filterContent").find("dl");
    var f = false;
    var d = 0;
    if (!$(".filterCond ").is(":hidden")) {
        f = true
    }
    e.each(function () {
        if (d != 0) {
            $(this).css("border-top", "1px dotted #CCCCCC")
        }
        d++
    })
}
function AdvfilterNameSlasher(c) {
    var d = $(".AdvFfiledNameDesc");
    d.each(function () {
        var a = $.trim($(this).html());
        a = a.substring(0, a.length - 1);
        var b = slasher(a, c * 2, false);
        $(this).html(b + ":")
    })
}
function recomStoreDescribSlasher() {
    var b = $(".recomStoreDescrib");
    b.html(slasher(b.html(), 88 * 2, true))
}
;
/* FILE BEGIN searchSug.js */
$.ajax({type:"GET", data:"key=" + $("#keyword").val() + "&cityId=" + $("#cityId").val(), dataType:"html", url:"buyMore.html", success:function (b) {
    var a = b.split("@split@");
    $("#finalBuy").html(a[0]);
    $("#buyMore").html(a[1]);
    $("#singleRec_findMore").html(a[2]);
    if (a[2] != "\r\n") {
        $("#singleRec_findMore").css("display", "block")
    }
    new SnLazyLoad("#buyLast,#bugMore,#singleRec_findMore")
}, error:function () {
}});
/* FILE BEGIN jsInit.js */
if (typeof(param) != "undefined") {
    $PT.showTab(param.isList);
    $PT.proSort(param.sortIndex);
    $PT.catalogTree(param.level, param.categoryId);
    $PT.sibOpera("navBarConIndex", "dt", "dd", param.categoryId, param.dirBean_level);
    $PT.sibOpera("navBarCon", "dt", "dd");
    if (param.currentPage) {
        new $PT.topPager(parseInt(param.currentPage) + 1, parseInt(param.pageNumbers), parseInt(param.numFound)).init();
        new $PT.buttomPager(parseInt(param.currentPage) + 1, parseInt(param.pageNumbers)).init()
    }
}
$PT.compare("compareBtn", "compareCon", $.cookie("compare"));
$PT.goTopBox();
$PT.filter($("#filterContent"), $("#price"), $("#filterContent li a"), $("#filterContent .moreCond span"), $("#filterShrink"), $("#resetFilter"));
$PT.customPrice("filterPrice", "customPrice");
$("#proShow li").hover(function () {
    $(this).addClass("foc").siblings().removeClass("foc")
}, function () {
    $(this).removeClass("foc")
});
new SnLazyLoad("#proShow,#recClassify,#recFStore");
new sideToolsAct();
new slashNoResPageRelatedWords(6);
new AdvfilterNameSlasher(7);
new recomStoreDescribSlasher();
/* FILE BEGIN collect_da.js */
function HashMap() {
    this.keys = new Array();
    this.data = new Object();
    this.put = function (d, c) {
        if (this.data[d] == null) {
            this.keys.push(d)
        }
        this.data[d] = c
    };
    this.get = function (b) {
        return this.data[b]
    };
    this.remove = function (b) {
        if (this.get(b) != null) {
            delete this.data[b]
        }
    }
}
var _samap = new HashMap();
function _filterSaPush() {
    var f = /^filter_.+$/;
    var e = ["a", null, null, f];
    var d = [e];
    _samap.put("_saClickDatas", d)
}
function _searchDataSaPush(C) {
    var y = document.location.href;
    var x = y.substring(y.indexOf("?") + 1, y.length);
    var u = x.split("&");
    var i = new HashMap();
    for (var A = 0; A < u.length; A++) {
        var z = u[A].split("=");
        for (var w = 0; w < z.length; w++) {
            i.put(z[w], z[++w])
        }
    }
    var t = i.get("keyword");
    var D = (!t || t == null || t == "undefined") ? "" : t;
    var E = C;
    var F = "0";
    var G = "";
    var B = i.get("ci");
    var H = (!B || B == null || B == "undefined") ? "" : B;
    var v = i.get("catalogId");
    var I = (!v || v == null || v == "undefined") ? "" : v;
    var J = [D, E, F, G, H, I];
    _samap.put("_saSearchDatas", J)
}
;