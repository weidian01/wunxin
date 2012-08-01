/**
 * Created with JetBrains PhpStorm.
 * User: Evan Hou
 * Date: 12-7-31
 * Time: 下午6:25
 * To change this template use File | Settings | File Templates.
 */
var design = {};

//收藏设计图
design.favoriteDesign = function (dId)
{
    if ( !wx.isEmpty(dId)) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'design/favorite/add';
    var param = 'design_id='+dId;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//删除设计图收藏
design.deleteFavorite = function (dId)
{
    if (confirm('确定删除此设计图收藏！')) {
        if (!wx.isEmpty(dId)) {
            return false;
        }

        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/design/favorite/deleteFavorite';
        var param = 'design_id='+dId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        alert('删除失败!');
    }
}

//清空设计图收藏
design.emptyFavorite = function ()
{
    if (confirm('确定清空所有设计图收藏！')) {
        if ( !wx.isLogin() ) {
            return 0;
        }

        var url = '/design/favorite/emptyFavorite';
        var param = '';
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        alert('删除失败!');
    }
}

//评论设计图
design.comment = function (dId, title, content)
{
    if ( !wx.isEmpty(dId) || !wx.isEmpty(title) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'design/comment/add';
    var param = 'did='+dId+'&title='+title+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

//设计图评论回复
design.commentReply = function (commentId, content)
{
    if ( !wx.isEmpty(commentId) || !wx.isEmpty(content) ) {
        return false;
    }

    if ( !wx.checkLoginStatus() ) {
        return false;
    }

    var url = 'design/comment/Reply';
    var param = 'comment_id='+commentId+'&content='+content;
    var data = wx.ajax(url, param);

    if (data.error == '0') {
        return true;
    }

    return data;
}

design.deleteComment = function(cId)
{
    if (confirm('确定删除此产品评论！')) {
        if (!wx.isEmpty(cId)) {
            return false;
        }

        if ( !wx.checkLoginStatus() ) {
            return false;
        }

        var url = '/design/comment/delete';
        var param = 'comment_id='+cId;
        var data = wx.ajax(url, param);

        if (data.error == '0') {
            wx.pageReload(0);
            return true;
        }

        return data;
    }
}