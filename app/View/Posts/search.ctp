<div>
	<?=$this->Form->create('Post', array('action' => 'search', 'type' => 'get'))?>
	<?=$this->Form->input('keyword', array('label' => 'Tìm kiếm'))?>
	<?=$this->Form->end('Tìm kiếm')?>
</div>
<h1>Kết quả tìm kiếm</h1>
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