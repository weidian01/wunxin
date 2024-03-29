/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-6
 * Time: 下午2:22
 * To change this template use File | Settings | File Templates.
 */
//最近动态与公告切换
function showbox(a)
{
    if (a == "blt1") {
        document.getElementById(a).style.display = "";
        document.getElementById("blt2").style.display = "none";
        document.getElementById("bullt1").className = "curr";
        document.getElementById("bullt2").className = ""

    } else {
        document.getElementById(a).style.display = "";
        document.getElementById("blt1").style.display = "none";
        document.getElementById("bullt2").className = "curr";
        document.getElementById("bullt1").className = ""
    }
}

//切换显示广告
function showAdvert(t)
{
    //if ( !wx.isEmpty(t) ) return ;
    //console.log(t);
    $('.index_recommend_ad').each(function(){
        $(this).hide();
    });
    /*
    for (var i = 1; i <= 3; i++) {
        document.getElementById(a + i).style.display = "none";
    }
    //*/
    $('#'+t).fadeIn("fast");
    //document.getElementById(t).style.display = 'block';
    //t.style.display = 'block';
}

//隐藏层
function hideLayer (elementId, number)
{
    for (var i = 1; i < number; i++) {
        document.getElementById(elementId + i).className = "picm2";
    }
}

//显示层
function showLayer(elementId, elementName, number)
{
    for (var i = 1; i < number; i++) {
        document.getElementById(elementName + i).className = "picm";
    }
    document.getElementById(elementName + elementId).className = "picm2";
}

var get = function (id)
{
    return "string" == typeof id ? document.getElementById(id) : id;
};

var Extend = function(destination, source)
{
    for (var property in source) {
        destination[property] = source[property];
    }
    return destination;
}

var CurrentStyle = function(element)
{
    return element.currentStyle || document.defaultView.getComputedStyle(element, null);
}

var Bind = function(object, fun)
{
    var args = Array.prototype.slice.call(arguments).slice(2);
    return function() {
        return fun.apply(object, args.concat(Array.prototype.slice.call(arguments)));
    }
}

var Tween = {
    Quart: {
        easeOut: function(t,b,c,d){
            return -c * ((t=t/d-1)*t*t*t - 1) + b;
        }
    },
    Back: {
        easeOut: function(t,b,c,d,s){
            if (s == undefined) s = 1.70158;
            return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
        }
    },
    Bounce: {
        easeOut: function(t,b,c,d){
            if ((t/=d) < (1/2.75)) {
                return c*(7.5625*t*t) + b;
            } else if (t < (2/2.75)) {
                return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
            } else if (t < (2.5/2.75)) {
                return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
            } else {
                return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
            }
        }
    }
}

//容器对象,滑动对象,切换数量
var SlideTrans = function(container, slider, count, options)
{
    this._slider = get(slider);
    this._container = get(container);//容器对象
    this._timer = null;//定时器
    this._count = Math.abs(count);//切换数量
    this._target = 0;//目标值
    this._t = this._b = this._c = 0;//tween参数
    this.Index = 0;//当前索引
    this.SetOptions(options);
    this.Auto = !!this.options.Auto;
    this.Duration = Math.abs(this.options.Duration);
    this.Time = Math.abs(this.options.Time);
    this.Pause = Math.abs(this.options.Pause);
    this.Tween = this.options.Tween;
    this.onStart = this.options.onStart;
    this.onFinish = this.options.onFinish;

    var bVertical = !!this.options.Vertical;
    this._css = bVertical ? "top" : "left";//方向

    //样式设置
    var p = CurrentStyle(this._container).position;
    p == "relative" || p == "absolute" || (this._container.style.position = "relative");
    this._container.style.overflow = "hidden";
    this._slider.style.position = "absolute";

    this.Change = this.options.Change ? this.options.Change :
        this._slider[bVertical ? "offsetHeight" : "offsetWidth"] / this._count;
};
SlideTrans.prototype = {
  //设置默认属性
  SetOptions: function(options) {
    this.options = {//默认值
        Vertical:	true,//是否垂直方向（方向不能改）
        Auto:		true,//是否自动
        Change:		0,//改变量
        Duration:	50,//滑动持续时间
        Time:		10,//滑动延时
        Pause:		4000,//停顿时间(Auto为true时有效)
        onStart:	function(){},//开始转换时执行
        onFinish:	function(){},//完成转换时执行
        Tween:		Tween.Quart.easeOut//tween算子
    };
    Extend(this.options, options || {});
  },
  //开始切换
  Run: function(index) {
    //修正index
    index == undefined && (index = this.Index);
    index < 0 && (index = this._count - 1) || index >= this._count && (index = 0);
    //设置参数
    this._target = -Math.abs(this.Change) * (this.Index = index);
    this._t = 0;
    this._b = parseInt(CurrentStyle(this._slider)[this.options.Vertical ? "top" : "left"]);
    this._c = this._target - this._b;

    this.onStart();
    this.Move();
  },
  //移动
  Move: function() {
    clearTimeout(this._timer);
    //未到达目标继续移动否则进行下一次滑动
    if (this._c && this._t < this.Duration) {
        this.MoveTo(Math.round(this.Tween(this._t++, this._b, this._c, this.Duration)));
        this._timer = setTimeout(Bind(this, this.Move), this.Time);
    }else{
        this.MoveTo(this._target);
        this.Auto && (this._timer = setTimeout(Bind(this, this.Next), this.Pause));
    }
  },
  //移动到
  MoveTo: function(i) {
    this._slider.style[this._css] = i + "px";
  },
  //下一个
  Next: function() {
    this.Run(++this.Index);
  },
  //上一个
  Previous: function() {
    this.Run(--this.Index);
  },
  //停止
  Stop: function() {
    clearTimeout(this._timer); this.MoveTo(this._target);
  }
};

var forEach = function (array, callback, thisObject) {
    if (array.forEach) {
        array.forEach(callback, thisObject);
    } else {
        for (var i = 0, len = array.length; i < len; i++) {
            callback.call(thisObject, array[i], i, array);
        }
    }
}


/*
//设计图滚动 代码开始
$(function(){
    $("#tktktkt").jCarouselLite({
        btnNext:".slide-next",
        btnPrev:".slide-pre"
    });
});
//*/
$(function () {
    $('#top-menu li').hover(
            function () {
                $('ul', this).slideDown(200);
            },
            function () {
                $('ul', this).slideUp(200);
            });
});

$(function () {
    $(".click").click(function () {
        $("#panel").slideToggle("slow");
        $(this).toggleClass("active");
        return false;
    });
});

$(function () {
    $('.fade').hover(
            function () {
                $(this).fadeTo("slow", 0.5);
            },
            function () {
                $(this).fadeTo("slow", 5);
            });
});
//设计图滚动 代码结束

var index = {};

//改变用户 -- 切换用户产品
index.changeUser = function (uId)
{
    if ( !wx.isEmpty(uId) ) {
        return false;
    }

    var url = '/index/getUserProduct';
    var param = 'uid='+uId;
    var data = wx.ajax('/main/getUserProduct', 'uid='+uId);

    if ( !wx.isEmpty(data) ) {
        return false;
    }

    var html = '';
    for (var i in data) {
        html += '<div class="brand-pro">\
            <div class="brand-proimg"><a href="'+wx.productURL(data[i].pid)+'" title="'+data[i].pname+', ￥'+wx.fPrice(data[i].sell_price)+'" target="_blank">\
            <img src="'+wx.img_url+'product/'+idToPath(data[i].pid)+'default.jpg" width="160" height="186"/></a></div>\
            <p><a href="'+wx.productURL(data[i].pid)+'" title="'+data[i].pname+', ￥'+wx.fPrice(data[i].sell_price)+'" target="_blank">'+data[i].pname+'</a></p>\
            <span class="font4">￥'+wx.fPrice(data[i].sell_price)+'</span></div>';
    }

    $('#user_product_id').html(html);
}