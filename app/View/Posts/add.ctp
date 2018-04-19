<h1>Thêm tin tức</h1>
<?=$this->Form->create('Post')?>
<?=$this->Form->input('title', array('label' => 'Tiêu đề'))?>
<?=$this->Form->input('content', array('rows' => '3', 'label' => 'Nội dung'))?>
<?=$this->Form->end('Lưu')?>