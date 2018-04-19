<div style="width:75%;margin-right:5%;float:left">
    <h1><?=h($post['Post']['title'])?></h1>
    <p>
        <small>Ngày lên bài: <?=date('d/m/Y H:i:s', $post['Post']['created'])?> | Lượt xem: <?=$post['Post']['view_count']?></small>
    </p>
    <p><?=h($post['Post']['content'])?></p>
</div>
<div style="width:20%;float:left">
    <h1>Danh sách người dùng</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
        </tr>
		<? foreach ($users as $user) { ?>
            <tr>
                <td><?=$user['User']['id']?></td>
                <td><?=$user['User']['username']?></td>
            </tr>
		<? } ?>
    </table>
</div>
<div style="clear:both"></div>
<div style="width:48%;margin-right:2%;float:left">
    <h2>Danh sách bài viết</h2>
    <ul>
		<? foreach ($posts as $post) { ?>
            <li>
				<?=$this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['slug']))?>
            </li>
		<? } ?>
    </ul>
</div>
<div style="width:48%;float:left">
    <h2>Bài viết mới cập nhật</h2>
    <ul id="newest">
		<li>Loading...</li>
    </ul>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            dataType: 'html',
            type: "POST",
            evalScripts: true,
            url: '<?= Router::url(array('controller'=>'posts','action'=>'list_ajax'));?>',
            data: ({type:'original'}),
            success: function (data){
                $('#newest').replaceWith(data);
            }
        });
    })
</script>