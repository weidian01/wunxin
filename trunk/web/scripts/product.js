/**
 * Created with JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-7-31
 * Time: 下午4:09
 */
var product = {};
//产品收藏
product.favoriteProduct = function(pId)
{
    if ( !wx.isEmpty(pId)) {
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'product/product_favorite/favorite';
    var param = 'pid='+pId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//删除产品收藏
product.deleteFavoriteProduct = function(pId)
{
    if (confirm('确定删除收藏的产品！')) {
        if (!wx.isEmpty(pId)) {
            return false;
        }

        if ( !wx.isLogin() ) {
            return 0;
        }

        var url = '/product/product_favorite/deleteFavorite';
        var param = 'fid='+pId;
        var data = wx.ajax(url, param);

        if (data.error == '20013') {
            wx.pageReload(0);
            return true;
        }

        return data;
    }
}

//清空产品收藏
product.emptyFavorite = function()
{
    if (confirm('您确定要清空收藏夹里的所有产品！')) {
        if ( !wx.isLogin() ) {
            return 0;
        }

        var url = '/product/product_favorite/emptyFavorite';
        var param = '';
        var data = wx.ajax(url, param);

        if (data.error == '20016') {
            wx.pageReload(0);
            return true;
        }

        alert('清空产品收藏失败!');
    }
}


//产品评论 pId 产品ID, title 标题, content 内容, rank 商品评分, comfort 合适度评分, exterior外观评分, size_deviation 尺寸偏差
product.productComment = function (pId, title, content, rank, comfort, exterior, size_deviation)
{
    if ( !wx.isEmpty(pId) || !wx.isEmpty(title) || !wx.isEmpty(content) || !wx.isEmpty(rank) || !wx.isEmpty(comfort) || !wx.isEmpty(exterior) || !wx.isEmpty(size_deviation) ) {
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'product/comment/addComment';
    var param = 'pid='+pId+'&title='+title+'&content='+content+'&rank='+rank+'&comfort='+comfort+'&exterior='+exterior+'&size_deviation='+size_deviation;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//评论回复
product.commentReply = function (commentId, content)
{
    if ( !wx.isEmpty(commentId) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'product/comment/commentReply';
    var param = 'comment_id='+commentId+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//评论是否有效 commentId 评论ID， operaType 操作类型 0为无效， 0为有效
product.commentIsInvalid = function (commentId, operaType)
{
    if ( !wx.isEmpty(commentId)) {
        return false;
    }

    var url = 'product/comment/CommentIsValid';
    var param = 'comment_id='+commentId+'&opera_type='+operaType;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

product.deleteProductComment = function(cId)
{
    if (confirm('确定删除！')) {
        if (!wx.isEmpty(cId)) {
            return false;
        }

        var url = '/product/comment/deleteComment';
        var param = 'cid='+cId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        alert('删除失败!');
    }
}

//添加产品问答
product.addQa = function (pId, title, content)
{
    if ( !wx.isEmpty(pId) || !wx.isEmpty(title) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'product/qa/addQa';
    var param = 'pid='+pId+'&title='+title+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//产品问答是否有效  qaId 问答ID， operaType 操作类型 0为无效， 0为有效
product.qaIsValid = function (qaId, operaType)
{
    if ( !wx.isEmpty(qaId)) {
        return false;
    }

    var url = 'product/qa/postProductQAIsValid';
    var param = 'qa_id='+qaId+'&opera_type='+operaType;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//产品问答回复
product.qaReply = function (qaId, content)
{
    if ( !wx.isEmpty(qaId) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.isLogin() ) {
        return 0;
    }

    var url = 'product/qa/postProductQAReply';
    var param = 'qa_id='+qaId+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

product.deleteProductQa = function(qId)
{
    if (confirm('确定删除！')) {
        if (!wx.isEmpty(qId)) {
            return false;
        }

        if ( !wx.isLogin() ) {
            return 0;
        }

        var url = '/product/qa/deleteProductQa';
        var param = 'qa_id='+qId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        alert('删除失败!');
    }
}