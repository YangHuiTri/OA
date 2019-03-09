<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/css/base.css" />
    <link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
    <link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
    <title>移动办公自动化系统</title>
    <style type='text/css'>
    table tr .id {
        width: 63px;
        text-align: center;
    }
    
    table tr .name {
        width: 118px;
        padding-left: 17px;
    }
    
    table tr .nickname {
        width: 63px;
        padding-left: 17px;
    }
    
    table tr .dept_id {
        width: 63px;
        padding-left: 13px;
    }
    
    table tr .sex {
        width: 63px;
        padding-left: 13px;
    }
    
    table tr .birthday {
        width: 80px;
        padding-left: 13px;
    }
    
    table tr .tel {
        width: 113px;
        padding-left: 13px;
    }
    
    table tr .email {
        width: 160px;
        padding-left: 13px;
    }
    
    table tr .addtime {
        width: 160px;
        padding-left: 13px;
    }
    
    table tr .operate {
        padding-left: 13px;
    }
    </style>
</head>

<body>
    <div class="title">
        <h2>邮件管理</h2></div>
    <div class="table-operate ue-clear">
        <a href="/index.php/Admin/Email/add" class="add">添加</a>
        <a href="javascript:;" class="del">删除</a>
        <a href="javascript:;" class="edit">编辑</a>
        <a href="javascript:;" class="check">审核</a>
    </div>
    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th class="id">序号</th>
                    <th class="name">发件人</th>
                    <th class="name">标题</th>
                    <th class="file">附件</th>
                    <th class="content">内容</th>
                    <th class="addtime">发送时间</th>
                    <th class="status">状态</th>
                    <th class="operate">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                        <td class="id"><?php echo ($vol["id"]); ?></td>
                        <td class="name"><?php echo ($vol["truename"]); ?></td>
                        <td class="name"><?php echo ($vol["title"]); ?></td>
                        <td class="file"><?php if($vol["hasfile"] == 1): ?><a href='/index.php/Admin/Email/download/id/<?php echo ($vol["id"]); ?>'><?php echo ($vol["filename"]); ?></a><?php endif; ?></td>
                        <td class="content"><?php echo ($vol["content"]); ?></td>
                        <td class="addtime"><?php echo (date('Y-m-d H:i:s',$vol["addtime"])); ?></td>
                        <td class="status">
                            <?php if($vol["isread"] == 0): ?><span style="color: blue;">未读</span>
                                <?php else: ?><span style="color: violet;">已读</span><?php endif; ?>
                        </td>
                        <td class="operate">
                            <a href='javascript:;' class="show" data="<?php echo ($vol["id"]); ?>" data-title="<?php echo ($vol["title"]); ?>" isread="<?php echo ($vol["isread"]); ?>">查看</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination ue-clear">
        <div class="pagin-list">
            <?php echo ($page); ?>
        </div>
        <div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
    </div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Admin/plugin/layer/layer.js"></script>
<script type="text/javascript">
$(".select-title").on("click", function() {
    $(".select-list").hide();
    $(this).siblings($(".select-list")).show();
    return false;
})
$(".select-list").on("click", "li", function() {
    var txt = $(this).text();
    $(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

$("tbody").find("tr:odd").css("backgroundColor", "#eff6fa");

showRemind('input[type=text], textarea', 'placeholder');
//jQuery代码
$(function() {
    //给查看按钮绑定点击事件
    $('.show').on('click', function() {
        //事件处理程序
        var id = $(this).attr('data');
        var title = $(this).attr('data-title');
        var isread = $(this).attr('isread');
        layer.open({
            type: 2,
            title: title,
            shadeClose: true,
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['893px', '500px'],
            content: '/index.php/Admin/Email/getContent/id/' + id,
            end: function(){
                //处理关闭的操作
                if(isread == 0){
                    window.location.href = location.href;
                    //window.location.reload();
                }
            }
        });
    });
});
</script>

</html>