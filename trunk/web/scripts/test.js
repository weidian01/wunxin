window.console = window.console || {};
window.console.log = window.console.log || function () {
};
function html_chars_decode(a) {
    return !a ? "" : a.replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&amp;/g, "&").replace(/&quot;/g, '"').replace(/&#0*39;/g, "'")
}
QUERY_KEYWORD = html_chars_decode(window.QUERY_KEYWORD);
REAL_KEYWORD = html_chars_decode(window.REAL_KEYWORD);
$("#key").val(QUERY_KEYWORD);
String.prototype.trim = function () {
    return this.replace(/^\s*(.*?)\s*$/, "$1")
};
String.prototype.isEmpty = function () {
    if (0 == this.length) {
        return true
    } else {
        return false
    }
};
function template(a, b) {
    if (typeof b != "object") {
        return""
    }
    return a.replace(/{#(.*?)#}/g, function () {
        var c = arguments[1];
        if ("undefined" != typeof(b[c]) && b[c] != null) {
            return b[c]
        } else {
            return""
        }
    })
}
function getQueryString(a) {
    var b = new RegExp("(^|\\?|&)" + a + "=([^&]*)(\\s|&|$)", "i");
    if (b.test(location.href)) {
        return RegExp.$2
    }
    return""
}
function sGetScript(b, e, d) {
    e = e || "GBK";
    var a = document.createElement("script");
    a.type = "text/javascript";
    a.charset = e;
    a.src = b;
    if (d == true) {
        a.async = true
    }
    var c = document.getElementsByTagName("head")[0];
    c.appendChild(a)
}
function htmlspecialchars(a, b) {
    a = a.replace("<", "&lt;").replace(">", "&gt;").replace("&", "&amp;").replace('"', "&quot;");
    return b == true ? a.replace("'", "&#0*39;") : a
}
(function () {
    var d = $("#refilter");
    if (d.length < 1) {
        return
    }
    var b = d.find(".item"), c = d.find(".more");
    var a = function (f) {
        var e = b.length;
        for (var g = 0; g < e; g++) {
            if (g >= 10) {
                if (!f) {
                    $(b[g]).hide()
                } else {
                    $(b[g]).show()
                }
            }
        }
    };
    c.each(function (e) {
        a(false);
        $(this).bind("click", function () {
            if ((!$(this).attr("s") || $(this).attr("s") == null || $(this).attr("s") == "1")) {
                $(this).html("<span>收起</span><b class='close'></b>");
                a(true);
                $(this).attr({s:"0"})
            } else {
                $(this).html("<span>显示全部分类</span><b class='open'></b>");
                a(false);
                $(this).attr({s:"1"})
            }
        })
    });
    $("#refilter .item h3").each(function () {
        $(this).click(function () {
            var e = $(this).parent();
            if (e.hasClass("hover")) {
                e.removeClass("hover")
            } else {
                e.addClass("hover")
            }
        })
    });
    $("#refilter .item h3 a").click(function (e) {
        e.stopPropagation()
    })
})();
$(function () {
    var c = {};
    c.setASCIICookie = function (i, j, f, g, e, h) {
        if ("string" == typeof(i) && "string" == typeof(j)) {
            j = escape(j);
            c.setCookie(i, j, f, g, e, h)
        }
    };
    c.setUnicodeCookie = function (i, j, f, g, e, h) {
        if ("string" == typeof(i) && "string" == typeof(j)) {
            j = encodeURIComponent(j);
            c.setCookie(i, j, f, g, e, h)
        }
    };
    c.setCookie = function (j, k, f, g, e, i) {
        if ("string" == typeof(j) && "string" == typeof(k)) {
            var h = j + "=" + k;
            if (f) {
                h += "; expires=" + f.toGMTString()
            }
            if (g) {
                h += "; path=" + g
            }
            if (e) {
                h += "; domain=" + e
            }
            if (i) {
                h += "; secure"
            }
            document.cookie = h
        }
    };
    c.getUnicodeCookie = function (f) {
        if ("string" == typeof(f)) {
            var g = getCookie(f);
            if (null == g) {
                return null
            } else {
                return decodeURIComponent(g)
            }
        } else {
            var e = document.cookie;
            return e
        }
    };
    c.getASCIICookie = function (f) {
        if ("string" == typeof(f)) {
            var g = getCookie(f);
            if (null == g) {
                return null
            } else {
                return unescape(g)
            }
        } else {
            var e = document.cookie;
            return e
        }
    };
    c.getCookie = function (h) {
        var e = document.cookie;
        if ("string" == typeof(h)) {
            var g = "(?:; )?" + h + "=([^;]*);?";
            var f = new RegExp(g);
            if (f.test(e)) {
                return RegExp["$1"]
            } else {
                return null
            }
        } else {
            return e
        }
    };
    c.deleteCookie = function (g, f, e) {
        c.setCookie(g, "", new Date(0), f, e)
    };
    var b = {"1":{name:"\u5317\u4EAC", c:"72"}, "2":{name:"\u4E0A\u6D77", c:"78"}, "3":{name:"\u5929\u6D25", c:"83"}, "4":{name:"\u91CD\u5E86", c:"87"}, "5":{name:"\u6CB3\u5317", c:"142"}, "6":{name:"\u5C71\u897F", c:"303"}, "7":{name:"\u6CB3\u5357", c:"412"}, "8":{name:"\u8FBD\u5B81", c:"560"}, "9":{name:"\u5409\u6797", c:"639"}, "10":{name:"\u9ED1\u9F99\u6C5F", c:"698"}, "11":{name:"\u5185\u8499\u53E4", c:"799"}, "12":{name:"\u6C5F\u82CF", c:"904"}, "13":{name:"\u5C71\u4E1C", c:"1000"}, "14":{name:"\u5B89\u5FBD", c:"1116"}, "15":{name:"\u6D59\u6C5F", c:"1158"}, "16":{name:"\u798F\u5EFA", c:"1303"}, "17":{name:"\u6E56\u5317", c:"1381"}, "18":{name:"\u6E56\u5357", c:"1482"}, "19":{name:"\u5E7F\u4E1C", c:"1601"}, "20":{name:"\u5E7F\u897F", c:"1715"}, "21":{name:"\u6C5F\u897F", c:"1827"}, "22":{name:"\u56DB\u5DDD", c:"1930"}, "23":{name:"\u6D77\u5357", c:"2121"}, "24":{name:"\u8D35\u5DDE", c:"2144"}, "25":{name:"\u4E91\u5357", c:"2235"}, "26":{name:"\u897F\u85CF", c:"2951"}, "27":{name:"\u9655\u897F", c:"2376"}, "28":{name:"\u7518\u8083", c:"2487"}, "29":{name:"\u9752\u6D77", c:"2580"}, "30":{name:"\u5B81\u590F", c:"2628"}, "31":{name:"\u65B0\u7586", c:"2652"}, "32":{name:"\u53F0\u6E7E", c:"2768"}, "42":{name:"\u9999\u6E2F", c:"2754"}, "43":{name:"\u6FB3\u95E8", c:"2770"}};
    var d = new Date().getTime() + 1000 * 3600 * 24 * 30;
    var a = new Date(d);
    window.SEARCH = {};
    window.SEARCH.setAreaCookie = function (f) {
        if (null == f || "" == f) {
            c.deleteCookie("ipLoc-djd", "/", "360buy.com");
            c.deleteCookie("ipLocation", "/", "360buy.com")
        } else {
            var g = b[f];
            if (null != g && "undefined" != typeof(g)) {
                var j = g.c;
                if (null != j && "undefined" != typeof(j)) {
                    var e = f + "-" + j;
                    var i = g.name;
                    try {
                        c.setCookie("ipLoc-djd", e, a, "/", "360buy.com", false);
                        c.setASCIICookie("ipLocation", i, a, "/", "360buy.com", false)
                    } catch (h) {
                        console.log("info: " + h)
                    }
                }
            }
        }
    };
    $("#store-selector").hoverForIE6();
    (function () {
        try {
            var j = window.location.search;
            var i = j.match(/area=(\d*)/i);
            if (null != i && 2 == i.length) {
                var e = i[1];
                e = e.trim();
                if ("string" == typeof(e) && "" != e) {
                    var g = $("[p=" + e + "]");
                    if (g.length > 0) {
                        var k = "<div>" + g.html() + "<b></b></div>";
                        var f = $("#store-selector");
                        f.children()[0].innerHTML = k
                    }
                }
            }
        } catch (h) {
            console.log("info: " + h)
        }
    })();
    $("#store-selector").Jdropdown()
});
function getAreaParam() {
    var c = window.location.search;
    var b = c.match(/area=(\d*)/i);
    var a = "";
    if (null != b && 2 == b.length) {
        a = b[1];
        a = a.trim();
        if ("string" == typeof(a) && "" != a) {
            a = "&area=" + a
        } else {
            a = ""
        }
    }
    return a
}
function relationalSearchCallback(g) {
    if ("string" == typeof(g) && g.length > 0) {
        var e = true, f = $(".dialogbox");
        if (f.length < 1) {
            e = false;
            f = $(".recommend")
        }
        g = g.replace(/\*$/, "");
        var j = g.split("*");
        var c = [], m = j.length;
        for (var h = 0; h < m; h++) {
            if ("" == b) {
                continue
            }
            c.push(j[h])
        }
        var a = c.length;
        if (a > 7) {
            a = 7
        }
        if (a > 0) {
            var l = getAreaParam();
            var k = "<span>相关搜索：</span>";
            for (var h = 0; h < a; h++) {
                var b = c[h];
                if (e) {
                    var d = "", n = "<b></b>";
                    if (h == 0) {
                        d = ' class="fore"'
                    } else {
                        if (h == a - 1) {
                            n = ""
                        }
                    }
                    sAnchorNode = "<a onclick='searchlog(1, 0, " + h + ', 52, "' + b + "\");' href='search?keyword=" + b + l + "'" + d + ">" + b + "</a>" + n
                } else {
                    sAnchorNode = "<a onclick='searchlog(1, 0, " + h + ', 52, "' + b + "\");' href='search?keyword=" + b + l + "'>" + b + "</a>"
                }
                k += sAnchorNode
            }
            f.html(k).show()
        }
    }
}
function relationalSearch() {
    var b = QUERY_KEYWORD;
    if ("" == b) {
        return
    } else {
        b = encodeURIComponent(b);
        b = b.toLocaleLowerCase();
        var e = "http://qpsearch.360buy.com/relationalSearch?keyword={keyword}&callback=relationalSearchCallback";
        var d = e.replace(/\{keyword}/, b);
        var a = document.createElement("script");
        a.type = "text/javascript";
        a.charset = "UTF-8";
        a.async = true;
        a.src = d;
        var c = document.getElementsByTagName("head")[0];
        c.appendChild(a)
    }
}
var showBookSummary = function () {
    this.fragment = ['<div class="img"><img src="http://img10.360buyimg.com/n1/{img}" width="280" height="280" alt="" /></div><div class="text"><table cellpadding="0" cellspacing="0" border="0" width="100%">{detaile}</table></div>', '<div class="summary"><div class="i-summary"><div class="close" onclick="$(this).parent().parent().hide()"></div><div class="arrow"></div><div class="con"><div class="iloading">\u6b63\u5728\u52a0\u8f7d\u4e2d\uff0c\u8bf7\u7a0d\u5019...</div></div></div></div>', "<tr><td>{name}{value}</td></tr>"];
    this.object = $(".item-book");
    this.dataUrl = "http://www.360buy.com/book/ExtAjaxService.aspx?stype=search&skuid=";
    this.edataUrl = "http://e.360buy.com/ebook/ExteBookService.aspx?stype=search&skuid=";
    this.setPosition = function (b) {
        var c = this, a = (screen.width >= 1200) ? 700 : 480;
        if (b.get(0).offsetLeft > $("#header").get(0).offsetLeft + a) {
            b.find(".summary").addClass("direct-left")
        }
    };
    this.init = function () {
        var a = this;
        this.object.each(function (b) {
            var c = $(this);
            c.find("img").bind("mouseover",function () {
                if ($("#plist").hasClass("plist-book")) {
                    return
                }
                var g = c.attr("bookid");
                c.css({"z-index":5});
                if (c.find(".summary").length == 1) {
                    c.find(".summary").show()
                }
                if (!g) {
                    return false
                } else {
                    c.append(a.fragment[1]);
                    a.setPosition(c);
                    c.removeAttr("bookid");
                    var d = c.find(".con");
                    var f = (c.attr("e-tag") == "1");
                    var e = (!f ? a.dataUrl : a.edataUrl) + g + "&callback=?";
                    $.getJSON(e, function (q) {
                        var j = "";
                        var h = "";
                        var l = "";
                        var o = "";
                        var m = f ? q.FileFormat.trim() : "";
                        var p = q.Author ? q.Author.trim() + " 著 " : "";
                        var k = q.Editer ? q.Editer.trim() + " 编 " : "";
                        var n = q.Transfer ? q.Transfer.trim() + " 译 " : "";
                        var i = q.Drawer ? q.Drawer.trim() + " 绘 " : "";
                        h = p + k + n + i;
                        h = h.trim();
                        if (!h) {
                            h = "暂无"
                        }
                        if (m) {
                            if (m == "PDF" || m == "EXE" || m == "SWF" || m == "EPUB") {
                                l += '<b class="pc"></b>'
                            }
                            if (m == "EPUB" || m == "PDF") {
                                l += '<b class="iphone"></b><b class="ipad"></b>'
                            }
                            if (m == "APK" || m == "EPUB" || m == "PDF") {
                                l += '<b class="android"></b>'
                            }
                        }
                        if (h) {
                            o += a.fragment[2].replace("{name}", "作　　者：").replace("{value}", h)
                        }
                        if (q.Publishers) {
                            o += a.fragment[2].replace("{name}", "出 &nbsp;版 &nbsp;社：").replace("{value}", q.Publishers)
                        }
                        if (q.PublishTime) {
                            o += a.fragment[2].replace("{name}", "出版时间：").replace("{value}", q.PublishTime)
                        }
                        if (q.BatchNo > 0) {
                            o += a.fragment[2].replace("{name}", "版　　次：").replace("{value}", q.BatchNo)
                        }
                        if (q.Pages) {
                            o += a.fragment[2].replace("{name}", "页　　数：").replace("{value}", q.Pages)
                        }
                        if (q.PrintTime) {
                            o += a.fragment[2].replace("{name}", "印刷时间：").replace("{value}", q.PrintTime)
                        }
                        if (q.Format) {
                            o += a.fragment[2].replace("{name}", "开　　本：").replace("{value}", q.Format)
                        }
                        if (q.Papers) {
                            o += a.fragment[2].replace("{name}", "纸　　张：").replace("{value}", q.Papers)
                        }
                        if (q.PrintNo > 0) {
                            o += a.fragment[2].replace("{name}", "印　　数：").replace("{value}", q.PrintNo)
                        }
                        if (q.WordCount > 0) {
                            o += a.fragment[2].replace("{name}", "字　　数：").replace("{value}", q.WordCount)
                        }
                        if (m) {
                            o += a.fragment[2].replace("{name}", "文件格式：").replace("{value}", m)
                        }
                        if (q.ISBN) {
                            o += a.fragment[2].replace("{name}", "ＩＳＢＮ：").replace("{value}", q.ISBN)
                        }
                        if (q.FileSize > 0) {
                            o += a.fragment[2].replace("{name}", "文件大小：").replace("{value}", q.FileSize + "M")
                        }
                        if (l) {
                            o += a.fragment[2].replace("{name}", '<span class="carrier">\u652F\u6301\u8f7d\u4F53\uff1a</span>').replace("{value}", l)
                        }
                        j = a.fragment[0].replace(/\{img\}/, q.img).replace(/\{detaile\}/, o);
                        d.html(j)
                    })
                }
            }).bind("mouseout", function () {
                c.css({"z-index":0}).find(".summary").hide()
            })
        })
    }
};
(function () {
    if (typeof LogParm == "undefined") {
        LogParm = {ab:0, result_count:0}
    }
    if (typeof LogParm.rec_type == "undefined") {
        LogParm.rec_type = getQueryString("nr") == "" ? "0" : "10"
    }
    LogParm.ev = getQueryString("ev") ? "1" : "0";
    if (getQueryString("cid1")) {
        LogParm.cid = getQueryString("cid1")
    } else {
        if (getQueryString("cid2")) {
            LogParm.cid = getQueryString("cid2")
        } else {
            if (getQueryString("cid3")) {
                LogParm.cid = getQueryString("cid3")
            } else {
                LogParm.cid = ""
            }
        }
    }
    LogParm.psort = getQueryString("psort") ? getQueryString("psort") : "";
    LogParm.page = getQueryString("page") ? getQueryString("page") : "1"
})();
window.searchlog = function () {
    var c = Array.prototype.slice.call(arguments, 0), b, e = c[0] == 0 ? QUERY_KEYWORD : window.REAL_KEYWORD || QUERY_KEYWORD;
    if (c[0] == "e") {
        var f = encodeURIComponent(LogParm.ekey) + "^#psort#^#page#^#cid#^" + encodeURIComponent(document.referrer);
        c.shift();
        c.push(QUERY_KEYWORD)
    } else {
        var f = encodeURIComponent(e) + "^#psort#^#page#^#cid#^" + encodeURIComponent(document.referrer)
    }
    var g = "http://sstat.360buy.com/scslog?args=";
    if (c.length > 0) {
        if (c[0] == 0) {
            LogParm.front_cost = LogParm.front_cost || "0";
            LogParm.back_cost = LogParm.back_cost || "0";
            LogParm.ip = LogParm.ip || "";
            b = g + LogParm.rec_type + "^" + f + "^^^" + LogParm.result_count + "^^" + LogParm.ev + "^" + LogParm.ab + "^" + LogParm.back_cost + "^" + LogParm.front_cost + "^" + LogParm.ip
        } else {
            if (c[0] == 1) {
                if (LogParm.rec_type != 10) {
                    b = g + "1^" + f + "^"
                } else {
                    b = g + "11^" + f + "^"
                }
                for (var d = 1; d < c.length; d++) {
                    b += encodeURI(c[d]) + "^"
                }
                if (c.length > 3 && c[3] == "51") {
                    LogParm.cid = c[1]
                }
                if (c.length > 3 && c[3] == "55") {
                    LogParm.psort = c[1]
                }
                if (c.length > 3 && c[3] == "56") {
                    LogParm.page = c[1]
                }
                for (var d = 0, a = (5 - c.length); d < a; d++) {
                    b += "^"
                }
                b += LogParm.ev + "^" + LogParm.ab
            }
        }
    }
    b = b.replace("#cid#", LogParm.cid);
    b = b.replace("#psort#", LogParm.psort);
    b = b.replace("#page#", LogParm.page);
    $.getScript(b)
};
searchlog(0, 0, window.REAL_KEYWORD || QUERY_KEYWORD);
var adLoadFlag = 2;
var adLogStr = new Array();
function getQueryString(a) {
    var b = new RegExp("(^|\\?|&)" + a + "=([^&]*)(\\s|&|$)", "i");
    if (b.test(location.href)) {
        return RegExp.$2
    }
    return""
}
function handleAdLeft(g) {
    var f = "";
    var d = "";
    var c = "";
    var b = "";
    if (g.length > 0) {
        for (var e = 0; e < g.length; e++) {
            b = encodeURIComponent(e.toString(10) + "," + g[e].wareid + "," + g[e].product_url);
            c += e.toString(10) + ":" + g[e].wareid + ",";
            d = "<li sku='" + g[e].wareid + "'" + (e == 0 ? " class='fore'" : "") + " onclick='searchlog(1, \"" + g[e].wareid + '", ' + e + ', 81);JA.tracker.adclick("' + b + "\");'>";
            d += "<div class='p-img'>";
            d += "<a target='_blank' href='" + g[e].product_url + "'>";
            d += "<img width='100' height='100' src='" + g[e].image_url + "' />";
            d += "</a>";
            sIco = g[e].ico;
            var a = "";
            if (null != sIco && "0" != sIco) {
                a = "pi" + sIco
            } else {
                if ("1" == g[e].ware_type) {
                    a = "pi-ebook"
                }
            }
            d += "<div class='" + a + "' shop_id='" + g[e].shop_id + "'></div>";
            d += "</div>";
            d += "<div class='rate'>";
            d += "<a target='_blank' href='" + g[e].product_url + "'>";
            g[e].waretitle = g[e].waretitle || "";
            d += g[e].warename + "<font style='color:#ff0000' class='adwords'>" + g[e].waretitle + "</font>";
            d += "</a>";
            d += "</div>";
            d += "<div class='p-price'" + (g[e].is_elec == "0" ? "" : " id='djd" + g[e].wareid + "'") + ">";
            d += "<em></em><strong><img src='" + g[e].price_url + '\' onerror=\'this.className="err-price";this.src="http://misc.360buyimg.com/lib/img/e/blank.gif"\' /></strong>';
            d += "</div>";
            d += "</li>";
            f += d
        }
        $("#left_ad").html(f);
        $("#ad_left").removeClass("hide")
    }
    return c
}
function handleAdBottom(d) {
    var f = "";
    var g = "";
    var j = "";
    var c = "";
    var a = "";
    if (d.length > 0) {
        var h = d.length;
        if (h > 3 && window.pageConfig.wideVersion != true) {
            h = 3
        }
        for (var e = 0; e < h; e++) {
            j = d[e].wareid.toString(10);
            a = encodeURIComponent((e + 6).toString(10) + "," + j + "," + d[e].product_url);
            c += (e + 6).toString(10) + ":" + j + ",";
            g = "<li sku='" + j + "'" + (j.length == 8 && j.charAt(0) == "1" ? " class='item-book' bookid='" + d[e].wareid + "'" : "") + " onclick='searchlog(1, \"" + j + '", ' + (e + 6) + ', 82);JA.tracker.adclick("' + a + "\");'>";
            g += "<div class='p-img'>";
            g += "<a target='_blank' href='" + d[e].product_url + "'>";
            g += "<img width='160' height='160' src='" + d[e].image_url + "' />";
            g += "</a>";
            sIco = d[e].ico;
            var b = "";
            if (null != sIco && "0" != sIco) {
                b = "pi" + sIco
            } else {
                if ("1" == d[e].ware_type) {
                    b = "pi-ebook"
                }
            }
            g += "<div class='" + b + "' shop_id='" + d[e].shop_id + "'></div>";
            g += "</div>";
            g += "<div class='p-name'>";
            g += "<a target='_blank' href='" + d[e].product_url + "'>";
            d[e].waretitle = d[e].waretitle || "";
            g += d[e].warename + "<font style='color:#ff0000' class='adwords'>" + d[e].waretitle + "</font>";
            g += "</a>";
            g += "</div>";
            if (j.length == 8) {
                g += "<div class='p-info'></div>"
            }
            g += "<div class='p-price'" + (d[e].is_elec == "0" ? "" : " id='djd" + d[e].wareid + "'") + ">";
            g += "<em></em><strong><img src='" + d[e].price_url + '\' onerror=\'this.className="err-price";this.src="http://misc.360buyimg.com/lib/img/e/blank.gif"\' /></strong>';
            g += "</div>";
            g += "</li>";
            f += g
        }
        $("#bottom_ad").html(f);
        $("#shop-choice").removeClass("hide");
        $("#shop-choice li").hover(function () {
            $(this).addClass("hover1")
        }, function () {
            $(this).removeClass("hover1")
        })
    }
    return c
}
function adLeftCallback(d) {
    if ("undefined" != typeof(d)) {
        var c = d.result;
        if ("undefined" != typeof(c)) {
            adLogStr[0] = handleAdLeft(c);
            adLoadFlag--;
            if (adLoadFlag == 0) {
                var a = "";
                for (var b = 0; b < adLogStr.length; b++) {
                    a += adLogStr[b]
                }
                if (a.length > 1) {
                    a = a.substring(0, a.length - 1);
                    $(document).ready(function () {
                        JA.tracker.adshow(encodeURIComponent(a))
                    })
                }
            }
        }
    }
}
function adBottomCallback(d) {
    if ("undefined" != typeof(d)) {
        var b = d.result;
        if ("undefined" != typeof(b)) {
            adLogStr[1] = handleAdBottom(b);
            adLoadFlag--;
            if (adLoadFlag == 0) {
                var a = "";
                for (var c = 0; c < adLogStr.length; c++) {
                    a += adLogStr[c]
                }
                if (a.length > 1) {
                    a = a.substring(0, a.length - 1);
                    $(document).ready(function () {
                        JA.tracker.adshow(encodeURIComponent(a))
                    })
                }
            }
        }
    }
}
function searchAd() {
    if (getQueryString("cid1") != "" || getQueryString("cid2") != "" || getQueryString("cid3") != "" || $("#selected_attrs").length > 0) {
        return
    }
    var a = 2;
    adLoadFlag = a;
    for (var e = 0; e < a; e++) {
        adLogStr[e] = ""
    }
    var d = "http://ad.360buy.com/index.php?keyword=" + encodeURIComponent(QUERY_KEYWORD) + "&area=" + getQueryString("area") + "&rel_cat=" + encodeURIComponent(rel_cat) + "&enc=utf-8&t=" + new Date().getTime();
    var b = $("#selected_attrs").length;
    if (b > 0) {
        d += "&ev=1";
        adLoadFlag--
    } else {
        if (getQueryString("psort") == "" && getQueryString("wtype") == "" && getQueryString("cid2") == "" && getQueryString("cid3") == "") {
            d += "&page=" + getQueryString("page") + "&pagesize=24"
        }
    }
    var c = d + "&pos=left&callback=adLeftCallback";
    asyncScript(c);
    if (b <= 0) {
        var f = d + "&pos=bottom&callback=adBottomCallback";
        asyncScript(f)
    }
}
function shop_search(a) {
    if (a == "") {
        return
    }
    $.ajax({url:"shop.php", data:{shop_id:a}, dataType:"json", success:function (c) {
        if (typeof c != "object" || !c.logo) {
            return
        }
        var b = '<div class="store-logo"><a href="{#url#}" onclick="searchlog(1, \'{#shop_id#}\', 0, 58)" target="_blank"><img src="{#logo#}" alt="{#name#}"></a></div><div class="store-info"><h2><a href="{#url#}" onclick="searchlog(1, \'{#shop_id#}\', 0, 58)" target="_blank">{#name#}</a></h2><div class="shop-about">{#brief#}</div></div><div class="store-number" {#visible#}><dl><dd id="evaluate"><em>服务评价：</em><span class="heart-white"><span class="heart-red h{#star#}">&nbsp;</span></span><em title="{#full_score#}分">{#score#}分</em></dd></dl></div><a href="{#url#}" class="go-store" onclick="searchlog(1, \'{#shop_id#}\', 0, 58)" target="_blank">进入店铺</a>';
        c.score = c.score || 0;
        c.full_score = Math.floor(c.score * 10000) / 10000;
        c.score = Math.floor(c.score * 10) / 10;
        c.visible = c.score > 0 ? "" : 'style="visibility:hidden"';
        c.star = c.score.toFixed(0);
        if (c.name && c.name.length > 14) {
            c.name = c.name.substr(0, 14) + "..."
        }
        if (c.brief && c.brief.length > 20) {
            c.brief = c.brief.substr(0, 20) + "..."
        }
        b = template(b, c);
        if (b != "") {
            $("#flagship-store").html(b).show()
        }
    }})
}
function filtUrl(d, c) {
    var e, f;
    if (!d && !c) {
        return""
    } else {
        if (!c) {
            e = window.location.href;
            f = d
        } else {
            e = d;
            f = c
        }
    }
    return e.replace(new RegExp("(^|\\?|&)" + f + "=([^&]*)", "i"), "")
}
function jumpto() {
    var a = parseInt($(".pagin .jumpto").val(), 10);
    if (a > 0) {
        if (window.view_type == undefined) {
            window.location.href = filtUrl("page") + "&page=" + a
        } else {
            window.location.href = filtUrl(filtUrl("page"), "vt") + "&vt=" + window.view_type + "&page=" + a
        }
    }
}
(function () {
    var c = "", a = $(".shop-name[shop_id]");
    if (a.length < 1) {
        return
    }
    for (var b = 0; b < a.length; b++) {
        c += $(a[b]).attr("shop_id") + ","
    }
    $.getJSON("ShopName.php", {ids:c}, function (e) {
        if (typeof e != "object") {
            $(".shop-name[shop_id]").remove();
            return
        }
        for (var d in e) {
            var g = e[d], f = a.filter("[shop_id='" + g.id + "']");
            f.html('<a href="' + g.url + '" onclick="searchlog(1, ' + g.id + ', 0, 58)" target="_blank">' + g.title + "</a>");
            f.removeAttr("shop_id")
        }
        $(".shop-name[shop_id]").remove()
    })
})();
(function () {
    var a = $("#select .price-range");
    if (a.length < 1) {
        return
    }
    a.keypress(function (c) {
        if (!$.browser.mozilla) {
            if (c.keyCode && (c.keyCode < 48 || c.keyCode > 57) && c.keyCode != 46) {
                c.preventDefault()
            }
        } else {
            if (c.charCode && (c.charCode < 48 || c.charCode > 57) && c.keyCode != 46) {
                c.preventDefault()
            }
        }
    });
    a.blur(function (g) {
        var d = $(this), c = $.trim(d.val()), f = new RegExp("^[0-9]+(.[0-9]{2})?$", "g");
        if (!f.test(c)) {
            d.val("")
        }
        g = g || event;
        b(g)
    });
    function b(c) {
        c.stopPropagation ? c.stopPropagation() : c.celBubble = true
    }

    $(".btn-determine").click(function () {
        var f = a.eq(0).val(), c = a.eq(1).val(), d = $(this).attr("url");
        f = parseInt(f, 10);
        c = parseInt(c, 10);
        if (!isNaN(f) && !isNaN(c)) {
            if (f > c) {
                var e = f;
                f = c;
                c = e
            }
            searchlog(1, 0, 0, 22, "鄹?:" + f + "-" + c);
            window.location.href = d.replace("min", f).replace("max", c)
        } else {
            if (!isNaN(f)) {
                searchlog(1, 0, 0, 22, "价格::" + f + "gt");
                window.location.href = d.replace("min", f).replace("-max", "gt")
            } else {
                if (!isNaN(c)) {
                    searchlog(1, 0, 0, 22, "价格::0-" + c);
                    window.location.href = d.replace("min", 0).replace("max", c)
                }
            }
        }
    })
})();
(function () {
    var f = $("#select-hold").html("<b></b>展开").attr("class", "open"), l = $("#select-brand .content div"), n = screen.width >= 1200, i = n ? l.slice(15).hide() : l.slice(12).hide(), d = $("#select-brand .tab"), k = $("#select-brand .content"), e = d.find(".curr").attr("rel"), c, j = [], a = filtUrl("ev") + "&ev=" + getQueryString("ev"), h = "可搜索拼音、汉字查找品牌", g, m = function (r, q) {
        if (!r instanceof Array) {
            return
        }
        var o = "";
        q = $.trim(q);
        for (var b = 0; b < r.length; b++) {
            var s = r[b];
            var p = htmlspecialchars(r[b].brand);
            if (q != "0" && q != "" && s.zimu != q) {
                continue
            }
            o += '<div><a href="' + a + "exbrand_" + encodeURIComponent(s.brand) + '" onclick="searchlog(1,0,0,71,\'品牌::' + p.replace("'", "\\'") + '\')" title="' + p + '">' + p + "</a></div>"
        }
        if (o == "") {
            return"抱歉，未找到相关的品牌"
        }
        return o
    };
    if ((n && l.length > 15) || (!n && l.length > 12)) {
        f.bind("click", function () {
            var b = $(this);
            if (b.attr("class") != "close") {
                if (j.length == 0) {
                    k.find("div").each(function () {
                        var p = $(this), o = p.find("a"), q = {};
                        q.brand = o.attr("title");
                        q.zimu = p.attr("rel");
                        j.push(q)
                    });
                    d.find("li").bind("click", function () {
                        d.find(".curr").removeClass("curr");
                        $(this).addClass("curr");
                        k.html(m(j, $(this).attr("rel")));
                        $("#brand-search").val(h)
                    })
                }
                k.html(m(j));
                if ($.trim(window.brand_ids)) {
                    $("#brand-search").css("display", "inline-block")
                }
                d.show();
                k.css({height:"150px", "overflow-y":"auto", border:"1px solid #ddd", padding:"3px 0 3px 10px", margin:"0 0 8px"});
                f.html("<b></b>收起").attr("class", "close")
            } else {
                $("#brand-search").hide();
                d.hide();
                k.html(m(j.slice(0, n ? 15 : 12)));
                k.css({height:"auto", "overflow-y":"visible", border:"none", padding:"0", margin:"0"});
                f.html("<b></b>展开").attr("class", "open");
                d.find(".curr").removeClass("curr");
                d.find("li[rel='0']").addClass("curr")
            }
            searchlog(1, 0, 0, 50)
        })
    } else {
        f.attr("class", "hide")
    }
    window.brand_search_result = function (o) {
        if (typeof o != "object") {
            return
        }
        var b = "";
        k.html(m(o))
    };
    $("#brand-search").val(h).click(function () {
        if ($(this).val() == h) {
            $(this).val("");
            var b = d.find(".curr");
            if (b.attr("rel") != "0") {
                b.removeClass("curr");
                d.find("li[rel='0']").addClass("curr");
                k.html(m(j))
            }
        }
        searchlog(1, 0, 0, 49)
    }).blur(function () {
        if ($(this).val() == "") {
            $(this).val(h)
        }
    }).keyup(function (o) {
        if (o.keyCode == 13) {
            var b = k.find("a");
            if (b.length == 1) {
                window.location.href = b.attr("href");
                return
            }
        }
        var p = $(this).val();
        if (p == g) {
            return
        }
        if (p != "") {
            sGetScript("http://bsearch.360buy.com/?callback=brand_search_result&ids=" + brand_ids + "&key=" + encodeURIComponent($(this).val()), "UTF-8", true)
        } else {
            k.html(m(j))
        }
        g = p
    })
})();
$("#select dl:first").addClass("fore");
$("#list-unselected").click(function () {
    $(this).addClass("list-curr");
    $("#grid-unselected").removeClass("grid-curr");
    $("#grid-unselected").addClass("grid-unselected");
    $("#plist").addClass("plist-book")
});
$("#grid-unselected").click(function () {
    $(this).addClass("grid-curr");
    $("#list-unselected").removeClass("list-curr");
    $("#list-unselected").addClass("list-unselected");
    $("#plist").removeClass("plist-book")
});
$("#list-unselected,#grid-unselected").click(function () {
    if (window.view_type == undefined) {
        $("#refilter a, #select a, #filter a:not(#list-unselected,#grid-unselected), #pagin-btm a").click(function (a) {
            a.preventDefault();
            var b = $(this).attr("href");
            window.location.href = filtUrl(b, "vt") + "&vt=" + window.view_type
        })
    }
    window.view_type = ($(this).attr("id") == "list-unselected") ? 1 : 2
});