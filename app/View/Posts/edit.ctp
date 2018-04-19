<h1>Chỉnh sửa bài viết</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title', array('label' => 'Tiêu đề'));
echo $this->Form->input('content', array('rows' => '3', 'label' => 'Nội dung'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Lưu');
?>