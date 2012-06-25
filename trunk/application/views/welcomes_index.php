<?php include 'header.php';?>
<div class="box2">
    <div class="container">
        <div id="idContainer2" class="focus">
            <table id="idSlider2" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <?php foreach ($broadcast_recommend as $brv) {?>
                    <td class="td_f"><a href="<?php echo $brv['link'];?>" target="_blank"><img src="<?php echo base_url().str_replace('\\', '/', $brv['img_addr']);?>" alt="<?php echo $brv['title'];?>"></a></td>
                    <?php }?>
                    <!--
                    <td class="td_f"><a href="#" target="_blank"><IMG src="images/f2.jpg"></a></td>
                    <td class="td_f"><a href="#" target="_blank"><IMG src="images/f3.jpg"></a></td>
                    <td class="td_f"><a href="#" target="_blank"><IMG src="images/f4.jpg"></a></td>
                    -->
                </TR>
                </tbody>
            </table>
            <ul id="idNum" class="num"></ul>
        </div>
        <SCRIPT>
            var forEach = function (array, callback, thisObject) {
                if (array.forEach) {
                    array.forEach(callback, thisObject);
                } else {
                    for (var i = 0, len = array.length; i < len; i++) {
                        callback.call(thisObject, array[i], i, array);
                    }
                }
            }

            var st = new SlideTrans("idContainer2", "idSlider2", <?php echo count($broadcast_recommend);?>, { Vertical:false });

            var nums = [];
            //插入数字
            for (var i = 0, n = st._count - 1; i <= n;) {
                (nums[i] = $("idNum").appendChild(document.createElement("li"))).innerHTML = ++i;
            }

            forEach(nums, function (o, i) {
                o.onmouseover = function () {
                    o.className = "on";
                    st.Auto = false;
                    st.Run(i);
                }
                o.onmouseout = function () {
                    o.className = "";
                    st.Auto = true;
                    st.Run();
                }
            })

            //设置按钮样式
            st.onStart = function () {
                forEach(nums, function (o, i) {
                    o.className = st.Index == i ? "on" : "";
                })
            }
            st.Run();
        </SCRIPT>
        <div class="tod-act">
            <div class="today">
                <div class=" hp-carousel-cata" id="j-carousel-cata">
                    <div class="today-h">
                        <div class="act">
                            <ul>
                                <li class="prev">prev</li>
                                <li class="next">next</li>
                            </ul>
                        </div>
                    </div>
                    <div class="bd">
                        <div class="j-sw-clip">
                            <ul class="j-sw-c" style="width: 678px; ">
                                <?php foreach ($day_recommend as $drv) {?>
                                <li style="display: block; float: left; ">
                                    <a target="_blank" title="" href="<?php echo $drv['link'];?>"><img alt="<?php echo $drv['title'];?>" src="<?php echo base_url().str_replace('\\', '/', $drv['img_addr']);?>" width="95" height="120"></a>
                                </li>
                                <?php }?>
                                <!--
                                <li style="display: block; float: left; ">
                                    <a target="_blank" title="Euromoda 童趣 2012 春号" href="#"><img alt="Euromoda 童趣 2012 春号" src="images/s2.jpg" width="95" height="120"></a>
                                </li>
                                -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--今日推荐end-->
            <div class="bulletin">
                <div class="blt-h"><span id="bullt1" class="curr" onclick="showbox('blt1')">最新公告</span> <span
                    id="bullt2" onclick="showbox('blt2')">最新动态</span></div>
                <div class="blt-cont" id="blt1">
                    <ul>
                        <li><a href="#">BERNINI 姐妹花时装玩家</a></li>
                        <li><a href="#">抓住三大要素 打造日系美人</a></li>
                        <li><a href="#">Chanel秀后派对 香粉靓过超模</a></li>
                        <li><a href="#">揭秘《甄嬛传》中珠宝造型</a></li>
                        <li><a href="#">范冰冰"真假"男友逐个数</a></li>
                        <li><a href="#">不同星座女星离婚表现大不同</a></li>
                    </ul>
                </div>
                <div class="blt-cont" id="blt2" style="display:none;">
                    <ul>
                        <li><a href="#">网友节完美闭幕感谢网友</a></li>
                        <li><a href="#">从农村走出来的女孩的悲哀</a></li>
                        <li><a href="#">旅人实拍丰都名山幽幂鬼城</a></li>
                        <li><a href="#">揭秘《甄嬛传》中珠宝造型</a></li>
                        <li><a href="#">剩女博士相亲连遭老男青眼</a></li>
                        <li><a href="#">不同星座女星离婚表现大不同</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="box2">
    <div class="container tp">
        <div class="slide">
            <ul>
                <li class="norm"><img alt="五色上下装搭配" src="images/sd1.jpg" width="164" height="210"/></li>
                <li class="norm"><img alt="五色上下装搭配" src="images/sd2.jpg" width="164" height="210"/></li>
                <li class="curr"><img alt="五色上下装搭配" src="images/sd5.jpg" width="204" height="269"/></li>
                <li class="norm"><img alt="五色上下装搭配" src="images/sd3.jpg" width="164" height="210"/></li>
                <li class="norm"><img alt="五色上下装搭配" src="images/sd4.jpg" width="164" height="210"/></li>
            </ul>
            <div class="slide-pre"><a href="#"></a></div>
            <div class="slide-next"><a href="#"></a></div>
        </div>
    </div>
</div>
<div class="box2 pad3">
<div class="container tp">
<div class="slide-ad">
    <div class="ad-btn">
        <span class="ad-btn1" onmouseover="showAD('ad','1')"><a href="#">PROMOTION SITE</a></span>
        <span class="ad-btn2" onmouseover="showAD('ad','2')"><a href="#">SHOP SITE</a></span>
        <span class="ad-btn3" onmouseover="showAD('ad','3')"><a href="#">PROMOTION SITE</a></span>
    </div>
    <ul>
        <?php $i = 1;foreach ($AD_recommend as $arv) {?>
        <li id="ad<?php echo $i;?>" style="<?php echo $i == 1 ? '' : 'display:none;';?>">
            <a href="<?php echo $arv['link'];?>">
                <img alt="<?php echo $arv['title'];?>" src="<?php echo base_url().str_replace('\\', '/', $arv['img_addr']);?>" width="978" height="200"/>
            </a>
        </li>
        <?php $i++;}?>
        <!--
        <li id="ad2" style="display:none;"><img alt="广告一" src="images/ad2.jpg" width="978" height="200"/></li>
        <li id="ad3" style="display:none;"><img alt="广告一" src="images/ad3.jpg" width="978" height="200"/></li>
        -->
    </ul>
</div>
<div class="prodbox">
<div class="prod-tit">
    <div class="prod-t-h"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>

        </ul>
    </div>
</div>
<div class="prod-bd">
    <div class="men-l">
        <div class="men-p">
            <div class="pro-pic">
                <a href="#"><img src="images/m1.jpg" width="120" height="120" alt="T恤"/></a>
            </div>
            <div class="men-cont"><span class="font2">CDSB567890</span><br/> Justyle 素色经典短袖T恤<br/> <span class="font3">￥49,000</span></div>
        </div>
        <div class="men-p">
            <div class="pro-pic"><a href="#"><img src="images/m2.jpg" width="120" height="120" alt="T恤"/></a></div>
            <div class="men-cont"><span class="font2">CDSB567890</span><br/> 诠渡良品英伦休闲纯色polo衫<br/> <span class="font3">￥49,000</span></div>
        </div>
        <div class="men-p">
            <div class="pro-pic"><a href="#"><img src="images/m3.jpg" width="120" height="120" alt="T恤"/></a></div>
            <div class="men-cont"><span class="font2">CDSB567890</span><br/> Justyle 素色经典短袖T恤<br/> <span class="font3">￥49,000</span></div>
        </div>
        <div class="men-p">
            <div class="pro-pic"><a href="#"><img src="images/m1.jpg" width="120" height="120" alt="T恤"/></a></div>
            <div class="men-cont"><span class="font2">CDSB567890</span><br/> Justyle 素色经典短袖T恤<br/> <span class="font3">￥49,000</span></div>
        </div>
    </div>
    <div class="prod-ct"><img src="images/m4.jpg" alt="t恤" width="186" height="280"/></div>
    <div class="prod-ct"><img src="images/m5.jpg" width="186" height="280" alt="T恤"/></div>
    <div class="clear"></div>
    <div class="men-bd">
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d3.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥802.00</span></div>
        </div>
    </div>
</div>
<!--男款end-->
<div class="prod-tit titbg2">
    <div class="prod-t-h h-bg"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>

        </ul>
    </div>
</div>
<div class="prod-bd pad">
    <div class="toplady">
        <div class="floorMain" onmouseout="disshowmask('picmt')"><a href="#" class="item1"><img id="picmt1"
                                                                                                onmouseover="showmask('1','picmt')"
                                                                                                src="images/y1.jpg"
                                                                                                alt="万象网" width="237"
                                                                                                height="300"> </a>
            <a href="#" class="item2"><img id="picmt2" onmouseover="showmask('2','picmt')" src="images/y2_01.jpg"
                                           alt="万象网" width="237" height="150"></a>
            <a href="#" class="item3"><img id="picmt3" onmouseover="showmask('3','picmt')" src="images/y2_02.jpg"
                                           alt="万象网" width="237" height="150"></a>
            <a href="#" class="item4"><img id="picmt4" onmouseover="showmask('4','picmt')" src="images/y3.jpg" alt="万象网"
                                           width="237" height="300"></a>
            <a href="#" class="item5"><img id="picmt5" onmouseover="showmask('5','picmt')" src="images/y4_01.jpg"
                                           alt="万象网" width="237" height="150"></a>
            <a href="#" class="item6"><img id="picmt6" onmouseover="showmask('6','picmt')" src="images/y4_02.jpg"
                                           alt="万象网" width="237" height="150"></a></div>
    </div>
    <div class="men-bd pad7">
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"
                                                                  alt="闲短袖T恤"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d3.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
    </div>
</div>
<!--女款T恤end-->
<div class="prod-tit titbg3">
    <div class="prod-t-h h-bg2"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>

        </ul>
    </div>
</div>
<div class="prod-bd pad5">
    <div class="sweet"><img src="images/bigimg.jpg" width="948" height="299" alt="情侣T恤"/></div>
    <div class="men-bd pad7">
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d3.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
    </div>
</div>
<div class="prod-tit titbg4">
    <div class="prod-t-h h-bg3"></div>
    <div class="prod-n-more">
        <ul>
            <li class="cm"><a href="#" target="_blank">查看更多</a></li>
            <li><a href="#" target="_blank">特卖</a></li>
            <li><a href="#" target="_blank">新品</a></li>
            <li><a href="#" target="_blank">热卖</a></li>
            <li><a href="#" target="_blank">T恤</a></li>
            <li><a href="#" target="_blank">连衣裙</a></li>
            <li><a href="#" target="_blank">半裙</a></li>
            <li><a href="#" target="_blank">衬衫</a></li>
            <li><a href="#" target="_blank">背心/吊带衫</a></li>
            <li><a href="#" target="_blank">小西装</a></li>
            <li><a href="#" target="_blank">裤子</a></li>
            <li><a href="#" target="_blank">薄针织</a></li>
            <li style="background:none;"><a href="#" target="_blank">牛仔裤</a></li>

        </ul>
    </div>
</div>
<div class="prod-bd pad6">
    <div class="toplady">
        <div class="floorMain" onmouseout="disshowqz('qz')"><a href="#" class="qv1"><img id="qz1"
                                                                                         onmouseover="showqz('1','qz')"
                                                                                         src="images/q2.jpg" alt="万象网"
                                                                                         width="264" height="300"></a>
            <a href="#" class="qv2"><img id="qz2" onmouseover="showqz('2','qz')" src="images/q1.jpg" alt="万象网"
                                         width="447" height="220"></a>
            <a href="#" class="qv3"><img id="qz3" onmouseover="showqz('3','qz')" src="images/q3_01.jpg" alt="万象网"
                                         width="149" height="80"></a>
            <a href="#" class="qv4"><img id="qz4" onmouseover="showqz('4','qz')" src="images/q3_02.jpg" alt="万象网"
                                         width="149" height="80"></a>
            <a href="#" class="qv5"><img id="qz5" onmouseover="showqz('5','qz')" src="images/q3_03.jpg" alt="万象网"
                                         width="149" height="80"></a>
            <a href="#" class="qv6"><img id="qz6" onmouseover="showqz('6','qz')" src="images/q4.jpg" alt="万象网"
                                         width="237" height="220"></a>
            <a href="#" class="qv7"><img id="qz7" onmouseover="showqz('7','qz')" src="images/q5.jpg" alt="万象网"
                                         width="237" height="80"></a></div>
    </div>
    <div class="men-bd pad7">
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d3.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d2.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
        <div class="men-bd-b"><a class="productimg" href="#"><img src="images/d1.jpg" width="163" height="163"/></a>

            <div class="pro-n">
                <p><a href="#">时尚帅气军旅风男士休闲短袖T恤</a></p>
                <span class="font4">￥82.00</span></div>
        </div>
    </div>
</div>
<!--亲子装end-->
<div class="brand">
    <div class="left-brand" onmouseout="disshowbrandpic('bdimg')">
        <ul>
            <li><img id="bdimg1" onmouseover="showbrandpic('1','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg2" onmouseover="showbrandpic('2','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg3" onmouseover="showbrandpic('3','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg4" onmouseover="showbrandpic('4','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg5" onmouseover="showbrandpic('5','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg6" onmouseover="showbrandpic('6','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg7" onmouseover="showbrandpic('7','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg8" onmouseover="showbrandpic('8','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg9" onmouseover="showbrandpic('9','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg10" onmouseover="showbrandpic('10','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg11" onmouseover="showbrandpic('11','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
            <li><img id="bdimg12" onmouseover="showbrandpic('12','bdimg')" src="images/br1.jpg" width="90" height="90"
                     alt="brand1"/></li>
        </ul>
    </div>
    <div class="rgt-p">
        <div class="brand-pro">
            <div class="brand-proimg"><a href="#"><img src="images/n1.gif" width="180" height="206"/></a></div>
            <p>Bessie 梦幻镂空网纱大荷叶领</p>
            <span class="font4">￥135.90</span></div>
        <div class="brand-pro">
            <div class="brand-proimg"><a href="#"><img src="images/n1.gif" width="180" height="206"/></a></div>
            <p>Bessie 梦幻镂空网纱大荷叶领</p>
            <span class="font4">￥135.90</span></div>
        <div class="brand-ad"><img src="images/n5.gif" width="169" height="288" alt="广告"/></div>
    </div>
</div>
</div>
</div>
</div>
<?php include 'footer.php';?>