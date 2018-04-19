<? foreach ($posts as $post) { ?>
	<li>
		<?=$this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['slug']))?>
	</li>
<? } ?>