/**
 * Created with JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-7-31
 * Time: 下午4:09
 */
var product = {};
//产品收藏
product.favoriteProduct = function(pId, bingingId)
{
    if ( !wx.isEmpty(pId)) {
        wx.showPop('参数不全', bingingId);
        //art.dialog({ title:false, follow: document.getElementById(bingingId), content: '<span style="font-weight: bold;color: #a10000;">参数不全</span>' });
        return false;
    }

    if (bingingId == '' || bingingId == undefined) {
        bingingId = '';
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'product/favorite/add';
    var param = 'pid='+pId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.favoriteProductLayer(1, bingingId);
        return true;
    }

    var status = 4;
    switch (data.error) {
        case '20012':status = 4; break;
        case '10009':wx.loginLayer(); break;
        case '20002':status = 3; break;
        case '20010':status = 2; break;
        case '20011':status = 4; break;
    }

    wx.favoriteProductLayer(status, bingingId);

    return false;
}

//删除产品收藏
product.deleteFavoriteProduct = function(pId, bingingId)
{
    if (confirm('确定删除收藏的产品！')) {
        if (!wx.isEmpty(pId)) {
            //art.dialog({ title:false, follow: document.getElementById(bingingId), content: '<span style="font-weight: bold;color: #a10000;">参数不全</span>' });
            wx.showPop('参数不全', bingingId);
            return false;
        }

        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/product/favorite/deleteFavorite';
        var param = 'fid='+pId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        var prompt = '系统繁忙，请稍后再试';
        switch (data.error) {
            case '20015':prompt = '参数不全'; break;
            case '10009':wx.loginLayer(); break;
            case '20014':prompt = '系统繁忙，请稍后再试'; break;
        }

        //art.dialog({ title:false, follow: document.getElementById(bingingId), content: '<span style="font-weight: bold;color: #a10000;">'+prompt+'</span>' });
        wx.showPop(prompt, bingingId);
        return data;
    }
}

//清空产品收藏
product.emptyFavorite = function(bindingId)
{
    if (confirm('您确定要清空收藏夹里的所有产品！')) {
        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/product/favorite/emptyFavorite';
        var param = '';
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        var prompt = '系统繁忙，请稍后再试';
        switch (data.error) {
            case '10009':wx.loginLayer(); break;
            case '20017':prompt = '系统繁忙，请稍后再试'; break;
        }

        //art.dialog({ title:false, follow: document.getElementById(bingingId), content: '<span style="font-weight: bold;color: #a10000;">'+prompt+'</span>' });
        wx.showPop(prompt, bindingId);

        alert('系统繁忙，请稍后再试!');
    }
}


//评论产品 -- 检测用户是否购买过此产品 -- 是否已经评论过
product.productComment = function (pId, bindingId)
{
    if ( !wx.isEmpty(pId) ) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'product/comment/isBuyProduct';
    var param = 'pid='+pId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.productCommentLayer(data.data.pid, data.data.pname);
        return true;
    }

    var prompt = '';
    switch (data.error) {
        case '50002':prompt = '您尚未购买此商品或订单未完成，还不能对产品进行评论。';break;
        case '50019':prompt = '您已评论过此商品。';break;
        default :prompt = '此商品不存在。';
    }

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'</span><br/>' });
    wx.showPop(prompt, bindingId);
}

//产品评论 pId 产品ID, title 标题, content 内容, rank 商品评分, comfort 合适度评分, exterior外观评分, size_deviation 尺寸偏差
product.productCommentSubmit = function (bindingId)
{
    var pId = document.getElementById('pid').value;
    var title = document.getElementById('title').value;
    var content = document.getElementById('content').value;
    var rank = document.getElementById('p_s_s_id').value;
    var comfort = document.getElementById('p_c_s_id').value;
    var exterior = document.getElementById('p_e_s_id').value;
    var size_deviation = wx.getRadioCheckBoxValue('size_deviation');
    //var pId = document.getElementById('size_deviation').value;

    if ( !wx.isEmpty(title) || title.length < 5) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">评论标题为空或少于5个字。</span><br/>' });
        wx.showPop('评论标题为空或少于5个字。', bindingId);
        return false;
    }

    if ( !wx.isEmpty(content) || content.length < 5) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">评论内容为空或少于5个字。</span><br/>' });
        wx.showPop('评论内容为空或少于5个字。', bindingId);
        return false;
    }

    if ( !wx.isEmpty(pId) || !wx.isEmpty(title) || !wx.isEmpty(content) || !wx.isEmpty(rank) || !wx.isEmpty(comfort) || !wx.isEmpty(exterior) || !wx.isEmpty(size_deviation) ) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">请认真填写评论内容。</span><br/>' });
        wx.showPop('请认真填写评论内容。', bindingId);
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'product/comment/addComment';
    var param = 'pid='+pId+'&title='+title+'&content='+content+'&rank='+rank+'&comfort='+comfort+'&exterior='+exterior+'&size_deviation='+size_deviation;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.layerClose();
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">评论成功。</span><br/>' });
        wx.showPop('评论成功。', bindingId);
        return true;
    }

    var prompt = '';
    switch (data.error) {
        case '20002':prompt = '此商品不存在';break;
        case '50002':prompt = '您没有购买过此商品';break;
        case '50019':prompt = '你已评论过此商品';break;
        case '50003':prompt = '系统繁忙，请稍后再试';break;
    }

    if (data.error == '50019') {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
        wx.showPop(prompt, bindingId);
        return false;
    }

    return data;
}

//评论回复
product.commentReply = function(commentId, bindingId)
{
    var html = '\
        <div id="comment_reply_html_code">\
        <input type="hidden" value="'+commentId+'" name="comment_id" id="comment_id">\
        <textarea rows="" cols="" name="content" id="content"/><br/>\
        <input type="button" value="回复" onclick="product.commentReplySubmit('+bindingId+')">\
        </div>\
        ';

    $('#'+bindingId).html(html);
}

//评论回复提交
product.commentReplySubmit = function (bindingId)
{
    var commentId = document.getElementById('comment_id').value;
    var content = document.getElementById('content').value;

    if ( !wx.isEmpty(content) || content.length < 5) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">内容为空或小于5个字。</span><br/>' });
        wx.showPop('内容为空或小于5个字。', bindingId);
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'product/comment/commentReply';
    var param = 'comment_id='+commentId+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">回复成功。</span><br/>' });
        wx.showPop('回复成功。', bindingId);
        $('#comment_reply_html_code').remove();
        return true;
    }

    return data;
}

//评论是否有效 commentId 评论ID， operaType 操作类型 0为无效， 0为有效
product.commentIsInvalid = function (commentId, operaType, bindingId)
{
    if ( !wx.isEmpty(commentId)) {
        return false;
    }

    var url = 'product/comment/CommentIsValid';
    var param = 'comment_id='+commentId+'&opera_type='+operaType;
    var data = wx.ajax(url, param);

    var prompt = '已成功';
    switch (data.error) {
        case '0': prompt = '已成功';break;
        case '50008': prompt = '参数不全';break;
        case '50009': prompt = '系统繁忙，请稍后再试';break;
    }

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
    wx.showPop(prompt, bindingId);

    return data;
}

//删除产品评论
product.deleteProductComment = function(cId, bindingId)
{
    if (confirm('确定删除！')) {
        if (!wx.isEmpty(cId)) {
            return false;
        }

        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/product/comment/deleteComment';
        var param = 'cid='+cId;
        var data = wx.ajax(url, param);

        var prompt = '已删除成功';
        switch (data.error) {
            case '0': prompt = '已删除成功';break;
            case '20021': prompt = '参数不全';break;
            case '20022': prompt = '系统繁忙，请稍后再试';break;
            case '10009': wx.loginLayer();break;
        }

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        wx.showPop(prompt, bindingId);
    }
}

//添加产品问答
product.addProductQa = function (pId, bindingId)
{
    if ( !wx.isEmpty(pId) ) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'product/qa/checkQaProduct';
    var param = 'pid='+pId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.productQaLayer(data.data);
        return true;
    }

    var prompt = '已提过问题';
    switch (data.error) {
        case '50010': prompt = '参数不全';break;
        case '20002': prompt = '产品不存在';break;
        case '10009': wx.loginLayer();break;
        case '20027': prompt = '已提过问题';break;
    }

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
    wx.showPop(prompt, bindingId);

    return true;
}

//添加产品问答提交
product.addProductQaSubmit = function (bindingId)
{
    var pId = parseInt(document.getElementById('pid_id').value);
    var title = document.getElementById('title_id').value;
    var content = document.getElementById('content_id').value;
    var qaType = parseInt(wx.getRadioCheckBoxValue('q_type'));

    if ( !wx.isEmpty(pId)) {
        wx.showPop('产品ID为空', bindingId);
        return false;
    }

    if ( title == '' || title.length < 5 || title.length > 50) {
        wx.showPop('问题小于5或大于50个字符', bindingId);
        return false;
    }

    if ( content == '' || content.length < 5 || content.length > 100) {
        wx.showPop('问题描述小于5或大于100个字符', bindingId);
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'product/qa/addQa';
    var param = 'pid='+pId+'&title='+title+'&content='+content+'&qa_type='+qaType;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.layerClose();
        wx.showPop('提问成功');
        return true;
    }

    var prompt = '系统繁忙，请稍后再试';
    switch (data.error) {
        case '50010': prompt = '参数不全';break;
        case '20002': prompt = '产品不存在';break;
        case '10009': wx.loginLayer();break;
        case '20027': prompt = '已提过问题';break;
        case '50011': prompt = '系统繁忙，请稍后再试';break;
    }

    wx.showPop(prompt, bindingId);

    return data;
}

//产品问答是否有效  qaId 问答ID， operaType 操作类型 0为无效， 0为有效
product.qaIsValid = function (qaId, operaType, bindingId)
{
    if ( !wx.isEmpty(qaId)) {
        return false;
    }

    var url = 'product/qa/postProductQAIsValid';
    var param = 'qa_id='+qaId+'&opera_type='+operaType;
    var data = wx.ajax(url, param);

    /*
    if (data.error == '0') {
        return true;
    }
    //*/
    var prompt = '已成功';
    switch (data.error) {
        case '0': prompt = '已成功';break;
        case '50015': prompt = '参数不全';break;
        case '50014': prompt = '系统繁忙，请稍后再试';break;
    }

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
    wx.showPop(prompt, bindingId);
    return data;
}

//产品问答回复
product.qaReply = function (qaId, content)
{
    if ( !wx.isEmpty(qaId) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'product/qa/postProductQAReply';
    var param = 'qa_id='+qaId+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

product.deleteProductQa = function(qId, bindingId)
{
    if (confirm('确定删除！')) {
        if (!wx.isEmpty(qId)) {
            return false;
        }

        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/product/qa/deleteProductQa';
        var param = 'qa_id='+qId;
        var data = wx.ajax(url, param);

        /*
        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }
        //*/

        wx.pageReload();

        var prompt = '已删除成功';
        switch (data.error) {
            case '0': prompt = '已删除成功';break;
            case '20024': prompt = '参数不全';break;
            case '20023': prompt = '系统繁忙，请稍后再试';break;
            case '10009': prompt = '用户未登陆';break;
        }

        wx.showPop(prompt, bindingId);
    }
}

//产品晒单
product.productShare = function (pId, bindingId)
{
    if ( !wx.isEmpty(pId) ) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">参数不全。</span><br/>' });
        wx.showPop('参数不全。', bindingId);
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = '/product/share/isBuyProduct';
    var param = 'pid='+pId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.productShareLayer(data.data.pid, data.data.pname);
        return true;
    }

    if (data.error == '0') {
        wx.productShareLayer(pId);
        return true;
    }

    var prompt = '系统繁忙，请稍后再试';
    switch (data.error) {
        case '50008': prompt = '晒单参数不全';break;
        case '50002': prompt = '您没有购买过此产品';break;
        case '50020': prompt = '您已对此产品进行过晒单';break;
    }

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
    wx.showPop(prompt, bindingId);
}

//产品晒单提交
product.productShareSubmit = function (bindingId)
{
    var title = document.getElementById('share_title_id').value;
    var content = document.getElementById('share_content_id').value;
    var file = document.getElementById('share_file_id').value;

    if (title.length < 5 || title.length > 50) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">标题小于5或小于50个字符。</span><br/>' });
        wx.showPop('标题小于5或小于50个字符。', bindingId);
        return false;
    }

    if (content.length < 5 || content.length > 80) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">内容小于5或小于80个字符。</span><br/>' });
        wx.showPop('内容小于5或小于80个字符。', bindingId);
        return false;
    }

    if ( !wx.isEmpty(file) ) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">请上传要晒单的图片。</span><br/>' });
        wx.showPop('请上传要晒单的图片。', bindingId);
        return false;
    }

    document.product_share_form.submit();
}

//晒单评论提交
product.shareReplySubmit = function (sId, content, bindingId)
{
    if ( !wx.isEmpty(sId) || !wx.isEmpty(content) ) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">参数不全。</span><br/>' });
        wx.showPop('参数不全。', bindingId);
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'product/share/comment';
    var param = 'sid='+sId+'&content='+content;
    var data = wx.ajax(url, param);

    var prompt = '系统繁忙，请稍后再试';
    switch (data.error) {
        case '20020': prompt = '晒单参数不全';break;
        case '20019': prompt = '系统繁忙，请稍后再试';break;
        case '0': prompt = '评论成功';break;
    }

    art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
    wx.showPop(prompt, bindingId);
}

//喜欢晒单图片
product.likeShareImage = function (siId, bindingId)
{
    if ( !wx.isEmpty(siId) ) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">参数不全。</span><br/>' });
        wx.showPop('参数不全。', bindingId);
        return false;
    }

    var url = 'product/share/likeShareImage';
    var param = 'img_id='+siId;
    var data = wx.ajax(url, param);

    var prompt = '系统繁忙，请稍后再试';
    switch (data.error) {
        case '20009': prompt = '参数不全';break;
        case '20008': prompt = '系统繁忙，请稍后再试';break;
        case '0': prompt = '喜欢成功';break;
    }

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
    wx.showPop(prompt, bindingId);
}

//申请退换货
product.applyReturn = function (pId, order_sn, bindingId)
{
    if ( !wx.isEmpty(pId) || !wx.isEmpty(order_sn)) {
        //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">参数不全。</span><br/>' });
        wx.showPop('参数不全。', bindingId);
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = '/product/share/isBuyProduct';
    var param = 'pid='+pId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        wx.goToUrl(wx.base_url+'user/center/addReturn?pid='+pId+'&order_sn='+order_sn);
        //wx.productShareLayer(data.data.pid, data.data.pname);
        return true;
    }

    var prompt = '系统繁忙，请稍后再试';
    switch (data.error) {
        case '50008': prompt = '申请退换货参数不全';break;
        case '50002': prompt = '您没有购买过此产品';break;
        //case '50020': prompt = '您已对此产品进行过晒单';break;
    }

    //art.dialog({ title:false, follow: document.getElementById(bindingId), time: 5, content: '<br/><span style="color: #A10000;font-weight: bold;">'+prompt+'。</span><br/>' });
    wx.showPop(prompt, bindingId);
}