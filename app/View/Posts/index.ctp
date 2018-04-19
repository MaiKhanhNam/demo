<div style="width:75%;margin-right:5%;float:left">
    <div>
	    <?=$this->Form->create('Post', array('action' => 'search', 'type' => 'get'))?>
	    <?=$this->Form->input('keyword', array('label' => 'Tìm kiếm'))?>
	    <?=$this->Form->end('Tìm kiếm')?>
    </div>
    <h1>Danh sách tin tức</h1>
    <p><?=$this->Html->link("Thêm tin tức", array('action' => 'add'))?></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Ngày lên bài</th>
            <th>Ngày chỉnh sửa</th>
            <th>Thao tác</th>
        </tr>
		<? foreach ($posts as $post) { ?>
            <tr>
                <td><?=$post['Post']['id']?></td>
                <td>
					<?=$this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['slug']))?>
                </td>
                <td>
					<?=date('d/m/Y H:i:s', $post['Post']['created'])?>
                </td>
                <td>
					<?=date('d/m/Y H:i:s', $post['Post']['modified'])?>
                </td>
                <td>
					<?=$this->Html->link('Sửa', array('action' => 'edit', $post['Post']['slug']))?>
					<?=$this->Form->postLink('Xóa', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Bạn có chắc muốn xóa bài viết này không?'))?>
                </td>
            </tr>
		<? } ?>
    </table>
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